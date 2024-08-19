<!-- <div class="top-navbar navbar-light bg-white">
    <div class="navbar-contact-info text-left py-2 px-3" style="font-size: 15px; float: left; color: rgb(19,53,123); font-weight: bold;">
        <b><i class="fi fi-lk"></i> 011 2 10 20 42 </b>  | <i class="fi fi-au"></i> 61 (03) 9999 7450 | <i class="fi fi-lu"></i> 352 20 331 999 | <i class="fi fi-gb"></i> 44 752 06 44 688 | <i class="fi fi-ca"></i> 1 (403) 8000111 | <i class="fi fi-sg"></i> 65 (3) 1594440 |
    </div>
    <div class="navbar-email-icons text-right py-2 px-3" style="font-size: 17px; float: right; color: rgb(19,53,123);">
        <a href="https://www.facebook.com/roomista" target="_blank" style="color: rgb(19,53,123);"><i class="fab fa-facebook fa-lg"></i></a> |
        <a href="https://www.instagram.com/roomistacom" target="_blank" style="color: rgb(19,53,123);"><i class="fab fa-instagram fa-lg"></i></a> |

        <a href="https://www.youtube.com/@roomista2212" target="_blank" style="color: rgb(19,53,123);"><i class="fab fa-youtube fa-lg"></i></a> 
    </div>
    <div style="clear: both;"></div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('all-properties') }}">Accomodations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('all-destinations') }}">Destinations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Careers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('blogs') }}">Blogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
            <div class="d-flex nav-button-main">
                @auth('customers')

                    <div class="dropdown">
                        <button class="btn btn-light me-1 dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="display: flex;align-items: center;justify-content: space-between;padding: 10px 20px;">
                            <i class="fas fa-user-circle" style="font-size: 25px;margin-right: 8px;"></i> <span>My
                                Account</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item text-capitalize">{{ auth('customers')->user()->name }}</a></li>
                            <hr class="my-1">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">My Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('front.logout') }}" role="button"
                                    onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">Logout</a>
                                <form id="logoutForm" action="{{ route('front.logout') }}" method="post">@csrf</form>
                            </li>
                        </ul>
                    </div>
                @else
                @php
                $googleClientId = config('services.google.client_id');
              @endphp
                 
                  <script src="https://accounts.google.com/gsi/client" async defer></script>
                  <div id="g_id_onload" data-client_id="{{$googleClientId}}" data-context="signin"
                      data-login_uri="{{url('oauth/google')}}"
                      data-_token="{{ csrf_token() }}" data-close_on_tap_outside="false" data-auto_prompt="true">
                  </div>
                    <a class="btn btn-light me-md-1 mb-2 mb-md-0" href="{{ route('front.login') }}">Sign In / Register</a>
                @endauth
                <a class="btn btn-outline-light" href="{{ route('front.property.register') }}">List Your Property</a>
            </div>
        </div>
    </div>
</nav>

 -->

