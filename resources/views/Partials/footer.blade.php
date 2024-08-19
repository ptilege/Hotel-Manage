<style>
    .custom-width-input {
        width: 50%;
    }
</style>


<section class="newsletter-one" style="background-image: url({{ asset('images/main-slider/19.jpg') }}); background-size: cover;">
		<div class="">
			<!-- Sec Title Two -->
			<div class="sec-title_two">
				<!-- <div class="bid-title">newsletter</div> -->
			
				<div class="heding-text-main" style="text-transform: capitalize;">Explore fantastic deals and more!</div>
				<div class="sec-title_two-text">Subscribe now, save, and above all, enjoy.</div>
			</div>
			<!-- Title Box -->
			<div class="cta-one_title-box">
				<!-- Subscribe Box Two -->
				<div class="subscribe-box_two">
                    <form action="https://roomista.us9.list-manage.com/subscribe/post?u=27ce1f63cd43369cf0c73b5a3&amp;id=0d90289d3e&amp;f_id=00b02be1f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
						<div class="form-group">
							<input type="email" name="EMAIL" class="required email" id="mce-EMAIL" value="" placeholder="Enter your email address here ..." required>
                            <div id="mce-responses" class="clear foot">
                                <div class="response" id="mce-error-response" style="display: none;"></div>
                                <div class="response" id="mce-success-response" style="display: none;"></div>
                            </div>
                            <button class="btn-style-two theme-btn" style="padding: 16px 35px;" type="submit" name="subscribe" id="mc-embedded-subscribe" value="Subscribe">
										<span class="btn-wrap">
											<span class="text-one"></i> Subscribe</span>
											<span class="text-two"></i> Subscribe</span>
										</span>
									</button>
							<!-- <button class="submit-btn theme-btn">
								Subscribe
							</button> -->
                    </div>
                </form>
            </div>

        </div>

        <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
        <script type="text/javascript">
            (function($) {
                window.fnames = new Array();
                window.ftypes = new Array();
                fnames[0] = 'EMAIL';
                ftypes[0] = 'email';
                fnames[1] = 'FNAME';
                ftypes[1] = 'text';
                fnames[2] = 'LNAME';
                ftypes[2] = 'text';
                fnames[3] = 'ADDRESS';
                ftypes[3] = 'address';
                fnames[4] = 'PHONE';
                ftypes[4] = 'phone';
                fnames[5] = 'BIRTHDAY';
                ftypes[5] = 'birthday';
            }(jQuery));
            var $mcj = jQuery.noConflict(true);
        </script>
    </div>

    </div>
</section>



