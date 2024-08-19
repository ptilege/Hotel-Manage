<div class="container py-2">
    <div class="section-heding py-3">
        <h2 class="heding-text-main" style="margin-bottom: 30px; margin-top: 30px;">Sri Lanka Tourist Destinations</h2>
        <div class="text-main-sub">Travel to Sri Lanka and wander wisely with Roomista best price guarantee.</div>

    </div>
    <section id="topDestinations" class="section gallery-four">
        <div class="row">
            <div class="slider-for">
                @foreach ($destinations as $index => $destination)
                <div class="destination-card" style="height: 500px;">
                    <a href="{{ route('destination-details', $destination->slug) }}" class="text-decoration-none">
                        <div class="card-content">
                            <img src="{{ $destination->image ?? asset('images/placeholders/placeholder500x500.webp') }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder500x500.webp') }}';" alt="{{ $destination->name }}" style="height:500px;">
                            <div class="image-text-overlay-top-des-main">
                                <div class="heding-text-main">{{ $destination->name }}</div>
                            </div>
                        </div>
                    </a>
                </div>

                @endforeach

            </div>



            <!-- Slider for navigation thumbnails -->
            <div class="slider-nav">
                @foreach ($destinations as $index => $destination)
                <div class="destination-card" style="height: 150px;">

                    <div class="card-content">
                        <img class="zoom-image" src="{{ $destination->image ?? asset('images/placeholders/placeholder500x500.webp') }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder500x500.webp') }}';" alt="{{ $destination->name }}" style="height:150px;">
                        <div class="image-text-overlay-top-des">
                            <div class="overlat-text">{{ $destination->name }}</div>
                        </div>
                    </div>

                </div>

                @endforeach
            </div>




        </div>
    </section>



    <!-- <a class="btn btn-primary mt-3 mx-auto d-block" style="width:200px;" href="{{ route('all-destinations') }}">All Destinations</a> -->
    <style>
        .zoom-image {
            transition: transform 0.3s ease-in-out;
        }

        .zoom-image:hover {
            transform: scale(1.2);
            /* You can adjust the scale factor as needed */
        }

        .image-text-overlay-top-des {
            position: absolute;
            top: 65%;
            left: 0;
            bottom: 0;
            width: 100%;

            text-align: center;
            color: white;
            /* Set the text color */
            font-size: 16px;
            /* Set the font size */
            /* Add any additional styling as needed */
            background: rgba(0, 0, 0, 0.5);
            /* Set the background color with alpha channel for transparency */
            padding-top: 10px;
            /* Add padding for better readability */
            padding-bottom: 10px;
            /* Add padding for better readability */

            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            padding-bottom: 10px;

        }

        .image-text-overlay-top-des-main {
            position: absolute;
            top: 85%;
            left: 0;
            bottom: 0;
            width: 100%;

            text-align: center;
            color: white;
            /* Set the text color */
            font-size: 25px;
            /* Set the font size */
            /* Add any additional styling as needed */
            background: rgba(0, 0, 0, 0.5);
            /* Set the background color with alpha channel for transparency */
            padding: 10px;

            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            /* padding-bottom: 10px; */

        }

        .largecard {
            background-color: red;
            width: 100px;
        }

        .smallcard {
            background-color: green;
            width: 50px;
        }

        .normalcard {
            background-color: green;
            width: 50px;
        }

        .slick-prev,
        .slick-next {
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

        .slick-prev:hover,
        .slick-next:hover {
            background-color: var(--main-color);
            /* Adjust the hover background color as needed */
        }

        .slick-prev {
            left: -15px;
        }

        .slick-next {
            right: -15px;
        }

        @media (max-width: 576px) {
            .slider-nav {
                display: none;
            }
            .slick-prev {
            left: 0px;
        }

        .slick-next {
            right: 0px;
        }
        }
    </style>
    <script>
        // Initialize the sliders
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.slider-nav',
            prevArrow: '<button type="button" class="slick-prev fa fa-chevron-left"></button>',
            nextArrow: '<button type="button" class="slick-next fa fa-chevron-right"></button>',

        });

        $('.slider-nav').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            arrows: false,
            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    </script>
</div>