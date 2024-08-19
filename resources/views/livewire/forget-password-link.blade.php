<section class="page-banner" style="background-image: url('{{ asset('images/main-slider/1.jpg') }}'); padding-bottom:30px;">
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card auth-form bg-light-blue justify-center align-items-center">
            <div class="card-body">





                <div class="card-header sec-title_two-text" style="color: #051036;">Reset Password</div>
                <div class="card-body">

                    <form action="{{ route('forget-password-link.post') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email_address" class="col-md-12 form-label text-main-sub" style="text-align:left">E-Mail Address</label>
                            <div class="col-md-12">
                                <input type="text" id="email_address" class="form-control text-main-sub" name="email" required autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="password" class="col-md-12 form-label text-main-sub" style="text-align:left">New Password</label>
                            <div class="col-md-12">
                                <input type="password" id="password" class="form-control text-main-sub" name="password" required autofocus>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="password-confirm" class="col-md-12 form-label text-main-sub" style="text-align:left">Confirm Password</label>
                            <div class="col-md-12">
                                <input type="password" id="password-confirm" class="form-control text-main-sub" name="password_confirmation" required autofocus>
                                @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div> -->
                        <div class="col-md-12  mt-5">
                            <button type="submit" class="btn-style-two">
                                <span class="btn-wrap">
                                    <span class="text-one">Reset Password</span>
                                    <span class="text-two">Reset Password</span>
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