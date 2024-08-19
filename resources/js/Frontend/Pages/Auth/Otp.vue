<template>
  <!-- Document Wrapper   
============================================= -->
  <div id="main-wrapper">
    <!-- Content
  ============================================= -->
    <div id="content">
      <div class="container pt-5 pb-4">
        <div class="row">
          <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
            <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-4 px-sm-5">
              <h3 class="text-center mt-3 mb-2">Verify Mobile Number</h3>
              <!-- <p class="text-center">
                <img
                  class="img-fluid"
                  src="images/otp-icon.png"
                  alt="verification"
                />
              </p> -->
              <p class="text-muted text-3 text-center">
                Please enter the OTP (one time password) to verify your mobile
                number. <br />
                A Code has been sent to
                <span class="text-dark text-4">{{ phone }}</span>
              </p>
              <form
                id="otpScreen"
                class="form-border"
                @submit.prevent="submit()"
              >
                <div class="form-row">
                  <div class="col form-group">
                    <input
                      type="text"
                      class="form-control border-2 text-center text-6 px-0 py-2"
                      maxlength="1"
                      required=""
                      autocomplete="off"
                      v-model="otp1"
                    />
                  </div>
                  <div class="col form-group">
                    <input
                      type="text"
                      class="form-control border-2 text-center text-6 px-0 py-2"
                      maxlength="1"
                      required=""
                      autocomplete="off"
                      v-model="otp2"
                    />
                  </div>
                  <div class="col form-group">
                    <input
                      type="text"
                      class="form-control border-2 text-center text-6 px-0 py-2"
                      maxlength="1"
                      required=""
                      autocomplete="off"
                      v-model="otp3"
                    />
                  </div>
                  <div class="col form-group">
                    <input
                      type="text"
                      class="form-control border-2 text-center text-6 px-0 py-2"
                      maxlength="1"
                      required=""
                      autocomplete="off"
                      v-model="otp4"
                    />
                  </div>
                </div>
                <button
                  class="btn btn-primary btn-block shadow-none my-3"
                  type="submit"
                >
                  Verify
                </button>
              </form>
              <p class="text-2 text-center">
                Not received your code?
                <a class="btn-link" href="#">Resend code</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppLayout from "@@/Layouts/AppLayout";

export default {
  props: {
    countryCode: {
      default: "",
    },
    phoneNumber: {
      default: "",
    },
  },
  data() {
    return {
      otp: "",
      otp1: "",
      otp2: "",
      otp3: "",
      otp4: "",
    };
  },
  mounted() {
    var thisVar = this;
    // OTP Form (Focusing on next input)
    var otpArr = [];
    $("#otpScreen .form-control").keyup(function () {
      if (this.value.length == 0) {
        otpArr.pop();
        $(this).blur().parent().prev().children(".form-control").focus();
      } else if (this.value.length == this.maxLength) {
        otpArr.push(this.value);
        $(this).blur().parent().next().children(".form-control").focus();
      }
    });
  },
  methods: {
    submit() {
      this.otp = this.otp1 + this.otp2 + this.otp3 + this.otp4;
      if (this.otp.length == 4) {
        console.log("ok");
      }
    },
  },
  computed: {
    phone() {
      return this.phoneNumber
        ? "+" +
            this.countryCode +
            this.phoneNumber.replace(/./g, (match, offset) => {
              return offset < this.phoneNumber.length - 3 ? "*" : match;
            })
        : "+" + this.countryCode + "********";
    },
  },
};
</script>

<style>
</style>