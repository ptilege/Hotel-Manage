<?php

namespace App\Http\Livewire;

use App\Mail\MakeBooking;
use App\Models\BedType;
use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Country;
use App\Models\MealType;
use App\Models\PaymentOption;
use App\Models\Property;
use App\Models\Room;
use App\Models\Settings;
use App\Models\Transaction;
use App\PaymentGateways\PayHere\PayHereGateway;
use Livewire\Component;
use BookingCart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Rules\OldNICValidation;
use App\Rules\NewNICValidation;
use App\Services\Tcpdf\TcpdfService;
use Illuminate\Http\Request;


class CheckoutComponent extends Component
{
    public $firstName;
    public $lastName;
    public $email;
    public $confirmEmail;
    public $address;
    public $country = 'Sri Lanka';
    public $city;
    public $nic;
    public $mobile;

    public $paymentMethod;

    public $acceptTerms;
    public $isPartialPay = false;

    public $totalPaidAmount = 0;
    public $totalPartialPaidAmount = 0;

    public function mount()
    {
        $cart = BookingCart::instance('booking')->content();

        if (BookingCart::instance('booking')->content()->count() < 1) {
            return redirect()->route('all-properties');
        }

        $this->totalPaidAmount = $cart->reduce(function ($carry, $item) {
            return $carry + ($item->options->has('total_amount') ? $item->options->total_amount : 0);
        }, 0);

        $firstCartItem = $cart->first();
        $propertyId = $firstCartItem->options->property_id;

        $property = Property::find($propertyId);

        $partialPayData = [
            'type' => $property->partial_pay_type,
            'amount' => $property->partial_pay_amount,
        ];

        $this->totalPartialPaidAmount = $cart->reduce(function ($carry, $item) use ($partialPayData) {
            $total = $item->options->has('total_amount') ? $item->options->total_amount : 0;
            $amount = 0;
            if ($partialPayData['type'] == 'percentage') {
                $amount = $total * ($partialPayData['amount'] / 100);
            } else {
                $amount = $partialPayData['amount'];
            }
            return $carry + $amount;
        }, 0);

        $isPartialContain = $cart->map(function ($item, $key) {
            return $item->options->has('partial_paid_amount') && $item->options->partial_paid_amount > 0  ? true : false;
        })->values()->toArray();

        if (in_array(true, $isPartialContain)) {
            $this->isPartialPay = true;
        }
    }

    public function render()
    {

        $countries = Country::where(['status' => 1])->get('name');
        $terms = Settings::where(['key' => 'default_privacy_policy'])->first();
        $terms = $terms->value;
        $paymentOptions = PaymentOption::where(['status' => 1])->get();

        $cart = BookingCart::instance('booking')->content();

        $cartItems = [];

        foreach ($cart as $key => $item) {
            $cartItems[$key]['rowId'] = $item->rowId;
            $cartItems[$key]['room'] = Room::where('id', $item->id)->first();
            $cartItems[$key]['meal_type'] = $item->options->has('meal_type') ? MealType::find($item->options->meal_type) : null;
            $cartItems[$key]['bed_type'] = $item->options->has('bed_type') ? BedType::find($item->options->bed_type) : null;
            $cartItems[$key]['room_qty'] = $item->options->has('room_qty') ? $item->options->room_qty : null;
            $cartItems[$key]['adult_qty'] = $item->options->has('extra_beds') ? $item->options->extra_beds : null;
            $cartItems[$key]['child_qty'] = $item->options->has('extra_child') ? $item->options->extra_child : null;
            $cartItems[$key]['nights'] = $item->options->has('no_of_nights') ? $item->options->no_of_nights : null;
            $cartItems[$key]['total_amount'] = $item->options->has('total_amount') ? $item->options->total_amount : null;
            $cartItems[$key]['partial_amount'] = $item->options->has('partial_paid_amount') ? $item->options->partial_paid_amount : null;
            $cartItems[$key]['check_in'] = $item->options->has('check_in') ? $item->options->check_in : null;
            $cartItems[$key]['check_out'] = $item->options->has('check_out') ? $item->options->check_out : null;
        }

        $roomsTotal = $cart->reduce(function ($carry, $item) {
            return $carry + $item->price;
        }, 0);

        $totalAmount = $roomsTotal;

        $firstCartItem = $cart->first();
        $propertyId = $firstCartItem->options->property_id;

        $property = Property::find($propertyId);

        if ($property->hotel_policy) {
            $terms = $property->hotel_policy;
        }

        $partialPayData = [
            'type' => $property->partial_pay_type,
            'amount' => $property->partial_pay_amount,
        ];

        $partialAmount = $cart->reduce(function ($carry, $item) use ($partialPayData) {
            $total = $item->options->has('total_amount') ? $item->options->total_amount : 0;
            $amount = 0;
            if ($partialPayData['type'] == 'percentage') {
                $amount = $total * ($partialPayData['amount'] / 100);
            } else {
                $amount = $partialPayData['amount'];
            }
            return $carry + $amount;
        }, 0);

        // dd($property);
        return view('livewire.checkout-component', compact('cartItems', 'roomsTotal', 'totalAmount', 'partialPayData', 'partialAmount', 'terms', 'paymentOptions', 'countries'))->layout('frontend');
    }

    public function updated($request, $propertyName)
    {
        $this->validateOnly($propertyName, [
            'confirmEmail' => 'same:email',
        ]);
    }

