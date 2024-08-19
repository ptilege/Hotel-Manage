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
            <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
              <ul class="nav nav-tabs nav-justified mb-2" role="tablist">
                <li class="nav-item">
                  <a class="nav-link text-5 line-height-3 active">Register</a>
                </li>
              </ul>
              <p class="text-4 font-weight-300 text-muted text-center mb-2">
                Looks like you're new here!
              </p>
              <form id="signupForm" @submit.prevent="submit()">
                <InputComponent
                  type="text"
                  id="fullName"
                  label="Full Name"
                  v-model="form.name"
                />
                <InputComponent
                  type="email"
                  id="emailAddress"
                  label="Email Address"
                  v-model="form.email"
                />
                <InputComponent
                  type="tel"
                  classStr="no-arrows"
                  id="mobileNo"
                  label="Mobile Number"
                  v-model="form.phone"
                  :error="errors.phone"
                />
                <InputComponent
                  type="password"
                  id="loginPassword"
                  label="Password"
                  v-model="form.password"
                />
                <div class="progress" style="height: 4px">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    :style="
                      'width: ' +
                      passwordStrength +
                      '%;background-color:' +
                      passwordStrengthColor +
                      ';'
                    "
                    :aria-valuenow="passwordStrength"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  ></div>
                </div>
                <!-- <progress
                  max="100"
                  :value="passwordStrength"
                  id="passwordStrength"
                  :style="'background:'+passwordStrengthColor"
                ></progress> -->
                <!-- <div class="form-group my-4">
                <div class="form-check text-2 custom-control custom-checkbox">
                  <input
                    id="agree"
                    name="agree"
                    class="custom-control-input"
                    type="checkbox"
                  />
                  <label class="custom-control-label" for="agree"
                    >I agree to the <a href="#">Terms</a> and
                    <a href="#">Privacy Policy</a>.</label
                  >
                </div>
              </div> -->
                <button class="btn btn-primary btn-block my-3" type="submit">
                  Sign Up
                </button>
              </form>
              <div class="d-flex align-items-center my-2">
                <hr class="flex-grow-1" />
                <span class="mx-2 text-2 text-muted"
                  >Or Sign Up with Social Profile</span
                >
                <hr class="flex-grow-1" />
              </div>
              <div class="d-flex flex-column align-items-center mb-2">
                <ul
                  class="social-icons social-icons-colored social-icons-circle"
                >
                  <li class="social-icons-facebook mr-2">
                    <a
                      :href="route('social.oauth', 'facebook')"
                      data-toggle="tooltip"
                      data-original-title="Log In with Facebook"
                      ><i class="fab fa-facebook-f"></i
                    ></a>
                  </li>
                  <li class="social-icons-google ml-2">
                    <a
                      :href="route('social.oauth', 'google')"
                      data-toggle="tooltip"
                      data-original-title="Log In with Google"
                      ><i class="fab fa-google"></i
                    ></a>
                  </li>
                </ul>
              </div>
              <p class="text-2 text-center mb-0">
                Already have an account?
                <a class="btn-link" :href="route('customer.login')">Log In</a>
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
import InputComponent from "@@/Components/InputComponent";
import CheckboxComponent from "@@/Components/CheckboxComponent";

export default {
  components: {
    AppLayout,
    InputComponent,
    CheckboxComponent,
  },
  props: {
    errors: {
      type: Object,
    },
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone: "",
        countryCode: "",
        password: "",
      },
      passwordStrengthColor: "#ff0000",
    };
  },
  mounted() {
    let self = this;
    $(document).ready(function () {
      var telInput = document.querySelector("#mobileNo");

      var iti = intlTelInput(telInput, {
        initialCountry: "auto",
        autoPlaceholder: "aggressive",
        separateDialCode: true,
        nationalMode: true,
        utilsScript:
          "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.16/js/utils.min.js",
        geoIpLookup: function (callback) {
          $.get(
            "https://ipinfo.io?token=680246b4e8718d",
            function () {},
            "jsonp"
          ).always(function (resp) {
            var countryCode = resp && resp.country ? resp.country : "us";
            callback(countryCode);
          });
        },
      });

      telInput.addEventListener("countrychange", function () {
        self.form.countryCode = iti.getSelectedCountryData().dialCode;
      });
      telInput.addEventListener("keyup", function () {
        if (
          self.form.phone.match(/[a-zA-Z!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/)
        ) {
          self.form.phone = self.form.phone.replace(
            /[a-zA-Z!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/,
            ""
          );
        }
        if (iti.isValidNumber()) {
          self.errors.phone = "";
        } else {
          self.errors.phone = "Invalid Mobile Number";
        }
      });

      $(".iti__flag-container").on("click", function () {
        var telInputWidth = $(".form-group").width();
        $("ul.iti__country-list").width(telInputWidth - 2);
      });
    });
  },
  methods: {
    submit() {
      if (this.errors.hasOwnProperty('phone') && this.errors.phone != "Invalid Mobile Number") {
        console.log('ok');
        this.$inertia.post(route('customer.make.register'),this.$data.form,{preserveScroll:true});
      }
    },
  },
  computed: {
    passwordStrength() {
      var strength = 0;
      if (this.form.password.match(/[a-z]+/)) {
        strength += 1;
      }
      if (this.form.password.match(/[A-Z]+/)) {
        strength += 1;
      }
      if (this.form.password.match(/[0-9]+/)) {
        strength += 1;
      }
      if (this.form.password.match(/[$@#&!]+/)) {
        strength += 1;
      }
      if (this.form.password.length >= 8) {
        strength += 1;
      }
      switch (strength) {
        case 0:
          this.passwordStrengthColor = "#ff0000";
          return 0;
        case 1:
          this.passwordStrengthColor = "#ff0000";
          return 20;
        case 2:
          this.passwordStrengthColor = "#ff8400";
          return 40;
        case 3:
          this.passwordStrengthColor = "#ffdd00";
          return 60;
        case 4:
          this.passwordStrengthColor = "#6aff00";
          return 80;
        case 5:
          this.passwordStrengthColor = "green";
          return 100;
      }
    },
  },
};
</script>

<style>
</style>