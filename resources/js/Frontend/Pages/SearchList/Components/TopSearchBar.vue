<template>
  <div class="row">
    <div class="col mb-2">
      <form id="bookingHotels" method="post">
        <div class="form-row">
          <div class="col-md-12 col-lg form-group">
            <input
              type="text"
              class="form-control"
              id="hotelsFrom"
              required=""
              placeholder="Enter City/Hotel"
            />
            <span class="icon-inside"
              ><i class="fas fa-map-marker-alt"></i
            ></span>
          </div>
          <div class="col-md-6 col-lg form-group">
            <input
              id="hotelsCheckIn"
              type="text"
              class="form-control"
              required=""
              placeholder="Check In"
            />
            <span class="icon-inside"><i class="far fa-calendar-alt"></i></span>
          </div>
          <div class="col-md-6 col-lg form-group">
            <input
              id="hotelsCheckOut"
              type="text"
              class="form-control"
              required=""
              placeholder="Check Out"
            />
            <span class="icon-inside"><i class="far fa-calendar-alt"></i></span>
          </div>
          <div class="col-md-6 col-lg travellers-class form-group">
            <input
              type="text"
              id="hotelsTravellersClass"
              class="travellers-class-input form-control"
              name="hotels-travellers-class"
              placeholder="Rooms / People"
              required=""
              onkeypress="return false;"
            />
            <span class="icon-inside"><i class="fas fa-caret-down"></i></span>
            <div class="travellers-dropdown">
              <div class="row align-items-center">
                <div class="col-sm-7">
                  <p class="mb-sm-0">Rooms</p>
                </div>
                <div class="col-sm-5">
                  <div class="qty input-group">
                    <div class="input-group-prepend">
                      <button
                        type="button"
                        class="btn bg-light-4"
                        data-value="decrease"
                        data-target="#hotels-rooms"
                        data-toggle="spinner"
                      >
                        -
                      </button>
                    </div>
                    <input
                      type="text"
                      data-ride="spinner"
                      id="hotels-rooms"
                      class="qty-spinner form-control"
                      value="1"
                      readonly=""
                    />
                    <div class="input-group-append">
                      <button
                        type="button"
                        class="btn bg-light-4"
                        data-value="increase"
                        data-target="#hotels-rooms"
                        data-toggle="spinner"
                      >
                        +
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="mt-2 mb-4" />
              <div class="row align-items-center">
                <div class="col-sm-7">
                  <p class="mb-sm-0">
                    Adults <small class="text-muted">(12+ yrs)</small>
                  </p>
                </div>
                <div class="col-sm-5">
                  <div class="qty input-group">
                    <div class="input-group-prepend">
                      <button
                        type="button"
                        class="btn bg-light-4"
                        data-value="decrease"
                        data-target="#adult-travellers"
                        data-toggle="spinner"
                      >
                        -
                      </button>
                    </div>
                    <input
                      type="text"
                      data-ride="spinner"
                      id="adult-travellers"
                      class="qty-spinner form-control"
                      value="1"
                      readonly=""
                    />
                    <div class="input-group-append">
                      <button
                        type="button"
                        class="btn bg-light-4"
                        data-value="increase"
                        data-target="#adult-travellers"
                        data-toggle="spinner"
                      >
                        +
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="my-2" />
              <div class="row align-items-center">
                <div class="col-sm-7">
                  <p class="mb-sm-0">
                    Children <small class="text-muted">(1-12 yrs)</small>
                  </p>
                </div>
                <div class="col-sm-5">
                  <div class="qty input-group">
                    <div class="input-group-prepend">
                      <button
                        type="button"
                        class="btn bg-light-4"
                        data-value="decrease"
                        data-target="#children-travellers"
                        data-toggle="spinner"
                      >
                        -
                      </button>
                    </div>
                    <input
                      type="text"
                      data-ride="spinner"
                      id="children-travellers"
                      class="qty-spinner form-control"
                      value="0"
                      readonly=""
                    />
                    <div class="input-group-append">
                      <button
                        type="button"
                        class="btn bg-light-4"
                        data-value="increase"
                        data-target="#children-travellers"
                        data-toggle="spinner"
                      >
                        +
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <button
                class="btn btn-primary btn-block submit-done mt-3"
                type="button"
              >
                Done
              </button>
            </div>
          </div>
          <div class="col-md-6 col-lg form-group">
            <button class="btn btn-primary btn-block" type="submit">
              Search
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>