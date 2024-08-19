<section class="page-banner" style="background-image: url('{{ asset('images/main-slider/1.jpg') }}'); padding-bottom:30px;">
  <div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card auth-form bg-light-blue justify-center align-items-center">
      <div class="card-body">
        @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
          {{ Session::get('message') }}
        </div>
        @endif

        <ul class="nav nav-tabs" id="myTab" role="tablist" wire:ignore>
          <li class="nav-item" role="presentation">
            <a href="#login" class="nav-link" style="color: var(--button-main-color);" id="login-tab" type="button" role="tab" aria-controls="home" aria-selected="true">LOGIN</a>
          </li>
          <li class="nav-item" role="presentation">
            <a href="#register" class="nav-link" style="color: var(--button-main-color);" id="register-tab" type="button" role="tab" aria-controls="profile" aria-selected="false">REGISTER</a>
          </li>
        </ul>
        <div class="tab-content account-create" id="myTabContent">
          <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="home-tab" wire:ignore.self>
            <h5 class="heding-text-main" style="padding-bottom: 5px; text-transform: capitalize;">Sign in to your account</h5>
            <form class="mt-3" wire:submit.prevent="login">
              <div class="mb-2" style="display: flex; align-items: center; flex-wrap: wrap;">
                <label for="email" class="form-label text-main-sub" style="margin-right: 10%; flex-shrink: 0; margin-top: 0;">Email address</label>
                <input type="email" class="form-control text-main-sub" id="email" wire:model="email" style="margin-top: 0;">
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="mb-2">
                <label for="password" class="form-label text-main-sub" style=" margin-right:90%; margin-top: 0;">Password</label>
                <input type="password" class="form-control text-main-sub" id="password" wire:model="password" style="margin-top: 0;">
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              {{-- <div class="mb-2 form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> --}}
              <button type="submit" class="btn btn-primary mt-2  btn-style-two theme-btn" style="width:100%;display: flex; justify-content: center; align-items: center;"><span class="btn-wrap"><span class="text-one">Submit</span><span class="text-two" style="width:100%">Submit</span></span></button>

              <hr>
              <a href="{{url('/oauth/google')}}" type="button" class="btn btn-outline-primary mt-1 mb-2 w-100" style="font-weight:500;">
                <img src="https://img.icons8.com/color/16/000000/google-logo.png"> Google
              </a>
              <!-- <button type="submit" class="btn btn-outline-primary mt-1 mb-2 w-100" style="font-weight:500;">
                          Login With OTP
                        </button> -->
              <div class="mb-2 mt-3">
                <label for="reset" class="form-label text-main-sub" style="margin-top: 0;">
                  <a href="{{  route('forget-password') }}" class="reset-password-link">
                    Forgotten password?
                  </a>
                </label>

              </div>
              {{-- <div >Sign with :</div> --}}
            </form>
          </div>
          <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="profile-tab" wire:ignore.self>
            <h5 class="heding-text-main" style="text-transform: capitalize;">Create your Account!</h5>
            <form class="mt-1" wire:submit.prevent="register">
              <div class="row">
                <div class="col-12 col-md-6 mb-2" style="display: flex; align-items: center; flex-wrap: wrap;">
                  <label for="f_name" class="form-label text-main-sub" style="margin-right:10%;">First Name</label>
                  <input type="text" class="form-control text-main-sub" id="f_name" wire:model="firstName" style="margin-top: 0;">
                  @error('firstName') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 col-md-6 mb-2" style="display: flex; align-items: center; flex-wrap: wrap;">
                  <label for="l_name" class="form-label text-main-sub">Last Name</label>
                  <input type="text" class="form-control text-main-sub" id="l_name" wire:model="lastName" style="margin-top: 0;">
                  @error('lastName') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
              </div>

              <div class="mb-2" style="display: flex; align-items: center; flex-wrap: wrap;">
                <label for="r_email" class="form-label text-main-sub">Email address</label>
                <input type="email" class="form-control text-main-sub" id="r_email" wire:model="emailAddress" style="margin-top: 0;">
                @error('emailAddress') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="mb-2" style="display: flex; align-items: center; flex-wrap: wrap;">
                <label for="mobile" class="form-label text-main-sub">Mobile Number</label>
                <input type="text" class="form-control text-main-sub" id="mobile" wire:model="mobile" style="margin-top: 0;">
                @error('mobile') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <div class="mb-2" style="display: flex; align-items: center; flex-wrap: wrap;">
                <label for="r_password" class="form-label text-main-sub">Password</label>
                <input type="password" class="form-control text-main-sub" id="r_password" wire:model="password" style="margin-top: 0;">
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror

              </div>
              <div class="mb-5" style="display: flex; align-items: center; flex-wrap: wrap;">
                <label for="c_password" class="form-label text-main-sub">Confirm Password</label>
                <input type="password" class="form-control text-main-sub" id="c_password" wire:model="password_confirmation" style="margin-top: 0;">
                @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
              </div>
              <button type="submit" class="btn btn-primary mt-1 w-100 text-two btn-style-two theme-btn"><span class="btn-wrap"><span class="text-one">Submit</span><span class="text-two" style="width:100%">Submit</span></span></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<style>
  .background {
    position: relative;
  }

  .card-container {
    position: relative;
    top: 90%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
  }

  .reset-password-link {
    /* Initial link styles */
    color: var(--bs-link-color);
    /* Set the initial color */
    text-decoration: none;
    transition: color 0.3s;
    /* Add transition for smooth color change */
  }

  .reset-password-link:hover {

    color: blue;
  }
</style>
<script>
  $(document).ready(function() {
    // Listen for click events on the login and register links
    $('#login-tab').on('click', function(e) {
      e.preventDefault();
      showTab('login');
      history.pushState(null, null, '#login');
    });

    $('#register-tab').on('click', function(e) {
      e.preventDefault();
      showTab('register');
      history.pushState(null, null, '#register');
    });

    // Function to show/hide tabs
    function showTab(tabName) {
      // Hide all tabs
      $('.tab-pane').removeClass('show active');

      // Remove 'active' class from all nav-links
      $('.nav-link').removeClass('active');

      // Show the selected tab
      $('#' + tabName).addClass('show active');

      // Add 'active' class to the selected nav-link
      $('#' + tabName + '-tab').addClass('active');


    }
    var currentHash = window.location.hash;
    if (currentHash === "#register") {
      showTab('register');
    } else {
      showTab('login'); // Default to login if no hash is present
    }
  });
</script>