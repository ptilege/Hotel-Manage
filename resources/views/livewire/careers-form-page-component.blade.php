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
                        <li class="breadcrumb-item active" style="color: #808080;" aria-current="page">Careers Form</li>
                    </ol>
                </nav> -->
                </div>
                <div class="banner-one_title">

                </div>
                <h1 class="banner-one_heading-hotel">{{$career->title}}</h1>




            </div>
        </div>
    </div>
</section>
<!-- End Page Banner -->




<div class="container mt-5">
    <div class="row justify-content-center align-items-center" style="text-align: center;">
        <span class=" text-main-sub"></span>
        <span class="heding-text-main mt-5" style="font-size: 30px !important; font-weight:600 !important;">JOB DESCRIPTION</span>
        <p class="wall-container mt-5 text-main-sub">{{$career->job_description}}</p>
    </div>
    <h3 class="wall-container mt-3 heding-text-main" style="font-weight: 500;">About The Role:</h3>
    <ul class="wall-container mt-3">
        @php
        $items = explode(',', $career->about_role);
        @endphp
        @foreach($items as $item)
        <li class="mb-2 text-main-sub">
            <i class="icon fas fa-square fa-fw" style="color: black;">
            </i>&nbsp;&nbsp;{{ trim($item) }}
        </li>
        @endforeach



    </ul>
    <h3 class="wall-container mt-4 heding-text-main">About You:</h3>
    <ul class="wall-container mt-3">


        @php
        $items = explode(',', $career->about_you);
        @endphp
        @foreach($items as $item)

        <li class="mb-2 text-main-sub">
            <i class="icon fas fa-circle fa-fw" style="color: black;"></i>&nbsp;&nbsp; {{ trim($item) }}
        </li>
        @endforeach


    </ul>
</div>



<div class="mt-5">
    <div class="container py-4">
        <div class="section-heding py-3">
            <div class="d-flex justify-content-center align-items-center mt-2">
                {!! $career->iframe_link !!}
            </div>
        </div>
    </div>
</div>




<!-- <h1 id="h1"></h1> -->

<style>
    span.thin {
        font-weight: 100;
        display: initial;
        font-size: 20px;
        color: #1C231F;
    }

    .wall-container {
        margin-left: auto;
        margin-right: auto;
        max-width: 1000px;
        text-align: justify;
        text-justify: inter-word;
    }


    ul li {
        font-size: 18px;
        margin-left: 50px;
    }

    .iframe-with-shadow {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* Adjust the shadow properties as needed */
    }
</style>

<script>
    // var iframe = document.getElementById('myIframe');

    // // Check if the iframe is loaded
    // iframe.onload = function () {
    //     // Access the contentWindow of the iframe
    //     console.log('Iframe loaded');
    //     var iframeWindow = iframe.contentWindow;


    //     // Send a message to the iframe
    //     iframeWindow.postMessage('getTitle', 'https://crm.roomista.com/forms/wtl/5c85f1c28bf0cf5ca0987a937fe47c55');
    // };

    // // Listen for messages from the iframe
    // window.addEventListener('message', function (event) {
    //     if (event.origin === 'https://crm.roomista.com/forms/wtl/5c85f1c28bf0cf5ca0987a937fe47c55' && event.data.title) {
    //         var iframeTitle = event.data.title;

    //         // Set the title in the h1 tag
    //         document.getElementById("h1").innerHTML = iframeTitle;
    //     }
    // });
</script>