<footer class="main-footer main" style="background-image: url('{{ asset('images/main-slider/1.jpg') }}');background-size: cover;">
    <div class="auto-container footer-box">
        <div class="row mb-4" style="Padding-bottom:20px; border-bottom: 1px solid rgba(var(--white-color-rgb), 0.20);">
            <div class="column col-12 col-md-3 col-sm-12 center-items" style="z-index: 10; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <div>
                    <i class="fa fa-phone fa-fw mb-2" style="color:white; font-size:1.6rem;"></i>
                </div>
                <div>
                    <a class="footer-box-text center-text text-white" style="z-index: 10; display: flex; justify-content: center; align-items: center;">
                        HERE FOR <br> YOU
                    </a>

                </div>


            </div>
            <div class="column col-12 col-md-3 col-sm-12 center-items" style="z-index: 10; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <div>
                    <i class="fa fa-check-square-o fa-fw mb-2" style="color:white; font-size:1.6rem;"></i>
                </div>
                <div>
                    <a class="footer-box-text center-text text-white" style="z-index: 10; display: flex; justify-content: center; align-items: center;">
                        BEST-PRICE <br> GUARANTEE
                    </a>

                </div>


            </div>
            <div class="column col-12 col-md-3 col-sm-12 center-items" style="z-index: 10;  display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <div>
                    <i class="fa fa-gift fa-fw mb-2" style="color:white; font-size:1.6rem;"></i>
                </div>
                <div>
                    <a class="footer-box-text center-text text-white" style="z-index: 10; display: flex; justify-content: center; align-items: center;">
                        EXCLUSIVE <br> OFFERS
                    </a>

                </div>


            </div>
            <div class="column col-12 col-md-3 col-sm-12 center-items" style="z-index: 10;  display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <div>
                    <i class="fa fa-user fa-fw mb-2" style="color:white; font-size:1.6rem;"></i>
                </div>
                <div>
                    <a class="footer-box-text center-text text-white" style="z-index: 10; display: flex; justify-content: center; align-items: center;">
                        PERSONALLY <br> APPROVED HOTELS
                    </a>

                </div>


            </div>



        </div>




    </div>


    <div class="auto-container">
        <!-- Upper Box -->
        <div class="upper-box">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="footer-logo" style="z-index: 10;"><a href="{{ route('home') }}"><img style="width: 150px;" src="{{ asset('images/logo.png') }}" alt="" title=""></a></div>
                <ul class="footer-nav" style="z-index: 10;">
                    <li class="li"><a href="{{ route('all-properties') }}">Accomodation</a></li>
                    <li class="li"><a href="{{ route('all-destinations') }}">Destinations</a></li>
                    <li class="li"><a href="{{ route('about-us') }}">About</a></li>
                    <li class="li"><a href="{{ route('blogs') }}">Blog</a></li>
                    <li class="li"><a href="{{ route('contact') }}">Contact</a></li>
                    <li class="li"><a href="{{ route('careers') }}">Careers</a></li>

                </ul>
                <!-- Social Box -->
                <div class="footer-social_box" style="z-index: 10;">
                    <a href="https://www.facebook.com/roomista" target="_blank" class="fab fa-facebook fa-fw"></a>

                    <a href="https://instagram.com/" class="fab fa-instagram fa-fw"></a>
                    <a href="https://twitter.com/" class="fab fa-tiktok fa-fw"></a>
                </div>
            </div>
        </div>
        <div class="black"></div>
        <div class="smoke-fog"></div>

        <div class="footer-bottom" style="z-index: 1;">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
             <div class="copyright">Copyright &copy; <span id="currentYear"></span> Roomista. All rights reserved.</div>
                <ul class="footer-bottom_nav">
                    <li><a href="{{ route('privacy-policy') }}">Privacy policy</a></li>
                    <li><a href="{{ route('terms-and-condition') }}">Terms & Condition</a></li>
                </ul>
            </div>
        </div>

    </div>
</footer>
<!-- <div class="container py-4">
  <div class="container py-4">
    <div>
        <h4 style="text-align:center;">Get Updates & More</h4>

        {{-- <div class="col-12 col-md-4">
            <div class="footer-logo">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo-dark.png') }}" alt="">
                </a>
            </div>
        </div> --}}
        <div style="width:50%; margin: 0 auto; text-align: center;">
            {{-- <div class="input-group">
                <input type="email" class="form-control custom-width-input" placeholder="Your Email" aria-label="Your Email" aria-describedby="subscribeButton">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="subscribeButton">Subscribe</button>
                </div>
            </div> --}}
            <form id="mc-form" class="validate" style="align-items: center">
                <div class="input-group">
                    <input type="email" name="EMAIL" class="form-control custom-width-input" id="mce-EMAIL" placeholder="Enter your email address" required="" value="">
                    <input type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary ml-2" value="Subscribe">
                </div>
                <div aria-hidden="true" style="position: absolute; left: -5000px;">
                    <input type="text" name="b_a50fed79fb7a12a40cb3a1123_e70e15ec59" tabindex="-1" value="">
                </div>
            </form>
            <div id="success-message" style="display: none; margin-top: 10px;">Thank you for subscribing! You will receive our newsletter.</div>
            

        </div>
        
        
    </div>
    
