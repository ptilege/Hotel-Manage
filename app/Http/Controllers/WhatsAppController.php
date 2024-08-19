<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Handle incoming WhatsApp messages here
        $message = $request->body;
        // Process the message and send a response to WhatsApp
        // ...
    }
}
