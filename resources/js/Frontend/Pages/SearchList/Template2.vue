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
            <div class="bg-white shadow-md rounded py-4">
              <div class="mx-3 mb-3 text-center">
                <h2 class="text-6 mb-4">
                  Mumbai <small class="mx-2">to</small>Surat
                </h2>
              </div>
              <!-- list header -->
              <div
                class="
                  text-1
                  bg-light-3
                  border border-right-0 border-left-0
                  py-2
                  px-3
                "
              >
                <div class="row">
                  <div class="col col-sm-3">
                    <span class="d-none d-sm-block">Operators</span>
                  </div>
                  <div class="col col-sm-2 text-center">Departure</div>
                  <div class="col-sm-2 text-center d-none d-sm-block">
                    Duration
                  </div>
                  <div class="col col-sm-2 text-center">Arrival</div>
                  <div class="col col-sm-3 text-center d-none d-sm-block">
                    Price
                  </div>
                </div>
              </div>
              <!-- list header -->
              <div class="bus-list">
                <div class="bus-item" v-for="client in clients" :key="client.id">
                  <div class="row align-items-sm-center flex-row py-4 px-3">
                    <div class="col col-sm-3">
                      <span class="text-3 text-dark text-capitalize operator-name"
                        >{{client.name}}</span
                      >
                      <span class="text-1 text-muted d-block">AC Sleeper</span>
                    </div>
                    <div class="col col-sm-2 text-center time-info">
                      <span class="text-4 text-dark">12:00</span>
                      <small class="text-muted d-block">Mumbai</small>
                    </div>
                    <div
                      class="
                        col col-sm-2
                        text-center
                        d-none d-sm-block
                        time-info
                      "
                    >
                      <span class="text-3 duration">06h 32m</span>
                      <small class="text-muted d-block">12 Stops</small>
                    </div>
                    <div class="col col-sm-2 text-center time-info">
                      <span class="text-4 text-dark">05:15</span>
                      <small class="text-muted d-block">Surat</small>
                    </div>
                    <div
                      class="
                        col-12 col-sm-3
                        align-self-center
                        text-right text-sm-center
                        mt-2 mt-sm-0
                      "
                    >
                      <div
                        class="
                          d-inline-block d-sm-block
                          text-dark text-5
                          price
                          mb-sm-1
                        "
                      >
                        $250
                      </div>
                      <a
                        href="#"
                        class="btn btn-sm btn-outline-primary shadow-none"
                        data-toggle="modal"
                        data-target="#select-busseats"
                        ><i
                          class="fas fa-ellipsis-h d-none d-sm-block d-lg-none"
                          data-toggle="tooltip"
                          title="Select Seats"
                        ></i>
                        <span class="d-block d-sm-none d-lg-block"
                          >Select Seats</span
                        ></a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
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
      console.log(formField);
      formField.forEach((el) => {
        if (typeof el.field.variable == "object") {
          console.log(el.field.variable);
          el.field.variable.forEach((i) => {
            this.form[i] = "";
          });
        } else {
          this.form[el.field.variable] = "";
        }
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

<style>
.select2-container--default .select2-selection--single {
  padding: 0.7rem 0.96rem;
  height: 30px;
  font-size: 1.2em;
  position: relative;
  outline: none;
  width: 100% !important;
}
</style>