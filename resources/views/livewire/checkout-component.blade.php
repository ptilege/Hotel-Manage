<section class="banner-one">
    <div class="banner-one_image-layer" style="background-image: url('{{ asset('images/main-slider/1.jpg') }}')"></div>
    <div class="container">

        <!-- Content Column -->
        <div class="banner-one_content">
            <div class="banner-one_content-inner">
                <div class="container">
                    <!--breadcrumb-->
                    <!-- <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" style="color: #808080;" aria-current="page">Checkout</li>
                        </ol>
                    </nav> -->
                </div>

                <h1 class="banner-one_heading">
                    Checkout
                </h1>

                <!-- <div class="banner-one_text"  style="font-family: 'Poppins', sans-serif;">Luxury Hotel</div> -->


                <!-- Description Box -->

                <div class="">
                    <div class="banner-description">
                        <div class="container py-4 checkout banner-one_form-box-checkout">
                            <div class="row">
                                <div class="col-md-8">
                                    <form wire:submit.prevent="confirmPayment">
                                        <div class="card border-0 mb-5">
                                            <div class="card-header " style="background:none;border-bottom:2px solid #051036">
                                                <h4>Checkout Details</h4>
                                            </div>
                                        </div>
                                        <div class="row g-3 mb-4">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" placeholder="First Name" wire:model.debounce.500ms="firstName">
                                                @error('firstName') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" placeholder="Last Name" wire:model.debounce.500ms="lastName">
                                                @error('lastName') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" class="form-control" placeholder="Email Address" wire:model.debounce.500ms="email">
                                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" class="form-control" placeholder="Confirm Email Address" wire:model.debounce.500ms="confirmEmail">
                                                @error('confirmEmail') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="col-12">
                                                <textarea class="form-control" placeholder="Your Address" rows="5" wire:model.debounce.500ms="address"></textarea>
                                                @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <select id="inputState" class="form-select" wire:model.debounce.500ms="country">
                                                    <option value="" selected disabled>Select Your Country</option>
                                                    @foreach ($countries as $item)
                                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('country') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputCity" placeholder="City" wire:model.debounce.500ms="city">
                                                @error('city') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputEmail4" placeholder="NIC / Passport No." wire:model.debounce.500ms="nic">
                                                @error('nic') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="inputPassword4" placeholder="Mobile Number" wire:model.debounce.500ms="mobile">
                                                @error('mobile') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>

                                        <div class="card border-0 mb-5">
                                            <div class="card-header " style="background:none;border-bottom:2px solid #051036">
                                                <h4>Payment Details</h4>
                                            </div>
                                        </div>
                                        @error('paymentMethod') <div class="text-danger mb-2">{{ $message }}</div> @enderror
                                        @foreach ($paymentOptions as $option)
                                        <div class="form-check mb-2 d-flex">
                                            <input class="form-check-input" type="radio" name="paymentMethod" value="{{$option->option}}" id="gateway-{{$option->option}}" wire:model.debounce.500ms="paymentMethod">
                                            <label class="form-check-label ml-2" style="padding: 5px;" for="gateway-{{$option->option}}">
                                                <b>{{$option->name}}</b> <br>
                                                <small>{{$option->description}}</small> <br>
                                                @if ($option->option == 'pay-here')
                                                <img src="{{asset('images/pay-here.png')}}" alt="">
                                                @endif
                                            </label>
                                        </div>


                                        @endforeach
                                        <div class="card border-0 mb-5 mt-4">
                                            <div class="card-header " style="background:none;border-bottom:2px solid #051036">
                                                <h4>Terms and Conditions</h4>
                                            </div>
                                        </div>
                                        <div class="card bg-light-blue" style="max-height: 200px;overflow: hidden;overflow-y: auto;">
                                            <div class="card-body">
                                                {!! $terms !!}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="mt-2">
                                            @error('acceptTerms') <div class="text-danger">{{ $message }}</div> @enderror
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" wire:model.debounce.500ms="acceptTerms">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <b>I have read and accepted the terms and conditions.</b>
                                                </label>
                                            </div>
                                            @if ($partialPayData['amount'] > 0)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" wire:model.debounce.500ms="isPartialPay">
                                                <label class="form-check-label" for="flexCheckChecked"><b>I confirm to pay {{$partialPayData['type']=='percentage' ? $partialPayData['amount'].'%' : 'LKR'.number_format($partialPayData['amount'], 2, '.', ',')}} advanced payment for
                                                        room booking.</b>
                                                </label>
                                            </div>
                                            @endif

                                        </div>
                                        @if ($isPartialPay)
                                        <div class="card  bg-light-blue">
                                            <div class="card-body">
                                                <div class="card-body d-flex align-items-center justify-content-between">
                                                    <div><b>Advanced Payment to Pay</b><br /> <small>( Rest will be paid at the check-in )</small> </div>
                                                    <div style="font-size:18px;"><b>Rs: {{number_format(round($partialAmount, 0), 2, '.', ',')}}</b></div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        {{-- <p class="pt-2" style="font-size: 13px;font-weight: 600;color: red;">Please note that bookings will be processed based on availability</p> --}}
                                        <div class="continue-button d-flex align-items-center mt-4 ">
                                            <button class="btn btn-primary">Continue With Payment</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4>Your booking details</h4>
                                            <hr>
                                            <div class="card bg-light-blue">
                                                <div class="card-body">
                                                    <div class="checkout-date-range d-flex align-items-center justify-content-around">
                                                        <div class="checkout-date">
                                                            <p>Check-in</p>
                                                            <b>{{count($cartItems)>0 ? \Carbon\Carbon::parse(array_values($cartItems)[0]['check_in'])->format('d-M-Y'):''}}</b>
                                                        </div>
                                                        <div class="vr"></div>
                                                        <div class="checkout-date">
                                                            <p>Check-in</p>
                                                            <b>{{count($cartItems)>0 ? \Carbon\Carbon::parse(array_values($cartItems)[0]['check_out'])->format('d-M-Y'):''}}</b>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="d-flex align-items-center justify-content-between px-3">
                                                        <div>
                                                            Total length of stay:
                                                        </div>
                                                        <div><b>{{count($cartItems)>0 ?array_values($cartItems)[0]['nights'] :'0'}} Night(s)</b></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div>
                                                @foreach ($cartItems as $item)
                                                <div class="card cart-item mb-2 bg-light-blue">
                                                    <div class="card-header p-1 pb-0 d-flex align-items-center justify-content-between border-0 bg-light-blue">
                                                        <h5 class="card-title m-0 ps-2 ">{{ $item['room'] ? $item['room']->name : '' }}</h5>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class="room-data mb-1">
                                                            <div>
                                                                {{ $item['bed_type'] ? $item['bed_type']->name : '' }}/{{ $item['meal_type'] ? $item['meal_type']->name : '' }}
                                                            </div>
                                                            <div><b>{{ $item['room_qty'] ? $item['room_qty'] : '0' }} Room(s)</b></div>

                                                        </div>
                                                        <div class="room-data mb-1">
                                                            <div><b>{{ $item['adult_qty'] ? $item['adult_qty'] : '0' }} Extra Bed(s)</b></div>
                                                            <div>
                                                                <div><b>{{ $item['bed_type'] ? $item['bed_type']->quantity : '0' }} Adult(s)</b>
                                                                </div>
                                                                <div><b>{{ $item['child_qty'] ? $item['child_qty'] : '0' }} Children</b></div>
                                                            </div>
                                                        </div>
                                                        <hr class="my-1">
                                                        <div class="room-data">
                                                            <div style="font-size:16px;">
                                                                <b>Price:</b>
                                                            </div>
                                                            <div style="font-size:16px;">
                                                                {{-- <b>LKR {{number_format($item['partial_amount']?$item['partial_amount']:$item['total_amount'], 2, '.', ',')}}</b> --}}
                                                                <b>LKR {{number_format($item['total_amount'], 2, '.', ',')}}</b>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <hr>
                                            <div class="card bg-light-blue">
                                                <div class="card-body d-flex align-items-center justify-content-between room-total">
                                                    <div>Room(s) Total</div>
                                                    @php
                                                    $roomsAllTotal = collect($cartItems)->reduce(function ($carry, $item) {
                                                    return $carry + $item['total_amount'];
                                                    }, 0);
                                                    @endphp
                                                    <div>Rs: {{number_format($roomsAllTotal, 2, '.', ',')}}</div>
                                                    {{-- <div>Rs: {{number_format($roomsTotal, 2, '.', ',')}}
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h4>Your price summary</h4>
                                        <hr>
                                        <div class="card bg-light-blue">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>Taxes and fees</div>
                                                    <div><b>Rs: 0.00</b></div>
                                                </div>
                                                <hr>
                                                <div class="d-flex align-items-center justify-content-between total">
                                                    <div>Total</div>
                                                    {{-- <div>Rs: {{number_format($totalAmount, 2, '.', ',')}}
                                                </div> --}}
                                                <div>Rs: {{number_format($roomsAllTotal, 2, '.', ',')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($isPartialPay)
                                    <div class="card mt-3 bg-light-blue">
                                        <div class="card-body d-flex align-items-center justify-content-between">
                                            <div><b>Advanced Payment to Pay</b><br /> <small>( Rest will be paid at the check-in )</small> </div>
                                            <div><b>Rs: {{number_format(round($partialAmount, 0), 2, '.', ',')}}</b></div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    </div>
</section>


<style>
    .banner-one {
        position: relative;
    }

    .banner-one_image-layer {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 25%;
        /* Adjust this value to control the height of the background */
        background-size: cover;
        background-position: center;
    }

    .banner-one_content {
        position: relative;
        z-index: 1;
    }

    .banner-one_heading {
        font-size: 80px;
        padding-bottom: 60px;
        padding-top: 50px;
    }


    .banner-one_form-box-checkout {
        width: 100%;
        margin-bottom: -180px;
        padding-top: 25px;
        position: relative;

        margin: 0 auto;
        padding: 10px 45px 10px;
        border-radius: 25px;
        margin-top: var(--margin-top-30);
        background-color: var(--white-color);
        box-shadow: 5px 20px 50px rgba(0, 0, 0, 0.1);
    }

    .continue-button {
        justify-content: end;
    }
</style>

<style>
    @media only screen and (max-width: 400px) {

        .banner-one_heading {
            font-size: 50px;
        }

        .banner-one_form-box-checkout {
            /* margin: 10px; */
            margin-bottom: -200px;
            padding-top: 25px;
        }

        .banner-description {
            font-size: 13px;
        }

        .continue-button {
            justify-content: center;
        }
    }