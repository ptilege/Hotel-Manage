<section class="banner-one">
    <div class="banner-one_image-layer" style="background-image: url('{{$destination->image ? $destination->image :asset('images/placeholders/placeholder1000x650.webp')}}" class="img-fluid rounded-1" alt="..." onerror="this.onerror=null;this.src='{{asset('images/placeholders/placeholder1000x650.webp')}}';"></div>
    <div class="auto-container">

        <!-- Content Column -->
        <div class="banner-one_content">
            <div class="banner-one_content-inner">
                <div class="container">
                    <!--breadcrumb-->
                    <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" style="color: #808080;" aria-current="page">Property</li>
                    </ol>
                </nav> -->
                </div>

                <h1 class="banner-one_heading">
                    {{$destination->name}}
                </h1>

                <!-- <div class="banner-one_text"  style="font-family: 'Poppins', sans-serif;">Luxury Hotel</div> -->


                <!-- Description Box -->

                <div class="banner-one_form-box">
                    <p class="banner-description">
                        {{$destination->description}}
                    </p>
                </div>


            </div>
        </div>
    </div>
</section>


@php
config()->set('app.name','Hotels in '.$destination->name)
@endphp

<div class="container pb-3 position-relative destination-detials-page">
    <section id="allProperties" style="padding-top: 200px;">
        <div class="col-12 col-lg-9">
            <div class="property-list-header">
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
                                        <div class="addtional-image position-relative" data-bs-toggle="modal" data-bs-html="true" data-bs-custom-class="beautifier" title='<img src="{{ count($property->featuredMedia) > 0 && $i + 1 < count($property->featuredMedia) ? $property->featuredMedia[$i + 1]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" alt="Image">' data-bs-target="#propertyImageGalleryModel-{{ $property->id }}">
                                            <img src="{{ count($property->featuredMedia) > 0 && $i + 1 < count($property->featuredMedia) ? $property->featuredMedia[$i + 1]->original_url : asset('images/placeholders/placeholder1000x650.webp') }}" alt="" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder1000x650.webp') }}';">
                                        </div>
                                        @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-8 prop-data">
                                <div class="card-body ps-2 pt-0 pb-0">




                                    <div class="row">
                                        <div class="property-add">
                                            <i class="fas fa-map-marker-alt" style="margin-left: 5px;"></i>
                                            {{ $property->address_1 && $property->address_1 != 'NULL' ? $property->address_1 : '' }}

                                            <a href="{{ route('property-details', $property->slug) }}" target="_blank" class="text-decoration-none text-dark">
                                                <h2 class="property-name-heading" style="text-transform: none;padding-top: 5px;">{{ $property->name }}</h2>
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
                                                    <span class="offers-ava" style="color: #f26422;text-transform: none;">Offers available</span>
                                                </div>

                                                @elseif($offerRate == 0)

                                                <div>

                                                    <span style="color: green;"></span>
                                                </div>

                                                @endif
                                            </div>
                                            <div>
                                                <span class="fa fa-check offers-ava" style="color: #16a664;"></span>
                                                <span class="offers-ava" style="color: #16a664;text-transform: none;">Best-price guarantee</span>
                                            </div>

                                            <div class="property-pricing mt-3 mt-lg-0" style="width:103%; display: flex; justify-content: space-between; height: 70%; margin-top:30px;">
                                            </div>

                                            <div id="bottom" class="bottom-div" style="position: absolute;bottom: 5px;">
                                                <div style="height: 50px; float: left; display:flex; justify-content: space-between; ">
                                                    <div class="property-reviews inline-block flex-row">
                                                        <div class="text-start">

                                                            @php
                                                            $totalRate = $this->getLowestRate($property->id);
                                                            $offerRate = $this->getLowestOfferRate($property->id)
                                                            @endphp
                                                            @if ($totalRate > 0 && $offerRate > 0)
                                                            <span class="price-text" style="color: red; text-decoration:line-through;">
                                                                {{ $this->displayCurrency($totalRate) }}</span>
                                                            <br>
                                                            <span class="price-text-main">{{ $this->displayCurrency($offerRate) }}</span>
                                                            @elseif ($totalRate > 0 )

                                                            <span class="price-text-main">{{ $this->displayCurrency($totalRate) }}</span>



                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="book_now_btn" style="height: 50px; float: right; display:flex; justify-content: space-between;; ">
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

                                        <div class="rating">
                                            <div class=" position-relative" style="float: right;width: auto;">
                                                <div class="">

                                                    <div class="review-heading">
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
                    </div>

                    {{-- image gallery --}}
                    @livewire('property.property-gallery-images-component', ['propertyId' => $property->id], key($property->id))
                    {{-- image gallery end --}}
                    @endforeach

                </div>
            </div>
        </div>
        <div class="view-all-btn my-4">
            <a href="{{route('all-properties', ['d_id'=>$destination->id])}}" class="btn btn-primary mx-auto d-block" style="width:200px;">View All</a>
        </div>

    </section>


    <div class="currency-changer">
        <!-- <div class="currency {{$isLocal ? 'active':''}}" wire:click.prevent="changeCurrency('lkr')">LKR</div>
        <div class="currency {{$isLocal ? '':'active'}}" wire:click.prevent="changeCurrency('usd')">USD</div> -->

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

        <!-- <div class="currency-main">
            <div type="button" class="lkr-button {{ $isLocal ? 'currency-active' : '' }}" wire:click.prevent="changeCurrency('lkr')">
                <p class="currency-text">LKR</p>
            </div>
            <div type="button" class="usd-button {{ $isLocal ? '' : 'currency-active' }}" wire:click.prevent="changeCurrency('usd')">
                <p class="currency-text">USD</p>
            </div>
        </div> -->

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

    </div>

