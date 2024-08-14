<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\Payment;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Models\PaymentResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class PaymentController extends Controller
{
    public function paymentOptions(Request $request)
    {

        return view('paymentOptions');
}

    public function paymentOptionsUpdate(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->first();

        return view('paymentOptions', compact('order'));
    }

    public function redirectPaymentMethod(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->first();
        $paymentMethod = $request->payment_method;

        if ($paymentMethod == 'cb-en-ligne') {
            if ($order->rest_id == 1) {
                return redirect()->route('payment-process-dijon', ['order_id' => $order->order_id]);
            } elseif ($order->rest_id == 2) {
                return redirect()->route('payment-process-besancon', ['order_id' => $order->order_id]);
            }
        }

        return view('paymentOptions', compact('order'));
    }
    public function paymentFinalize(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->first();

        $order->payment_status = 'pending';
        $order->order_status = 'terminé';
        $order->save();

        if ($order) {
            session()->forget('cart');
            session()->forget('cart-step');

            return view('finalPageSummary', compact('order'));
        }

        return redirect()->route('menu');
    }
    public function generatePaymentPage($order, $merchantId, $secretKey, $keyVersion, $normalRetrunUrl)
    {

        $amount = (int) ($order->payment->payment_amount * 100);
        $orderId = $order->order_id;

        $currencyCode = 978;

        $transactionReference = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $interfaceVersion = "HP_3.2";

        $data = 'amount=' . $amount . '|s10TransactionReference.s10TransactionId=' . $transactionReference . '|currencyCode=' . $currencyCode . '|merchantId=' . $merchantId . '|normalReturnUrl=' . $normalRetrunUrl . '|orderId=' . $orderId . '|keyVersion=' . $keyVersion;

        $seal = hash('sha256', mb_convert_encoding($data, 'UTF-8') . $secretKey);

        return Http::asForm()->post('https://sherlocks-payment-webinit.secure.lcl.fr/paymentInit', [
            'DATA' => $data,
            'SEAL' => $seal,
            'interfaceVersion' => $interfaceVersion,
        ]);
    }

    public function generatePaymentPageTest(Request $request)
    {
        $merchantId = '002016000000001';
        $secretKey = '002016000000001_KEY1';
        $keyVersion = 1;
        $normalReturnUrl = 'https://newtest.centralsushi.fr/payment-success-test';

        return $this->generatePaymentPage($request, $merchantId, $secretKey, $keyVersion, $normalReturnUrl);
    }

    public function generatePaymentPageBesancon($order_id)
    {
        $order = Order::where('order_id', $order_id)->first();
        
        $merchantId = '083262709500018';
        $secretKey = 'iPPdH5CgxCQV05UiWF5tK4tsu1wcWwbHL2KZWiFCDY0';
        $keyVersion = 3;
        $normalReturnUrl = 'https://newtest.centralsushi.fr/payment-success-besancon';

        return $this->generatePaymentPage($order, $merchantId, $secretKey, $keyVersion, $normalReturnUrl);
    }

    public function generatePaymentPageDijon($order_id)
    {
        $order = Order::where('order_id', $order_id)->first();

        $merchantId = '085323798000018';
        $secretKey = '3jihidtWLDLkBw8_lyks2y4dc8iDqUKSRMm9i3KefKU';
        $keyVersion = 4;
        $normalReturnUrl = 'https://newtest.centralsushi.fr/payment-success-dijon';


        return $this->generatePaymentPage($order, $merchantId, $secretKey, $keyVersion, $normalReturnUrl);
    }

    public function generatePaymentPageBelfort(Request $request)
    {
        $order = Order::where('order_id', $order_id)->first();

        $merchantId = '083262709500018';
        $secretKey = 'iPPdH5CgxCQV05UiWF5tK4tsu1wcWwbHL2KZWiFCDY0';
        $keyVersion = 3;
        $normalReturnUrl = 'https://newtest.centralsushi.fr/payment-success-belfort';

        return $this->generatePaymentPage($request, $merchantId, $secretKey, $keyVersion, $normalReturnUrl);
    }

    public function handlePaymentResponse(Request $request, $secretKey)
    {
        // Extract and validate response data
        $data = $request->input('Data');
        $seal = $request->input('Seal');

        $calculatedSeal = hash('sha256', mb_convert_encoding($data, 'UTF-8') . $secretKey);

        if ($calculatedSeal !== $seal) {
            // Invalid response, stop processing
            return response()->json(['error' => 'Invalid response'], 400);
        }

        // Decode and store the response data in the database
        $decodedData = urldecode($data);
        $responseData = array_map(function ($part) {
            return explode('=', $part, 2);
        }, explode('|', $decodedData));

        // Convert the array into an associative array
        $responseData = array_column($responseData, 1, 0);
        Log::info('Response Data:' . json_encode($responseData));

        // Create a new array with only the keys you're interested in
        $keysToStore = ['acquirerResponseCode', 'responseCode', 'amount', 'orderId', 's10TransactionId', 'merchantId', 'transactionReference', 'currencyCode', 'paymentMethod', 'paymentMeanBrand', 'transactionDateTime', 'cardNumber', 'cardNetwork', 'cardCountry'];
        $filteredData = array_filter($keysToStore, function ($key) use ($responseData) {
            return array_key_exists($key, $responseData);
        });

        // Get values for the filtered keys
        $filteredData = array_intersect_key($responseData, array_flip($filteredData));
        Log::info('Filtered Data:' . json_encode($filteredData));

        // Store $filteredData in the database
        $paymentrespone = PaymentResponse::create($filteredData);

        $orderId = $paymentrespone->orderId;

        $order = Order::where('order_id', $orderId)->first();

        $user = $order->user_id;
        Log::info('User:' . $user);
        if (!auth()->check()) {
            $userInstance = User::find($user);
            Auth::login($userInstance);
        }

        if ($paymentrespone->acquirerResponseCode == '00') {
            $order->payment_status = 'paid';
            $order->payment->payment_status = 'paid';
            $order->payment->payment_method = 'online';
            $order->payment->payment_process_id = $paymentrespone->id;
            $order->order_status = 'confirmed';
            $order->payment->save();
            $order->save();
            $statusMessage = 'Payment processed successfully';
        } else {
            $order->payment_status = 'failed';
            $order->order_status = 'failed';
            $order->save();
            $statusMessage = 'Payment failed. Please try again';
        }

        return redirect()->route('order-details', ['order_id' => $orderId])
            ->with('status', $statusMessage);
    }

    public function handlePaymentResponseDijon(Request $request)
    {
        $secretKey = '3jihidtWLDLkBw8_lyks2y4dc8iDqUKSRMm9i3KefKU'; // Replace with your actual secret key
        return $this->handlePaymentResponse($request, $secretKey);
    }

    public function handlePaymentResponseBesancon(Request $request)
    {
        // Extract and validate response data
        $secretKey = 'iPPdH5CgxCQV05UiWF5tK4tsu1wcWwbHL2KZWiFCDY0'; // Replace with your actual secret key
        return $this->handlePaymentResponse($request, $secretKey);
    }

    public function handlePaymentResponseTest(Request $request)
    {
        // Extract and validate response data
        $secretKey = '002016000000001_KEY1'; // Replace with your actual secret key
        return $this->handlePaymentResponse($request, $secretKey);
    }

    public function handlePaymentResponseBelfort(Request $request)
    {
        $secretKey = '002016000000001_KEY1'; // Replace with your actual secret key
        return $this->handlePaymentResponse($request, $secretKey);
    }
}