    public function confirmPayment()
    {
        $this->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'confirmEmail' => 'required|email|same:email',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'nic' => ['required'],
            'mobile' => 'required',
            'paymentMethod' => 'required',
            'acceptTerms' => 'required',
        ], [
            'paymentMethod.required' => 'Please Select Payment Method.',
            'acceptTerms.required' => 'Please Accept Terms and Conditions.',
        ]);


        // if (ctype_digit($this->nic) && $this->country == 'Sri Lanka') {
        //     // new nic number validation
        //     $this->validate([
        //         'nic' => ['required', 'regex:/(^(?:19|20)?\d{2}(?:[0-35-8]\d\d(?<!(?:000|500|36[7-9]|3[7-9]\d|86[7-9]|8[7-9]\d)))[0]\d?\d{4}$)/u'],
        //     ]);
        // } elseif (preg_match('/[vVxX]$/', $this->nic) && $this->country == 'Sri Lanka') {
        //     // old nic number validation
        //     $this->validate([
        //         'nic' => ['required', 'regex:/(^\d{2}(?:[0-35-8]\d\d(?<!(?:000|500|36[7-9]|3[7-9]\d|86[7-9]|8[7-9]\d)))\d{4}(?:[vVxX])$)/u'],
        //     ]);
        // } elseif (preg_match('/^[A-Z0-9]{6,9}$/i', $this->nic)) {
        //     // passport number validation
        //     $this->validate([
        //         'nic' => ['required', 'regex:/^[A-Z0-9]{6,9}$/i'],
        //     ]);
        // } else {

        //     return 'The :attribute is not a valid Format.';
        // }

        $cart = BookingCart::instance('booking')->content();
        $firstCartItem = $cart->first();
        $commonData = [
            'property_id' => $firstCartItem->options->property_id,
            'check_in' =>  $firstCartItem->options->check_in,
            'check_out' =>  $firstCartItem->options->check_out,
        ];

        try {
            $booking = new Booking();
            DB::beginTransaction();
            $booking->property_id = $commonData['property_id'];
            $booking->first_name = $this->firstName;
            $booking->last_name = $this->lastName;
            $booking->email = $this->email;
            $booking->address = $this->address;
            $booking->country = $this->country;
            $booking->city = $this->city;
            $booking->nic = $this->nic;
            $booking->mobile = $this->mobile;
            $booking->checkin_date = $commonData['check_in'];
            $booking->checkout_date = $commonData['check_out'];
            $booking->coupon_id = null;
            $booking->total_amount = $this->totalPaidAmount;
            if ($this->isPartialPay) {
                $booking->patial_amount = $this->totalPartialPaidAmount;
            }
            $booking->total_tax = 0;
            $booking->status = 'pending';
            $booking->save();
            DB::commit();

            foreach ($cart as $key => $item) {
                DB::beginTransaction();
                $bookingItem = new BookingItem();
                $bookingItem->booking_id = $booking->id;
                $bookingItem->room_id = $item->id;
                $bookingItem->meal_type = $item->options->meal_type;
                $bookingItem->bed_type = $item->options->bed_type;
                $bookingItem->qty = $item->options->room_qty;
                $bookingItem->extra_child = $item->options->extra_child;
                $bookingItem->extra_beds = $item->options->extra_beds;
                $bookingItem->partial_amount = $item->options->partial_paid_amount;
                $bookingItem->total_amount = $item->options->total_amount;
                $bookingItem->save();
                DB::commit();
            }

            $transaction = new Transaction();
            $transaction->booking_id = $booking->id;
            $transaction->payment_option_id = $this->paymentMethod;
            $transaction->status = 'pending';
            $transaction->save();

            $currentBooking = Booking::with('property')->find($booking->id);
            $currentProperty = Property::find($commonData['property_id']);

            $mailList = Settings::where(['key' => 'booking_invoice_mails'])->first();
            $mailList = json_decode($mailList->value);
            
            // $invoicePdf = $this->generatePdf($currentBooking);
            
            // dd( $invoicePdf);
            if ($this->paymentMethod == 'bank-transfer') {
                // $currentProperty->email
                Mail::to($this->email)->cc($mailList->cc)->bcc($mailList->bcc)->send(new MakeBooking($currentBooking));
                BookingCart::instance('booking')->destroy();
                return redirect()->route('success', $booking->id);
            } else if ($this->paymentMethod == 'pay-here') {
                Mail::to('bookings@roomista.com')->cc(['viraj@roomista.com'])->bcc('hushantha@weblook.com')->send(new MakeBooking($currentBooking));
                return redirect()->route('payment-process', $booking->id);
            }
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);

            abort(500);
        }
    }

    public function validateNIC(Request $request)
    {
        $rules = [
            'nic' => 'required|older_nic_format',
            'nic' => 'required|new_nic_format',
        ];

        $messages = [
            'older_nic.older_nic_format' => 'The older NIC format is invalid.',
            'new_nic.new_nic_format' => 'The new NIC format is invalid.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // Handle validation failure
        }

        // Continue processing if validation passes
    }

    public function processPayment($method, $order)
    {
    }

    public function generatePdf($hotelData)
    {
        $pdf = new TcpdfService();
        $pdf->hotelData = $hotelData;

        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 14);

        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);

        $pdf->SetFont('helvetica', '', 12);

        $filename =  "invoices/Inv-".$hotelData->id.".pdf";

        // return storage_path();
        $pdf->Output(public_path($filename), 'F');
        // return response()->download(public_path($filename));
        // $pdf->Output('invoice.pdf', 'I');
    }
}
