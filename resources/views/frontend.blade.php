<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $settings = [
        'app_name' => App\Models\Settings::where(['key' => 'app_name'])->first()->value,
        'app_description' => App\Models\Settings::where(['key' => 'app_description'])->first()->value,
        'app_keywords' => '',
        'app_author' => '',
        'app_favicon' => App\Models\Settings::where(['key'=>'app_favicon'])->first()->value,
        'app_logo' => '',
    ];
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="lLfil_NbxbTAUI5UqWHFHO6O3UDJwfGbuHUcFG7uMKI" />
    <meta name="description" content="{{ $settings['app_description'] }}">
    <meta name="keywords" content="{{ $settings['app_keywords'] }}">
    <meta name="author" content="{{ $settings['app_author'] }}">

    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>

    <!-- <link rel="icon" type="image/x-icon" href="{{env('APP_URL')}}{{ $settings['app_favicon'] }}">


    <title inertia>{{ $settings['app_name'] }}</title>
    <a href="https://wa.me/94777666124" target="_blank" class="float"
        style="
        /* border: 1px solid red; */
        position: fixed;
        width: 100px;
        height: 100px;
        bottom: 50px;
        right: 50px;
        color: #fff;
        border-radius: 50px;
        text-align: center;
        cursor: pointer;
      
        z-index: 999;
      ">
        <img src="https://img.icons8.com/office/96/whatsapp--v2.png" alt="" height="60px" width="60px" />
    </a> -->
    <div id="fbtn"  class="floating_btn">
    <a target="_blank" href="https://wa.me/94777666124">
      <div class="contact_icon">
        <i class="fa fa-whatsapp my-float"></i>
      </div>
    </a>
 
  </div>
  <style>
    #fbtn{
        display: none;
    }
  </style>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">


    {{-- livewire Styles --}}
    @livewireStyles
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-o5yuqF6r9S3RJS6p0hiS1dXwnz8AC3fXsdz5JL6EI6SE6HUFq5Ucl5C/2fGZIpeG" crossorigin="anonymous">

    <!-- Stylesheet ============================================= -->
    <link rel="stylesheet" href="{{ asset('frontend/css/custom-style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/hotel-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/flag-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/flag-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/icons.css') }}">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Owl Carousel -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- swiper carousel -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!--  Slick slider -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <!-- price range filter -->
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

        <!-- magnific-popup css cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="{{asset('frontend/css/custom-style.css')}}">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <script src="{{ mix('js/frontend/app.js') }}" defer></script>

    <style>
        
.floating_btn {
  position: fixed;
  bottom: -10px;
  right: -40px;
  width: 100px;
  height: 100px;
  display: flex;
  flex-direction: column;
  align-items:center;
  justify-content:center;
  z-index: 1000;
}

@keyframes pulsing {
  to {
    box-shadow: 0 0 0 30px rgba(232, 76, 61, 0);
  }
}

.contact_icon {
  background-color: #42db87;
  color: #fff;
  width: 50px;
  height: 50px;
  font-size:30px;
  border-radius: 50px;
  text-align: center;
  box-shadow: 2px 2px 3px #999;
  display: flex;
  align-items: center;
  justify-content: center;
  transform: translatey(0px);
  animation: pulse 1.5s infinite;
  box-shadow: 0 0 0 0 #42db87;
  -webkit-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
  -moz-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
  -ms-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
  animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
  font-weight: normal;
  font-family: sans-serif;
  text-decoration: none !important;
  transition: all 300ms ease-in-out;
}


.text_icon {
  margin-top: 8px;
  color: #707070;
  font-size: 13px;
 
}


   

        .loader {
       
            border: 2px solid #f3f3f3;
            border-top: 2px solid var(--main-color);
            border-radius: 50%;
            width: 100px;
            height: 100px;
            animation: spin 1s linear infinite;
        }

        .loader-section {
          /* border: 1px solid red; */
          position: fixed; /* Use fixed instead of absolute for better positioning */
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          display: flex; /* Use flexbox for easier centering */
          justify-content: center; /* Center horizontally */
          align-items: center; /* Center vertically */
          background: var(--button-main-color);
          z-index: 1000;
        }

        .section-left {
            left: 0;
        }

        .section-right {
            right: 0;
        }
        .loading-text{
         
          font-size: 50px;
          color: white;
          align-items: center;
        }
        .loading-text span {
          display: inline-block;
          transform-style: preserve-3d;
          transform-origin: center;
          /* animation: flip 1s infinite ease-out; */
        }
        @keyframes flip {
          from {
        width: 0;
      }
        }
        /* .loading-text span:nth-child(1) { animation-delay: 0.1s; }
        .loading-text span:nth-child(2) { animation-delay: 0.2s; }
        .loading-text span:nth-child(3) { animation-delay: 0.3s; }
        .loading-text span:nth-child(4) { animation-delay: 0.4s; }
        .loading-text span:nth-child(5) { animation-delay: 0.5s; }
        .loading-text span:nth-child(6) { animation-delay: 0.6s; }
        .loading-text span:nth-child(7) { animation-delay: 0.7s; } */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
    </style>
</head>

<body>
<div id="loader-wrapper">
     
        <div class="">
        <div class="loader-wrap">
		<div class="preloader">
		
			<div id="handle-preloader" class="handle-preloader">
				<div class="animation-preloader">
       
					<!-- <div class="spinner"></div>
					<div class="txt-loading">
						<span data-text-preloader="R" class="letters-loading">
							R
						</span>
						<span data-text-preloader="O" class="letters-loading">
							O
						</span>
						<span data-text-preloader="O" class="letters-loading">
							O
						</span>
						<span data-text-preloader="M" class="letters-loading">
							M
						</span>
						<span data-text-preloader="I" class="letters-loading">
							I
						</span>
						<span data-text-preloader="S" class="letters-loading">
							S
						</span>
						<span data-text-preloader="T" class="letters-loading">
							T
						</span>
						<span data-text-preloader="A" class="letters-loading">
							A
						</span>
					</div> -->
				</div>  
			</div>
		</div>
	</div>
        
      
        </div>
       
    </div>
    @include('Partials.navbar')
    {{ $slot }}
    @include('Partials.footer')
    {{-- livewire Scripts --}}
    @livewireScripts
    

    <!-- Script -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>
    <script src="{{ asset('frontend/js/swiper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/fecha.min.js') }}"></script>
    <script src="{{ asset('frontend/js/hotel-datepicker.min.js') }}"></script>

    <script src="{{ asset('frontend/js/sweetalert2.min.js') }}"></script>
    <x-livewire-alert::scripts />


    <script src="{{ asset('frontend/js/custom-script.js') }}"></script>

    <!-- jquery cdn link  lightbox image gallery -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

<!-- magnific popup js cdn link lightbox image gallery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->

<script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.floating_btn').forEach(function(bottomDiv) {
                bottomDiv.style.display = "none";
            }); 
            document.querySelectorAll('.floating_btn').forEach(function(bottomDiv) {
                bottomDiv.style.display = "block";
            });
        });
    </script>




    @stack('page-scripts')
</body>
<script>
      document.addEventListener("DOMContentLoaded", function () {
        // Hide loader after a delay
        setTimeout(function () {
            document.getElementById("loader-wrapper").style.display = "none";
        }, 1000); // Set the delay in milliseconds (e.g., 2000 for 2 seconds)
    });
</script>
</html>
