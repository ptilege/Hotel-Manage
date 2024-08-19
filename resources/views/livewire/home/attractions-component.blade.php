<div class="container py-4" style="z-index: 0;">
    <div class="section-heding py-3">
        <h2 class="heding-text-main" style="z-index: -12;">Attractions</h2>

        <div class="column" style="text-align: center; margin-bottom: 30px; margin-top: 30px;">
            <!-- @if($category == null)
                    <a class="btn btn-style-three-active" style="margin: 5px; line-height:1rem; font-size:.75rem; letter-spacing:1.3px;"
                    wire:click.prevent="changeDeal(null)">
                    <div class="btn-wrap">
                        <span class="text-one">All Attractions</span>
                       

                    </div>
                </a>
                @else
                    <a class="btn btn-style-three" style="margin: 5px; line-height:1rem; font-size:.75rem; letter-spacing:1.3px;"
                    wire:click.prevent="changeDeal(null)">
                    <div class="btn-wrap">
                        <span class="text-one">All Attractions</span>
                        <span class="text-two">All Attractions</span>

                    </div></a>
                @endif -->
            <div class="owl-attrac owl-carousel" wire:ignore>
                @foreach ($activities as $activity)
                @if($category == $activity->id)
                <a class="flip-flop-button active" style="margin: 5px; line-height:1rem; font-size:.75rem; letter-spacing:1.3px;" wire:click.prevent="changeDeal('{{ $activity->id }}')">
                    {{ $activity->name }}
                </a>
                @else
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front" wire:click.prevent="changeDeal('{{ $activity->id }}')">
                            <p class="flip-card-text-front mb-0">{{ $activity->name }}</P>
                        </div>
                        <div class="flip-card-back" wire:click.prevent="changeDeal('{{ $activity->id }}')">
                            <p class="flip-card-text-back mb-0">{{ $activity->name }}</P>
                        </div>
                    </div>
                </div>

                @endif
                @endforeach
            </div>


        </div>








        <section id="topDeals" class="section" style="overflow: hidden;">
            <div class="row" style="flex-wrap: nowrap;">
                @foreach ($properties as $property)
                <div class="col-12 col-sm-2 col-md-4 col-lg-3" wire:key="{{ $property->id }}">
                    <div class="">
                        <div class="location-block_one-inner" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 15px 80px 4px;">

                            <div class="location-block_one-image">
                                <a href="{{ route('property-details', ['slug' => $property->slug]) }}">
                                    <img src="{{ count($property->featuredMedia) > 0 ? $property->featuredMedia[0]->original_url : asset('images/placeholders/placeholder500x500.webp') }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder500x500.webp') }}';" class="attrac-image">
                                </a>
                                <div class="image-text-overlay" onclick="window.location='{{ route('property-details', ['slug' => $property->slug]) }}';" style="cursor: pointer;">
                                    <a href="{{ route('property-details', ['slug' => $property->slug]) }}" class="overlay-link">
                                        <div class="overlat-text" style="color: white;">
                                            <p>{{ $property->name }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- <div class="location-block_one-content">
                                    <h5 class="location-block_one-heading"><a href="{{ route('property-details', ['slug' => $property->slug]) }}">{{ $property->name }}</a></h5>
                                   
                             
                                </div> -->

                        </div>


                        <!-- <img src="{{ count($property->featuredMedia) > 0 ? $property->featuredMedia[0]->original_url : asset('images/placeholders/placeholder500x500.webp') }}"
                                onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder500x500.webp') }}';" class="attrac-image">
                            <div class="card-body card-body-absolute">
                                <h5 class="card-title">{{ $property->name }}</h5>
                                <a href="{{route('property-details', ['slug' => $property->slug])}}"  class="btn btn-primary">Book
                                    Now</a>
                            </div>
                            <div class="overlay-text">
                                <h5>{{ $property->name }}</h5>
                                <a href="{{ route('property-details', ['slug' => $property->slug]) }}" class="btn btn-primary">Book Now</a>
                            </div> -->
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>

    <style>
        .location-block_one-image {
            position: relative;
        }

        .image-text-overlay {
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
            padding: 30px;
            /* Add padding for better readability */
            border-radius: 5px;
            padding-bottom: 40px;
        }


        .attrac-image {
            height: 350px;
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

        /* The flip card container - set the width and height to whatever you want. We have added the border property to demonstrate that the flip itself goes out of the box on hover (remove perspective if you don't want the 3D effect */
        .flip-card {
            background-color: transparent;
            /* width: 300px; */
            height: 50px;
            /* border: 1px solid #f1f1f1; */
            perspective: 1000px;
            /* Remove this if you don't want the 3D effect */
        }

        /* This container is needed to position the front and back side */
        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 6px;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        /* Do an horizontal flip when you move the mouse over the flip box container */
        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        /* Position the front and back side */
        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 80%;
            justify-content: center;
            align-items: center;
            display: flex;
            -webkit-backface-visibility: hidden;
            /* Safari */
            backface-visibility: hidden;
        }

        /* Style the front side (fallback if image is missing) */
        .flip-card-front {
            background-color: #d1d1d1;
            color: black;
        }

        /* Style the back side */
        .flip-card-back {
            background-color: var(--button-main-color);
            color: white;
            transform: rotateY(180deg);
        }

        .flip-card-text-front {
            color: black;
            padding: 5px;
            font-weight: 400;
            letter-spacing: .05em;
            font-size: 13px;
            line-height: 1rem;

            text-transform: capitalize;
        }

        .flip-card-text-back {
            color: white;
            padding: 5px;
            font-weight: 400;
            letter-spacing: .05em;
            font-size: 13px;
            line-height: 1rem;

            text-transform: capitalize;
        }
    </style>

    <script>
        $(document).ready(function() {
            $(".owl-attrac").owlCarousel({
                items: 6, // Set the number of items to show
                loop: true, // Enable loop mode
                margin: 10, // Set the margin between items
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 6
                    }
                }
            });
        });
    </script>

</div>