</div>


<style>
    .banner-one_heading {
        font-size: 80px;
        padding-bottom: 60px;
        padding-top: 50px;
    }

    /* .btn-style-two{
    padding-left: 600px;
} */
    .book_now_btn {
        /* padding-left: 670px; */
        margin-bottom: 25px;
    }

    .checked {
        color: orange;
    }

    .banner-one_form-box {
        margin-bottom: -180px;
        padding-top: 25px;
    }

    .row {
        flex-wrap: nowrap;
    }

    .bottom-div {
        width: 62%;
    }

    .property-card {
        padding-right: 20px;
    }

    .property-main {
        width: 1400px;
        padding-right: 105px;
    }

    .property-add {
        width: 70%;
    }

    .price-text-main {
        color: black;
    }

    .rating {
        width: 30%;
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

    .review-heading {
        margin-bottom: 5px;
        font-size: .75rem;
        letter-spacing: 1.7px;
        text-transform: uppercase;
        font-weight: 300;
        font-family: var(--font-family-CircularStd);
        color: #a2a2a2;
    }

    .review-text {
        /* margin-left: 160px; */
    }

    /* .review-text {
    padding-left: 100px;
} */
</style>



<!-- 

================================

        Responsive Section

================================ 

-->

<style>
    @media only screen and (max-width: 500px) {

        .banner-one_heading {
            font-size: 50px;
        }

        .banner-one_form-box {
            margin: 10px;
            margin-bottom: -200px;
            padding-top: 25px;
        }

        .property-main {
            width: 100%;
            padding-right: 0px;
        }

        .row {
            flex-wrap: wrap;
        }

        .review-text {
            font-size: 8px;
        }

        .price-text-main {
            color: black;
            letter-spacing: 0px;
        }

        .bottom-div {
            width: 83%;
        }

        .offers-ava {
            letter-spacing: 0px;

        }

        .banner-description {
            font-size: 13px;
        }

    }

    @media only screen and (max-width: 1024px) {
        .col-lg-9 {
            width: 100%;
        }

        .bottom-div {
            width: 61%;
        }

        .banner-one_heading {
            font-size: 50px;
        }

        .banner-one_form-box {
            margin: 10px;
            margin-bottom: -200px;
            padding-top: 25px;
        }

        .property-main {
            width: 100%;
            padding-right: 0px;
        }

        .row {
            flex-wrap: wrap;
        }

        .review-text {
            font-size: 8px;
        }

        .price-text-main {
            color: black;
            letter-spacing: 0px;
        }

        .offers-ava {
            letter-spacing: 0px;

        }

        .banner-description {
            font-size: 13px;
        }

    }
</style>