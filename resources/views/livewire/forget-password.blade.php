<section class="page-banner" style="background-image: url('{{ asset('images/main-slider/1.jpg') }}'); padding-bottom:30px;">
  <div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card auth-form bg-light-blue justify-center align-items-center">
      <div class="card-body">


        <div class="card-header sec-title_two-text" style="color: #051036;">Password Recovery</div>
        <div class="card-body">

          @if (Session::has('message'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
          </div>
          @endif

          <form action="{{ route('forget.password.post') }}" method="POST">
            @csrf
            <div class="form-group row mt-3">
              <label for="email_address" class="form-label text-main-sub" style="text-align: left;">Email address</label>
              <div class="">
                <input type="text" id="email_address" class="form-control text-main-sub" name="email" required autofocus>
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
              </div>
            </div>
            <div class="col-md-12  mt-5">
              <button type="submit" class="btn-style-two">
                <span class="btn-wrap">
                  <span class="text-one">Send Password Reset Link</span>
                  <span class="text-two">Send Password Reset Link</span>
                </span>
              </button>
            </div>
          </form>

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
</style>