<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\PaymentGateways\PayHere\PayHereGateway;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{

    public function handlePages(Request $request) {

        $routeName = $request->route()->getName();
        switch ($routeName) {
            case 'contact':
                // dd($request->route()->getName());
                return Inertia::render('Contact/Index');
                break;
            case 'about':
                // dd($request->route()->getName());
                return Inertia::render('AboutUs/Index');
                break;
            case 'privacy':
                // dd($request->route()->getName());
                return Inertia::render('PrivacyPolicy/Index');
                 break;
            case 'terms':
                // dd($request->route()->getName());
                return Inertia::render('TermsAndConditions/Index');
                break;
            case 'faq':
                // dd($request->route()->getName());
                return Inertia::render('Faq/Index');
                break;
            case 'work':
                // dd($request->route()->getName());
                return Inertia::render('HowItWorks/Index');
                break;
            case 'home':
                // dd($request->route()->getName());
                return Inertia::render('Home/Index');
                break;
            
            default:
                # code...
                break;
        }
    }

    public function payhereRedirect($id) {
        $booking = Booking::find($id);
        $data = PayHereGateway::payhereCheckout($booking);
        // dd($data);
        return view('payment-gateways.payhere', compact('data'));
    }
}
