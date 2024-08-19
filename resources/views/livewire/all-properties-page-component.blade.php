<div>

    <section class="banner-one">
        <div class="banner-one_image-layer" style="background-image: url('{{ asset('images/main-slider/1.jpg') }}')"></div>
        <div class="auto-container">
            <!-- <ul class="page-breadbrumbs">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Property</li>
            </ul> -->
            <!-- Content Column -->
            <div class="banner-one_content">
                <div class="banner-one_content-inner">
                    <div class="container">
                        <!--breadcrumb-->
                        <!-- Page Banner -->
                        <!-- End Page Banner -->
                        <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" style="color: #808080;" aria-current="page">Property</li>
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" style="color: var(--main-color)" aria-current="page">Property</li>
                    </ol>
                </nav> -->
                    </div>
                    <div class="banner-one_title">
                        Find Your Dream Luxury
                    </div>
                    <h1 class="banner-one_heading-hotel">Hotel</h1>

                    <!-- <div class="banner-one_text"  style="font-family: 'Poppins', sans-serif;">Luxury Hotel</div> -->
                    <!-- Form Box -->
                    <div class="banner-one_form-box">
                        <!-- Travel Form -->
                        <div class="travel-form">
                            <form method="post" action="#">
                                <div class="row clearfix">
                                    <div class="col-md-6 col-12 property-search-box">
                                        <!-- <label for="Search Hotel" class="ms-2" style="font-weight: 500; color:black;">Search Hotel</label> -->
                                        <input style="color: var(--main-color);" type="search" id="" class="form-control border-0 py-3 date-select" placeholder="Search Hotel" wire:model.debounce.500ms="searchTerm">
                                    </div>
                                    <div class="col-md-6 col-12 property-search-box" style="border: 0;" wire:ignore>
                                        <!--  <label class="ms-2" for="" style="color: black; font-weight: 500; font-size: 15px;">Check in - Check out</label> -->
                                        <input type="text" id="allPropertyDateSelect" class="form-control border-0 py-3 date-select" placeholder="Check in - Check out" aria-label="Select Date">
                                    </div>

                                    <!-- <div class="col-md-4 col-12 align-items-center d-flex">
                                        <button class="btn btn-primary w-100 py-3  align-items-center" style="height:100%;"><i
                                                class="fas fa-search fw-100 align-items-center" style="font-size: 20px; margin-right:5px;">
                                            </i> Search</button>
                                    </div> -->
                                    <!-- <div class="col-md-4 col-12" >
                                    <div class="button-box">
                                    <button class="btn-style-two">
                                        <span class="btn-wrap">
                                            <span class="text-one">SEARCH</span>
                                            <span class="text-two">SEARCH</span>
                                        </span>
                                    </button>
                                </div>
                                    </div> -->
                                    


                                </div>
                                <!-- Button Box -->
                               
                            </form>
                        </div>
                        <!-- End Travel Form -->
                    </div>


                </div>
            </div>
        </div>
    </section>

    <div class="container" id="allProperties">

        <!--breadcrumb-->
        <!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Property</li>
        </ol>
    </nav> -->
        <!-- //newly added -->

        <!-- <div class="row mb-4 px-3">
        <div class="col-12 justify-center text-center">
            <h2 style="font-weight: bold; color:black;">
                Find Your Dream Luxury Hotel
            </h2>
        </div>
    </div> -->



        <!-- <div class="row mb-4 px-3">
        <div class="col-12" id="propertySearch">

            <div class="row align-items-center py-3 shadow-sm rounded-2" style="background-color: #f5f9ff;"> -->
        <!-- <div class="col-md-5 col-12 property-search-box"> -->
        <!-- <label for="Search Hotel" class="ms-2" style="font-weight: 500; color:black;">Search Hotel</label> -->
        <!-- <input type="search" id="" class="form-control border-1 py-3"
                        style="border-color: #6974883d;" placeholder="Search Hotel"
                        wire:model.debounce.500ms="searchTerm"> -->
        <!-- </div> -->

        <!-- <div class="col-md-3 col-12 property-search-box my-2" wire:ignore> -->
        <!--  <label class="ms-2" for="" style="color: black; font-weight: 500; font-size: 15px;">Check in - Check out</label> -->
        <!-- <input type="text" id="allPropertyDateSelect" class="form-control border-0 py-3" -->
        <!-- placeholder="Check in - Check out" aria-label="Select Date"> -->
        <!-- </div> -->
        <!-- <div class="col-md-4 col-12 align-items-center d-flex">
                    <button class="btn btn-primary w-100 py-3  align-items-center" style="height:100%;"><i
                            class="fas fa-search fw-100 align-items-center" style="font-size: 20px; margin-right:5px;">
                        </i> Search</button>
                </div> -->

        <!-- desabled -->
        <!-- <div class="col-md-3 property-search-box" wire:ignore>
                    <label for="checkinout" class="ms-2" style="font-weight: 500; color:black;">Location</label>

                    <select class="form-control form-select select2 select2-select border-0" id="selectDestination" aria-label="Default select example">
                        <option selected value="">Select Location</option>
                        @foreach ($destinations as $destination)
