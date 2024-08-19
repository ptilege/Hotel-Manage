<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client as Twilio;


class ChatController extends Controller
{
    public function sendWhatsappMsg() {
        $sid    = getenv("TWILIO_AUTH_SID");
        $token  = getenv("TWILIO_AUTH_TOKEN");
        $wa_from= getenv("TWILIO_WHATSAPP_FROM");
        $recipient = '+94703982131';
        $twilio = new Twilio($sid, $token);

        $body = "Hello, welcome to codelapan.com.";

        $twilio->messages->create("whatsapp:$recipient",["from" => "whatsapp:$wa_from", "body" => $body]);

        return redirect()->back();

    }
}