<header class="header header_style_one">
	<div class="middle_bar">
		<div class="auto-container">
			<div class="middle_bar_inner d-flex align-items-center justify-content-center justify-content-between flex-wrap">
				<!-- Logo -->
				<div class="logo">
					<a href="{{ route('home') }}" class="logo_default">
						<img src="{{ asset('images/Roomista-white.png') }}" alt="" style="width : 130px;">
					</a>
				</div>
				<div class="mainnav d-none d-lg-block">
					<ul class="main_menu">
						<li class="menu-item menu-item-has-children {{ request()->routeIs('home') ? 'active' : '' }}">
							<a class="hover-menu" href="{{ route('home') }}" style="color: white; {{ request()->routeIs('home') ? 'border-bottom: 1px solid white;' : '' }}">Home</a>
						</li>

						<li class="menu-item menu-item-has-children  {{ request()->routeIs('all-properties') ? 'active' : '' }}">
							<a href="{{ route('all-properties') }}" style="color: white; {{ request()->routeIs('all-properties') ? 'border-bottom: 1px solid white;' : '' }}">Accomodation</a>
						</li>

						<li class="menu-item menu-item-has-children {{ request()->routeIs('all-destinations') ? 'active' : '' }}">
							<a href="{{ route('all-destinations') }}" style="color: white; {{ request()->routeIs('all-destinations') ? 'border-bottom: 1px solid white;' : '' }}">Destinations</a>
						</li>

						<!-- <li class="menu-item menu-item-has-children">
							<a href="{{ route('careers') }}" style="color: white; {{ request()->routeIs('careers') ? 'border-bottom: 1px solid white;' : '' }}" >Careers</a>
							</li> -->

						<li class="menu-item menu-item-has-children {{ request()->routeIs('blogs') ? 'active' : '' }}">
							<a href="{{ route('blogs') }}" style="color: white; {{ request()->routeIs('blogs') ? 'border-bottom: 1px solid white;;' : '' }}">Blogs</a>
						</li>

						<li class="menu-item menu-item-has-children">
							<a href="{{ route('contact') }}" style="color: white;{{ request()->routeIs('contact') ? 'border-bottom: 1px solid white;' : '' }}">Contact</a>
						</li>

						<!-- <li class="menu-item menu-item-has-children">
							<i id="hotel-icon" class="fas fa-hotel" style="color: white; font-size: 1rem;"></i>

							</li> -->


					</ul>
				</div>


				@auth('customers')
				<div class="other_elements_wrapper d-flex align-items-center gap-4">
					<div class="d-none d-sm-block">
						<button class="btn-dropdown me-1 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex;align-items: center;justify-content: space-between;">
							<span>My
								Account</span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
							<li><a class="dropdown-item text-capitalize" style="font-family: Poppins; font-size:13px;">{{ auth('customers')->user()->name }}</a></li>
							<hr class="my-1">
							<li><a class="dropdown-item" style="font-family: Poppins; font-size:13px;" href="{{ route('profile') }}">My Profile</a></li>
							<li><a class="dropdown-item" style="font-family: Poppins; font-size:13px;" href="{{ route('front.logout') }}" role="button" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">Logout</a>
								<form id="logoutForm" action="{{ route('front.logout') }}" method="post">@csrf</form>
							</li>
						</ul>
					</div>
					<!-- Button Box -->
					<div class="button-box d-none d-sm-block">
						<a class="btn-style-two theme-btn" href="{{ route('front.property.register') }}">
							<div class="btn-wrap">
								<span class="text-one">List Your Property</span>
								<span class="text-two">List Your Property</span>
							</div>
						</a>

					</div>
					<li class="d-none d-sm-block menu-item menu-item-has-children" style="padding-bottom: 10px;">

						<i id="cart-link" class="fas fa-hotel text-white card-icon-nav" style="cursor: pointer; padding:5px; border:1px solid white; border-radius:50%;"></i>

					</li>

				</div>

				@else
				@php
				$googleClientId = config('services.google.client_id');
				@endphp
				<script src="https://accounts.google.com/gsi/client" async defer></script>
				<div id="g_id_onload" data-client_id="{{$googleClientId}}" data-context="signin" data-login_uri="{{url('oauth/google')}}" data-_token="{{ csrf_token() }}" data-close_on_tap_outside="false" data-auto_prompt="true">
				</div>
				<div class="other_elements_wrapper d-flex align-items-center gap-4">
					<!-- Button Box -->
					<div class=" d-none d-sm-block">
						<a class="btn-style-two theme-btn" href="{{ route('front.login') }}">
							<div class="btn-wrap">
								<span class="text-one">Sign In / Register</span>
								<span class="text-two">Sign In / Register</span>
							</div>
						</a>

					</div>
					<!-- Button Box -->
					<div class="button-box d-none d-sm-block">
						<a class="btn-style-two theme-btn" href="{{ route('front.property.register') }}">
							<div class="btn-wrap">
								<span class="text-one">List Your Property</span>
								<span class="text-two">List Your Property</span>
							</div>
						</a>

					</div>
					<li class="d-none d-sm-block menu-item menu-item-has-children" style="padding-bottom: 10px;">

						<i id="cart-link" class="fas fa-hotel text-white card-icon-nav" style="cursor: pointer; padding:5px; border:1px solid white; border-radius:50%;"></i>

					</li>

				</div>
				@endauth




				<!-- Mobile Menu Toggle Button -->
				<div class="mr_menu_toggle d-lg-none">
					<span class="toggle_line"></span>
					<span class="toggle_line"></span>
					<span class="toggle_line"></span>
				</div>


			</div>

		</div>
	</div>
	</div>
