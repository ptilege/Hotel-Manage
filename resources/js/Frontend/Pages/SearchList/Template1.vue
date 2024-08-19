<template>
  <app-layout>
    <!-- Page Header
    ============================================= -->
    <section class="page-header page-header-text-light bg-secondary">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h1>{{ category.name ?? "" }}</h1>
          </div>
        </div>
      </div>
    </section>
    <!-- Page Header end -->
    <!-- Content
  ============================================= -->
    <div id="content">
      <section class="container">
        <!-- <TopSearchBar /> -->
        <div class="row">
          <!-- Side Panel
        ============================================= -->
          <aside class="col-lg-3 sidebar-filters">
            <div class="bg-white shadow-md rounded p-3">
              <h3 class="text-5">Filter</h3>
              <hr class="mx-n3" />
              <div
                class="accordion accordion-alternate style-2 mt-n3"
                id="toggleAlternate"
              >
                <div class="card">
                  <div class="card-header" id="search">
                    <h5 class="mb-0">
                      <a
                        href="#"
                        class="collapse"
                        data-toggle="collapse"
                        data-target="#togglesearch"
                        aria-expanded="true"
                        aria-controls="togglesearch"
                        >Search</a
                      >
                    </h5>
                  </div>
                  <div
                    id="togglesearch"
                    class="collapse show"
                    aria-labelledby="search"
                  >
                    <div class="card-body">
                      <form
                        id="bookingSearchForm"
                        class="booking-search-form"
                        @submit.prevent="submit(category)"
                      >
                        <div class="form-row">
                          <div class="col-md-12 col-lg form-group">
                            <input
                              type="text"
                              class="form-control form-control-sm"
                              id="SearchHotel"
                              placeholder="Search by Name"
                              data-field-name="name"
                              v-model="form.name"
                            />
                            <span class="icon-inside"
                              ><i class="fas fa-search"></i
                            ></span>
                          </div>
                        </div>
                        <div
                          v-for="(formField, index) in JSON.parse(
                            category.search_form
                          )"
                          :key="index"
                        >
                          <!-- Form Row Location -->
                          <div
                            class="form-row"
                            v-if="formField.field.type == 'location'"
                          >
                            <div class="col-lg-12 form-group">
                              <select
                                :id="'location-' + category.slug"
                                class="custom-select text-secondary select2"
                                v-model="form[formField.field.variable]"
                                :data-field-name="formField.field.variable"
                              >
                                <option selected="selected" disabled value="">
                                  {{ formField.field_name }}
                                </option>
                                <option
                                  :value="location.id"
                                  v-for="location in locations"
                                  :key="location.id"
                                >
                                  {{ location.name }}
                                </option>
                              </select>
                              <span class="icon-inside"
                                ><i class="fas fa-map-marker-alt"></i
                              ></span>
                            </div>
                          </div>
                          <!-- Form Row Location End -->
                          <!-- Form Row Service -->
                          <div
                            class="form-row"
                            v-if="formField.field.type == 'service'"
                          >
                            <div class="col-lg-12 form-group">
                              <select
                                :id="'service-' + category.slug"
                                class="custom-select text-secondary select2"
                                v-model="form[formField.field.variable]"
                                :data-field-name="formField.field.variable"
                              >
                                <option selected="selected" disabled value="">
                                  {{ formField.field_name }}
                                </option>
                                <option
                                  :value="service.id"
                                  v-for="service in services"
                                  :key="service.id"
                                >
                                  {{ service.name }}
                                </option>
                              </select>
                              <span class="icon-inside"
                                ><i class="fas fa-map-marker-alt"></i
                              ></span>
                            </div>
                          </div>
                          <!-- Form Row Service End -->
                          <!-- Form Row Date -->
                          <div
                            class="form-row"
                            v-if="formField.field.type == 'date'"
                          >
                            <div class="col-lg-12 form-group">
                              <input
                                :id="'date-' + category.slug"
                                type="text"
                                class="
                                  form-control form-control-sm
                                  date-range-picker
                                "
                                required=""
                                :placeholder="formField.field_name"
                                :data-field-name="formField.field.variable"
                                v-model="form[formField.field.variable]"
                              />
                              <span class="icon-inside"
                                ><i class="far fa-calendar-alt"></i
                              ></span>
                            </div>
                          </div>
                          <!-- Form Row Date End -->
                          <!-- Form Row Checkin Checkout End -->
                          <div
                            class="form-row"
                            v-if="formField.field.type == 'checkin_checkout'"
                          >
                            <div class="col-lg-6 form-group">
                              <input
                                :id="'checkIn-' + category.slug"
                                type="text"
                                class="
                                  form-control form-control-sm
                                  date-range-picker
                                "
                                placeholder="Check In"
                                :data-field-name="formField.field.variable[0]"
                                v-model="form[formField.field.variable[0]]"
                              />
                              <span class="icon-inside"
                                ><i class="far fa-calendar-alt"></i
                              ></span>
                            </div>
                            <div class="col-lg-6 form-group">
                              <input
                                :id="'checkOut-' + category.slug"
                                type="text"
                                class="
                                  form-control form-control-sm
                                  date-range-picker
                                "
                                placeholder="Check Out"
                                :data-field-name="formField.field.variable[1]"
                                v-model="form[formField.field.variable[1]]"
                              />
                              <span class="icon-inside"
                                ><i class="far fa-calendar-alt"></i
                              ></span>
                            </div>
                          </div>
                          <!-- Form Row Form Row Checkin Checkout End -->
                          <!-- Form Row Form Row From To -->
                          <div
                            class="form-row"
                            v-if="formField.field.type == 'from_to'"
                          >
                            <div class="col-lg-6 form-group">
                              <select
                                :id="'from-' + category.slug"
                                class="custom-select text-secondary select2"
                                :data-field-name="formField.field.variable[0]"
                                v-model="form[formField.field.variable[0]]"
                              >
                                <option selected="selected" disabled value="">
                                  From
                                </option>
                                <option
                                  :value="location.id"
                                  v-for="location in locations"
                                  :key="location.id"
                                >
                                  {{ location.name }}
                                </option>
                              </select>
                            </div>
                            <div class="col-lg-6 form-group">
                              <select
                                :id="'to-' + category.slug"
                                class="custom-select text-secondary select2"
                                :data-field-name="formField.field.variable[1]"
                                v-model="form[formField.field.variable[1]]"
                              >
                                <option selected="selected" disabled value="">
                                  To
                                </option>
                                <option
                                  :value="location.id"
                                  v-for="location in locations"
                                  :key="location.id"
                                >
                                  {{ location.name }}
                                </option>
                              </select>
                            </div>
                          </div>
                          <!-- Form Row Form Row From To End -->
                          <!-- Form Row Form Row Date Time -->
                          <div
                            class="form-row no-gutters"
                            v-if="formField.field.type == 'date_time'"
                          >
                            <div class="col-8 form-group">
                              <input
                                :id="'date' + category.slug"
                                type="text"
                                class="form-control date-range-picker"
                                required=""
                                :placeholder="formField.field_name"
                                :data-field-name="formField.field.variable[0]"
                                v-model="form[formField.field.variable[0]]"
                              />
                              <span class="icon-inside"
                                ><i class="far fa-calendar-alt"></i
                              ></span>
                            </div>
                            <div class="col-4 form-group">
                              <input
                                :id="'time' + category.slug"
                                type="time"
                                class="form-control"
                                required=""
                                :data-field-name="formField.field.variable[1]"
                                v-model="form[formField.field.variable[1]]"
                              />
                            </div>
                          </div>
                          <!-- Form Row Form Row Date Time End -->
                        </div>

                        <button
                          class="btn btn-primary btn-sm btn-block"
                          type="submit"
                        >
                          Search
                        </button>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header" id="price">
                    <h5 class="mb-0">
                      <a
                        href="#"
                        class="collapse"
                        data-toggle="collapse"
                        data-target="#togglePrice"
                        aria-expanded="true"
                        aria-controls="togglePrice"
                        >Price</a
                      >
                    </h5>
                  </div>
                  <div
                    id="togglePrice"
                    class="collapse show"
                    aria-labelledby="price"
                  >
                    <div class="card-body">
                      <p>
                        <input
                          id="amount"
                          type="text"
                          readonly=""
                          class="form-control border-0 bg-transparent p-0"
                        />
                      </p>
                      <div id="slider-range"></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="propertyTypes">
                    <h5 class="mb-0">
                      <a
                        href="#"
                        class="collapse"
                        data-toggle="collapse"
                        data-target="#togglepropertyTypes"
                        aria-expanded="true"
                        aria-controls="togglepropertyTypes"
                        >Property Types</a
                      >
                    </h5>
                  </div>
                  <div
                    id="togglepropertyTypes"
                    class="collapse show"
                    aria-labelledby="propertyTypes"
                  >
                    <div class="card-body">
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="hotel"
                          name="propertyTypes"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="hotel"
                          >Hotel
                          <small class="text-muted float-right"
                            >250</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="resort"
                          name="propertyTypes"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="resort"
                          >Resort
                          <small class="text-muted float-right"
                            >76</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="villa"
                          name="propertyTypes"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="villa"
                          >Villa
                          <small class="text-muted float-right"
                            >31</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="heritage"
                          name="propertyTypes"
                          class="custom-control-input"
                        />
                        <label
                          class="custom-control-label d-block"
                          for="heritage"
                          >Heritage
                          <small class="text-muted float-right"
                            >12</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="motel"
                          name="propertyTypes"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="motel"
                          >Motel
                          <small class="text-muted float-right">5</small></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="guestHouse"
                          name="propertyTypes"
                          class="custom-control-input"
                        />
                        <label
                          class="custom-control-label d-block"
                          for="guestHouse"
                          >Guest House
                          <small class="text-muted float-right"
                            >107</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="farmHouse"
                          name="propertyTypes"
                          class="custom-control-input"
                        />
                        <label
                          class="custom-control-label d-block"
                          for="farmHouse"
                          >Farm House
                          <small class="text-muted float-right"
                            >66</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="palace"
                          name="propertyTypes"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="palace"
                          >Palace
                          <small class="text-muted float-right"
                            >18</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="sercicedApartments"
                          name="propertyTypes"
                          class="custom-control-input"
                        />
                        <label
                          class="custom-control-label d-block"
                          for="sercicedApartments"
                          >Serviced Apartments
                          <small class="text-muted float-right"
                            >41</small
                          ></label
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="starCategory">
                    <h5 class="mb-0">
                      <a
                        href="#"
                        class="collapse"
                        data-toggle="collapse"
                        data-target="#togglestarCategory"
                        aria-expanded="true"
                        aria-controls="togglestarCategory"
                        >Star Category</a
                      >
                    </h5>
                  </div>
                  <div
                    id="togglestarCategory"
                    class="collapse show"
                    aria-labelledby="starCategory"
                  >
                    <div class="card-body">
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="5Star"
                          name="starCategory"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="5Star"
                          >5 Star <i class="fas fa-star text-warning"></i
                          ><i class="fas fa-star text-warning"></i
                          ><i class="fas fa-star text-warning"></i
                          ><i class="fas fa-star text-warning"></i
                          ><i class="fas fa-star text-warning"></i>
                          <small class="text-muted float-right"
                            >512</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="4Star"
                          name="starCategory"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="4Star"
                          >4 Star <i class="fas fa-star text-warning"></i
                          ><i class="fas fa-star text-warning"></i
                          ><i class="fas fa-star text-warning"></i
                          ><i class="fas fa-star text-warning"></i
                          ><small class="text-muted float-right"
                            >476</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="3Star"
                          name="starCategory"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="3Star"
                          >3 Star <i class="fas fa-star text-warning"></i
                          ><i class="fas fa-star text-warning"></i
                          ><i class="fas fa-star text-warning"></i>
                          <small class="text-muted float-right"
                            >176</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="2Star"
                          name="starCategory"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="2Star"
                          >2 Star <i class="fas fa-star text-warning"></i
                          ><i class="fas fa-star text-warning"></i>
                          <small class="text-muted float-right"
                            >231</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="1Star"
                          name="starCategory"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="1Star"
                          >1 Star <i class="fas fa-star text-warning"></i>
                          <small class="text-muted float-right">5</small></label
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="userReview">
                    <h5 class="mb-0">
                      <a
                        href="#"
                        class="collapse"
                        data-toggle="collapse"
                        data-target="#toggleuserReview"
                        aria-expanded="true"
                        aria-controls="toggleuserReview"
                        >User Review</a
                      >
                    </h5>
                  </div>
                  <div
                    id="toggleuserReview"
                    class="collapse show"
                    aria-labelledby="userReview"
                  >
                    <div class="card-body">
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="excellent"
                          name="userReview"
                          class="custom-control-input"
                        />
                        <label
                          class="custom-control-label d-block"
                          for="excellent"
                          >Excellent
                          <small class="text-muted float-right"
                            >499</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="good"
                          name="userReview"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="good"
                          >Good
                          <small class="text-muted float-right"
                            >310</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="fair"
                          name="userReview"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="fair"
                          >Fair
                          <small class="text-muted float-right"
                            >225</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="poor"
                          name="userReview"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="poor"
                          >Poor
                          <small class="text-muted float-right"
                            >110</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="bad"
                          name="userReview"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="bad"
                          >Bad
                          <small class="text-muted float-right"
                            >44</small
                          ></label
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="amenities">
                    <h5 class="mb-0">
                      <a
                        href="#"
                        class="collapse"
                        data-toggle="collapse"
                        data-target="#toggleamenities"
                        aria-expanded="true"
                        aria-controls="toggleamenities"
                        >Amenities</a
                      >
                    </h5>
                  </div>
                  <div
                    id="toggleamenities"
                    class="collapse show"
                    aria-labelledby="amenities"
                  >
                    <div class="card-body">
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="internetWiFi"
                          name="amenities"
                          class="custom-control-input"
                        />
                        <label
                          class="custom-control-label d-block"
                          for="internetWiFi"
                          ><i class="fas fa-wifi"></i> Internet/Wi-Fi
                          <small class="text-muted float-right"
                            >512</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="restaurant"
                          name="amenities"
                          class="custom-control-input"
                        />
                        <label
                          class="custom-control-label d-block"
                          for="restaurant"
                          ><i class="fas fa-utensils"></i> Restaurant
                          <small class="text-muted float-right"
                            >476</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="bar"
                          name="amenities"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="bar"
                          ><i class="fas fa-glass-martini"></i> Bar
                          <small class="text-muted float-right"
                            >176</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="swimmingPool"
                          name="amenities"
                          class="custom-control-input"
                        />
                        <label
                          class="custom-control-label d-block"
                          for="swimmingPool"
                          ><i class="fas fa-swimmer"></i> Swimming Pool
                          <small class="text-muted float-right"
                            >231</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="businessFacilities"
                          name="amenities"
                          class="custom-control-input"
                        />
                        <label
                          class="custom-control-label d-block"
                          for="businessFacilities"
                          ><i class="fas fa-chalkboard-teacher"></i> Business
                          Facilities
                          <small class="text-muted float-right">5</small></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="spaWellness"
                          name="amenities"
                          class="custom-control-input"
                        />
                        <label
                          class="custom-control-label d-block"
                          for="spaWellness"
                          ><i class="fas fa-spa"></i> Spa/Wellness
                          <small class="text-muted float-right"
                            >107</small
                          ></label
                        >
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          id="gym"
                          name="amenities"
                          class="custom-control-input"
                        />
                        <label class="custom-control-label d-block" for="gym"
                          ><i class="fas fa-dumbbell"></i> Gym
                          <small class="text-muted float-right"
                            >66</small
                          ></label
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </aside>
          <!-- Side Panel end -->
          <div class="col-lg-9 mt-4 mt-lg-0">
            <!-- Sort Filters
          ============================================= -->
            <div class="border-bottom mb-3 pb-3">
              <div class="row align-items-center">
                <div class="col-6 col-md-8">
                  <span class="mr-3"
                    ><span class="text-4">{{ getLocationName() }} : </span>
                    <span class="font-weight-600">
                      {{ clients ? clients.length : "" }}
                      {{ category.name }}</span
                    >
                    found</span
                  >
                </div>
                <div class="col-6 col-md-4"></div>
              </div>
            </div>
            <!-- Sort Filters end -->

            <!-- List Item
          ============================================= -->
            <div class="items-list">
              <!-- hotel card -->
              <div
                class="items-list-item bg-white shadow-md rounded p-3 mb-2"
                v-for="client in clients"
                :key="client.id"
              >
                <div class="row">
                  <div class="col-md-4">
                    <a href="#"
                      ><img
                        class="img-fluid rounded align-top"
                        src="images/brands/hotels/hotel-1.jpg"
                        alt="hotels"
                    /></a>
                  </div>
                  <div class="col-md-8 pl-3 pl-md-0 mt-3 mt-md-0">
                    <div class="row no-gutters">
                      <div class="col-sm-9">
                        <h4>
                          <a href="#" class="text-dark text-5">{{
                            client.name ?? ""
                          }}</a>
                        </h4>
                        <p class="mb-2">
                          <span class="mr-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                          </span>
                          <span class="text-black-50"
                            ><i class="fas fa-map-marker-alt"></i>
                            {{ getClientAddress(client.address) }}</span
                          >
                        </p>
                        <p class="mb-2">
                          <span class="text-black-50">
                            {{ getClientDescription(client.description) }}</span
                          >
                        </p>
                        <p
                          class="
                            services
                            d-flex
                            align-items-center
                            mb-2
                            text-4
                          "
                        >
                          <span
                            v-for="service in client.services"
                            :key="service.id"
                            data-toggle="tooltip"
                            :data-original-title="service.name"
                            class="px-1"
                            ><i class="fas fa-wifi"></i
                          ></span>
                        </p>
                        <!-- <p class="reviews mb-2">
                          <span
                            class="
                              reviews-score
                              px-2
                              py-1
                              rounded
                              font-weight-600
                              text-light
                            "
                            >8.2</span
                          >
                          <span class="font-weight-600">Excellent</span>
                          <a class="text-black-50" href="#">(245 reviews)</a>
                        </p> -->
                        <!-- <p class="text-danger mb-0">
                          Last Booked - 18 hours ago
                        </p> -->
                      </div>
                      <div
                        class="
                          col-sm-3
                          text-right
                          d-flex
                          align-items-end
                        "
                      >
                        <Link
                          :href="route('client.details', {slug:category.slug, client_slug:client.slug})"
                          class="btn btn-sm btn-primary order-4 ml-auto"
                          >Book Now</Link
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- hotel card end -->

              <!-- car List card -->
              <!-- <div class="car-item bg-white shadow-md rounded p-3">
                <div class="row">
                  <div class="col-md-4">
                    <a href="#"
                      ><img
                        class="img-fluid rounded align-top"
                        src="images/brands/cars/creta.png"
                        alt="cars"
                    /></a>
                  </div>
                  <div class="col-md-8 mt-3 mt-md-0">
                    <div class="row no-gutters">
                      <div class="col-sm-9">
                        <h4 class="d-flex align-items-center">
                          <a href="#" class="text-dark text-5 mr-2"
                            >Creta Hyundai</a
                          >
                          <span
                            class="
                              alert alert-info
                              rounded-pill
                              px-2
                              py-1
                              line-height-1
                              font-weight-400
                              text-2
                              mb-0
                            "
                            >SUV</span
                          >
                        </h4>
                        <p
                          class="
                            car-features
                            d-flex
                            align-items-center
                            mb-2
                            text-4
                          "
                        >
                          <span
                            data-toggle="tooltip"
                            data-original-title="5 Adult Passenger"
                            ><i class="fas fa-user"></i> <small>5</small></span
                          >
                          <span
                            data-toggle="tooltip"
                            data-original-title="2 Large Bag"
                            ><i class="fas fa-suitcase-rolling"></i>
                            <small>2</small></span
                          >
                          <span
                            data-toggle="tooltip"
                            data-original-title="1 Small Bag"
                            ><i class="fas fa-suitcase"></i>
                            <small>1</small></span
                          >
                          <span
                            data-toggle="tooltip"
                            data-original-title="Automatic transmission"
                            ><i class="fas fa-cog"></i>
                            <small>Auto</small></span
                          >
                          <span
                            data-toggle="tooltip"
                            data-original-title="Drive unlimited distance with this car at no extra cost"
                            ><i class="fas fa-tachometer-alt"></i>
                            <small>Mileage</small></span
                          >
                          <span
                            data-toggle="tooltip"
                            data-original-title="Air Conditioning Available"
                            ><i class="fas fa-snowflake"></i>
                            <small>A/C</small></span
                          >
                        </p>
                        <div class="row text-1 mb-3">
                          <div
                            data-toggle="tooltip"
                            data-original-title="Free cancellation up to 72 hours prior to pick up"
                            class="col-6"
                          >
                            <span class="text-success mr-1"
                              ><i class="fas fa-check"></i></span
                            >Free Cancellation
                          </div>
                          <div
                            class="col-6"
                            data-toggle="tooltip"
                            data-original-title="Instantly confirmed upon booking"
                          >
                            <span class="text-success mr-1"
                              ><i class="fas fa-check"></i></span
                            >Instantly Confirmed
                          </div>
                          <div
                            class="col-6"
                            data-toggle="tooltip"
                            data-original-title="In the unlikely event you find a better price on the same brand, we'll beat it. See 'Price Promise' on our About Us page"
                          >
                            <span class="text-success mr-1"
                              ><i class="fas fa-check"></i></span
                            >Price Guarantee
                          </div>
                          <div
                            class="col-6"
                            data-toggle="tooltip"
                            data-original-title="Rate includes Third Party Liability Cover"
                          >
                            <span class="text-success mr-1"
                              ><i class="fas fa-check"></i></span
                            >Third Party Liability
                          </div>
                        </div>
                        <p class="reviews mb-0">
                          <span
                            class="
                              reviews-score
                              px-2
                              py-1
                              rounded
                              font-weight-600
                              text-light
                            "
                            >4.7</span
                          >
                          <span class="font-weight-600">Excellent</span>
                          <a class="text-black-50" href="#">(188 reviews)</a>
                        </p>
                      </div>
                      <div
                        class="
                          col-sm-3
                          text-right
                          d-flex d-sm-block
                          align-items-center
                        "
                      >
                        <div class="text-success text-3 mb-0 mb-sm-1 order-2">
                          16% Off!
                        </div>
                        <div
                          class="
                            d-block
                            text-3 text-black-50
                            mb-0 mb-sm-2
                            mr-2 mr-sm-0
                            order-1
                          "
                        >
                          <del class="d-block">$250</del>
                        </div>
                        <div
                          class="
                            text-dark text-7
                            font-weight-500
                            mb-0 mb-sm-2
                            mr-2 mr-sm-0
                            order-0
                          "
                        >
                          $210
                        </div>
                        <div
                          class="
                            text-black-50
                            mb-0 mb-sm-2
                            order-3
                            d-none d-sm-block
                          "
                        >
                          per day
                        </div>
                        <a
                          href="#"
                          class="btn btn-sm btn-primary order-4 ml-auto"
                          >Book Now</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
              <!-- car List card end -->
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- Content end -->
  </app-layout>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

