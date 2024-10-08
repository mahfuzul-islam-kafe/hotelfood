<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date');

        $frm_date = $request->input('frm_date');

        $to_date = $request->input('to_date');

        if($frm_date && $to_date){
            $orders = Order::where('delivery_method', 'takeaway')->whereBetween('created_at', [$frm_date, $to_date])->get();
        }else{
            if ($date) {
                $orders = Order::where('delivery_method', 'takeaway')->whereDate('created_at', $date)->get();
            } else {
                $orders = Order::where('delivery_method', 'takeaway')->get();
            }
        }

    
        return view('admin.orders', compact('orders'));
    }

    public function indexDelivery(Request $request)
    {
        $date = $request->input('date');

        $frm_date = $request->input('frm_date');

        $to_date = $request->input('to_date');

        if($frm_date && $to_date){
            $orders = Order::where('delivery_method', 'delivery')->whereBetween('created_at', [$frm_date, $to_date])->get();
        }else{
            if ($date) {
                $orders = Order::where('delivery_method', 'delivery')->whereDate('created_at', $date)->get();
            } else {
                $orders = Order::where('delivery_method', 'delivery')->get();
            }
        }

        return view('admin.orders-delivery', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('orderDetails')->findOrFail($id);
        return view('admin.order-details', compact('order'));
    }
    public function updateOrders(Request $request)
    {
        $fromDate = $request->input('from');
        $toDate = $request->input('to');

        // Fetch updated orders based on the date range
        $ordersDijon = $this->getUpdatedOrders(1, $fromDate, $toDate);
        $ordersBelfort = $this->getUpdatedOrders(2, $fromDate, $toDate);
        $ordersBesancon = $this->getUpdatedOrders(3, $fromDate, $toDate);

        // Return the updated orders as JSON
        return response()->json([
            'dijon' => $ordersDijon,
            'belfort' => $ordersBelfort,
            'besancon' => $ordersBesancon,
        ]);
    }

    public function updateOrderStatus(Request $request)
    {
        $orderId = $request->input('orderId');
        $status = $request->input('status');

        // Update the order status
        $order = Order::find($orderId);
        $order->order_status = $status;
        $order->save();

        // Return the updated order status as JSON
        return response()->json([
            'orderId' => $orderId,
            'status' => $status,
        ]);
    }

    // Helper method to get updated orders based on restaurant ID and date range
    private function getUpdatedOrders($restId, $fromDate, $toDate)
    {
        return Order::where('rest_id', $restId)
            ->whereBetween('order_date', [$fromDate, $toDate])
            ->get();
    }
}