</header>
<header class="header sticky-header">
	<div class="middle_bar">
		<div class="auto-container">
			<div class="middle_bar_inner d-flex align-items-center justify-content-center justify-content-between flex-wrap">
				<!-- Logo -->
				<div class="logo">
					<a href="{{ route('home') }}" class="logo_default">
						<img src="{{ asset('images/Roomista-blue.png') }}" alt="" style="width : 130px;">
					</a>
				</div>
				<div class="mainnav d-none d-lg-block">
					<ul class="main_menu">
						<li class="menu-item menu-item-has-children {{ request()->routeIs('home') ? 'active' : '' }}">
							<a href="{{ route('home') }}" style="color: black; {{ request()->routeIs('home') ? 'color: var(--button-main-color);border-bottom: 1px solid var(--button-main-color);' : '' }}">Home</a>
						</li>

						<li class="menu-item menu-item-has-children  {{ request()->routeIs('all-properties') ? 'active' : '' }}">
							<a href="{{ route('all-properties') }}" style="color: black; {{ request()->routeIs('all-properties') ? 'color: var(--button-main-color); border-bottom: 1px solid var(--button-main-color);' : '' }}">Accomodation</a>
						</li>

						<li class="menu-item menu-item-has-children {{ request()->routeIs('all-destinations') ? 'active' : '' }}">
							<a href="{{ route('all-destinations') }}" style="color: black; {{ request()->routeIs('all-destinations') ? 'color: var(--button-main-color);border-bottom: 1px solid var(--button-main-color);' : '' }}">Destinations</a>
						</li>

						<!-- <li class="menu-item menu-item-has-children">
							<a href="{{ route('careers') }}" style="color: black; {{ request()->routeIs('careers') ? 'color: var(--button-main-color);border-bottom: 1px solid var(--button-main-color);' : '' }}" >Careers</a>
							</li> -->

						<li class="menu-item menu-item-has-children {{ request()->routeIs('blogs') ? 'active' : '' }}">
							<a href="{{ route('blogs') }}" style="color: black; {{ request()->routeIs('blogs') ? 'color: var(--button-main-color); border-bottom: 1px solid var(--button-main-color);' : '' }}">Blogs</a>
						</li>

						<li class="menu-item menu-item-has-children">
							<a href="{{ route('contact') }}" style="color: black;{{ request()->routeIs('contact') ? 'color: var(--button-main-color);border-bottom: 1px solid var(--button-main-color);' : '' }}">Contact</a>
						</li>


					</ul>
				</div>



				@auth('customers')
				<div class="other_elements_wrapper d-flex align-items-center gap-4">
					<div class="d-none d-sm-block">
						<button class="btn-dropdown me-1 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex;align-items: center;justify-content: space-between; color:black">
							<span>My
								Account</span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
							<li><a class="dropdown-item text-capitalize">{{ auth('customers')->user()->name }}</a></li>
							<hr class="my-1">
							<li><a class="dropdown-item" href="{{ route('profile') }}">My Profile</a></li>
							<li><a class="dropdown-item" href="{{ route('front.logout') }}" role="button" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">Logout</a>
								<form id="logoutForm" action="{{ route('front.logout') }}" method="post">@csrf</form>
							</li>
						</ul>
					</div>
					<!-- Button Box -->
					<div class="button-box d-none d-sm-block">
						<a class="btn-style-two theme-btn" href="{{ route('front.property.register') }}">
							<div class="btn-wrap">
								<span class="text-one">List Your Property</span>
								<span class="text-two">List Your Property</span>
							</div>
						</a>

					</div>
					<li class="d-none d-sm-block menu-item menu-item-has-children" style="padding-bottom: 10px;">

						<i id="cart-link-two" class="fas fa-hotel text-black card-icon-nav" style="cursor: pointer; padding:5px; border:1px solid black; border-radius:50%;"></i>

					</li>
				</div>
				@else
				@php
				$googleClientId = config('services.google.client_id');
				@endphp
				<script src="https://accounts.google.com/gsi/client" async defer></script>
				<div id="g_id_onload" data-client_id="{{$googleClientId}}" data-context="signin" data-login_uri="{{url('oauth/google')}}" data-_token="{{ csrf_token() }}" data-close_on_tap_outside="false" data-auto_prompt="true">
				</div>
				<div class="other_elements_wrapper d-flex align-items-center gap-4">
					<!-- Button Box -->
					<div class=" d-none d-sm-block">
						<a class="btn-style-two theme-btn" href="{{ route('front.login') }}">
							<div class="btn-wrap">
								<span class="text-one">Sign In / Register</span>
								<span class="text-two">Sign In / Register</span>
							</div>
						</a>

					</div>
					<!-- Button Box -->
					<div class="button-box d-none d-sm-block">
						<a class="btn-style-two theme-btn" href="{{ route('front.property.register') }}">
							<div class="btn-wrap">
								<span class="text-one">List Your Property</span>
								<span class="text-two">List Your Property</span>
							</div>
						</a>

					</div>
					<li class="d-none d-sm-block menu-item menu-item-has-children" style="padding-bottom: 10px;">

						<i id="cart-link-two" class="fas fa-hotel text-black card-icon-nav" style="cursor: pointer; padding:5px; border:1px solid black; border-radius:50%;"></i>

					</li>
				</div>
				@endauth


				<!-- Mobile Menu Toggle Button -->
				<div class="mr_menu_toggle navbar-two d-lg-none">
					<span class="toggle_line" style="background: black;"></span>
					<span class="toggle_line" style="background: black;"></span>
					<span class="toggle_line" style="background: black;"></span>
				</div>

			</div>
		</div>
	</div>
	</div>
