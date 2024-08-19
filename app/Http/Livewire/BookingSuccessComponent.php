<?php

namespace App\Http\Livewire;

use App\Mail\MakeBooking;
use App\Models\Booking;
use App\Models\Settings;
use App\PaymentGateways\PayHere\PayHereGateway;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use BookingCart;

class BookingSuccessComponent extends Component
{
    public $hash;

    public function mount($hash)
    {
        $this->hash = $hash;
    }
    public function render()
    {
        $booking = Booking::find($this->hash);
        $mailList = Settings::where(['key' => 'booking_invoice_mails'])->first();
        $mailList = json_decode($mailList->value);
        
        if ($booking->transaction->payment_option_id == 'pay-here') {
            PayHereGateway::validateResponseSignature(request()->all());
            Mail::to($booking->email)->cc($mailList->cc)->bcc($mailList->bcc)->send(new MakeBooking($booking));
            // Mail::to($booking->email)->cc(['bookings@roomista.com', 'viraj@roomista.com', 'info@roomista.com', 'thiya@roomista.com'])->bcc('hushantha@weblook.com')->send(new MakeBooking($booking));
            BookingCart::instance('booking')->destroy();
        }
        // dd(request()->all());
        return view('livewire.booking-success-component', compact('booking'))->layout('frontend');
    }
}
