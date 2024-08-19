<template>
  <!-- Side Panel
        ============================================= -->
  <aside class="col-lg-3">
    <div class="bg-white shadow-md rounded p-3">
      <h3 class="text-5">Filter</h3>
      <hr class="mx-n3" />
      <div
        class="accordion accordion-alternate style-2 mt-n3"
        id="toggleAlternate"
      >
        <div class="card">
          <div class="card-header" id="hotelName">
            <h5 class="mb-0">
              <a
                href="#"
                class="collapse"
                data-toggle="collapse"
                data-target="#togglehotelName"
                aria-expanded="true"
                aria-controls="togglehotelName"
                >Hotel Name</a
              >
            </h5>
          </div>
          <div
            id="togglehotelName"
            class="collapse show"
            aria-labelledby="hotelName"
          >
            <div class="card-body">
              <div class="form-row">
                <div class="col-md-12 col-lg form-group mb-0">
                  <input
                    type="text"
                    class="form-control form-control-sm"
                    id="SearchHotel"
                    placeholder="Search by Hotel Name"
                  />
                  <span class="icon-inside"><i class="fas fa-search"></i></span>
                </div>
              </div>
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
          <div id="togglePrice" class="collapse show" aria-labelledby="price">
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
                  <small class="text-muted float-right">250</small></label
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
                  <small class="text-muted float-right">76</small></label
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
                  >Villa <small class="text-muted float-right">31</small></label
                >
              </div>
              <div class="custom-control custom-checkbox">
                <input
                  type="checkbox"
                  id="heritage"
                  name="propertyTypes"
                  class="custom-control-input"
                />
                <label class="custom-control-label d-block" for="heritage"
                  >Heritage
                  <small class="text-muted float-right">12</small></label
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
                  >Motel <small class="text-muted float-right">5</small></label
                >
              </div>
              <div class="custom-control custom-checkbox">
                <input
                  type="checkbox"
                  id="guestHouse"
                  name="propertyTypes"
                  class="custom-control-input"
                />
                <label class="custom-control-label d-block" for="guestHouse"
                  >Guest House
                  <small class="text-muted float-right">107</small></label
                >
              </div>
              <div class="custom-control custom-checkbox">
                <input
                  type="checkbox"
                  id="farmHouse"
                  name="propertyTypes"
                  class="custom-control-input"
                />
                <label class="custom-control-label d-block" for="farmHouse"
                  >Farm House
                  <small class="text-muted float-right">66</small></label
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
                  <small class="text-muted float-right">18</small></label
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
                  <small class="text-muted float-right">41</small></label
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
                  <small class="text-muted float-right">512</small></label
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
                  ><small class="text-muted float-right">476</small></label
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
                  <small class="text-muted float-right">176</small></label
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
                  <small class="text-muted float-right">231</small></label
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
                <label class="custom-control-label d-block" for="excellent"
                  >Excellent
                  <small class="text-muted float-right">499</small></label
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
                  >Good <small class="text-muted float-right">310</small></label
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
                  >Fair <small class="text-muted float-right">225</small></label
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
                  >Poor <small class="text-muted float-right">110</small></label
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
                  >Bad <small class="text-muted float-right">44</small></label
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
                <label class="custom-control-label d-block" for="internetWiFi"
                  ><i class="fas fa-wifi"></i> Internet/Wi-Fi
                  <small class="text-muted float-right">512</small></label
                >
              </div>
              <div class="custom-control custom-checkbox">
                <input
                  type="checkbox"
                  id="restaurant"
                  name="amenities"
                  class="custom-control-input"
                />
                <label class="custom-control-label d-block" for="restaurant"
                  ><i class="fas fa-utensils"></i> Restaurant
                  <small class="text-muted float-right">476</small></label
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
                  <small class="text-muted float-right">176</small></label
                >
              </div>
              <div class="custom-control custom-checkbox">
                <input
                  type="checkbox"
                  id="swimmingPool"
                  name="amenities"
                  class="custom-control-input"
                />
                <label class="custom-control-label d-block" for="swimmingPool"
                  ><i class="fas fa-swimmer"></i> Swimming Pool
                  <small class="text-muted float-right">231</small></label
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
                  ><i class="fas fa-chalkboard-teacher"></i> Business Facilities
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
                <label class="custom-control-label d-block" for="spaWellness"
                  ><i class="fas fa-spa"></i> Spa/Wellness
                  <small class="text-muted float-right">107</small></label
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
                  <small class="text-muted float-right">66</small></label
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </aside>
  <!-- Side Panel end -->
</template>

<script>
export default {};
</script>

<style>
</style>