</header>
<div>
	@livewire('cart.cart-component')
</div>
<!-- Mobile Responsive Menu -->
<div class="mr_menu d-lg-none">
	<div class="nav-menu-header">
		<a href="{{ route('home') }}" class="">
			<img src="{{ asset('images/Roomista-white.png') }}" alt="" style="width : 130px;">
		</a>
		<button type="button" class="mr_menu_close "><i class="fa fa-times text-white"></i></button>
	</div>


	<div class="mr_navmenu">
		<ul class="nav-menu">
			<li><a href="{{ route('home') }}"><i style="padding-right: 10px;" class="fas fa-home"></i>Home</a></li>
			<li><a href="{{ route('all-properties') }}"><i style="padding-right: 10px;" class="fas fa-door-open"></i>Accomodation</a></li>
			<li><a href="{{ route('all-destinations') }}"><i style="padding-right: 10px;" class="fas fa-map-marker"></i>Destination</a></li>
			<li><a href="{{ route('careers') }}"><i style="padding-right: 10px;" class="fas fa-suitcase"></i>Careers</a></li>
			<li><a href="{{ route('blogs') }}"><i style="padding-right: 10px;" class="fas fa-heart"></i>Blogs</a></li>
			<li><a href="{{ route('contact') }}"><i style="padding-right: 10px;" class="fas fa-envelope"></i>Contact</a></li>
			<li><a href="{{ route('about-us') }}"><i style="padding-right: 10px;" class="fas fa-info-circle"></i>About</a></li>
			@auth('customers')
			<li><a href="{{ route('profile') }}"><i style="padding-right: 10px;" class="fas fa-user-plus"></i>Account</a></li>
			<li><a class="dropdown-item" href="{{ route('front.logout') }}" role="button" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">Logout</a>
				<form id="logoutForm" action="{{ route('front.logout') }}" method="post">@csrf</form>
			</li>
			@else
			<li><a href="{{ route('front.login') }}"><i style="padding-right: 10px;" class="fas fa-user-plus"></i>Sign / Register</a></li>
			@endauth
			
			<li><a href="{{ route('front.property.register') }}"><i style="padding-right: 10px;" class="fas fa-building"></i>List Your Property</a></li>
		</ul>
	</div>
</div>
<!-- End Main Header -->

