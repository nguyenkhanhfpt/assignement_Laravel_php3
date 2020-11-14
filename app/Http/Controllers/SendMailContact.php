<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendMailContactJob;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class SendMailContact extends Controller
{
    protected function sendMail(Request $request) {
        $request->validate([
            'your_email' => 'required|email',
            'review' => 'required'
        ]);

        $datas = [
            'email' => $request->your_email,
            'content' => $request->review
        ];

        SendMailContactJob::dispatch($datas);

        return response()->json(['status' => 200, 'message' => trans('view.contact_success')]);
    }
}
