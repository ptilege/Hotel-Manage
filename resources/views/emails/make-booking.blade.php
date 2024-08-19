<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roomista</title>
    <style>
        .bg-light-blue {
            background: #f5f9ff !important;
        }

        .bg-blue {
            background: #3554d1 !important;
        }

        .details-content p {
            margin-bottom: 0;
            padding: 15px 0;
        }

        .details-content p b {
            padding-left: 30px;
        }

        .i-container {
            width: 70%;max-width: 1200px;min-width: 280px;margin: auto;background: #fff;padding: 25px;font-family: Arial, Helvetica, sans-serif;
        }
        .row {
            display:flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: row;
            flex-wrap: nowrap;
        : 1px solid #ddd;
        }
        .row .col-5 {
            width: 90%;
        }
        .row .col-7 {
            width: 100%;
        }
        @media screen and (max-width:575px) {
            .i-container {
                width: 100% !important;
                padding: 15px !important;
            }

            .property-branding p {
                font-size: 10px;
            }

            .property-branding img {
                width: 50px;
            }

            .navbar-brand {
                margin: auto;
                padding: 0;
            }

            .navbar-brand img {
                width: 150px;
            }

            .collapse.navbar-collapse {
                display: block;
            }

            .collapse.navbar-collapse .navbar-nav {
                flex-direction: row;
                align-items: center;
                justify-content: space-around;
            }

            .header-divider {
                margin: 3px 0;
            }

            .details-content {
                font-size: 12px;
            }

            .details-content p b {
                padding-left: 10px;
            }

            .signature {
                text-align: center !important;
                font-weight: 500;
            }

            .signature p {
                margin-bottom: 0;
            }

            .image-divider {
                width: 100%;
            }

            .footer {
                text-align: center;
            }

            .footer .copyright {
                justify-content: center !important;
            }

            .contact-no {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    @php
        $booking = App\Models\Booking::with('property')->find($booking->id);
    @endphp
    <div class="bg-light-blue" style="background: #f5f9ff !important;">
        <div class="i-container" style="width: 70%;max-width: 1200px;min-width: 280px;margin: auto;background: #fff;padding: 25px;font-family: Arial, Helvetica, sans-serif;">
            <div class="navbar navbar-expand-sm navbar-light" style="background:#fff;">
                <div class="container-fluid" style="text-align: center;">
                    <a class="navbar-brand">
                        <img src="{{ asset('images/logo-dark.png') }}" width="200" alt="">
                    </a>
                </div>
            </div>
            <hr class="header-divider">
            <div style="text-align:center;">
                <div class="property-branding">
                    @if ($booking->property->image)
                        <img src="{{ $booking->property->image }}" width="85" alt="">
                    @endif
                    <h2 style="text-transform:capitalize;">{{ $booking->property->name }}</h2>
                    <p class="">Roomista.com has received your booking request, and we will confirm it based on availability. Rest assured, our team is working diligently to secure your reservation.</p>
                </div>
                <img class="image-divider" src="{{ asset('images/star-divider.png') }}" style="width:100%;max-width:400px;" alt="">
                <div class="details-content" style="min-width: 275px;width:70%;margin:auto;">
                    <div class="row" style="display:flex;align-items: center;justify-content: space-between;flex-direction: row;flex-wrap: nowrap;border-bottom: 1px solid #ddd;">
                        <div class="col-5 col-md-6" style="text-align: left;width: 90%;">
                            <p><b>Invoice ID</b></p>
                        </div>
                        <div class="col-7 col-md-6" style="text-align: left;width: 100%;">
                            <p>: INV-{{ $booking->id }}</p>
                        </div>
                    </div>
                    <div class="row" style="display:flex;align-items: center;justify-content: space-between;flex-direction: row;flex-wrap: nowrap;border-bottom: 1px solid #ddd;">
                        <div class="col-5 col-md-6" style="text-align: left;width: 90%;">
                            <p><b>Name</b></p>
                        </div>
                        <div class="col-7 col-md-6" style="text-align: left;width: 100%;">
                            <p>: {{ $booking->first_name }} {{ $booking->last_name }}</p>
                        </div>
                    </div>
                    <div class="row" style="display:flex;align-items: center;justify-content: space-between;flex-direction: row;flex-wrap: nowrap;border-bottom: 1px solid #ddd;">
                        <div class="col-5 col-md-6" style="text-align: left;width: 90%;">
                            <p><b>Email Address</b></p>
                        </div>
                        <div class="col-7 col-md-6" style="text-align: left;width: 100%;">
                            <p>: {{ $booking->email }}</p>
                        </div>
                    </div>
                    <div class="row" style="display:flex;align-items: center;justify-content: space-between;flex-direction: row;flex-wrap: nowrap;border-bottom: 1px solid #ddd;">
                        <div class="col-5 col-md-6" style="text-align: left;width: 90%;">
                            <p><b>Mobile No.</b></p>
                        </div>
                        <div class="col-7 col-md-6" style="text-align: left;width: 100%;">
                            <p>: {{ $booking->mobile }}</p>
                        </div>
                    </div>
                    <div class="row" style="display:flex;align-items: center;justify-content: space-between;flex-direction: row;flex-wrap: nowrap;border-bottom: 1px solid #ddd;">
                        <div class="col-5 col-md-6" style="text-align: left;width: 90%;">
                            <p><b>Invoice Date</b></p>
                        </div>
                        <div class="col-7 col-md-6" style="text-align: left;width: 100%;">
                            <p>: {{ Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="row" style="display:flex;align-items: center;justify-content: space-between;flex-direction: row;flex-wrap: nowrap;border-bottom: 1px solid #ddd;">
                        <div class="col-5 col-md-6" style="text-align: left;width: 90%;">
                            <p><b>Checkin Date</b></p>
                        </div>
                        <div class="col-7 col-md-6" style="text-align: left;width: 100%;">
                            <p>: {{ Carbon\Carbon::parse($booking->checkin_date)->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="row" style="display:flex;align-items: center;justify-content: space-between;flex-direction: row;flex-wrap: nowrap;border-bottom: 1px solid #ddd;">
                        <div class="col-5 col-md-6" style="text-align: left;width: 90%;">
                            <p><b>Checkout Date</b></p>
                        </div>
                        <div class="col-7 col-md-6" style="text-align: left;width: 100%;">
                            <p>: {{ Carbon\Carbon::parse($booking->checkout_date)->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="row" style="display:flex;align-items: center;justify-content: space-between;flex-direction: row;flex-wrap: nowrap;border-bottom: 1px solid #ddd;">
                        <div class="col-5 col-md-6" style="text-align: left;width: 90%;">
                            <p><b>Tax Charges</b></p>
                        </div>
                        <div class="col-7 col-md-6" style="text-align: left;width: 100%;">
                            <p>: LKR {{ number_format($booking->total_tax, 2, '.', ',') }}</p>
                        </div>
                    </div>
                    <div class="row" style="display:flex;align-items: center;justify-content: space-between;flex-direction: row;flex-wrap: nowrap;border-bottom: 1px solid #ddd;">
                        <div class="col-5 col-md-6" style="text-align: left;width: 90%;">
                            <p><b>Total Amount</b></p>
                        </div>
                        <div class="col-7 col-md-6" style="text-align: left;width: 100%;">
                            <p>: LKR {{ number_format($booking->total_amount, 2, '.', ',') }}</p>
                        </div>
                    </div>
                    <div class="row" style="display:flex;align-items: center;justify-content: space-between;flex-direction: row;flex-wrap: nowrap;border-bottom: 1px solid #ddd;">
                        <div class="col-5 col-md-6" style="text-align: left;width: 90%;">
                            <p><b>Paid Amount</b></p>
                        </div>
                        <div class="col-7 col-md-6" style="text-align: left;width: 100%;">
                            <p>: LKR {{ number_format($booking->patial_amount, 2, '.', ',') }}</p>
                        </div>
                    </div>
                    <div class="row" style="display:flex;align-items: center;justify-content: space-between;flex-direction: row;flex-wrap: nowrap;border-bottom: 1px solid #ddd;">
                        <div class="col-5 col-md-6" style="text-align: left;width: 90%;">
                            <p><b>Balance Payment</b></p>
                        </div>
                        <div class="col-7 col-md-6" style="text-align: left;width: 100%;">
                            <p>: LKR
                                {{ number_format($booking->total_amount - $booking->patial_amount, 2, '.', ',') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="signature" style="text-align: left;">
                    <p>Thank You, <br> Roomista.com Team.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-blue" style="background: #3554d1 !important;">
        <div class="bg-light i-container" 
            style="text-align:center;background: #f5f5f5;width: 70%;max-width: 1200px;min-width: 280px;margin: auto;padding: 25px;font-family: Arial, Helvetica, sans-serif;">
            <h4 class="" style="text-align:center;">Contact Us</h4>
            <p class="contact-no" style="text-align:center;"> <b>SL 011 2 10 20 42</b> | AUS 61 (03) 9999 7450 | LUX
                352 20 331 999 | UK 44 752 06 44 688 | CA 1 (403)
                8000111 | SGP 65 (3) 1594440</p>
            <p style="text-align:center;">info@roomista.com</p>
        </div>
    </div>
    <div class="bg-light-blue footer" style="background: #f5f9ff !important;">
        <div class="i-container" style="background: #fff;width: 70%;max-width: 1200px;min-width: 280px;margin: auto;padding: 25px;font-family: Arial, Helvetica, sans-serif;" style="">
            <div class="row py-4">
                <div class="col-md-6 col-12">
                    <img src="{{ asset('images/logo-dark.png') }}" width="120" alt="">
                </div>
                <div class="copyright col-md-6 col-12 d-flex align-items-center justify-content-end"
                    style="text-align: right;">
                    Copyright © {{ date('Y') }} &nbsp;<a href="https://roomista.com"> Roomista.com</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
