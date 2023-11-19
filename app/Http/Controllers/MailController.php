<?php

namespace App\Http\Controllers;

use App\Mail\notificationmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendmail(){
        $maildata = [
            'title' => 'mail by admin',
            'body' => 'send mail by admin'
        ];
        Mail::to('hiteshrana3204@gmail.com')->send(new notificationmail($maildata));

        dd(' mail -----sent');
    }
}
