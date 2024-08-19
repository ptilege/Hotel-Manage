<?php

namespace App\Http\Livewire\Cart;

use App\Models\BedType;
use App\Models\MealType;
use App\Models\Room;
use Livewire\Component;
use BookingCart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CartComponent extends Component
{
    public $currencytext;
    protected $listeners = ['refreshComponent' =>'$refresh'];

    public function render()
    {
        $currency = Session::get('currency');
        Log::info("cart" . $currency);
        if (Session::has('currency') && Session::get('currency')) {
          
            if($currency == 'USD'){
                $this->currencytext = 'USD';
            }
            if($currency == 'LKR'){
                $this->currencytext = 'LKR';
            }
        }
       
        $cart = BookingCart::instance('booking')->content();

        $cartItems = [];

        foreach ($cart as $key => $item) {
            $cartItems[$key]['rowId'] = $item->rowId;
            $cartItems[$key]['room'] = Room::where('id',$item->id)->first();
            $cartItems[$key]['meal_type'] = $item->options->has('meal_type') ? MealType::find($item->options->meal_type) : null;
            $cartItems[$key]['bed_type'] = $item->options->has('bed_type') ? BedType::find($item->options->bed_type) : null;
            $cartItems[$key]['room_qty'] = $item->options->has('room_qty') ? $item->options->room_qty : null;
            $cartItems[$key]['adult_qty'] = $item->options->has('extra_beds') ? $item->options->extra_beds : null;
            $cartItems[$key]['child_qty'] = $item->options->has('extra_child') ? $item->options->extra_child : null;
            $cartItems[$key]['nights'] = $item->options->has('no_of_nights') ? $item->options->no_of_nights : null;
            $cartItems[$key]['total_amount'] = $item->options->has('total_amount') ? $item->options->total_amount : null;
            $cartItems[$key]['partial_amount'] = $item->options->has('partial_paid_amount') ? $item->options->partial_paid_amount : null;
        }

       $totalAmount = $cart->reduce(function ($carry, $item) {
            return $carry + $item->price;
        }, 0);
        $cartCount = BookingCart::instance('booking')->count();

        // Emit an event to send the cart count
        $this->emit('updateCartCount', $cartCount);
        // Log::info('count', ['cartCount' => $cartCount]);

       
        return view('livewire.cart.cart-component',compact('cartItems','totalAmount'));
    }


    public function removeItem($rowId) {

        $existItem = BookingCart::instance('booking')->content()->contains('rowId', $rowId);

        if($existItem) {
            BookingCart::instance('booking')->remove($rowId);
        }
        // $this->emitUp('refreshComponent');
        $this->emitTo('cart.cart-component', 'refreshComponent');
        $this->emitTo('property.room-bed-type-component', 'refreshComponent');
    }
    
}
