@php
config()->set('app.name', $property->name);
@endphp
<div>
    <style>
        .detail-image-popup {
            height: 300px;
            width: 500px;
            overflow: hidden;
            object-fit: cover;
        }

        .owl-details-img-popup .owl-nav {

            position: absolute;
            top: 80%;
            /* transform: translateY(-50%); */
            width: 100%;
            /* display: flex; */
            /* justify-content: space-between; */


        }

        .owl-details-img-popup .owl-nav .owl-prev,
        .owl-details-img-popup .owl-nav .owl-next {
            background-color: var(--button-main-color);
            border-radius: 50%;
            font-size: 0;
        }

        .owl-details-img-popup .owl-nav .owl-next::before {
            content: '\2192';

            font-size: 20px;
        }

        .owl-details-img-popup .owl-nav .owl-prev::before {
            content: '\2190';
            font-size: 20px;
        }


        .details-img-popup-prev-button,
        .details-img-popup-next-button {
            position: absolute;
            top: 50%;
            transform: translateY(-30%);

            font-size: 10px;
            width: 50px;
            height: 50px;
            color: #fff;
            background-color: var(--button-main-color);
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
            border: 10px solid white;
            z-index: 1;
            transition: background-color 0.3s ease;
        }

        .details-img-popup-prev-button {
            left: 10px;

        }

        .details-img-popup-next-button {
            right: 10px;
        }

        /* Popup Styles */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            max-width: 600px;
            margin: 20px auto;
            position: relative;
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }


        .policy p strong {
            font-family: 'RoomistaMedium';
            text-transform: capitalize;

        }

        .policy p {

            text-transform: capitalize;

        }

        .modal {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: left;
            align-items: left;
            z-index: 1000;
            /* Ensure the first modal is on top */
        }

        .modal-content {
            background-color: #fff;
            width: 100%;
            padding: 20px;
            border-radius: 5px;
            z-index: 9999;
        }

        .second-modal {
            display: none;
            position: fixed;
            left: 0;
            /* Adjust as needed */
            top: 0;
            /* Adjust as needed */
            width: 100%;
            /* Adjust as needed */
            height: 100%;
            /* Adjust as needed */
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 2000;
            /* Ensure the second modal is on top of the first modal */
        }

        .third-modal {
            display: none;
            position: fixed;
            left: 0;
            /* Adjust as needed */
            top: 0;
            /* Adjust as needed */
            width: 100%;
            /* Adjust as needed */
            height: 100%;
            /* Adjust as needed */
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .second-modal-content {
            position: relative;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 50%;

        }

        .profile-container {
            display: flex;
            flex-direction: row;
            align-items: center;
        }


        .avatar {
            font-size: 20px;
            /* Set the desired font size for the icon */
            color: white;
            /* Set the desired color for the icon */
            border-radius: 50%;
            /* Make it a circle */
            background-color: var(--button-main-color);
            /* Set the desired background color for the circle */
            width: 40px;
            /* Set the desired width */
            height: 40px;
            /* Set the desired height */
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .third-modal-content {
            position: relative;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 50%;

        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .close-button-review {
            position: fixed;
            top: 10px;
            right: 32%;
            background: none;
            border: none;
            z-index: 9999;
            cursor: pointer;
        }

        .text-container {
            max-width: 200px;
            /* Set your desired maximum width */
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1001;
        }

        .see-more-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
            overflow-y: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1001;
        }




        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .attrac-image {
            height: 350px;
            object-fit: cover;
            border-radius: 5px;

        }

        .image-text-overlay-nearest {
            position: absolute;
            top: 75%;
            left: 0;
            width: 100%;

            text-align: center;
            color: white;
            /* Set the text color */
            font-size: 16px;
            /* Set the font size */
            /* Add any additional styling as needed */
            background: rgba(0, 0, 0, 0.5);
            /* Set the background color with alpha channel for transparency */
            padding: 40px;
            /* Add padding for better readability */
            border-radius: 5px;
            /* padding-bottom: 40px; */
        }

        /* Add some basic styles for better presentation */
        .review {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 10px;
            text-align: left;
            height: 250px;
        }

        .customer-image {
            max-width: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .fixed-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            /* Adjust the z-index as needed */
        }

        .default-icon {
            /* Style for the default icon */
            max-width: 40px;
            max-height: 40px;
            border-radius: 50%;
            background-color: var(--button-main-color);
            /* Default background color */
            color: #fff;
            /* Default text color */
            text-align: center;
            line-height: 50px;
            /* Center content vertically */
            font-size: 24px;
            margin-right: 10px;
        }

        .default-icon-rev {
            /* Style for the default icon */
            max-width: 40px;

            border-radius: 50%;
            background-color: #ccc;
            /* Default background color */
            color: #fff;
            /* Default text color */
            text-align: center;
            line-height: 40px;
            /* Center content vertically */
            font-size: 14px;

        }

        .custom-prev,
        .custom-next {
            position: absolute;
            top: 45%;
            transform: translateY(-30%);

            font-size: 15px;
            width: 40px;
            height: 40px;
            color: #fff;
            background-color: #00427F;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
            border: 5px solid white;
            z-index: 1;
            transition: background-color 0.3s ease;
        }

        .custom-prev:hover,
        .custom-next:hover {
            background-color: var(--main-color);
            /* Adjust the hover background color as needed */
        }

        .custom-prev {
            left: -10px;

        }

        .custom-next {
            right: -10px;
        }

        /* hotel  */
        .prev-hotel,
        .next-hotel {
            position: absolute;
            /* top: 45%; */
            transform: translateY(-300%);

            font-size: 15px;
            width: 70px;
            height: 70px;
            color: #fff;
            background-color: var(--button-main-color);
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
            border: 5px solid white;
            z-index: 1;
            transition: background-color 0.3s ease;
        }

        .prev-hotel:hover,
        .next-hotel:hover {
            background-color: var(--main-color);
            /* Adjust the hover background color as needed */
        }

        .prev-hotel {
            left: -10px;

        }

        .next-hotel {
            right: -10px;
        }

        .round-box {
            border: 1px solid red;
            border-radius: 5px;

        }

        .hotel-paragraph {
            font-weight: 300;
            letter-spacing: 0.06rem;
            font-family: var(--font-family-CircularStd);
            color: #333;
            opacity: 0.8;
            font-stretch: 200%;
            line-height: 1.5;
            margin-bottom: 0.05rem;
        }

        .ps3hotel-content-paragraph {
            font-weight: 300;
            letter-spacing: 0.06rem;
            font-family: var(--font-family-CircularStd);
            color: #333;
            opacity: 0.8;
            font-stretch: 200%;
            line-height: 1.5;


        }
        @media only screen and (max-width: 500px) {
            .prop-main-images{
                display: none;
            }
          
        }
        @media only screen and (max-width: 1024px) {
           
           
        }
    </style>
    <div>
        <section class="banner-one">
            <div class="banner-one_image-layer" style="background-image: url('{{ $property->featuredMedia[0]->original_url }}');background-size: cover; filter: brightness(60%);"></div>
            <div class="auto-container">

                <!-- Content Column -->
                <div class="banner-one_content">
                    <div class="banner-one_content-inner">
                        <div class="container">
                            <!--breadcrumb-->
                            <!-- <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('all-properties') }}">Property</a></li>
                                <li class="breadcrumb-item active text-capitalize" aria-current="page">{{ $property->name }}</li>
                            </ol>
                        </nav> -->
                            <!--end breadcrumb-->
                        </div>
                        <!-- <div class="banner-one_title">
                                Find Your Dream Luxury 
                            </div> -->
                        <h3 class="banner-one_heading-hotel" style="font-size:75px;">{{ $property->name }}</h3>

                        <div class="banner-one_text" style="font-family: 'Poppins', sans-serif;">{{ $property->address_1 }}</div>



                    </div>
                </div>
            </div>
        </section>
        <div class="container py-3 position-relative property-detials-page" data-bs-spy="scroll" data-bs-target="#property-scroll" data-bs-offset="10">



            <div class="row property-details-header" id="heading">
                <div class="col-12 col-md-8">
                    <!-- <a class="text-secondary" href="{{ route('property-details', $property->slug) }}"
                            style="text-decoration:none;">
                            <h1 class="mb-0">{{ $property->name }}</h1>
                        </a> -->
                    <div class="d-flex align-items-center mt-2">
                        <!-- <p class="address mb-0">{{ $property->address_1 }}</p> -->
                        {{-- <div class="property-rating d-flex ms-2">
                                <i class="fas fa-star star-rating-fill"></i>
                                <i class="far fa-star not-fill"></i>
                                <i class="far fa-star not-fill"></i>
                                <i class="far fa-star not-fill"></i>
                                <i class="far fa-star not-fill"></i>
                            </div> --}}
                    </div>
                </div>

                <!-- <div class="col-12 col-md-4">
                        <div class="d-flex align-items-center justify-content-lg-end mt-2">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="far fa-star"></i>
                            </button>
                            <button class="btn btn-sm btn-primary ms-3" id="top-reserve-btn">
                                Reserve
                            </button>
                        </div>
                        <div class="text-end mt-2"><b>
                                {{ $this->displayCurrency($this->getLowestRate($property->id)) }}</b>/<small>1 day(s)</small>
                        </div>
                    </div> -->
            </div>
            <section class="photo-gallery" id="gallery" wire:ignore>
                <div class="row g-0">
                    <div class="col-12 col-md-6" style="height: 516px;">
                        <div class="gallery-image-item pt-1 p-1" style="overflow: hidden; border-radius:5px; position: relative; height:516px;">
                            <img class="img image-hover" style="border-radius: 5px; width:100%; height:100%;" src="{{ count($property->featuredMedia) > 0 ? $property->featuredMedia[0]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" alt="">
                            <div class="button-box position-absolute" style="bottom: 15px; left:15px; width: auto;">
                                <button class="btn-style-two theme-btn" data-bs-toggle="modal" data-bs-target="#propertyImageGalleryModel-{{ $property->id }}">
                                    <span class="btn-wrap">
                                        <span class="text-one"><i class="fa fa-bars" aria-hidden="true"></i> See all photos</span>
                                        <span class="text-two"><i class="fa fa-bars" aria-hidden="true"></i> See all photos</span>
                                    </span>
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-md-6 prop-main-images">
                        <div class="row g-0">
                            @for ($i = 0; $i < 4; $i++) @if ($i < 4) <div class="col-md-6">

                                <div style="height: 100%;"> <!-- First div -->
                                    <div class="gallery-image-item pt-1 p-1" style="border-radius:5px; overflow:hidden;">

                                        <img class="img image-hover" style="height: 250px; width:100%; border-radius: 5px;" src="{{ count($property->featuredMedia) > 0 && $i + 1 < count($property->featuredMedia) ? $property->featuredMedia[$i + 1]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" alt="">



                                    </div>
                                </div>

                        </div>
                        @endif
                        @endfor
                    </div>
                </div>
                {{-- image gallery --}}
                @livewire('property.property-gallery-images-component', ['propertyId' => $property->id])
                {{-- image gallery end --}}
            </section>
            <nav id="property-scroll" class="navbar navbar-light bg-white px-0 mt-4  overflow-hidden" wire:ignore>
                <ul class="nav nav-pills  flex-nowrap single-property-sticky-navbar">
                    <li class="nav-item ">
                        <a class="nav-link pe-3 active" style="color: black; opacity:1; font-size: 15px;" href="#overview">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-3" style="color: black; opacity:1; font-size: 15px;" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-3" style="color: black; opacity:1; font-size: 15px;" href="#rooms">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-3" style="color: black; opacity:1; font-size: 15px;" href="#policies">Policies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-3" style="color: black; opacity:1; font-size: 15px;" href="#facilities">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-3" style="color: black; opacity:1; font-size: 15px;" href="#reviews">Reviews</a>
                    </li>
                </ul>
            </nav>
            <section class="property-container">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="property-highlights card date-select-box" style="padding: 30px;">
                            <h3 id="overview" class="text-capitalize mb-3 heding-text-main" style="font-size: 1.5rem;">
                                {{ $property->name }} - Property highlights
                            </h3>

                            <div class="row mt-2">
                                @foreach ($highlights as $highlight)
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div>
                                        <div class="image-box" style="flex-direction:row; border:1px solid #e1dbdb; height: auto; margin-bottom:15px; padding:10px;">

                                            @php
                                            if (count($highlight->media) > 0) {
                                            $imagePath = $highlight->media[0]->original_url;

                                            } else {
                                            $imagePath = null;
                                            }
                                            // var_dump($highlight->media)
                                            @endphp
                                            <img style="margin-left: 5px;" src="{{ $imagePath ? $imagePath : asset('images/placeholders/placeholder1000x650.webp') }}" class="img-icon" alt="..." onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';">
                                            <!-- <i class="{{ $highlight->image }}"
                                                    style="color: #163ed0c7!important; font-size: 220%;"></i> -->
                                            <div class="" style="text-align:left; padding-left: 10px;">
                                                <p class="hotel-paragraph" style="color: black; opacity:1;">{{ $highlight->name }}</p>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                @endforeach
                            </div>
                            <!-- <hr> -->
                            {{-- <div class="row">
                                    <div class="col-3" style="flex-direction:row;  height: auto; margin-bottom:15px; padding:10px; text-align: center;">
                                        <!-- <span class="fa fa-circle offers-ava" style="color: black;"></span> -->
                                        <span class="offers-ava" style="color: black;">Best-price guarantee</span>
                                    </div>
                                   
                                    @foreach($rooms as $roomname)
                                    <div class="col-3" style="flex-direction:row;  height: auto; margin-bottom:15px; padding:10px; text-align: center;">
                                        <!-- <span class="fa fa-circle offers-ava" style="color: black;"></span> -->
                                      
                                        <span class="offers-ava" style="color: black;">{{ $roomname->name }} Type Option</span>

                        </div>
                        @endforeach
                        <div class="col-3" style="flex-direction:row; height: auto; margin-bottom:15px; padding:10px; text-align: center;">
                            @php
                            $offerRate = $this->getLowestOfferRate($property->id)
                            @endphp
                            @if($offerRate !== 0 )


                            <div>
                                <!-- <span class="fa fa-circle offers-ava" style="color: black;"></span> -->
                                <span class="offers-ava" style="color: black;">Offers available</span>
                            </div>

                            @elseif($offerRate == 0)

                            <div>

                                <span style="color: green;"></span>
                            </div>

                            @endif
                            <!-- <img style="width: 20px; margin-right:5px;" src="{{ asset('images/check-mark.png') }}" alt=""> -->
                        </div>
                    </div> --}}

                </div>



                <div class="property-overview card date-select-box my-4" style="padding: 30px;">
                    <h3 id="overview" class="text-capitalize mb-3 heding-text-main" style="font-size: 1.5rem;">
                        {{ $property->name }} - Property Overview
                    </h3>
                    <div class="row mt-1">
                        <div class="col-12">
                            <h6 class="hotel-content-paragraph">{!! $property->description !!}</h6>
                        </div>
                    </div>
                </div>
                <!-- <hr id="services" class="property-scrollspy " /> -->
                <div class="property-services my-4 card date-select-box" style="padding: 30px;">
                    <h3 class="text-capitalize mb-3 heding-text-main" style="font-size: 1.5rem;">{{ $property->name }} - Services & Amenities</h3>
                    <div class="row mt-1">
                        @foreach ($amenities as $amenity)
                        <div class="col-12 col-sm-6 col-md-4">
                            <div>
                                <div class="image-box" style="flex-direction:row; border:1px solid #e1dbdb; height: auto; margin-bottom:15px; padding:10px;">

                                    @php
                                    if (count($amenity->media) > 0) {
                                    $imagePath = $amenity->media[0]->original_url;

                                    } else {
                                    $imagePath = null;
                                    }
                                    // var_dump($amenity->media)
                                    @endphp
                                    <img style="margin-left: 5px;" src="{{ $imagePath ? $imagePath : asset('images/placeholders/placeholder1000x650.webp') }}" class="img-icon" alt="..." onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';">
                                    <!-- <i class="{{ $amenity->image }}"
                                                    style="color: #163ed0c7!important; font-size: 220%;"></i> -->
                                    <div class="" style="text-align:left; padding-left: 10px;">
                                        <p class="hotel-paragraph" style="color: black; opacity:1;">{{ $amenity->name }}</p>
                                    </div>
                                </div>

                            </div>

                        </div>


                        @endforeach
                    </div>
                    <!-- add search form start-->
                    <!-- <hr /> -->
                    {{-- <div class="">
                            <div class="row px-lg-3 " style="margin-top: 10px;">
                                <div class="col-12" id="">

                                    <div class="row align-items-center py-2 shadow-sm rounded-2"
                                        style="background-color: #f5f9ff;">

                                        <div class="col-md-8 col-12 my-2 my-lg-0  property-search-box" wire:ignore>
                                            <!--  <label class="ms-2" for="" style="color: black; font-weight: 500; font-size: 15px;">Check in - Check out</label> -->
                                            <input style="font-family: 'Jost'; font-size: 15px; color: #697488; border:0; z-index:9999;" type="text" id="roomFilterDateSelect" class="form-control border-1 py-3"
                                                placeholder="Arrival date — Departure date" aria-label="Select Date">
                                        </div>
                                        <div class="col-md-4 col-12 align-items-center d-flex">
                                            <button class="btn-style-two theme-btn w-100" wire:click="searchProperty" style="height:100%;"
                                                            >
                                                        <span class="btn-wrap">
                                                            <span class="text-one"><i class="fas fa-search" aria-hidden="true"></i> Search</span>
                                                            <span class="text-two w-100"><i class="fas fa-search" aria-hidden="true"></i> Search</span>
                                                        </span>
                                            </button>
                                            <!-- <button class="btn btn-primary w-100 py-3  align-items-center" style="height:100%;"
                                                wire:click="searchProperty"><i class="fas fa-search fw-100 align-items-center"
                                                    style="font-size: 20px; margin-right:5px;"> </i> Search</button> -->
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>--}}
                    <!-- add search form end-->
                </div>



        </div>

        <div class="col-12 col-md-4 ps-lg-5 mb-2 mb-lg-0">
            <div class="card date-select-box">
                <div class="card-body" style="padding: 30px;">
                    <div class="meta-row">
                        <div class="nights">
                            <div>{{ $noOfNights }} <span style="font-size: 20px;">Night(s)</span> </div>

                        </div>
                        <div class="nights">
                            <div>
                                <span class="fa fa-star checked" style="font-size: 17px; color:rgb(249 115 22);"></span> <span style="font-size: 17px;">
                                    {{ number_format($fullreviewcount, 1) }}</span>
                                <span style="opacity: 0.7; font-size:13px;">({{ $reviewcount }})</span>
                            </div>

                        </div>
                        <!-- <div class="rating">
                                        <span class="fa fa-star checked"> 4.5 (112)</span>
                                            <div class="rating-box">
                                                5.0
                                            </div>
                                            <small>1 reviews</small>
                                        </div> -->
                    </div>
                    <hr />
                    <div class="card">
                        <div class="p-3">

                            <div class="row">
                               

                                <div class="col-md-12">

                                    <div class="form-group mb-3" wire:ignore>
                                        <label class="date-select" for="" class="">Check In - Check Out</label>
                                        <input type="text" class="form-control-check" id="dateSelectBox" style="font-family: 'Jost'; font-size: 15px; color: #697488; border:0;">
                                    </div>

                                </div>
                            </div>

                            <hr>

                            <a href="#rooms" style="padding: 12px 20px; z-index:0;" id="checkAvailability" class="btn-style-two theme-btn w-100">
                                <div class="btn-wrap">
                                    <span class="text-one">Check Availability<i class="icon-arrow-top-right ms-2"></i></span>
                                    <span class="text-two w-100">Check Availability<i class="icon-arrow-top-right ms-2"></i></span>

                                </div>

                            </a>
                            <!-- <a href="#rooms" role="button" class="btn btn-primary w-100 mt-2"
                                            style="padding: 14px 35px; font-size: 15px;" id="checkAvailability">Check
                                            Availability <i class="icon-arrow-top-right ms-2"></i> </a> -->

                        </div>


                    </div>

                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body location-map">
                    {!! $property->map_location !!}
                </div>

            </div>
            <div class="card mt-3" style="height:350px;">
                <div class="card-body youtube-video">
                    <iframe class="ytvideo" width="100%" height="100%" src="{{ $property->video_url }}" allowfullscreen>
                    </iframe>
                </div>

            </div>
        </div>



    </div>
    </section>
    <hr />
    <section class="rooms">
        <h5 id="rooms" class="text-capitalize mb-3 property-scrollspy heding-text-main" style="font-size: 1.5rem;">Select Your Room</h5>
        <div class="border p-0" style="border-radius:5px;">
            @foreach ($rooms as $room)
            <div class="row g-0">
                <div class="col-12 col-md-12 col-lg-3">
                    <div class="p-3 mb-1 text-white text-center menu-bg-color room-heading-text">{{ $room->name }}</div>
                    <div class="px-3">
                        @php
                        $imagePaths = [];
                        if (count($room->media) > 0) {
                        foreach ($room->media as $media) {
                        $imagePaths[] = $media->original_url;
                        }
                        }
                        @endphp
                        <div class="owl-details-img owl-carousel owl-theme " style="z-index: 0;" wire:ignore>
                            @foreach ($imagePaths as $imagePath)
                            <div style="object-fit: cover;">

                                <img src="{{ $imagePath ? $imagePath : asset('images/placeholders/placeholder1000x650.webp') }}" style="height: 100%; width: 100%; " class="" alt="..." onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';">


                            </div>


                            @endforeach
                        </div>


                        <div class="mt-2 no-room-text mb-4" onclick="showPopup('{{ $room->id }}');" style="cursor: pointer;">
                            {{ substr($room->description, 0, 60) }}
                            <span id="seeMore{{ $room->id }}" onclick="showPopup('{{ $room->id }}'); return false;">... <a href="#" style="color: var(--button-main-color);">See more</a></span>

                        </div>
                        <div class="popup-overlay" id="popupOverlaymore{{$room->id}}"></div>
                        <div id="seeMorePopup{{ $room->id }}" class="see-more-popup container">
                            <span class="fa fa-close" style="float: right; cursor: pointer;" onclick="hidePopup('{{ $room->id }}')"></span>
                            <div class="container" style="margin: 0;">

                                <div class="col-12">
                                    <div class="row">
                                        <!-- Image column (col-md-7) -->
                                        <div class="col-md-5" style="height: 300px; overflow: hidden;">
                                            <div class="owl-details-img-popup owl-carousel owl-theme " style="z-index: 0;" wire:ignore>

                                                @foreach ($imagePaths as $imagePath)
                                                <div class="detail-image-popup">
                                                    <img style="height: 100%; width: 100%;" src="{{ $imagePath ? $imagePath : asset('images/placeholders/placeholder1000x650.webp') }}" class="img-fluid rounded-1" alt="..." onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';">
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Description column (col-md-5) -->
                                        <div class="col-md-7">
                                            <h5 class="no-room-text fw-bold" style="font-size: 1.7rem;">{{ $room->name }} Room</h5>
                                            <div class="no-room-text">
                                                <p>{{ $room->description }}</p>
                                            </div>
                                            <div class="no-room-text fw-800">
                                                <p>Max Adults Count: {{$room->max_adults}}</p>
                                            </div>
                                            <div class="no-room-text fw-800">
                                                <p>Max Child Count: {{$room->max_child}}</p>
                                            </div>
                                            <div class="no-room-text fw-800">
                                                <p>Max Extra Beds Count: {{$room->max_extra_beds}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-9">
                    <div class="row g-0">
                        <div class="col-12">
                            <div class="row g-0">
                                <div class="col-12 col-md-2">
                                    <div class="p-1 p-md-3 mb-1 text-white text-center menu-bg-color room-heading-text">Guests
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="p-1 p-md-3 mb-1 text-white text-center menu-bg-color room-heading-text">Meal Type
                                    </div>
                                </div>
                                <div class="col-4 col-md-3 d-none d-md-block">
                                    <div class="p-3 mb-1 text-white text-center menu-bg-color room-heading-text">No. of Rooms
                                    </div>
                                </div>
                                <!-- <div class="col-4 col-md-3 d-none d-md-block">
                                                    <div class="p-3 mb-1 bg-primary-light text-white text-center">Policies</div>
                                                </div> -->

                                <div class="col-4 col-md-4 d-none d-md-block">
                                    <div class="p-3 mb-1 text-white text-center menu-bg-color room-heading-text">Price
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($room->bedTypes as $bedType)
                    <div>
                        @livewire('property.room-bed-type-component', ['room' => $room, 'bedType' => $bedType, 'checkIn' => $checkIn, 'checkOut' => $checkOut, 'isLocal' => $isLocal], key($room->id . $bedType->id))

                    </div>

                    <hr>
                    @endforeach

                </div>
            </div>
            @endforeach
        </div>

    </section>
    <!-- ******************************************************************** -->
    <!-- //nearby loacations
                Hotel facilities -->
    <!-- ******************************************************************** -->
    <div class="customer-reviews">
        <h3 class="text-capitalize mb-3 heding-text-main" style="font-size: 1.5rem;">{{ $property->name }} - Reviews</h3>

        @if($reviewDetails->count() > 0)
        <div class="room-review_box">
            <div class="row clearfix">
                <!-- Column -->
                <div class="column col-12 col-md-4 col-sm-12">
                    <div class="review-box">
                        <div class="rating-details">
                            <p class="text-capitalize mb-3 facility-text" style="font-size: 1rem;">Cleanliness</p>
                            <p class="count text-capitalize mb-3 facility-text">{{ number_format($cleanlinessaverage, 1) }}</p>
                        </div>
                        <div class="bar" style="width: {{ number_format($cleanlinessaverage * 10, 1) }}%; background-color:
                                                        {{ $cleanlinessaverage > 8 ? 'green' : ($cleanlinessaverage > 4 ? 'blue' : 'red') }};">
                        </div>
                    </div>
                    <div class="review-box">
                        <div class="rating-details">
                            <p class="text-capitalize mb-3 facility-text" style="font-size: 1rem;">Staff</p>
                            <p class="count text-capitalize mb-3 facility-text">{{ number_format($staffaverage, 1) }}</p>
                        </div>
                        <div class="bar" style="width: {{ number_format($staffaverage * 10, 1) }}%; background-color:
                                                        {{ $staffaverage > 8 ? 'green' : ($staffaverage > 4 ? 'blue' : 'red') }};">
                        </div>

                    </div>

                </div>
                <!-- Column -->
                <div class="column col-12 col-md-4 col-sm-12">
                    <div class="review-box">
                        <div class="rating-details">
                            <p class="text-capitalize mb-3 facility-text" style="font-size: 1rem;">Comfort</p>
                            <p class="count text-capitalize mb-3 facility-text">{{ number_format($comfortaverage, 1) }}</p>
                        </div>
                        <div class="bar" style="width: {{ number_format($comfortaverage * 10, 1) }}%; background-color:
                                                        {{ $comfortaverage > 8 ? 'green' : ($comfortaverage > 4 ? 'blue' : 'red') }};">
                        </div>

                    </div>
                    <div class="review-box">
                        <div class="rating-details">
                            <p class="text-capitalize mb-3 facility-text" style="font-size: 1rem;">Value for money</p>
                            <p class="count text-capitalize mb-3 facility-text">{{ number_format($valueformoneyaverage, 1) }}</p>
                        </div>
                        <div class="bar" style="width: {{ number_format($valueformoneyaverage * 10, 1) }}%; background-color:
                                                        {{ $valueformoneyaverage > 8 ? 'green' : ($valueformoneyaverage > 4 ? 'blue' : 'red') }};">
                        </div>

                    </div>

                </div>
                <!-- Column -->
                <div class="column col-12 col-md-4 col-sm-12">
                    <div class="review-box">
                        <div class="rating-details">
                            <p class="text-capitalize mb-3 facility-text" style="font-size: 1rem;">Facilities</p>
                            <p class="count text-capitalize mb-3 facility-text">{{ number_format($facilitiesaverage, 1) }}</p>
                        </div>
                        <div class="bar" style="width: {{ number_format($facilitiesaverage * 10, 1) }}%; background-color:
                                                        {{ $facilitiesaverage > 8 ? 'green' : ($facilitiesaverage > 4 ? 'blue' : 'red') }};">
                        </div>

                    </div>
                    <div class="review-box">
                        <div class="rating-details">
                            <p class="text-capitalize mb-3 facility-text " style="font-size: 1rem;">Location</p>
                            <p class="count text-capitalize mb-3 facility-text">{{ number_format($locationaverage, 1) }}</p>
                        </div>
                        <div class="bar" style="width: {{ number_format($locationaverage * 10, 1) }}%; background-color:
                                                        {{ $locationaverage > 8 ? 'green' : ($locationaverage > 4 ? 'blue' : 'red') }};">
                        </div>

                    </div>

                </div>
            </div>
            <button id="openModalBtn" class="btn-style-two theme-btn" style="width: 200px;">

                <span class="btn-wrap">
                    <span class="text-one">Read all Reviews</span>
                    <span class="text-two" style="width: 170px;">Read all Reviews</span>
                </span>
            </button>
            <div class="column">
                <!-- Rating Category -->
                <div class="rating-category">
                    <div class="owl-prop owl-carousel owl-theme" wire.ignore.self>
                        @foreach($reviewDetails as $reviewDetailrv)
                        <div class="review">
                            <div class="profile-container">
                                <div class="avatar">
                                    {{ strtoupper(substr($reviewDetailrv->name, 0, 1)) }}
                                </div>
                                <div class="profile-name">
                                    <h6 class="rating-category-new" style="font-weight: bold; font-size:1rem; margin-bottom:0; line-height:normal; padding-left:10px;">{{ strtok($reviewDetailrv->name, ' ') }}</h6>
                                </div>
                            </div>

                            <div class="rating-category-new mt-3" style="font-size: 0.9rem; line-height:normal; letter-spacing:normal;">

                                {{ substr($reviewDetailrv->comment, 0, 300) }}
                                <span class="see-more-link" data-comment="{{ $reviewDetailrv->comment }}" data-initial="{{ strtoupper(substr($reviewDetailrv->name, 0, 1)) }}" data-name="{{ strtok($reviewDetailrv->name, ' ') }}" onclick="showPopupReview(this); return false;">
                                    ...<br> <a href="#" style="color: var(--button-main-color);">See more</a>
                                </span>

                            </div>


                        </div>
                        @endforeach

                    </div>
                    <!-- Custom Previous Button -->
                    <!-- <button class="custom-prev fa fa-chevron-left" ></button> -->

                    <!-- Custom Next Button -->
                    <!-- <button class="custom-next fa fa-chevron-right"></button> -->
                    <!-- <div class="popup-overlay" id="popupOverlay"></div> -->

                </div>
            </div>
            <!-- Popup Box -->
            <div class="popup-overlay" id="popupOverlayreviw">
                <div class="popup-content">
                    <div class="popup-close" onclick="hidePopupReview()">×</div>
                    <div id="popupContent"></div>
                </div>
            </div>
        </div>
        @else
        <div class="mb-4">
            <button onclick="openSecondModal()" class="btn-style-two theme-btn" style="width: 200px;">
                <span class="btn-wrap">
                    <span class="text-one">Write Review</span>
                    <span class="text-two" style="width: 170px;">Write Review</span>
                </span>
            </button>

        </div>
        @endif




        <!-- First Modal -->
        <div id="myModal" class="modal" wire:ignore.self>
            <div class="modal-content" style="overflow: auto; width:70%">
                <p class="text-capitalize mb-1 facility-text fw-600" style="font-size: 1.4rem;">Categories :</p>
                <div class="room-review_box row mt-4 mb-0">
                    <div class="row clearfix">
                        <!-- Column -->
                        <div class="column col-12 col-md-4 col-sm-12">
                            <div class="review-box">
                                <div class="rating-details">
                                    <p class="text-capitalize mb-3 facility-text" style="font-size: 1rem;">Cleanliness</p>
                                    <p class="count text-capitalize mb-3 facility-text">{{ number_format($cleanlinessaverage, 1) }}</p>
                                </div>
                                <div class="bar" style="width: {{ number_format($cleanlinessaverage * 10, 1) }}%; background-color:
                                                        {{ $cleanlinessaverage > 8 ? 'green' : ($cleanlinessaverage > 4 ? 'blue' : 'red') }};">
                                </div>
                            </div>
                            <div class="review-box">
                                <div class="rating-details">
                                    <p class="text-capitalize mb-3 facility-text" style="font-size: 1rem;">Staff</p>
                                    <p class="count text-capitalize mb-3 facility-text">{{ number_format($staffaverage, 1) }}</p>
                                </div>
                                <div class="bar" style="width: {{ number_format($staffaverage * 10, 1) }}%; background-color:
                                                        {{ $staffaverage > 8 ? 'green' : ($staffaverage > 4 ? 'blue' : 'red') }};">
                                </div>

                            </div>

                        </div>
                        <!-- Column -->
                        <div class="column col-12 col-md-4 col-sm-12">
                            <div class="review-box">
                                <div class="rating-details">
                                    <p class="text-capitalize mb-3 facility-text" style="font-size: 1rem;">Comfort</p>
                                    <p class="count text-capitalize mb-3 facility-text">{{ number_format($comfortaverage, 1) }}</p>
                                </div>
                                <div class="bar" style="width: {{ number_format($comfortaverage * 10, 1) }}%; background-color:
                                                        {{ $comfortaverage > 8 ? 'green' : ($comfortaverage > 4 ? 'blue' : 'red') }};">
                                </div>

                            </div>
                            <div class="review-box">
                                <div class="rating-details">
                                    <p class="text-capitalize mb-3 facility-text" style="font-size: 1rem;">Value for money</p>
                                    <p class="count text-capitalize mb-3 facility-text">{{ number_format($valueformoneyaverage, 1) }}</p>
                                </div>
                                <div class="bar" style="width: {{ number_format($valueformoneyaverage * 10, 1) }}%; background-color:
                                                        {{ $valueformoneyaverage > 8 ? 'green' : ($valueformoneyaverage > 4 ? 'blue' : 'red') }};">
                                </div>

                            </div>

                        </div>
                        <!-- Column -->
                        <div class="column col-12 col-md-4 col-sm-12">
                            <div class="review-box">
                                <div class="rating-details">
                                    <p class="text-capitalize mb-3 facility-text" style="font-size: 1rem;">Facilities</p>
                                    <p class="count text-capitalize mb-3 facility-text">{{ number_format($facilitiesaverage, 1) }}</p>
                                </div>
                                <div class="bar" style="width: {{ number_format($facilitiesaverage * 10, 1) }}%; background-color:
                                                        {{ $facilitiesaverage > 8 ? 'green' : ($facilitiesaverage > 4 ? 'blue' : 'red') }};">
                                </div>

                            </div>
                            <div class="review-box">
                                <div class="rating-details">
                                    <p class="text-capitalize mb-3 facility-text " style="font-size: 1rem;">Location</p>
                                    <p class="count text-capitalize mb-3 facility-text">{{ number_format($locationaverage, 1) }}</p>
                                </div>
                                <div class="bar" style="width: {{ number_format($locationaverage * 10, 1) }}%; background-color:
                                                        {{ $locationaverage > 8 ? 'green' : ($locationaverage > 4 ? 'blue' : 'red') }};">
                                </div>

                            </div>

                        </div>



                    </div>
                </div>
                <div>
                    <button onclick="openSecondModal()" class="btn-style-two theme-btn" style="width: 100%;">
                        <span class="btn-wrap">
                            <span class="text-one">Write Review</span>
                            <span class="text-two" style="width: 100%;">Write Review</span>
                        </span>
                    </button>
                </div>
                <div>
                    @foreach($reviewDetails as $reviewDetail)
                    <div class="col-lg-12 mt-4" style="border-bottom: 1px solid gray; margin-top:10px;">
                        <div class="row">
                            <div class="col-lg-3 mt-2">

                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="profile-container">
                                            <div class="avatar">
                                                {{ strtoupper(substr($reviewDetail->name, 0, 1)) }}
                                            </div>
                                            <div class="profile-name">
                                                <h6 class="rating-category-new" style="font-weight: bold; font-size:.8rem; margin-bottom:0; line-height:normal; padding-left:10px;">{{ strtok($reviewDetail->name, ' ') }}</h6>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 mt-2">
                                <h6 class="rating-category-new" style="font-size: 0.6rem; line-height:normal; margin-bottom:2px;margin-top:2px;">
                                    Reviwed {{ $reviewDetail->created_at}}</h6>
                                <h6 class="rating-category-new" style="font-weight: bold; font-size:1.2rem; margin-bottom:5px;">
                                    {{ $reviewDetail->heading }}
                                </h6>
                                <p class="rating-category-new" style="font-size: 0.8rem; line-height:normal; letter-spacing:normal;">{{$reviewDetail->comment}}</p>
                            </div>
                            @if($userEmaildelte == $reviewDetail->email)
                            <div class="col-lg-12 d-flex justify-content-end">
                                <button class="rating-category-new" style="font-weight: bold; font-size:.8rem; margin-bottom:0; line-height:normal; padding-left:10px; color:var(--button-main-color);" wire:click="deleteReview({{ $reviewDetail->review_id }})">Delete</button>


                            </div>

                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>


                <button class="close-button-review" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>

            </div>
        </div>

        <!-- Second Modal -->
        <div id="secondModal" class="second-modal" wire:ignore.self>
            @auth('customers')

            <div class="second-modal-content">
                <h3 class="facility-text" style="font-size: 1.6rem;">Enter Your Booking Details</h3>

                <div class="mt-3 mb-5" style=" display: flex; flex-direction: column;">
                    <label for="" class="facility-text">Booking Number</label>

                    <input wire:model="bookingNumber" class="booking-id-input facility-text" style="font-family: CircularStd;" type="text">

                    @if($bookingStatus === '0')
                    <p class="facility-text text-danger">No booking found. Please check your booking number.</p>
                    @endif
                    @if($bookingStatus === '2')
                    <p class="facility-text text-danger">Review Already Exists.</p>
                    @endif
                </div>

                <div class="col-12 col-md-12 mb-lg-0 mb-2">
                    <!-- Button Box -->
                    <div class="button-box">
                        <button class="btn-style-two" style="padding: 10px; width:100%; bottom:0;" wire:click.prevent="rateStay">
                            <span class="btn-wrap">
                                <span class="text-one">RATE YOUR STAY</span>
                                <span class="text-two" style=" width:100%">RATE YOUR STAY</span>
                            </span>
                        </button>
                    </div>

                </div>

                <button class="close-button" onclick="closeSecondModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            @else
            <div class="second-modal-content">
                <p>Please Login And Come Back....</p>

                <div class="button-box">
                    <button class="btn-style-two" style="padding: 10px; width:100%; bottom:0;" onclick="redirectToLogin()">
                        <span class="btn-wrap">
                            <span class="text-one">LOGIN</span>
                            <span class="text-two" style="width:100%">LOGIN</span>
                        </span>
                    </button>
                </div>
                <button class="close-button" onclick="closeSecondModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            @endauth
        </div>
        <!-- 3rd Modal -->
        <div id="thirdmodal" class="third-modal" wire:ignore.self>
            <div class="third-modal-content" style="overflow: auto;">
                <h3 class="facility-text" style="font-size: 1.6rem;">Enter Your Ratings</h3>
                <div class="row">


                    <div class="column col-12 col-md-4 col-sm-12 mb-3">
                        <div class="mb-3" style=" display: flex; flex-direction: column; align-items: center; justify-content: space-between;">
                            <label for="" class="facility-text">Comfort</label>
                            <div style="display: flex; flex-direction: row;">
                                <input id="Comfort" name="Comfort" wire:model="Comfort" class="range-input facility-text" style="font-family: CircularStd; order: 3;" type="range" min="0" max="10" step="1">
                            </div>
                            <span style="order: 4;">{{ $Comfort }}</span>
                        </div>
                        <div class="mb-3" style=" display: flex; flex-direction: column; align-items: center; justify-content: space-between;">
                            <label for="" class="facility-text">Value for money</label>
                            <div style="display: flex; flex-direction: row;">
                                <input id="Valueformoney" name="Valueformoney" wire:model="Valueformoney" class="range-input facility-text" style="font-family: CircularStd; order: 3;" type="range" min="0" max="10" step="1">
                            </div>
                            <span style="order: 4;">{{ $Valueformoney }}</span>
                        </div>


                    </div>
                    <div class="column col-12 col-md-4 col-sm-12 mb-3">
                        <div class="mb-3" style=" display: flex; flex-direction: column; align-items: center; justify-content: space-between;">
                            <label for="" class="facility-text">Facilities</label>
                            <div style="display: flex; flex-direction: row;">
                                <input id="Facilities" name="Facilities" wire:model="Facilities" class="range-input facility-text" style="font-family: CircularStd; order: 3;" type="range" min="0" max="10" step="1">
                            </div>
                            <span style="order: 4;">{{ $Facilities }}</span>
                        </div>
                        <div class="mb-3" style=" display: flex; flex-direction: column; align-items: center; justify-content: space-between;">
                            <label for="" class="facility-text">Location</label>
                            <div style="display: flex; flex-direction: row;">
                                <input id="Location" name="Location" wire:model="Location" class="range-input facility-text" style="font-family: CircularStd; order: 3;" type="range" min="0" max="10" step="1">
                            </div>
                            <span style="order: 4;">{{ $Location }}</span>
                        </div>

                    </div>
                    <div class="column col-12 col-md-4 col-sm-12 mb-3">
                        <div class="mb-3" style=" display: flex; flex-direction: column; align-items: center; justify-content: space-between;">
                            <label for="" class="facility-text">Cleanliness</label>
                            <div style="display: flex; flex-direction: row;">
                                <input id="Cleanliness" name="Cleanliness" wire:model="Cleanliness" class="range-input facility-text" style="font-family: CircularStd; order: 3;" type="range" min="0" max="10" step="1">
                            </div>
                            <span style="order: 4;">{{ $Cleanliness }}</span>
                        </div>
                        <div class="mb-3" style=" display: flex; flex-direction: column; align-items: center; justify-content: space-between;">
                            <label for="" class="facility-text">Staff</label>
                            <div style="display: flex; flex-direction: row;">
                                <input id="Staffrate" name="Staffrate" wire:model="Staffrate" class="range-input facility-text" style="font-family: CircularStd; order: 3;" type="range" min="0" max="10" step="1">
                            </div>
                            <span style="order: 4;">{{ $Staffrate }}</span>
                        </div>


                    </div>
                </div>
                <div class="mb-2" style=" display: flex; flex-direction: column;">
                    <label for="heading" class="facility-text">Heading</label>
                    <input id="heading" name="heading" wire:model="heading" class="booking-id-input facility-text" style="font-family: CircularStd;" type="text">
                </div>
                <div class="mb-2" style=" display: flex; flex-direction: column;">
                    <label for="comment" class="facility-text">Comment</label>
                    <textarea id="comment" name="comment" wire:model="comment" class="booking-id-input facility-text" style="font-family: CircularStd; height:120px;"></textarea>
                </div>
                <div class="col-12 col-md-12 mb-lg-0 mb-2">
                    <!-- Button Box -->
                    <div class="button-box">
                        <button class="btn-style-two" style="padding: 10px; width:100%; bottom:0;" wire:click.prevent="addReview">
                            <span class="btn-wrap">
                                <span class="text-one">ADD YOUR REVIEW</span>
                                <span class="text-two" style="width:100%">ADD YOUR REVIEW</span>
                            </span>
                        </button>
                    </div>

                </div>
                <button class="close-button" onclick="closeThirdModal()">
                    <i class="fas fa-times"></i>
                </button>

            </div>
        </div>
        <!-- Column -->

    </div>
    @if($facilities->count() > 0)
    <div class="mt-40">
        <div class="">
            <div class="row x-gap-40 y-gap-40">
                <div class="col-12">
                    <h3 class="text-capitalize mb-3 heding-text-main" style="font-size: 1.5rem;">{{ $property->name }} - Facilities</h3>
                    <div class="row x-gap-40 y-gap-40 pt-20" style="margin-bottom: 30px;">
                        @foreach ($facilities->chunk(3) as $chunk)
                        <div class="col-xl-4">
                            <div class="row y-gap-30 mt-4">
                                @foreach ($chunk as $Facility)
                                <div class="col-12">
                                    <div>
                                        <div class="d-flex text-16 fw-800">
                                            <i class="{{ $Facility->icon}} mr-15 facility-text" style="font-weight:600;"></i>
                                            <span class="facility-heading" style="padding-left: 15px;">{{ $Facility->name}} </span>


                                        </div>
                                        <ul class="text-15" style="margin-top:15px; margin-bottom:20px;">
                                            @php
                                            $subFacilities = explode(',', $Facility->sub_facilities);
                                            @endphp
                                            @foreach ($subFacilities as $subFacility)
                                            <li>
                                                <i class="icon-check mr-15 facility-text" style="font-size: 13px;"></i><span class="facility-text" style="padding-left: 15px;">{{ trim($subFacility) }}</span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                                @endforeach

                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>

    </div>
    @endif
    <h4 id="policies" class="text-capitalize mb-3 heding-text-main" style="font-size: 1.5rem;">{{ $property->name }} - Property Policies</h4>
    <div class="policy">{!! $property->hotel_policy
        ? $property->hotel_policy
        : App\Models\Settings::where(['key' => 'default_privacy_policy'])->first()->value !!}</div>
    {{-- <h4 id="facilities">Facilities</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, veniam perferendis fugit doloribus suscipit libero
                    beatae fugiat minima, architecto ut delectus asperiores. Nemo illo reiciendis voluptates doloribus! A magnam
                    dolorem est cupiditate alias ipsum totam natus dolores delectus quis accusamus fugit quod provident corporis,
                    officia inventore magni ex labore quibusdam?</p> --}}
    {{-- <h4 id="reviews">Reviews</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, veniam perferendis fugit doloribus suscipit libero
                    beatae fugiat minima, architecto ut delectus asperiores. Nemo illo reiciendis voluptates doloribus! A magnam
                    dolorem est cupiditate alias ipsum totam natus dolores delectus quis accusamus fugit quod provident corporis,
                    officia inventore magni ex labore quibusdam?</p> --}}





    <div>
        @livewire('cart.cart-component')
    </div>
    <div style="padding-top:30px;">
        <h3 class="text-capitalize mb-3 heding-text-main" style="font-size: 1.5rem;">Nearest Properties</h3>
        <div class="owl-hotel owl-carousel owl-theme" wire:ignore>
            @foreach ($propeties as $property)

            <div class="item">
                <div class="">
                    <div class="location-block_one-inner" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 15px 80px 4px;">
                        <div class="location-block_one-image">
                            <a href="{{ route('property-details', ['slug' => $property->slug]) }}">
                                <img src="{{ count($property->featuredMedia) > 0 ? $property->featuredMedia[0]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" class="attrac-image" alt="..." onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';" alt="">
                                <div class="image-text-overlay-nearest">
                                    <div class="overlat-text" style="color: white;">{{ $property->name }}</div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <img src="{{ count($property->featuredMedia) > 0 ? $property->featuredMedia[0]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" class="img-fluid rounded-1" alt="..." onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';" alt="">
                            <h4>{{$property->name}}</h4> -->
            </div>
            @endforeach
        </div>
        <!-- Custom Previous Button -->
        <button class="prev-hotel fa fa-chevron-left"></button>

        <!-- Custom Next Button -->
        <button class="next-hotel fa fa-chevron-right"></button>
    </div>

    <div>
        <a href="#" class="bg-primary cart-icon" id="openCartButton">
            <i class="fas fa-hotel" style="color: white;"></i>

        </a>

    </div>
    <div>
        <p  class="cart-icon-count" id="openCartButton">
            <span class="cart-count">{{ $cartCount }}</span>

    </p>

    </div>

    @livewire('cart.cart-component')
    <div class="currency-changer">
        <div class="currency-main">
            <div type="button" class="lkr-button {{ $isLocal == $defaultCurrencyname ? 'currency-active' : '' }}" wire:click.prevent="changeCurrency('{{$defaultCurrencyname}}')" wire.ignore>
                <p class="currency-text">{{$defaultCurrencyname}}</p>
            </div>
            @if($secondaryCurrencyname)
            <div type="button" class="usd-button {{ $isLocal != $defaultCurrencyname ? 'currency-active' : '' }}" wire:click.prevent="changeCurrency('{{$secondaryCurrencyname}}')"  wire.ignore>
                <p class="currency-text">{{$secondaryCurrencyname}}</p>
            </div>
            @endif
        </div>
    </div>
</div>

</div>

@push('page-scripts')
<script>
    var openModalBtn = document.getElementById('openModalBtn');
    var modal = document.getElementById('myModal');
    var secondModal = document.getElementById('secondModal');
    var thirdmodal = document.getElementById('thirdmodal');

    if (openModalBtn) {
        openModalBtn.addEventListener('click', function() {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Disable scroll
            document.documentElement.style.overflow = 'hidden';
        });
    }
    if (secondModal) {
        function openSecondModal() {
            secondModal.style.display = 'flex';
        }
    }


    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto'; // Enable scroll
        document.documentElement.style.overflow = 'auto';

        // Destroy the existing Owl Carousel instance
        $('.owl-prop').owlCarousel('destroy');

        // Reinitialize Owl Carousel
        $('.owl-prop').owlCarousel({
            loop: true,
            items: 3,
            margin: 10,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });

        // Add click event handlers for custom buttons
        $('.custom-prev').click(function() {
            $('.owl-prop').trigger('prev.owl.carousel');
        });

        $('.custom-next').click(function() {
            $('.owl-prop').trigger('next.owl.carousel');
        });
    }

    function closeSecondModal() {
        // Hide the second modal
        secondModal.style.display = 'none';
    }

    document.addEventListener('livewire:load', function() {
        Livewire.on('openThirdModal', function() {
            openThirdModal();
        });

        function openThirdModal() {
            thirdmodal.style.display = 'flex';
            secondModal.style.display = 'none';
        }
    });
    document.addEventListener('livewire:load', function() {
        Livewire.on('closeThirdModal', function() {
            closeThirdModal();
        });

        function openThirdModal() {
            thirdmodal.style.display = 'flex';
            secondModal.style.display = 'none';
        }
    });

    document.addEventListener('livewire:load', function() {
        Livewire.on('reloadPage', function() {
            location.reload(); // Reload the page using JavaScript
        });
    });

    function closeThirdModal() {
        thirdmodal.style.display = 'none';

        // Destroy the existing Owl Carousel instance
        $('.owl-prop').owlCarousel('destroy');

        // Reinitialize Owl Carousel
        $('.owl-prop').owlCarousel({
            loop: true,
            items: 3,
            margin: 10,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });

        // Add click event handlers for custom buttons
        $('.custom-prev').click(function() {
            $('.owl-prop').trigger('prev.owl.carousel');
        });

        $('.custom-next').click(function() {
            $('.owl-prop').trigger('next.owl.carousel');
        });
    }
    // Add this to your JavaScript file or script tag
    function showPopup(roomId) {
        document.getElementById('seeMorePopup' + roomId).style.display = 'block';
        document.getElementById('popupOverlaymore' + roomId).style.display = 'block';
        document.body.style.overflow = 'hidden'; // Disable scroll
        document.documentElement.style.overflow = 'hidden';
    }

    function hidePopup(roomId) {
        document.getElementById('seeMorePopup' + roomId).style.display = 'none';
        document.getElementById('popupOverlaymore' + roomId).style.display = 'none';
        document.body.style.overflow = 'auto'; // Enable scroll
        document.documentElement.style.overflow = 'auto';
    }








    $(document).ready(function() {
        let today = new Date();
        let tomorrow = new Date();
        tomorrow.setDate(today.getDate() + 1);

        const dataToday = @this.get('checkIn');
        const dataTomorrow = @this.get('checkOut');

        today = dataToday ? Date.parse(dataToday) : today;
        tomorrow = dataTomorrow ? Date.parse(dataTomorrow) : tomorrow;
        // console.log(today + '-' + tomorrow)

        const todayString = fecha.format(today, 'YYYY-MM-DD');
        const tomorrowString = fecha.format(tomorrow, 'YYYY-MM-DD');

        const dateSelectCard = document.getElementById('dateSelectBox');

        dateSelectCard.value = todayString + ' - ' + tomorrowString;
        var dateSelectBox = new HotelDatepicker(dateSelectCard, {
            clearButton: false,
            moveBothMonths: true,
            startOfWeek: 'monday',
            selectForward: true,
            onSelectRange: function() {
                var dateRange = dateSelectBox.getValue();
                var dateSplit = dateRange.split(" - ");
                var checkInDate = dateSplit[0];
                var checkOutDate = dateSplit[1];

                $('html, body').animate({
                    scrollTop: $("#rooms").offset().top
                }, 1000);

                @this.set('checkIn', checkInDate);
                @this.set('checkOut', checkOutDate);

            }
        });
    });

    $(document).ready(function() {
        $('.extra-beds-qty').attr("style", "display:none!important");
        $('.extra-beds input').on('click', function() {
            var extraBedsQty = $(this).closest('.extra-beds').find('.extra-beds-qty');

            if ($(this).is(':checked')) {
                extraBedsQty.slideDown(500, function() {
                    $(this).removeAttr("style");
                });
            } else {
                extraBedsQty.slideUp(
                    500,
                    function() {
                        $(this).attr("style", "display:none!important");
                    }
                );
            }
        });
        $('.childrens-qty').attr("style", "display:none!important");
        $('.childrens input').on('click', function() {
            var extraBedsQty = $(this).closest('.childrens').find('.childrens-qty');

            if ($(this).is(':checked')) {
                extraBedsQty.slideDown(500, function() {
                    $(this).removeAttr("style");
                });
            } else {
                extraBedsQty.slideUp(
                    500,
                    function() {
                        $(this).attr("style", "display:none!important");
                    }
                );
            }
        });
    });

    $(document).ready(function() {
        let today = new Date();
        let tomorrow = new Date();
        tomorrow.setDate(today.getDate() + 1);

        const dataToday = @this.get('checkIn');
        const dataTomorrow = @this.get('checkOut');

        today = dataToday ? Date.parse(dataToday) : today;
        tomorrow = dataTomorrow ? Date.parse(dataTomorrow) : tomorrow;
        // console.log(today + '-' + tomorrow)

        const todayString = fecha.format(today, 'YYYY-MM-DD');
        const tomorrowString = fecha.format(tomorrow, 'YYYY-MM-DD');

        const dateSelectCard = document.getElementById('roomFilterDateSelect');

        dateSelectCard.value = todayString + ' - ' + tomorrowString;
        var dateSelectBox = new HotelDatepicker(dateSelectCard, {
            clearButton: false,
            moveBothMonths: true,
            startOfWeek: 'monday',
            selectForward: true,
            onSelectRange: function() {
                var dateRange = dateSelectBox.getValue();
                var dateSplit = dateRange.split(" - ");
                var checkInDate = dateSplit[0];
                var checkOutDate = dateSplit[1];

                @this.set('checkIn', checkInDate);
                @this.set('checkOut', checkOutDate);

            }
        });
    });

    $('#top-reserve-btn').on('click', function() {
        $('html, body').animate({
            scrollTop: $("#rooms").offset().top
        }, 1000);
    })

    window.addEventListener('contentChanged', event => {
        // console.log('sdfdsf');
        var myOffcanvas = document.getElementById('offcanvasRight')
        var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
        bsOffcanvas.show();
    });

    // $('#selectPropertyType').on('change', function(evt) {
    //     @this.set('type', evt.target.value);
    // });
    $(document).ready(function() {
        $('.owl-hotel').owlCarousel({
            loop: true,
            items: 4,
            margin: 25,
            dots: false,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
        // Add click event handlers for custom buttons
        $('.prev-hotel').click(function() {
            $('.owl-hotel').trigger('prev.owl.carousel');
        });

        $('.next-hotel').click(function() {
            $('.owl-hotel').trigger('next.owl.carousel');
        });

    });
    $(document).ready(function() {
        $('.owl-prop').owlCarousel({
            loop: true,
            items: 3,
            margin: 10,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }

        })
        // Add click event handlers for custom buttons
        $('.custom-prev').click(function() {
            $('.owl-prop').trigger('prev.owl.carousel');
        });

        $('.custom-next').click(function() {
            $('.owl-prop').trigger('next.owl.carousel');
        });
    });
    // Livewire event listener to refresh Owl Carousel
    Livewire.on('reviewDeleted', function() {
        // Destroy existing instance
        $(".owl-prop").trigger("destroy.owl.carousel");

        // Reinitialize Owl Carousel
        $(".owl-prop").owlCarousel({
            loop: true,
            items: 3,
            margin: 10,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
        // Add click event handlers for custom buttons
        $('.custom-prev').click(function() {
            $('.owl-prop').trigger('prev.owl.carousel');
        });

        $('.custom-next').click(function() {
            $('.owl-prop').trigger('next.owl.carousel');
        });
    });
    // Livewire event listener to refresh Owl Carousel
    Livewire.on('reviewinsert', function() {
        // Destroy existing instance
        $(".owl-prop").trigger("destroy.owl.carousel");

        // Reinitialize Owl Carousel
        $(".owl-prop").owlCarousel({
            loop: true,
            items: 3,
            margin: 10,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
        // Add click event handlers for custom buttons
        $('.custom-prev').click(function() {
            $('.owl-prop').trigger('prev.owl.carousel');
        });

        $('.custom-next').click(function() {
            $('.owl-prop').trigger('next.owl.carousel');
        });
    });
    Livewire.on('reviewrateStay', function() {
        // Destroy existing instance
        $(".owl-prop").trigger("destroy.owl.carousel");

        // Reinitialize Owl Carousel
        $(".owl-prop").owlCarousel({
            loop: true,
            items: 3,
            margin: 10,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
        // Add click event handlers for custom buttons
        $('.custom-prev').click(function() {
            $('.owl-prop').trigger('prev.owl.carousel');
        });

        $('.custom-next').click(function() {
            $('.owl-prop').trigger('next.owl.carousel');
        });
    });
    $(document).ready(function() {
        $('.owl-details-img').owlCarousel({
            loop: true,
            items: 1,
            margin: 10,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true

        })



    });
    $(document).ready(function() {
        $('.owl-details-img-popup').owlCarousel({
            loop: true,
            items: 1,
            margin: 10,
            nav: true,
            dots: false,


        })



    });
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('openCartButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the anchor link

            var offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasRight'));
            offcanvas.show();
        });
    });


    function showPopupReview(link) {
        var comment = link.getAttribute('data-comment');
        var initial = link.getAttribute('data-initial');
        var name = link.getAttribute('data-name');

        // Populate the popup box with the review details
        var popupContent = '<div style="display: flex; align-items: center; margin-bottom: 10px;">';
        popupContent += '<h4 style="font-size:20px; color:white; width: 40px; height: 40px;  display: flex;align-items: center; justify-content: center; margin-right: 10px; padding:5px; background-color: var(--button-main-color); border-radius:50%;">' + initial + '</h4>';
        popupContent += '<p style="margin-bottom: 0; font-weight:bold;">' + name + '</p>';
        popupContent += '</div>';
        popupContent += '<p>' + comment + '</p>';

        document.getElementById('popupContent').innerHTML = popupContent;

        // Show the popup box
        document.getElementById('popupOverlayreviw').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Disable scroll
        document.documentElement.style.overflow = 'hidden';
    }

    function hidePopupReview() {
        // Hide the popup box
        document.getElementById('popupOverlayreviw').style.display = 'none';
    }

    function hidePopupReview() {
        // Hide the popup
        document.getElementById('popupOverlayreviw').style.display = 'none';
        document.body.style.overflow = 'auto'; // Enable scroll
        document.documentElement.style.overflow = 'auto';
    }

    function redirectToLogin() {
        window.location.href = "{{ route('front.login') }}";
    }
</script>
@endpush
</div>