import AppLayout from "@@/Layouts/AppLayout";
import TopSearchBar from "./Components/TopSearchBar.vue";
import SideFilterBar from "./Components/SideFilterBar.vue";

export default {
  components: {
    Link,
    AppLayout,
    TopSearchBar,
    SideFilterBar,
  },
  props: {
    requestData: Object,
    category: Object,
    clients: Object,
    services: Object,
    locations: {
      type: Object,
      default: {},
    },
  },
  data() {
    return {
      form: {
        name: "",
      },
    };
  },
  mounted() {

    // console.log(this.clients)
    // if (this.categories && this.categories.length > 0) {
    let formField = JSON.parse(this.category.search_form);
    if (formField && formField.length > 0) {
      formField.forEach((el) => {
        this.form[el.field.variable] = "";
      });
        // this.form['name'] = '';
    }

    if (this.requestData) {
      for (const [key, value] of Object.entries(this.requestData)) {
        if (this.form.hasOwnProperty(key)) {
          this.form[key] = value ?? "";
        }
      }
    }

    let self = this;
    $(".select2").select2();

    // Hotels Check In Date
    $(".date-range-picker").daterangepicker({
      singleDatePicker: true,
      autoApply: true,
      minDate: moment(),
      autoUpdateInput: false,
    });

    $(".date-range-picker").on("apply.daterangepicker", function (evt, picker) {
      $("#" + evt.target.id).val(picker.startDate.format("DD-MM-YYYY"));
      let varName = $(evt.target).data("field-name");
      self.form[varName] = $(evt.target).val();
    });

    $(".booking-search-form").on("change", function (evt) {
      let varName = $(evt.target).data("field-name");
      self.form[varName] = $(evt.target).val();
    });
    $("[data-toggle='tooltip']").tooltip({ container: "body" });
  },
  methods: {
    submit(category) {
      console.log(this.$data.form);
      this.$inertia.visit(route("search.list", category.slug), {
        preserveState: true,
        preserveScroll: true,
        only: ["clients"],
        method: "get",
        data: { category: category.slug, ...this.$data.form },
      });
    },
    getClientAddress(address) {
      return address ? address.address1 : "";
    },
    getClientDescription(description) {
      return description
        ? description.length < 80
          ? description
          : description.substring(0, 80) + "..."
        : "";
    },
    getLocationName() {
      let l = this.locations.find((el) => el.id == this.requestData.location);
      return l ? l.name : "";
    },
  },
};
</script>

<style scoped>
.select2-container--default .select2-selection--single {
  padding: 0.7rem 0.96rem;
  height: 30px;
  font-size: 1.2em;
  position: relative;
  outline: none;
  width: 100% !important;
}
</style>