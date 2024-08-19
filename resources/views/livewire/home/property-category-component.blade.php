<div>
    <div class="container py-4">
        <div class="section-heding py-3">
            <h2 class="heding-text-main" style="margin-bottom: 30px; margin-top: 30px;">Hotels In Sri Lanka</h2>
            <div class="text-main-sub">Browse By Type Hotels in Sri Lanka, Villas in Sri Lanka, Apartments in Sri Lanka, Resorts in Sri Lanka</div>

        </div>
        <section class="section">
            <div class="row">
                @foreach ($propertyTypes as $index => $type)
                <!-- Feature Block One -->
                <div class="col-lg-3 col-md-4 col-sm-6" style="margin-bottom: 0;">
                    <div class="card wow fadeInLeft text-center @if($index == 0) active1 @endif @if($index >= 3) d-none d-lg-block @endif" onclick="toggleDiv('{{ $index }}')" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 15px 80px 4px; padding-top:10px; padding-bottom:10px; cursor: pointer;" data-wow-delay="0ms" data-wow-duration="1500ms">

                        <h5 class="heding-text-main-faq" style="font-size:15px;  text-transform: capitalize; letter-spacing:normal;">{{ $type->name }}</h5>
                        <p class="text-main-sub-count" style="font-size: 12px; margin:0; opacity:0.8;">{{ $type->property_count }} {{ $type->name }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>


        @foreach ($propertyTypes as $index => $type)
        <div id="{{ $index }}-additional-info" style="display: {{ $index == 0 ? 'block' : 'none' }}; padding: 10px; margin-top:20px; max-height:330px;">
            @php $count = 0 @endphp
            <div class="row">
                <!-- <div class="owl-cat owl-carousel" style="overflow: hidden;"> -->
                @foreach ($properties as $property)
                @if ($property->property_type_id == $type->id)



                <div class="col-12 col-sm-2 col-md-4 col-lg-3" onclick="window.location='{{ route('property-details', ['slug' => $property->slug]) }}';" style="cursor: pointer;">
                    <div class="a">
                        <div class="location-block_one-inner" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 15px 80px 4spx;">

                            <div class="location-block_one-image">


                                <a href="{{ route('property-details', ['slug' => $property->slug]) }}"><img src="{{ count($property->featuredMedia) > 0 ? $property->featuredMedia[0]->original_url : asset('images/placeholders/placeholder500x500.webp') }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder500x500.webp') }}';" class="attrac-image"></a>
                                <div class="image-text-overlay-cat">
                                    <div class="overlat-text" style="color: white;"> {{ $property->name }}</div>

                                </div>
                            </div>



                        </div>


                    </div>
                </div>

                @php $count++ @endphp
                @endif
                @if ($count == 4)
                @break
                @endif

                @endforeach
                <!-- </div> -->
                <!-- Custom Previous Button -->
                <!-- <button class="cat-prev-button fa fa-chevron-left"></button> -->

                <!-- Custom Next Button -->
                <!-- <button class="cat-next-button fa fa-chevron-right"></button> -->
            </div>

            <div class="button-box mt-5">
                <button onclick="openModal('{{$index}}')" class="btn-style-two theme-btn">
                    <span class="btn-wrap">
                        <span class="text-one"><i class="fa fa-bars" aria-hidden="true"></i>See All {{$type->name}}</span>
                        <span class="text-two"><i class="fa fa-bars" aria-hidden="true"></i>See All {{$type->name}}</span>
                    </span>
                </button>
            </div>


            <!-- Modal -->
            <div class="modal" id="Modal{{$index}}" style="display: none;">
                <div class="modal-background"></div>
                <div class="modal-content-wrapper">
                    <div class="modal-content">
                        <!-- Modal content goes here -->
                        <button class="scroll-to-top-button" onclick="scrollToTop('{{$index}}')">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                        <h2 class="heding-text-main" style="margin-bottom: 30px; margin-top: 30px; text-align:center; color:#00427F;">All {{$type->name}} In Sri Lanka</h2>
                        <div class="row">
                            @foreach ($properties as $property)
                            @if ($property->property_type_id == $type->id)
                            <div class="col-12 col-sm-2 col-md-4 col-lg-3" onclick="window.location='{{ route('property-details', ['slug' => $property->slug]) }}';" style="cursor: pointer;">
                                <div class="">
                                    <div class="location-block_one-inner" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 15px 80px 4px;">
                                        <div class="location-block_one-image mt-5">
                                            <a href="{{ route('property-details', ['slug' => $property->slug]) }}"><img src="{{ count($property->featuredMedia) > 0 ? $property->featuredMedia[0]->original_url : asset('images/placeholders/placeholder500x500.webp') }}" onerror="this.onerror=null;this.src='{{ asset('images/placeholders/placeholder500x500.webp') }}';" class="attrac-image"></a>
                                            <div class="image-text-overlay-cat">
                                                <div class="overlat-text" style="color: white;"> {{ $property->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <!-- Close button -->
                        <button class="close-button" onclick="closeModal('{{$index}}')">

                            <i class="fas fa-window-close"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
        @endforeach

    </div>

</div>
<script src="https://unpkg.com/scrollreveal"></script>
<script>
    function scrollToTop(index) {
        var modalContentWrapper = document.querySelector('#Modal' + index + ' .modal-content-wrapper');
        modalContentWrapper.scrollTop = 0;


    }

    function openModal(index) {
        var modal = document.getElementById('Modal' + index);
        modal.style.display = 'flex';

        document.documentElement.style.overflow = 'hidden';



    }


    function closeModal(index) {
        var modal = document.getElementById('Modal' + index);
        modal.style.display = 'none';
        document.documentElement.style.overflow = 'auto';
    }

    window.onscroll = function() {
        scrollFunction()
    };




    function toggleDiv(index) {
        var $targetDiv = $("#" + index + "-additional-info");

        // Check if the target div is currently visible
        if ($targetDiv.is(":visible")) {

            $targetDiv.slideToggle('slow', 'swing');
        } else {

            $("[id$='-additional-info']").not($targetDiv).slideUp('slow', 'swing');

            $targetDiv.slideToggle('slow', 'swing');

            showAllProperties(index);
        }
    }

    function showAllProperties(index) {
        // Show all properties for this property type
        $("#" + index + "-additional-info .row .col-12").show();
    }






    document.addEventListener('DOMContentLoaded', function() {
        // Get all feature blocks
        var featureBlocks = document.querySelectorAll('.card');

        // Make the first feature block active by default
        featureBlocks[0].classList.add('active1');

        // Toggle active class on click
        featureBlocks.forEach(function(block, index) {
            block.addEventListener('click', function() {
                // Remove active class from all feature blocks
                featureBlocks.forEach(function(innerBlock) {
                    innerBlock.classList.remove('active1');
                });

                // Add active class to the clicked block
                block.classList.add('active1');
            });
        });
    });

    $(document).ready(function() {
        $('.owl-cat').owlCarousel({
            loop: true,
            items: 4,
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
        $('.cat-prev-button').click(function() {
            $('.owl-cat').trigger('prev.owl.carousel');
        });

        $('.cat-next-button').click(function() {
            $('.owl-cat').trigger('next.owl.carousel');
        });
    })
</script>

<style>
    .image-text-overlay-cat {
        position: absolute;
        top: 79%;
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
        padding: 20px;
        /* Add padding for better readability */
        border-radius: 5px;
        padding-bottom: 40px;
    }

    .active1 {
        /* Add your active styles here */
        background-color: var(--button-main-color);
        color: white;
    }

    .card:hover {
        background-color: var(--button-main-color);
        color: white;
    }

    .cat-prev-button,
    .cat-next-button {
        position: absolute;
        top: 50%;
        transform: translateY(-30%);

        font-size: 10px;
        width: 50px;
        height: 50px;
        color: #fff;
        background-color: #001B48;
        border: none;
        cursor: pointer;
        padding: 10px;
        border-radius: 50%;
        border: 5px solid white;
        z-index: 1;
        transition: background-color 0.3s ease;
    }

    .cat-prev-button:hover,
    .cat-next-button:hover {
        background-color: var(--main-color);
        /* Adjust the hover background color as needed */
    }

    .cat-prev-button {
        left: -2px;

    }

    .cat-next-button {
        right: -2px;
    }

    .modal {
        display: none;
        border: none;
        position: fixed;
        top: 0;
        left: 0;
        padding: 40px;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;



    }

    .modal-content {
        background-color: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        padding: 20px;
        border-radius: none;
        border: none;
        z-index: 9999;


    }

    .modal-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .modal-content-wrapper {
        position: relative;      
        z-index: 2;
        overflow: auto;
        max-height: calc(100% - 20px);
       
    }

    .close-button {
        position: fixed;
        top: 60px;
        right: 80px;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 30px;
        color: #000;
        padding: 0;
        z-index: 9999;
    }

    .close-button:hover {
        color: #ff0000;
    }

    .scroll-to-top-button {
        position: fixed;
        bottom: 60px;
        right: 80px;
        background-color: var(--button-main-color);
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        font-size: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        z-index: 9999;
    }

    .scroll-to-top-button:hover {
        background-color: var(--main-color);
        /* Adjust the hover background color as needed */
    }
</style>