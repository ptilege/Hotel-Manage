<template>
  <app-layout>
    <div class="container pt-5 pb-4">
      <div class="row">
        <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
          <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
            <h3 class="text-center mt-3 mb-4">Forgot your password?</h3>
            <p class="text-center text-3 text-muted">
              Enter your Email or Mobile and we’ll help you reset your password.
            </p>
            <form id="forgotForm" class="form-border" method="post">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control border-2"
                  id="emailAddress"
                  required=""
                  placeholder="Enter Email or Mobile Number"
                />
              </div>
              <button class="btn btn-primary btn-block my-4" type="submit">
                Continue
              </button>
            </form>
            <p class="text-center mb-0">
              <a class="btn-link" href="login.html">Return to Log In</a>
              <span class="text-muted mx-3">|</span>
              <a class="btn-link" href="otp.html">Request OTP</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@@/Layouts/AppLayout";

export default {
  components: {
    AppLayout,
  },
};
</script>