</div>
<hr>

           
            <div width=100% class="navbar-contact-info text-center" style="font-size: 15px; float: center; font-weight: bold;">
            

                <b><i class="fi fi-lk"></i> 011 2 10 20 42</b> | <i class="fi fi-au"></i> 61 (03) 9999 7450 | <i
                    class="fi fi-lu"></i> 352 20 331 999 | <i class="fi fi-gb"></i> 44 752 06 44 688 | <i
                    class="fi fi-ca"></i> 1 (403) 8000111 | <i class="fi fi-sg"></i> 65 (3) 1594440
            </div>
            <div width=100%>
                <hr>
                <h5 style="text-align: center">Destination Cities</h5>
                @php
                    $destinations = App\Models\Destination::where(['status' => 1])->get();
                @endphp
                <div class="row" style="text-align: center">
                    @foreach ($destinations as $destination)
                        <div class="col-6 col-md-4 col-lg-3">
                            <p><a class="text-decoration-none text-secondary"
                                    href="{{ route('destination-details', $destination->slug) }}">
                                    {{ $destination->name }}</a></p>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
       
            <div class="row mt-1" style="width: 115%;" >
                <div class="col-6">
                    <a href="#" style="text-decoration:none;color: #656363;">About Us&nbsp;</a>
                    <a href="#" style="text-decoration:none;color: #656363;">Careers&nbsp;</a>
                    <a href="#" style="text-decoration:none;color: #656363;">Blog</a>
                    <div class="navbar-email-icons text-right py-2 px-3" style="font-size: 17px; float: right; color: rgb(19,53,123);">
                        <a href="https://www.facebook.com/roomista" target="_blank" style="color: rgb(19,53,123);"><i class="fab fa-facebook fa-lg"></i></a> |
                        <a href="https://www.instagram.com/roomistacom" target="_blank" style="color: rgb(19,53,123);"><i class="fab fa-instagram fa-lg"></i></a> |
                
                        <a href="https://www.youtube.com/@roomista2212" target="_blank" style="color: rgb(19,53,123);"><i class="fab fa-youtube fa-lg"></i></a> 
                    </div>
                </div>
               
                <div class="col-6 text-end" style="width:38%">  Added 'text-end' class here 
                    <a href="#" style="text-decoration:none;color: #656363;">Contact&nbsp;</a>
                    <a href="#" style="text-decoration:none;color: #656363;">Privacy Policy&nbsp;</a>
                    <a href="#" style="text-decoration:none;color: #656363;">Terms and Conditions</a>
                </div>
            </div>



        </div> -->


<script>
    document.getElementById("mc-form").addEventListener("submit", function(e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Simulate a successful submission
        setTimeout(function() {
            document.getElementById("success-message").style.display = "block";
            // Hide the success message after 3 seconds
            setTimeout(function() {
                document.getElementById("success-message").style.display = "none";
            }, 3000);
        }, 1000); // Adjust the timing as needed

        // Clear the input field
        document.getElementById("mce-EMAIL").value = "";
    });

    
     
    
</script>
<script>
    document.getElementById("currentYear").innerHTML = new Date().getFullYear();
</script>
<style>
    /* Add this CSS to your stylesheet */

    .main-footer {
        position: relative;
        overflow: hidden;
    }

    .smoke-fog {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('{{ asset(' images/fog1.png') }}') repeat-x;
        /* Replace 'path/to/smoke-image.png' with the actual path to your smoke image */
        z-index: 1;
        opacity: 1;
        /* Adjust the opacity of the smoke */
        animation: smokeAnimation 20s linear infinite;
    }

    .black {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index: 0;
        opacity: 0.4;

    }

    


    @keyframes smokeAnimation {
        from {
            background-position: 0 0;
        }

        to {
            background-position: 100% 0;
        }
    }
</style>