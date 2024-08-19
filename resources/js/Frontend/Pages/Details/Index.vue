<template>
  <app-layout>
    <!-- Page Header
   ============================================= -->
    <section class="page-header page-header-text-light bg-secondary">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h1 class="text-6 mb-1 d-flex flex-wrap align-items-center">
              {{ client.name ?? "" }}
            </h1>
            <p class="opacity-8 mb-0">
              <i class="fas fa-map-marker-alt"></i>
              {{ client.address ? client.address.address1 : "" }}
            </p>
          </div>
          <div class="col-md-4"></div>
        </div>
      </div>
    </section>
    <!-- Page Header end -->

    <!-- Content
  ============================================= -->
    <div id="content">
      <div class="container">
        <div class="row">
          <!-- Middle Panel
        ============================================= -->
          <div class="col-lg-8">
            <div
              class="
                bg-white
                shadow-md
                rounded
                p-3 p-sm-4
                confirm-details
                smooth-scroll
              "
            >
              <div
                v-for="content in pageContent.filter(
                  (c) => c.name == 'gallery'
                )"
                :key="content.id"
              >
                <!-- Hotel Photo Slideshow
        	============================================= -->
                <div
                  class="owl-carousel owl-theme single-slider mb-3"
                  data-animateout="fadeOut"
                  data-animatein="fadeIn"
                  data-autoplay="true"
                  data-loop="true"
                  data-autoheight="true"
                  data-nav="true"
                  data-items="1"
                  v-if="content.name == 'gallery'"
                >
                  <div
                    class="item"
                    v-for="item in content.content"
                    :key="item.id"
                    style="max-height: 390px"
                  >
                    <a href="#"
                      ><img
                        class="img-fluid"
                        :src="item.image_path"
                        alt="Hotel photo"
                        height="100%"
                    /></a>
                  </div>
                </div>
                <!-- Hotel Photo Slideshow end -->
              </div>

              <!-- Secondary Navigation
        	============================================= -->
              <nav
                id="navbar-sticky"
                class="
                  bg-white
                  pb-2
                  mb-2
                  sticky-top
                  smooth-scroll
                  client-page-category
                "
              >
                <ul class="nav nav-tabs">
                  <li
                    class="nav-item"
                    v-for="content in pageContent.filter(
                      (c) => c.name != 'gallery'
                    )"
                    :key="content.id"
                  >
                    <a
                      class="nav-link text-nowrap"
                      :data-scroll="content.name"
                      :href="'#' + content.name"
                      >{{ content.value ?? "" }}</a
                    >
                  </li>
                </ul>
              </nav>
              <!-- Secondary Navigation end -->

              <div
                v-for="content in pageContent.filter(
                  (c) => c.name != 'gallery'
                )"
                :key="content.id"
                :id="content.name"
                class="pt-5 client-category-section"
              >
                <h2 class="text-6 mb-4">{{ content.value }}</h2>
                <div
                  class="inner-content"
                  v-if="
                    content.name == 'about-us' ||
                    content.name == 'terms-and-conditions'
                  "
                  v-html="content.content ?? ''"
                ></div>

                <!-- reviews -->
                <div v-if="content.name == 'reviews'">
                  <div
                    class="row"
                    v-for="item in content.content"
                    :key="item.id"
                  >
                    <div class="col-12 col-sm-3 text-center">
                      <div
                        class="
                          review-tumb
                          bg-dark-5
                          text-light
                          rounded-circle
                          d-inline-block
                          mb-2
                          text-center text-8
                        "
                      >
                        {{ item.customer ? item.customer.name[0] : "" }}
                      </div>
                      <p class="mb-0 line-height-1">
                        {{ item.customer ? item.customer.name : "" }}
                      </p>
                      <small><em>Jan 25, 2019</em></small>
                    </div>
                    <div class="col-12 col-sm-9 text-center text-sm-left">
                      <span class="text-2">
                        <i
                          class="fas fa-star"
                          v-for="r in 5"
                          :key="r"
                          v-bind:class="
                            parseInt(item.rating) >= r
                              ? 'text-warning'
                              : 'text-muted opacity-4'
                          "
                        ></i>
                      </span>
                      <p>
                        {{ item.review ?? "" }}
                      </p>
                      <hr />
                    </div>
                  </div>
                  <div class="text-center" v-if="content.content.length > 0">
                    <a href="#" class="btn btn-sm btn-outline-dark shadow-none"
                      >view more reviews</a
                    >
                  </div>
                </div>

                <!-- write review -->
                <div v-if="content.name == 'write-reviews'">
                  <form>
                    <div class="form-group">
                      <label for="yourName">Your Name</label>
                      <input
                        type="email"
                        class="form-control"
                        id="yourName"
                        required=""
                        aria-describedby="yourName"
                        placeholder="Enter your name"
                      />
                    </div>
                    <div class="form-group">
                      <label for="yourReview">Your Review</label>
                      <textarea
                        class="form-control"
                        rows="5"
                        id="yourReview"
                        required=""
                        placeholder="Enter Your Review"
                      ></textarea>
                    </div>
                    <div class="form-group">
                      <label>Rating</label>
                      <div>
                        <div
                          class="
                            custom-control custom-radio custom-control-inline
                          "
                        >
                          <input
                            id="bad"
                            name="reviewRating"
                            class="custom-control-input"
                            checked=""
                            required=""
                            type="radio"
                          />
                          <label class="custom-control-label" for="bad"
                            >Bad</label
                          >
                        </div>
                        <div
                          class="
                            custom-control custom-radio custom-control-inline
                          "
                        >
                          <input
                            id="poor"
                            name="reviewRating"
                            class="custom-control-input"
                            checked=""
                            required=""
                            type="radio"
                          />
                          <label class="custom-control-label" for="poor"
                            >Poor</label
                          >
                        </div>
                        <div
                          class="
                            custom-control custom-radio custom-control-inline
                          "
                        >
                          <input
                            id="fair"
                            name="reviewRating"
                            class="custom-control-input"
                            checked=""
                            required=""
                            type="radio"
                          />
                          <label class="custom-control-label" for="fair"
                            >Fair</label
                          >
                        </div>
                        <div
                          class="
                            custom-control custom-radio custom-control-inline
                          "
                        >
                          <input
                            id="good"
                            name="reviewRating"
                            class="custom-control-input"
                            checked=""
                            required=""
                            type="radio"
                          />
                          <label class="custom-control-label" for="good"
                            >Good</label
                          >
                        </div>
                        <div
                          class="
                            custom-control custom-radio custom-control-inline
                          "
                        >
                          <input
                            id="excellent"
                            name="reviewRating"
                            class="custom-control-input"
                            checked=""
                            required=""
                            type="radio"
                          />
                          <label class="custom-control-label" for="excellent"
                            >Excellent</label
                          >
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                      Submit
                    </button>
                  </form>
                </div>

                <!-- services -->
                <div v-if="content.name == 'services-and-amenities'">
                  <div class="hotels-amenities-detail text-5">
                    <span
                      class="border rounded"
                      v-for="item in content.content"
                      :key="item.id"
                      data-toggle="tooltip"
                      :data-original-title="item.name ?? ''"
                      style="width: 90px"
                      ><i class="fas fa-wifi text-primary"></i>
                      <div style="font-size: 14px; line-height: 1.2">
                        {{ item.name ?? "" }}
                      </div>
                    </span>
                  </div>
                </div>

                <!-- contact us -->
                <div v-if="content.name == 'contact'">
                  <div class="mt-4 mt-md-0">
                    <p class="text-3">
                      For Customer Support and Query, Get in touch with us
                    </p>
                    <div class="featured-box style-1" v-if="client.address">
                      <div class="featured-box-icon text-primary">
                        <i class="fas fa-map-marker-alt"></i>
                      </div>
                      <h3>Address</h3>
                      <p>
                        {{ client.address ? client.address.address1 : ""
                        }}<br />
                        {{ client.address ? client.address.address2 : ""
                        }}<br />
                      </p>
                    </div>
                    <div class="featured-box style-1" v-if="client.phone_no">
                      <div class="featured-box-icon text-primary">
                        <i class="fas fa-phone"></i>
                      </div>
                      <h3>Telephone</h3>
                      <p>
                        {{ client.phone_no ?? "" }},
                        {{ client.mobile_no ?? "" }}
                      </p>
                    </div>
                    <div class="featured-box style-1" v-if="client.fax">
                      <div class="featured-box-icon text-primary">
                        <i class="fas fa-fax"></i>
                      </div>
                      <h3>Fax</h3>
                      <p>{{ client.fax ?? "" }}</p>
                    </div>
                    <div class="featured-box style-1" v-if="client.email">
                      <div class="featured-box-icon text-primary">
                        <i class="fas fa-envelope"></i>
                      </div>
                      <h3>Inquiries</h3>
                      <p>{{ client.email ?? "" }}</p>
                    </div>
                  </div>
                </div>

                <!-- opening hours -->
                <div v-if="content.name == 'open-hours'">
                  <div class="mt-4 mt-md-0">
                    <div
                      v-for="(item, key) in content.content"
                      :key="key"
                      class="d-flex align-items-center"
                    >
                      <span
                        class="text-uppercase d-inline-block"
                        style="width: 50px"
                        ><b>{{ key }}</b></span
                      >
                      <div
                        class="px-2 d-inline-block"
                        style="
                          width: 50px;
                          background: #535b61;
                          height: 1px;
                          margin-right: 20px;
                        "
                      ></div>
                      <div>
                        <b>{{ item.open ?? "" }} - {{ item.close ?? "" }}</b>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="mb-0" />
              </div>
            </div>
          </div>
          <!-- Middle Panel End-->

          <!-- Side Panel
        ============================================= -->
          <aside class="col-lg-4 mt-4 mt-lg-0">
            <div class="bg-white shadow-md rounded p-3 sticky-top">
              <SalonBookingFormComponent :client="client"/>
              <hr class="mx-n3" />
              <form id="bookingHotels" method="post">

              </form>
            </div>
          </aside>
          <!-- Side Panel End -->
        </div>
      </div>
    </div>
    <!-- Content end -->
  </app-layout>
