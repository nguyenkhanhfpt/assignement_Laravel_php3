<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class SendMailContact extends Controller
{
    protected function sendMail(Request $request) {
        $datas = [
            'addressEmail' => $request->your_email,
            'content' => $request->review
        ];

        Mail::to('khanh26122000@gmail.com')->send(new ContactMail($datas));

        return redirect()->back()->with('successEmail', 'Cảm ơn bạn đã để lại ý kiến của mình');
    }
}
