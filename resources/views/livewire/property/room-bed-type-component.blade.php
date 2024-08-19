<div class="row g-0 bed-types">

    <div class="col-12 col-md-2" style="border-right:1px solid #00000029;">
        <div class="sleeps">
            @for ($i = 0; $i < $bedType->quantity ?? 1; $i++)
                <i class="fa fa-user p-1"></i>
                @endfor
        </div>

    </div>

    <div class="col-lg-3 col-md-3 px-2" style="border-right:1px solid #00000029;">

        <div class="meal-types mb-4 ">
            @foreach ($room->mealTypes as $key => $mealType)
            <div class="form-check mt-2 mb-2 form-font  d-flex justify-content-center">
                <input class="form-check-input" type="radio" name="meal-{{ $bedType->id }}-{{ $room->id }}" id="meal-{{ $mealType->id }}-{{ $bedType->id }}-{{ $room->id }}" value="{{ $mealType->id }}" wire:model.debounce.500ms="mealType">
                <label class="form-check-label ms-3 meal-type-text" for="meal-{{ $mealType->id }}-{{ $bedType->id }}-{{ $room->id }}">
                    {{ $mealType->name }}
                </label>
            </div>

            @endforeach
        </div>
    </div>

    <div class="col-lg-3 col-md-3 mb-2 mb-md-0" style="border-right:1px solid #00000029;">
        <!-- add -->
        <div class="col-12 col-md-3 d-md-none">
            <div class="p-1 mb-1 bg-primary-light text-white text-center">No. of Rooms</div>
        </div>
        <!-- add end -->
        <div class="room-qty mb-4 ">
            <button wire:click.prevent="setRoomQty('-')"><i class="fas fa-minus"></i></button>
            <input type="number" max="{{ $room->quantity ?? 1 }}" min="1" value="1" wire:model="roomQty">
            <button wire:click.prevent="setRoomQty('+')"><i class="fas fa-plus"></i></button>
        </div>
        <div class="extra-beds">
            <div class="form-check form-switch d-flex justify-content-center mb-1">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" wire:click="enableExtraBeds">
                <label class="form-check-label ms-2 no-room-text" for="flexSwitchCheckDefault">Extra Beds</label>
            </div>
            <div class="extra-beds-qty col-12" wire:ignore.self>
                <button wire:click.prevent="setExtraBedsQty('-')"><i class="fas fa-minus"></i></button>
                <input type="number" max="{{ $room->max_extra_beds ?? 0 }}" min="0" value="0" wire:click="extraBedsQty">
                <button wire:click.prevent="setExtraBedsQty('+')"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        <div class="childrens ">
            <div class="form-check form-switch d-flex justify-content-center me-2 mb-1">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" wire:click="enableExtraChild">
                <label class="form-check-label ms-2 no-room-text" for="flexSwitchCheckDefault">Children</label>
            </div>
            <div class="childrens-qty" wire:ignore.self>
                <button wire:click.prevent="setExtraChildQty('-')"><i class="fas fa-minus"></i></button>
                <input type="number" max="{{ $room->max_child ?? 0 }}" min="0" value="0" wire:model="extraChildQty">
                <button wire:click.prevent="setExtraChildQty('+')"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>


    @php
    $cart = BookingCart::instance('booking')->content();

    $alreadyInCart = $cart->contains(function ($cartItem, $key) {
    return $cartItem->id == $this->room->id && ($cartItem->options->has('bed_type') ? $cartItem->options->bed_type : '') == $this->bedType->id;
    });
    @endphp
    @if($totalPrice==0)
    <div class="col-lg-4 col-md-3 d-flex flex-column align-items-center justify-content-center p-2">
    <button class="my-4 partial-pay-btn text-danger">No Rates Available</button>
    </div>
    @else
    <div class="col-lg-4 col-md-3 d-flex flex-column align-items-center justify-content-center p-2">

        <div><b style="font-size: 20px; color: green;">{{ $this->displayCurrency($totalPrice) }}</b>/<small>{{ $noOfNights }}
                Night(s)</small></div>

        <button class="my-4 partial-pay-btn" @if ($partialPayAmount <=0 || $alreadyInCart) disabled @endif wire:click="makeReservetion({{ $partialPayAmount }}, {{ $totalPrice }})">~ Pay <b style="font-size: 17px; color:black; font-family:RoomistaRegular;">{{ $this->displayCurrency(round($partialPayAmount, 0)) }}</b>
            & reserve ~</button>

        <button class="btn-style-two theme-btn w-100" wire:click="makeReservetion(null, {{ $totalPrice }})" @if ($alreadyInCart || $totalPrice==0) disabled @endif>
            <span class="btn-wrap">
                <span class="text-one">{{ $alreadyInCart ? 'Booked' : 'Book' }}</span>
                <span class="text-two w-100">{{ $alreadyInCart ? 'Booked' : 'Book' }}</span>
            </span>
        </button>
        <!-- <button class="btn btn-primary reserve-btn" style="padding: 12px 20px;"
            wire:click="makeReservetion(null, {{ $totalPrice }})" @if ($alreadyInCart) disabled @endif
            style="background:#3554D1;">{{ $alreadyInCart ? 'Booked' : 'Book' }}</button> -->
        {{-- <p class="pt-2" style="font-size: 12px;font-weight: 600;color: red;text-align: center;"> Please note that bookings will be processed based on availability</p> --}}
    </div>
 @endif
</div>