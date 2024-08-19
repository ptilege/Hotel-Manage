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
                  <a class="nav-link text-5 line-height-3 active">Login</a>
                </li>
              </ul>
              <p class="text-4 font-weight-300 text-muted text-center mb-2">
                We are glad to see you again!
              </p>
              <form id="loginForm" @submit.prevent="submit()">
                <InputComponent
                  type="text"
                  id="emailAddress"
                  label="Mobile or Email"
                  v-model="form.login"
                />
                <InputComponent
                  type="password"
                  id="loginPassword"
                  label="Password"
                  v-model="form.password"
                />
                <div class="row my-2">
                  <div class="col">
                    <CheckboxComponent
                      id="remember-me"
                      label="Remember Me"
                      v-model="form.remember"
                    />
                  </div>
                  <div class="col text-2 text-right">
                    <a class="btn-link" href="forgot-password.html"
                      >Forgot Password ?</a
                    >
                  </div>
                </div>
                <button
                  class="btn btn-primary btn-block my-3"
                  type="submit"
                  :disabled="form.processing"
                >
                  Login
                </button>
              </form>
              <div class="d-flex align-items-center my-2">
                <hr class="flex-grow-1" />
                <span class="mx-2 text-2 text-muted"
                  >Or Login with Social Profile</span
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
                New User?
                <a class="btn-link" :href="route('customer.register')"
                  >Register</a
                >
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
  data() {
    return {
      form: this.$inertia.form({
        login: "",
        password: "",
        remember: false,
      }),
    };
  },
  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("customer.make.login"), {
          onFinish: () => this.form.reset("password"),
        });
    },
  },
};
</script>

<style>
</style>