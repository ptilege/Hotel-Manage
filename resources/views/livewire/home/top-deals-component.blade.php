<div class="container py-2">
    <div class="section-heding py-3">
        <h2 class="heding-text-main" style="margin-bottom: 30px; margin-top: 30px;">Top Hotel Deals</h2>
        <div class="text-main-sub">
            Find the best rates for your holiday in hotel offers in Sri Lanka! Explore places to stay on your holiday in
            Sri Lanka to suit your budget.
        </div>

    </div>


    <div class="row" style="flex-wrap: nowrap; height:530px; position: relative; margin-top:30px;">
        <!-- <button class="custom-prev-button fa fa-chevron-left"></button> -->
        <div class="owl-top owl-carousel">
            @foreach ($deals as $index=> $deal)


            <div class="" wire:key="{{$deal->id}}" @if($index % 2==1) style="margin-top: 40px;" @endif>
                <div class="" style="height:530px;">
                    <div class="location-block_one-inner" onclick="window.location='{{ route('property-details', ['slug' => $deal->property->slug]) }}';" style="cursor: pointer;">

                        <div class="location-block_one-image" style="height: 460px;">
                            @if ($deal->property) {{-- Check if $deal->property is not null --}}
                            <a href="{{ route('property-details', $deal->property->slug) }}">
                                <img src="{{$deal->image ?? asset('images/placeholders/placeholder500x500.webp')}}" onerror="this.onerror=null;this.src='{{asset('images/placeholders/placeholder500x500.webp')}}';" alt="{{$deal->name}}" class="card-img-top" style="min-height: 460px;">
                            </a>
                            @else
                            {{-- Handle the case where $deal->property is null --}}
                            <img src="{{$deal->image ?? asset('images/placeholders/placeholder500x500.webp')}}" onerror="this.onerror=null;this.src='{{asset('images/placeholders/placeholder500x500.webp')}}';" alt="{{$deal->name}}" class="card-img-top" style="min-height: 460px;">
                            @endif

                            <div class="image-text-overlay-top">
                                <div class="overlat-text" style="margin-top: 1rem; margin-bottom:1rem; color:white;">{{$deal->name}}</div>
                            </div>
                            <div class="discount-overlay">
                                <div class="overlat-text" style="margin-top: 0; color:white; padding:10px;">{{ substr($deal->description, 0, 20) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
        <!-- Custom Previous Button -->
        <button class="custom-prev-button fa fa-chevron-left"></button>

        <!-- Custom Next Button -->
        <button class="custom-next-button fa fa-chevron-right"></button>


    </div>
    <style>
        .location-block_one-image {
            position: relative;
        }

        .image-text-overlay-top {
            position: absolute;
            top: 85%;
            left: 0;
            width: 100%;
            text-align: center;
            color: white;
            font-size: 16px;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 5px;

        }

        .discount-overlay {
            position: absolute;
            top: 10%;
            left: 0;
            transform: translate(-1%, -50%);
            text-align: left;

            background: var(--button-main-color);
            padding: 5px;
            color: #fff;

        }

        .discount-text {
            font-size: 13px;
            font-weight: bold;
            line-height: 30px;
        }

        .card-img-top {
            /* min-height: 460px; */
            object-fit: cover;
            border-radius: 5px;

        }

        .property-image {
            overflow: hidden;
        }

        .btn.active {
            background-color: #28a745;
            /* Change the color to your preferred highlight color */
            color: #fff;
            /* Change the text color to be visible on the highlighted background */
        }

        .btn-light {
            background-color: #f8f9fa;
            /* Light background color for unselected buttons */
            color: #495057;
            /* Text color for unselected buttons */
        }

        .row {
            position: relative;
        }

        /* .owl-carousel {
            position: relative;
        } */

        .custom-prev-button,
        .custom-next-button {
            position: absolute;
            top: 50%;
            transform: translateY(-30%);

            font-size: 24px;
            width: 70px;
            height: 70px;
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

        .custom-prev-button:hover,
        .custom-next-button:hover {
            background-color: var(--main-color);
            /* Adjust the hover background color as needed */
        }

        .custom-prev-button {
            left: -20px;

        }

        .custom-next-button {
            right: -20px;
        }

        @media only screen and (max-width: 500px){
            .custom-prev-button {
            left: 0;

        }

        .custom-next-button {
            right: 0px;
        }
        }

    </style>
    <script>
        $(document).ready(function() {
            $('.owl-top').owlCarousel({
                loop: true,

                margin: 25,
                nav: false, // Disable default navigation controls
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
                },


            });

            // Add click event handlers for custom buttons
            $('.custom-prev-button').click(function() {
                $('.owl-top').trigger('prev.owl.carousel');
            });

            $('.custom-next-button').click(function() {
                $('.owl-top').trigger('next.owl.carousel');
            });
        });
    </script>


</div>