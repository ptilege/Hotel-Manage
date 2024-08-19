<!-- Page Banner -->
<section class="banner-one">
    <div class="banner-one_image-layer" style="background-image: url('{{ asset('images/main-slider/view-beautiful-tropical-beach-with-palms (1).png') }}')"></div>
    <div class="auto-container">

        <!-- Content Column -->
        <div class="banner-one_content">
            <div class="banner-one_content-inner">
                <div class="container">
                    <!--breadcrumb-->
                    <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" style="color: #808080;" aria-current="page">Careers</li>
                    </ol>
                </nav> -->
                </div>
                <div class="banner-one_title">

                </div>
                <h1 class="banner-one_heading">careers</h1>




            </div>
        </div>
    </div>
</section>
<!-- End Page Banner -->

<section class="gallery-five">
    @if(count($careers) > 0)
    <div class="container">
        <div class="sec-title centered">
            <h2 class="heding-text-main">AVAILABLE JOBS</h2>
        </div>

        <div class="mixitup-gallery">
            <div class="filter-list row clearfix" id="MixItUp46AA34">

                <!-- Gallery Block Two -->
                @foreach($careers as $career)
                <div class="gallery-block_two style-two all mix design cloud seasonal col-lg-4 col-md-6 col-sm-12" style="display: inline-block;">
                    <div class="gallery-block_two-inner">
                        <div class="gallery-block_two-image">
                            <img src="{{ asset('images/25.jpg') }}" alt="">
                            <div class="overlay-box_two">
                                <div class="overlay-box_two-inner heding-text-main">
                                    <h4 class="heding-text-main"><a id="title" href="destination-details.html">{{ $career->title }}</a></h4>

                                    <!-- <div class="gallery-block_two-text-two">Job Description</div> -->
                                    <div class="gallery-block_two-button">
                                        <a href="#" class="theme-btn learn-btn text-main-sub" onclick="applyCareer({{ $career->id }})">Apply</a>
                                    </div>
                                </div>
                            </div>
                            <div class="overlay-box">
                                <div class="overlay-content">
                                    <h3 class="gallery-block_two-title heding-text-main"><a id="title" href="destination-details.html">{{ $career->title }}</a></h3>
                                    <!-- <div class="d-flex  flex-wrap">
                                    <i class="icon fas fa-map-marker-alt fa-fw" style="color: white;">&nbsp&nbspColombo Sri Lanka</i>
                                        <div class="gallery-block_two-price">Location</div> 
                                    </div> -->
                                    <div class="row">

                                        <div class="col-12">
                                            <p style="color: white;" class="text-main-sub"><i class="icon fas fa-map-marker-alt fa-fw" style="color: white; margin-right:5px;"></i>{{ $career->location }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach



            </div>



        </div>

    </div>
    @else
    <div class="container">
        <div class="sec-title centered">
            <h2 class="heding-text-main">Apologies, there are currently no job vacancies available.
</h2>
        </div>
    </div>
    @endif
</section>



<style>
    #title {
        font-size: 30px;
        font-weight: 700;
    }
</style>

<script>
    function applyCareer(careerId) {
        Livewire.emit('careerSelected', careerId);
        window.location.href = '{{ route("careers-form", ["careerId" => ":careerId"]) }}'.replace(':careerId', careerId);
    }
</script>
</script>