<style>
	.mainnav {
		margin-left: 100px;
	}

	.card-icon-nav:hover::after {
		content: "Cart";
		position: absolute;
		background-color: #333;
		color: #fff;
		padding: 5px;
		border-radius: 5px;
		top: 50%;
		/* right: %; */
		/* left: 90%; */
		/* transform: translateX(10%); */
		opacity: 0.9;
		visibility: visible;
	}

	@media (max-width: 768px) {
		.other_elements_wrapper {
			display: none;
		}
	}

	.nav-menu-header {
		display: flex;
		justify-content: space-between;
		align-items: center;

	}

	.nav-menu {
		list-style-type: none;
		margin: 0;
		padding-top: 75px;
		overflow: hidden;

	}

	/* .nav-menu li {
			float: left;
		} */
	.nav-menu a {
		display: block;
		color: white;
		text-align: left;
		padding: 14px 1px;
		text-decoration: none;
	}

	.nav-menu a:hover {
		background-color: #555;
	}

	.active-menu-item {
		color: #ff0000;
		/* Change this to your desired text color */
	}

	.main_menu li.menu-item a {
		color: white;
		text-decoration: none;
		padding-bottom: 5px;
		/* Optional: Add some padding between text and border */
		transition: border-bottom 0.3s;
		/* Smooth transition effect */
	}

	.main_menu li.menu-item i {
		color: white;
		font-size: 1rem;
	}

	.main_menu li.menu-item:hover a {
		border-bottom: 1px solid white;
	}

	.main_menu li.menu-item:hover i {
		color: var(--button-main-color);
	}

	.main_menu li.menu-item.active a {
		border-bottom: 1px solid white;
	}

	.sticky-header {
		display: none;
		position: fixed;
		top: 0;
		width: 100%;
		z-index: 1000;

		background-color: white;
		animation: slideUpDown 0.5s ease-in-out;
	}

	.mr_menu {
		transform: translateX(-100%);
		transition: transform 0.3s ease-in-out;
		position: fixed;
		top: 0;
		left: 0;
		width: 80%;
		/* Set the width of your side menu */
		height: 100%;
		background-color: #333;
		/* Set your desired background color */
		padding: 20px;
		/* Set your desired padding */
		z-index: 1000;
		/* Adjust z-index based on your needs */
	}

	/* Styles for the open state */
	.mr_menu.open {
		transform: translateX(0);
	}


	@keyframes slideUpDown {
		from {
			transform: translateY(-100%);
		}

		to {
			transform: translateY(0);
		}
	}

	.sticky-header.slide-up {
		animation: slideUpDownReverse 0.9s ease-in-out;
	}

	@keyframes slideUpDownReverse {
		from {
			transform: translateY(0);
		}

		to {
			transform: translateY(-100%);
		}
	}
</style>


<script>
	document.addEventListener("DOMContentLoaded", function() {
		var header = document.querySelector('.header');
		var stickyHeader = document.querySelector('.sticky-header');
		var scrollThreshold = 0; // Adjust this value as needed
		var sticky = header.offsetTop;

		function handleScroll() {
			if (window.pageYOffset > scrollThreshold) {
				header.classList.add('slide-up');
				stickyHeader.style.display = 'block';
				stickyHeader.classList.remove('slide-up');
			} else {
				header.classList.remove('slide-up');
				setTimeout(function() {
					stickyHeader.classList.add('slide-up');
				}, 0);
				stickyHeader.style.display = 'none';
			}
		}

		window.addEventListener('scroll', handleScroll);
	});
	$(document).ready(function() {
		// Handle click event on the "Cart" link
		$("#cart-link").click(function(e) {
			e.preventDefault();

			// Trigger offcanvas display
			$('#offcanvasRight').offcanvas('show');
		});
	});
	$(document).ready(function() {
		// Handle click event on the "Cart" link
		$("#cart-link-two").click(function(e) {
			

			// Trigger offcanvas display
			$('#offcanvasRight').offcanvas('show');
		});
	});
	document.addEventListener("DOMContentLoaded", function() {
		const menuToggle = document.querySelector(".mr_menu_toggle");
		const menuClose = document.querySelector(".mr_menu_close");
		const sideMenu = document.querySelector(".mr_menu");

		// Function to open side menu
		function openSideMenu() {
			sideMenu.classList.add("open");
		}

		// Function to close side menu
		function closeSideMenu() {
			sideMenu.classList.remove("open");
		}

		// Event listener for the toggle button
		menuToggle.addEventListener("click", openSideMenu);

		// Event listener for the close button
		menuClose.addEventListener("click", closeSideMenu);
	});
	document.addEventListener("DOMContentLoaded", function() {
		const menuToggle = document.querySelector(".navbar-two");
		const menuClose = document.querySelector(".mr_menu_close");
		const sideMenu = document.querySelector(".mr_menu");

		// Function to open side menu
		function openSideMenu() {
			sideMenu.classList.add("open");
		}

		// Function to close side menu
		function closeSideMenu() {
			sideMenu.classList.remove("open");
		}

		// Event listener for the toggle button
		menuToggle.addEventListener("click", openSideMenu);

		// Event listener for the close button
		menuClose.addEventListener("click", closeSideMenu);
	});
</script>