<option value="{{ $destination->id }}">{{ $destination->name }}</option>
@endforeach
                    </select>

                </div>
                <div class="col-md-3 property-search-box" wire:ignore>
                    <label for="guest" class="ms-2" style="font-weight: 500; color:black;">Property Type</label>

                    <select class="form-control form-select select2 select2-select border-0" id="selectPropertyType" aria-label="Default select example" wire:model="type">
                        <option selected value="">Select Property Type</option>
                        @foreach ($propertTypes as $propertType)
<option value="{{ $propertType->id }}">{{ $propertType->name }}</option>
@endforeach
                    </select>
                </div>
                <div class="col-md-2">

                    <button type="button" id="search" class="btn btn-lg btn-primary w-100">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div> -->
        <!-- </div>
        </div>
    </div> -->

        <!-- //newly added -->


        <div class="row mt-5">
            <div class="col-12 col-lg-3">

                <div id="propertySearch" class="property-search">
                    <div class="card bg-light-blue border-0">
                        <div class="card-body">

                            <!-- <div class="form-group mb-3">
                            <label for="">Hotel Name</label>
                            <input type="search" class="form-control" name="" id="" placeholder="" wire:model.debounce.500ms="searchTerm">
                        </div> -->
                            <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Select City</div>
                                </div>
                                <div class="form-group mb-3" wire:ignore>

                                    <select class="form-select filter-text" id="selectDestination" aria-label="Default select example" wire:model="destination" style="background-color: transparent;">
                                        <option selected value="">Property City</option>
                                        @foreach ($destinations as $destination)
                                        <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- <div class="form-group mb-3" wire:ignore>

                                    <select class="form-select filter-text" id="selectPropertyType" aria-label="Default select example" wire:model="type">
                                        <option selected value="">Rooms Number</option>
                                        @foreach ($propertTypes as $propertType)
                                        <option value="{{ $propertType->id }}">{{ $propertType->name }}</option>
                                        @endforeach
                                    </select>
                                </div> -->

                            </div>
                            <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Select Property Type</div>
                                </div>

                                <div class="form-group mb-3" wire:ignore>
                                    @foreach ($propertTypes as $propertType)
                                    <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                    <label class="d-flex align-items-center">
                                            <input class="checkbox" type="checkbox" id="propertyType{{ $propertType->id }}" wire:model="selectedPropertyTypes" value="{{ $propertType->id }}">
                                            <label class="filter-text mb-0" style="margin-left: 8px;" for="propertyType{{ $propertType->id }}">
                                                {{ $propertType->name }}
                                            </label>
                                        </label>
                                    </div>

                                    @endforeach
                                </div>
                            </div>

                            <!-- <hr> -->
                            <!-- <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Price Scale</div>
                                </div>
                                <div class="form-group mb-3" wire:ignore>

                                    <div class="range">
                                        <div class="range-slider">
                                            <span class="range-selected"></span>
                                        </div>
                                        <div class="range-input filter-text">
                                            <input type="range" class="min" min="1000" max="100000" value="10000" step="10">
                                            <input type="range" class="max" min="1000" max="100000" value="70000" step="10">
                                        </div>
                                        <div class="range-price filter-text">
                                            <label for="">LKR</label>
                                            <input type="text" name="min" value="10000" disabled>
                                            <label for="">LKR</label>
                                            <input type="text" name="max" value="70000" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <hr>
                            <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Facilities</div>
                                </div>
                                <div class="form-group mb-3" wire:ignore>
                                    <div class="row">


                                        <div class="">
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px; ">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedAmenities" value="Airport shuttle">
                                                    <p class="filter-text mb-0" style=" margin-left: 8px;">Airport shuttle</p>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="">
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px; ">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedAmenities" value="Spa">
                                                    <p class="filter-text mb-0" style=" margin-left: 8px;">Spa & Welness</p>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedAmenities" value="Hot Water">
                                                    <p class="filter-text mb-0" style=" margin-left: 8px;">Hot Water</p>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="" style="text-align: left;padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedAmenities" value="Beach">
                                                    <p class="filter-text mb-0" style=" margin-left: 8px;">Beach</p>
                                                </label>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>
                            <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Meals</div>
                                </div>
                                <div class="form-group mb-3" wire:ignore>
                                    <div class="row">



                                        <div class="">
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedAmenities" value="Bar">
                                                    <p class="filter-text mb-0" style=" margin-left: 8px;">Bar</p>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedAmenities" value="Breakfast">
                                                    <p class="filter-text mb-0" style=" margin-left: 8px;">Breakfast</p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Offers</div>
                                </div>
                                <div class="form-group mb-3" wire:ignore>

                                    <select class="form-select filter-text" id="selectDestination" aria-label="Default select example" wire:model="offer" style="background-color: transparent;">
                                        <option selected value="">Offers List</option>
                                        @foreach ($offers as $offer)
                                        <option value="{{ $offer->id }}">{{ $offer->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Star Ratings</div>
                                </div>
                                <div class="form-group mb-3" wire:ignore>
                                    <div class="row">
                                        <div class="filter-text">
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedStars" value="1">
                                                    <span style="padding-left:8px;">1 Star</span>
                                                </label>
                                            </div>
                                            <div class="" style="text-align: left;padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedStars" value="2">
                                                    <span style="padding-left: 8px;">2 Stars</span>
                                                </label>
                                            </div>
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedStars" value="3">
                                                    <span style="padding-left: 8px;">3 Stars</span>
                                                </label>
                                            </div>
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedStars" value="4">
                                                    <span style="padding-left: 8px;">4 Stars</span>
                                                </label>
                                            </div>
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedStars" value="5">
                                                    <span style="padding-left: 8px;">5 Stars</span>
                                                </label>

                                            </div>
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedStars" value="0">
                                                    <span style="padding-left: 8px;">Unrated</span>
                                                </label>
                                            </div>



                                        </div>
                                        <!-- @foreach ($amenities as $amenity)
                          
                            <div class="col-md-6">
                            <div class="card" style="text-align: left; padding:8px; margin-bottom: 10px;">
                            <label style="font-size:13px;">
                                <input type="checkbox" wire:model="selectedAmenity" value="{{ $amenity->id }}">
                                {{ $amenity->name }}
                            </label>
                            
                            </div>
                            </div>
                           
                            @endforeach -->
                                    </div>

                                </div>
                            </div>

                            {{-- <div class="form-group mb-3">
                            <label for="">Star Rating</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                </label>
                            </div>
                        </div> --}}
                            <!-- add price filter opption end -->
                            <div class="form-group mb-3 ">
                                {{-- <label for="">Star Rating</label> --}}
                                <!-- new star rating start -->
                                {{-- <div class="btn-group col-12 mt-1   " role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check rounded-full px-9" name="btnradio" id="btnradio1" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="btnradio1">1</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio2">2</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio3">3</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio4">4</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio5">5</label>
                            </div> --}}
                                <!-- new star rating end -->

                                <!-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                </label>
                            </div> -->
                            </div>
                            {{-- <div class="form-group mb-3">
                            <label for="">Amenities</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    WI-FI
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Swimming pool
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Car park
                                </label>
                            </div>
                        </div> --}}
                        </div>
                    </div>
                </div>
                <div id="mobileSearch" class="mobile-search">
                    <p id="mobile-drop">Filters</p>
                    <div id="propertySearchmobile" class="property-search">
                    <div class="card bg-light-blue border-0">
                        <div class="card-body">

                            <!-- <div class="form-group mb-3">
                            <label for="">Hotel Name</label>
                            <input type="search" class="form-control" name="" id="" placeholder="" wire:model.debounce.500ms="searchTerm">
                        </div> -->
                            <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Select City</div>
                                </div>
                                <div class="form-group mb-3" wire:ignore>

                                    <select class="form-select filter-text" id="selectDestination" aria-label="Default select example" wire:model="destination" style="background-color: transparent;">
                                        <option selected value="">Property City</option>
                                        @foreach ($destinations as $destination)
                                        <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- <div class="form-group mb-3" wire:ignore>

                                    <select class="form-select filter-text" id="selectPropertyType" aria-label="Default select example" wire:model="type">
                                        <option selected value="">Rooms Number</option>
                                        @foreach ($propertTypes as $propertType)
                                        <option value="{{ $propertType->id }}">{{ $propertType->name }}</option>
                                        @endforeach
                                    </select>
                                </div> -->

                            </div>
                            <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Select Property Type</div>
                                </div>

                                <div class="form-group mb-3" wire:ignore>
                                    @foreach ($propertTypes as $propertType)
                                    <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                    <label class="d-flex align-items-center">
                                            <input class="checkbox" type="checkbox" id="propertyType{{ $propertType->id }}" wire:model="selectedPropertyTypes" value="{{ $propertType->id }}">
                                            <label class="filter-text mb-0" style="margin-left: 8px;" for="propertyType{{ $propertType->id }}">
                                                {{ $propertType->name }}
                                            </label>
                                        </label>
                                    </div>

                                    @endforeach
                                </div>
                            </div>

                            <!-- <hr> -->
                            <!-- <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Price Scale</div>
                                </div>
                                <div class="form-group mb-3" wire:ignore>

                                    <div class="range">
                                        <div class="range-slider">
                                            <span class="range-selected"></span>
                                        </div>
                                        <div class="range-input filter-text">
                                            <input type="range" class="min" min="1000" max="100000" value="10000" step="10">
                                            <input type="range" class="max" min="1000" max="100000" value="70000" step="10">
                                        </div>
                                        <div class="range-price filter-text">
                                            <label for="">LKR</label>
                                            <input type="text" name="min" value="10000" disabled>
                                            <label for="">LKR</label>
                                            <input type="text" name="max" value="70000" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <hr>
                            <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Facilities</div>
                                </div>
                                <div class="form-group mb-3" wire:ignore>
                                    <div class="row">


                                        <div class="">
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px; ">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedAmenities" value="Airport shuttle">
                                                    <p class="filter-text mb-0" style=" margin-left: 8px;">Airport shuttle</p>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="">
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px; ">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedAmenities" value="Spa">
                                                    <p class="filter-text mb-0" style=" margin-left: 8px;">Spa & Welness</p>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedAmenities" value="Hot Water">
                                                    <p class="filter-text mb-0" style=" margin-left: 8px;">Hot Water</p>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="" style="text-align: left;padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedAmenities" value="Beach">
                                                    <p class="filter-text mb-0" style=" margin-left: 8px;">Beach</p>
                                                </label>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>
                            <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Meals</div>
                                </div>
                                <div class="form-group mb-3" wire:ignore>
                                    <div class="row">



                                        <div class="">
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedAmenities" value="Bar">
                                                    <p class="filter-text mb-0" style=" margin-left: 8px;">Bar</p>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedAmenities" value="Breakfast">
                                                    <p class="filter-text mb-0" style=" margin-left: 8px;">Breakfast</p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Offers</div>
                                </div>
                                <div class="form-group mb-3" wire:ignore>

                                    <select class="form-select filter-text" id="selectDestination" aria-label="Default select example" wire:model="offer" style="background-color: transparent;">
                                        <option selected value="">Offers List</option>
                                        @foreach ($offers as $offer)
                                        <option value="{{ $offer->id }}">{{ $offer->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <div style="padding-bottom: 10px;">
                                    <div class="filter-heading">Star Ratings</div>
                                </div>
                                <div class="form-group mb-3" wire:ignore>
                                    <div class="row">
                                        <div class="filter-text">
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedStars" value="1">
                                                    <span style="padding-left:8px;">1 Star</span>
                                                </label>
                                            </div>
                                            <div class="" style="text-align: left;padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedStars" value="2">
                                                    <span style="padding-left: 8px;">2 Stars</span>
                                                </label>
                                            </div>
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedStars" value="3">
                                                    <span style="padding-left: 8px;">3 Stars</span>
                                                </label>
                                            </div>
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedStars" value="4">
                                                    <span style="padding-left: 8px;">4 Stars</span>
                                                </label>
                                            </div>
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedStars" value="5">
                                                    <span style="padding-left: 8px;">5 Stars</span>
                                                </label>

                                            </div>
                                            <div class="" style="text-align: left; padding-left: 8px; padding-bottom:10px;">
                                                <label class="d-flex align-items-center">
                                                    <input type="checkbox" wire:model="selectedStars" value="0">
                                                    <span style="padding-left: 8px;">Unrated</span>
                                                </label>
                                            </div>



                                        </div>
                                        <!-- @foreach ($amenities as $amenity)
                          
                            <div class="col-md-6">
                            <div class="card" style="text-align: left; padding:8px; margin-bottom: 10px;">
                            <label style="font-size:13px;">
                                <input type="checkbox" wire:model="selectedAmenity" value="{{ $amenity->id }}">
                                {{ $amenity->name }}
                            </label>
                            
                            </div>
                            </div>
                           
                            @endforeach -->
                                    </div>

                                </div>
                            </div>

                            {{-- <div class="form-group mb-3">
                            <label for="">Star Rating</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                </label>
                            </div>
                        </div> --}}
                            <!-- add price filter opption end -->
                            <div class="form-group mb-3 ">
                                {{-- <label for="">Star Rating</label> --}}
                                <!-- new star rating start -->
                                {{-- <div class="btn-group col-12 mt-1   " role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check rounded-full px-9" name="btnradio" id="btnradio1" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="btnradio1">1</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio2">2</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio3">3</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio4">4</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio5">5</label>
                            </div> --}}
                                <!-- new star rating end -->

                                <!-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="far fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                    <i class="fas fa-star star-rating-fill"></i>
                                </label>
                            </div> -->
                            </div>
                            {{-- <div class="form-group mb-3">
                            <label for="">Amenities</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    WI-FI
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Swimming pool
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Car park
                                </label>
                            </div>
                        </div> --}}
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="property-list-header">
                    <h2 class="heding-text-main">{{ $propeties->total() }} Propeties</h2>
                    <div class="item-wrapper">
                        @foreach ($propeties as $property)
                        <div class="col-12 property-main">
                            <div class="card property-card" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 15px 80px 4px;">
                                <div class="row g-1">
                                    <div class="col-12 col-md-4 pe-2" style="align-self: flex-start;">
                                        <div class="property-image">
                                            <img class="imgMain" src="{{ count($property->featuredMedia) > 0 ? $property->featuredMedia[0]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" class="img-fluid rounded-1" alt="..." onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';">
                                            <div class="addtional-images d-flex align-items-center">
                                                @for ($i = 0; $i < 4; $i++) @if ($i < 3) <div class="addtional-image" data-bs-toggle="tooltip" data-bs-html="true" data-bs-custom-class="beautifier" title='<img src="{{ count($property->featuredMedia) > 0 && $i + 1 < count($property->featuredMedia) ? $property->featuredMedia[$i + 1]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" alt="Image">'>
                                                    <img src="{{ count($property->featuredMedia) > 0 && $i + 1 < count($property->featuredMedia) ? $property->featuredMedia[$i + 1]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" alt="" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';">
                                            </div>
                                            @else
                                            {{-- onclick="fetchGalleryImages('{{ $property->id }}')" --}}
                                            {{-- <div class="addtional-image position-relative" data-bs-toggle="modal" data-bs-target="#propertyGalleryModel-{{ $property->id }}"> --}}
                                            <div class="addtional-image position-relative" data-bs-toggle="modal" data-bs-html="true" data-bs-custom-class="beautifier" title='<img src="{{ count($property->featuredMedia) > 0 && $i + 1 < count($property->featuredMedia) ? $property->featuredMedia[$i + 1]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" alt="Image">' data-bs-target="#propertyImageGalleryModel-{{ $property->id }}">
                                                <img src="{{ count($property->featuredMedia) > 0 && $i + 1 < count($property->featuredMedia) ? $property->featuredMedia[$i + 1]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" alt="" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';">
                                            </div>
                                            @endif
                                            @endfor
                                        </div>
                                    </div>

                                </div>


                                <div class="col-12 col-md-8 prop-data">
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="card-body ps-2 pt-0 pb-0">



                                                <div class="row">


                                                    <div class="property-add">
                                                        <i class="fas fa-map-marker-alt" style="margin-left: 5px;"></i>
                                                        {{ $property->address_1 && $property->address_1 != 'NULL' ? $property->address_1 : '' }}

                                                    </div>

                                                    <a href="{{ route('property-details', $property->slug) }}" target="_blank" class="text-decoration-none text-dark">
                                                        <h2 class="property-name-heading">{{ $property->name }}</h2>
                                                    </a>

                                                    <div style="margin-bottom: 5px;  ">
                                                        @for ($i = 1; $i <= 5; $i++) @if ($i <=$property->stars) <span class="fa fa-star checked"></span>
                                                            @else

                                                            @endif
                                                            @endfor

                                                    </div>
                                                    <div style="margin-bottom: 5px;">
                                                        @php
                                                        $offerRate = $this->getLowestOfferRate($property->id)
                                                        @endphp
                                                        @if($offerRate !== 0 )


                                                        <div>
                                                            <span class="fa fa-check offers-ava" style="color: #f26422;"></span>
                                                            <span class="offers-ava" style="color: #f26422;">Offers available</span>
                                                        </div>

                                                        @elseif($offerRate == 0)

                                                        <div>

                                                            <span style="color: green;"></span>
                                                        </div>

                                                        @endif
                                                        <!-- <img style="width: 20px; margin-right:5px;" src="{{ asset('images/check-mark.png') }}" alt=""> -->
                                                    </div>
                                                    <div>
                                                        <span class="fa fa-check offers-ava" style="color: #16a664;"></span>
                                                        <span class="offers-ava" style="color: #16a664;">Best-price guarantee</span>
                                                    </div>


                                                    <!-- <p class="property-address" style="padding-bottom: 1px;">
                                                    {{ $property->address_1 && $property->address_1 != 'NULL' ? $property->address_1 : '' }}
                                                </p> -->

                                                    <div class="property-pricing mt-3 mt-lg-0" style="width:103%; display: flex; justify-content: space-between; height: 70%; margin-top:30px;">

                                                        <!-- Left Div -->
                                                        <!-- <div style="width: 100%; max-height:32px; overflow:hidden;">
                                                       
                                                            @foreach ($property->amenities as $key => $amenity)
                                                                @if($key < 4)
                                                              
                                                                <span class="badge text-dark border px-3 mb-1"
                                                                style="font-weight: 100;padding: 7px; font-size:12px;">  
                                                                <i class="{{ $amenity->icon }}" style="color: #163ed0!important; padding-right:5px;"></i>{{ $amenity->name }}</span>
                                                                @else
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                       
                                                        </div> -->
                                                        <!-- Divider Div -->
                                                        <!-- <div style="width: 1px; background-color: #ddd;"></div> -->

                                                        <!-- Right Div -->
                                                        <!-- <div style="width: 30%; display: flex; flex-direction: column;align-self: flex-end;">
                                                        
                                                               
                                                            
                                                            <div class="text-end" >
                                                             
                                                                @php
                                                                $totalRate = $this->getLowestRate($property->id);
                                                                $offerRate = $this->getLowestOfferRate($property->id)
                                                                @endphp
                                                                @if ($totalRate > 0 && $offerRate > 0)
                                                                <p>1 night</p>
                                                                <b class="fw-600" style="font-size: 14px; color: red; text-decoration:line-through; font-family: Poppins;">
                                                                    {{ $this->displayCurrency($totalRate) }}</b>
                                                                <br>
                                                                <b class="fw-600" style="font-size: 20px; color: green; font-family: Poppins; ">{{ $this->displayCurrency($offerRate) }}</b>
                                                                @elseif ($totalRate > 0 )
                                                                <p>1 night</p>
                                                             
                                                                <b class="price-text"
                                                                                style="color: green; font-family: Poppins;">{{ $this->displayCurrency($totalRate) }}</b>

                                                                @endif
                                                            </div>
                                                        </div> -->

                                                    </div>


                                                    <div id="bottom" class="bottom-div" style="position: absolute;bottom: 5px;">
                                                        <div style="height: 50px; float: left; display:flex; justify-content: space-between; ">
                                                            <div class="property-reviews inline-block flex-row">

                                                                <!-- <div class="rating-box">
                                                                5.0
                                                        </div>
                                                        <div class="me-2" style="padding-left: 5px; ">
                                                      
                                                            <span class="mt-1"><strong style="font-weight: bold;" >Good</strong> <br style="font-size: 5px;">2 reviews</span>
                                                        </div>    -->
                                                                <div class="text-start">

                                                                    @php
                                                                    $totalRate = $this->getLowestRate($property->id);
                                                                    $offerRate = $this->getLowestOfferRate($property->id);
                                                                    $finalRate = $offerRate > 0 ? $offerRate : ($totalRate / 2);
                                                                    @endphp
                                                                    @if ($totalRate > 0 && $offerRate > 0)
                                                                    <!-- <p>1 night</p> -->
                                                                    <span class="price-text" style="color: red; text-decoration:line-through;">
                                                                        {{ $this->displayCurrency($totalRate) }}</span>
                                                                    <br>
                                                                    <span class="price-text-main">{{ $this->displayCurrency($offerRate) }}</span>
                                                                    @elseif ($totalRate > 0 )
                                                                    <!-- <p>1 night</p> -->

                                                                    <span class="price-text-main">{{ $this->displayCurrency($totalRate) }}</span>

                                                                    @endif
                                                                    @if($offerRate == null && $totalRate > 0)
                                                                    <p class="mt-1" style="color: red;">Pay {{$this->displayCurrency($finalRate)}} confirm your booking</p>
                                                                    @endif
                                                                    
                                                                </div>
                                                               
                                                            </div>
                                                            
                                                        </div>
                                                        

                                                        <div style="height: 50px; float: right; display:flex; justify-content: space-between; ">

                                                            <!-- <style>
                                                #bottom {
                                                  display: none; 
                                                }
                                               </style> -->

                                                            @if ($totalRate > 0)
                                                            <a href="{{ route('property-details', $property->slug) }}" style="padding: 20px 20px;" class="btn-style-two theme-btn w-100" target="_blank">
                                                                <div class="btn-wrap">
                                                                    <span class="text-one">Book Now <i class="icon-arrow-top-right ms-2"></i></span>
                                                                    <span class="text-two">Book Now <i class="icon-arrow-top-right ms-2"></i></span>

                                                                </div>

                                                            </a>
                                                            @else
                                                            <a href="https://wa.me/94777666124" style="padding: 20px 20px;" class="btn-style-two theme-btn w-100" target="_blank">
                                                                <div class="btn-wrap">
                                                                    <span class="text-one">Contact Us <i class="fab fa-whatsapp ms-2"></i></span>
                                                                    <span class="text-two">Contact Us <i class="fab fa-whatsapp ms-2"></i></span>

                                                                </div>
                                                            </a>
                                                            @endif
                                                        </div>
                                                        

                                                    </div>
                                                    
                                                   
                                                </div>
                                                

                                            </div>
                                            
                                        </div>
                                        
                                        <div class="" style="width: 23%;">
                                            <div class=" position-relative" style="float: right;">
                                                <div class="">

                                                    <div class="property-add">
                                                        <span class="review-text">{{$property->review_count}} review</span>
                                                    </div>
                                                    <div class="" style="float: right;">
                                                        <div class="rating-box">
                                                            {{ $property-> average_reviews}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        {{-- image gallery --}}
                        @livewire('property.property-gallery-images-component', ['propertyId' => $property->id], key($property->id))
                        {{-- image gallery end --}}
                    </div>
                    @endforeach
                    {{ $propeties->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="currency-changer">
        <!-- <a type="button" class="currency {{ $isLocal ? 'active' : '' }}" wire:click.prevent="changeCurrency('lkr')">
        <div class="currency-icon">Rs</div>
        LKR
    </a>
    <div class="currency {{ $isLocal ? '' : 'active' }}" wire:click.prevent="changeCurrency('usd')">
        <div class="currency-icon">$</div>
        USD
    </div> -->
        <!-- <a href="#" 
       class="toggle {{ $isLocal ? 'toggle--on' : 'toggle--off' }}" 
       wire:click.prevent="changeCurrency('{{ $isLocal ? 'usd' : 'local' }}')">
    </a> -->

        <div class="currency-main">
            <div type="button" class="lkr-button {{ $isLocal == 'LKR' ? 'currency-active' : '' }}" wire:click.prevent="changeCurrency('LKR')">
                <p class="currency-text">LKR</p>
            </div>
            <div type="button" class="usd-button {{ $isLocal == 'USD' ? 'currency-active' : '' }}" wire:click.prevent="changeCurrency('USD')">
                <p class="currency-text">USD</p>
            </div>
        </div>

        <!-- <a type="button"  class="currency lkr-btn {{ $isLocal ? 'active' : '' }}" wire:click.prevent="changeCurrency('lkr')">
        <div class="currency-icon">Rs</div>
         <span style="background-color: blue;">LKR</span>
    </a>
    <div>
    <a type="button"  class="currency usd-btn {{ $isLocal ? '' : 'active' }}" wire:click.prevent="changeCurrency('usd')">
        <div class="currency-icon">$</div>
         <span>USD</span>
    </a>
    </div> -->

        <!-- <div class="currency {{ $isLocal ? '' : 'active' }}" wire:click.prevent="changeCurrency('usd')">
        <div class="currency-icon">$</div>
        USD
    </div> -->
        <div class="modal fade" id="exampleModal123" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm You Are Sri Lankan?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Enter Your NIC Number:</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent="changeCurrency('lkr')">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@push('page-scripts')
<style>
    .banner-one_form-box{
        max-width: 600px;
    }
     #propertySearchmobile {
      display: none;
    }
    .prop-data {
        position: relative;
        /* border: 1px solid blue; */
    }

    .checked {
        color: orange;
    }

    /* Move the slider handle to the left side */
    .range-slider {
        height: 5px;
        position: relative;
        background-color: #e1e9f6;
        border-radius: 2px;
    }

    .range-selected {
        height: 100%;
        left: 10%;
        right: 30%;
        position: absolute;
        border-radius: 5px;
        background-color: #018ABE;
    }

    .me-2 {
        margin-right: 0.5rem !important;
    }

    .mt-1 {
        margin-top: 0.25rem !important;
    }

    .rating-box,
    .rating .rating-box {
        /* clip-path: polygon(50% 0%, 65% 31%, 98% 35%, 74% 58%, 79% 91%, 50% 74%, 21% 91%, 25% 59%, 2% 35%, 35% 31%); */
        background: #00427F;
        width: 45px;
        height: 45px;
        /* margin-left: 5px; */
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        border-radius: 6px;
        align-self: flex-end;

    }

    .range-input {
        position: relative;
    }

    .range-input input {
        position: absolute;
        width: 100%;
        height: 5px;
        top: -5px;
        background: none;
        pointer-events: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    .range-input input::-webkit-slider-thumb {
        height: 15px;
        width: 15px;
        border-radius: 50%;
        border: 3px solid #018ABE;
        background-color: #fff;
        pointer-events: auto;
        -webkit-appearance: none;
    }

    .range-input input::-moz-range-thumb {
        height: 10px;
        width: 10px;
        border-radius: 50%;
        border: 3px solid #018ABE;
        background-color: #fff;
        pointer-events: auto;
        -moz-appearance: none;
    }

    .range-price {
        margin: 30px 0;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .range-price label {
        margin-right: 5px;
    }

    .range-price input {
        width: 70px;
        padding: 5px;
    }

    .range-price input:first-of-type {
        margin-right: 15px;
    }


    @media only screen and (max-width: 767px) {
        span.review-text {
            font-size: 8px;
        }
    }
    #mobileSearch {
            display: none;
        }
    @media (max-width: 768px) {
        #propertySearch {
            display: none;
        }

        #mobileSearch {
            display: block;
        }
    }
    @media (max-width: 500px) {
        .banner-one_form-box{
            margin-left: 10px;
            margin-right: 10px;
        }
    }
</style>
<script>
    // let rangeMin = 10000;
    // const range = document.querySelector(".range-selected");
    // const rangeInput = document.querySelectorAll(".range-input input");
    // const rangePrice = document.querySelectorAll(".range-price input");
    // rangeInput.forEach((input) => {
    //     input.addEventListener("input", (e) => {
    //         let minRange = parseInt(rangeInput[0].value);
    //         let maxRange = parseInt(rangeInput[1].value);
    //         if (maxRange - minRange < rangeMin) {
    //             if (e.target.className === "min") {
    //                 rangeInput[0].value = maxRange - rangeMin;
    //             } else {
    //                 rangeInput[1].value = minRange + rangeMin;
    //             }
    //         } else {
    //             rangePrice[0].value = minRange;
    //             rangePrice[1].value = maxRange;
    //             range.style.left = (minRange / rangeInput[0].max) * 100 + "%";
    //             range.style.right = 100 - (maxRange / rangeInput[1].max) * 100 + "%";
    //         }
    //     });
    // });
    // Function to update the range values and trigger the change event
    // function updateRangeValues() {
    //     let minRange = parseInt(rangeInput[0].value);
    //     let maxRange = parseInt(rangeInput[1].value);

    //     if (maxRange - minRange < rangeMin) {
    //         rangeInput[0].value = maxRange - rangeMin;
    //         rangeInput[1].value = minRange + rangeMin;
    //     }

    //     rangePrice[0].value = minRange;
    //     rangePrice[1].value = maxRange;

    //     console.log('minRange:', minRange);
    //     console.log('maxRange:', maxRange);
    // }



    $('#selectDestination').on('change', function(evt) {
        @this.set('destination', evt.target.value);
    });
    $('.propertyTypeCheckbox').on('change', function(evt) {
        var selectedValues = [];
        $('.propertyTypeCheckbox:checked').each(function() {
            selectedValues.push($(this).val());
        });
        @this.set('selectedPropertyTypes', selectedValues);
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    async function fetchGalleryImages(id) {
        var response = await fetch("{{ url('roomista/properties/gallery/') }}" + '/' + id).then(res => res.json())
            .then(data => {
                var myModal = new bootstrap.Modal(document.getElementById('propertyGalleryModel'), {
                    keyboard: false
                })

                // myModal.show()

                // ---------
                Object.keys(data).forEach((category, key) => {
                    var navTab = '<button class="nav-link ' + (key == 0 ? "active" : "") +
                        '" id="nav-tab-' + key +
                        '" data-bs-toggle="tab" data-bs-target="#nav-gallery-' + key +
                        '" type="button" role="tab" aria-controls="nav-gallery-' + key +
                        '" aria-selected="true">' + category + '</button>';
                    $('#propertyGalleryModel .modal-body .nav-tabs').append(navTab);
                    var sliderItems = Array();

                    if (data[category] && data[category].length > 0) {
                        data[category].forEach(img => {
                            var item = '<div class="carousel-item ' + (key == 0 ? "active" :
                                    "") + '"><img src="' + img.original_url +
                                '" class="d-block w-100" alt="..."></div></div>';
                            console.log(img.original_url)
                            sliderItems.push(item);
                        });
                    }
                    var navContent = '<div class="tab-pane fade ' + (key == 0 ? "show active" : "") +
                        '" id="nav-gallery-' + key + '" role="tabpanel" aria-labelledby="nav-' + key +
                        '-tab"><div id="imageGallery' + key +
                        '" class="carousel slide" data-bs-ride="carousel"><div class="carousel-inner">' +
                        sliderItems +
                        ' <button class = "carousel-control-prev" type = "button" data-bs-target="#imageGallery' +
                        key +
                        '" data-bs-slide="prev"><span><button class="carousel-control-next" type = "button" data-bs-target="#imageGallery' +
                        key +
                        '" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button></div></div>';
                    $('#propertyGalleryModel .modal-body .tab-content').append(navContent);
                });


            })

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

        const dateSelectCard = document.getElementById('allPropertyDateSelect');

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
    document.addEventListener('livewire:load', function() {
        Livewire.on('scrollToTop', function() {
            window.scrollTo({
                top: 200,
                behavior: 'smooth'
            });
        });
    });
</script>

<script>
    $('.owl-carousel').owlCarousel({
        items: 4,
        loop: true,
        margin: 1,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
      // Get the element
      var propertySearchmobile = document.getElementById('propertySearchmobile');
      document.addEventListener('click', function(event) {
        // Check if the clicked element is the one you want to trigger the style change
        if (event.target.matches('#mobile-drop')) {
          // Toggle the display property
          propertySearchmobile.style.display = (propertySearchmobile.style.display === 'block') ? 'none' : 'block';
        }
      });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.bottom-div').forEach(function(bottomDiv) {
            bottomDiv.style.display = "none";
        });
        document.querySelectorAll('.bottom-div').forEach(function(bottomDiv) {
            bottomDiv.style.display = "block";
        });
    });
</script>


@endpush