</template>

<script>
import AppLayout from "@@/Layouts/AppLayout";
import SalonBookingFormComponent from "./SalonBookingFormComponent";
export default {
  components: {
    AppLayout,
    SalonBookingFormComponent,
  },
  props: {
    client: Object,
    category: Object,
    pageContent: Object,
  },
  mounted() {
    /*---------------------------------------------------
   Carousel (Owl Carousel)
----------------------------------------------------- */
    $(".owl-carousel").each(function (index) {
      var a = $(this);
      $(this).owlCarousel({
        autoplay: a.data("autoplay"),
        autoplayTimeout: a.data("autoplaytimeout"),
        autoplayHoverPause: a.data("autoplayhoverpause"),
        loop: a.data("loop"),
        speed: a.data("speed"),
        nav: a.data("nav"),
        dots: a.data("dots"),
        autoHeight: a.data("autoheight"),
        autoWidth: a.data("autowidth"),
        margin: a.data("margin"),
        stagePadding: a.data("stagepadding"),
        slideBy: a.data("slideby"),
        lazyLoad: a.data("lazyload"),
        navText: [
          '<i class="fa fa-chevron-left"></i>',
          '<i class="fa fa-chevron-right"></i>',
        ],
        animateOut: a.data("animateout"),
        animateIn: a.data("animatein"),
        video: a.data("video"),
        items: a.data("items"),
        responsive: {
          0: { items: a.data("items-xs") },
          576: { items: a.data("items-sm") },
          768: { items: a.data("items-md") },
          992: { items: a.data("items-lg") },
        },
      });
    });

    // tooltip
    $("[data-toggle='tooltip']").tooltip({ container: "body" });

    // navbar scroll
    var link = $(".nav.nav-tabs .nav-item a");
    // Move to specific section when click on menu link
    link.on("click", function (e) {
      var target = $($(this).attr("href"));
      $("html, body, .client-page-category").animate(
        {
          scrollTop: target.offset().top,
        },
        600
      );
      // link.removeClass("active");
      $(this).addClass("active");
      e.preventDefault();
    });

    // Run the scrNav when scroll
    $(window).on("scroll", function () {
      scrNav();
    });

    scrNav();

    function scrNav() {
      var sTop = $(window).scrollTop();
      $(".client-category-section").each(function () {
        var id = $(this).attr("id"),
          offset = $(this).offset().top - 1,
          height = $(this).height();
        if (sTop >= offset && sTop < offset + height) {
          link.removeClass("active");
          $(".nav.nav-tabs")
            .find('[data-scroll="' + id + '"]')
            .addClass("active");
          document.querySelector('[data-scroll="' + id + '"]').scrollIntoView();
        }
      });
    }
  },
  computed: {
    customerRatings() {
      return;
    },
  },
};
</script>

