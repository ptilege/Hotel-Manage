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



                <!-- <div class="banner-one_text"  style="font-family: 'Poppins', sans-serif;">Luxury Hotel</div> -->


                <!-- Description Box -->

                <div class="">
                    <div class="banner-description">
                        <div class="">
                            <div class="row">
                                <div class="m-auto">


                                    <div class="card bg-white">
                                        <div class="card-body py-5">
                                            <div class="row justify-content-center">
                                                <div class="col-12 text-center">
                                                    @if ($booking->transaction->status == 'failed' || $booking->transaction->status == 'canceled')
                                                    <img src="{{ asset('images/failed.png') }}" width="60" alt="">
                                                    <div class="h1 py-3">Unabled to Process Payment</div>
                                                    <p>We're sorry, we were unable to process your payment. <br> please contact us <b>info@roomista.com</b></p>
                                                    @else
                                                    <img src="{{ asset('images/tick-green.png') }}" width="60" alt="">
                                                    <div class="h1 py-3">Thank You For Your Reservation</div>
                                                    @endif
                                                </div>
                                                @if ($booking->transaction->status != 'failed' && $booking->transaction->status != 'canceled')
                                                <div class="col-md-7 col-12 py-4">
                                                    <div class="checkout-date-range d-flex align-items-center justify-content-around">
                                                        <div class="checkout-date">
                                                            <p>Check-in</p>
                                                            <b>{{Carbon\Carbon::parse($booking->checkin_date)->format('d-M-Y')}}</b>
                                                        </div>
                                                        <div class="vr"></div>
                                                        <div class="checkout-date">
                                                            <p>Check-in</p>
                                                            <b>{{Carbon\Carbon::parse($booking->checkout_date)->format('d-M-Y')}}</b>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="d-flex align-items-center justify-content-center px-3">
                                                        <div>
                                                            Total length of stay:
                                                        </div>
                                                        @php
                                                        $checkIn = Carbon\Carbon::parse($booking->checkin_date);
                                                        $checkOut = Carbon\Carbon::parse($booking->checkout_date);
                                                        $nights = $checkOut->diffInDays($checkIn);
                                                        @endphp
                                                        <div><b>{{$nights}} Night(s)</b></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center py-3">
                                                    <div class="h3">We've sent your confirmation email soon</div>
                                                    <br>
                                                    <p class="text-center">Roomista.com has received your booking request, and we will confirm it based on availability. Rest assured, our team is working diligently to secure your reservation.</p>
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