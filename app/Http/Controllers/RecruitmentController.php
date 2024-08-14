<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RecruitmentController extends Controller
{
    public function sendEmail(Request $request)
    {
        $data = $request->all();

        Mail::send('emails.recruitment', $data, function($message) {
            $message->to('contact@centralsushi.fr')
                    ->subject('New Recruitment Form Submission');
        });

        return back()->with('success', 'Thank you for your application!');
    }
}