<template>
  <div class="accordion" id="bookingAcordion">
    <div class="text-danger">{{ error }}</div>
    <div class="card card-default">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <a
            href="#"
            data-toggle="collapse"
            data-target="#collapseOne"
            aria-expanded="true"
            aria-controls="collapseOne"
            class="accordion-toggle"
            >Select Service(s)</a
          >
        </h5>
      </div>
      <div
        id="collapseOne"
        class="collapse show accordion-content"
        aria-labelledby="headingOne"
        data-parent="#bookingAcordion"
      >
        <div
          class="card-body"
          style="max-height: 200px; padding: 1.25rem; overflow-y: scroll"
        >
          <div class="d-flex flex-wrap justify-content-center mb-3">
            <div
              v-for="item in client.services"
              :key="item.id"
              data-toggle="tooltip"
              :data-original-title="item.name ?? ''"
              class="text-center service-item"
            >
              <input
                class="service_checkbox"
                type="checkbox"
                :id="item.id"
                :value="item"
                v-model="services"
              />
              <div class="border rounded service-item-inner">
                <i class="fas fa-wifi text-primary"></i>
              </div>
              <div style="font-size: 10px; line-height: 1.2">
                {{ item.name ?? "" }}
              </div>
            </div>
          </div>
        </div>
        <button
          class="btn btn-continue btn-service btn-primary btn-sm mt-2"
          v-bind:class="{ disabled: services.length < 1 }"
        >
          Continue
        </button>
      </div>
    </div>
    <div class="card card-default">
      <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
          <a
            href="#"
            class="collapsed disabled accordion-toggle"
            data-toggle="collapse"
            data-target="#collapseTwo"
            aria-expanded="false"
            aria-controls="collapseTwo"
            >Select Date</a
          >
        </h5>
      </div>
      <div
        id="collapseTwo"
        class="collapse accordion-content"
        aria-labelledby="headingTwo"
        data-parent="#bookingAcordion"
      >
        <div
          class="card-body"
          style="
            max-height: 300px;
            height: 280px;
            padding: 1.25rem;
            overflow-y: scroll;
          "
        >
          <div id="bookingDateWrapper"></div>
          <input
            type="hidden"
            name="daterange"
            id="bookingDate"
            v-model="bookingDate"
          />
        </div>
        <button
          class="btn btn-continue btn-date btn-primary btn-sm mt-2"
          v-bind:class="{ disabled: bookingDate == '' }"
        >
          Continue
        </button>
      </div>
    </div>
    <div class="card card-default">
      <div class="card-header" id="headingThree">
        <h5 class="mb-0">
          <a
            href="#"
            class="collapsed disabled accordion-toggle select-time"
            data-toggle="collapse"
            data-target="#collapseThree"
            aria-expanded="false"
            aria-controls="collapseThree"
            >Select Time Slot</a
          >
        </h5>
      </div>
      <div
        id="collapseThree"
        class="collapse accordion-content"
        aria-labelledby="headingThree"
        data-parent="#bookingAcordion"
      >
        <div
          class="card-body"
          style="
            max-height: 300px;
            height: 280px;
            padding: 1.25rem;
            overflow-y: scroll;
          "
        >
          <div id="bookingTimeWrapper">
            <input id="timeSlotSelect" type="hidden" />
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex align-items-center my-4">
      <div
        class="
          text-dark text-6
          line-height-1
          text-right
          w-100
          font-weight-500
          mr-2 mr-lg-3
        "
      >
        Total Fee - ${{ setServiceCharge }}
      </div>
      <!-- <div class="d-block text-4 text-black-50 mr-2 mr-lg-3">
                    <del class="d-block">$250</del>
                  </div> -->
      <!-- <div class="text-success text-3">16% Off!</div> -->
    </div>
    <button
      class="btn btn-primary btn-md btn-block"
      type="submit"
      @click.prevent="submit"
      v-bind:class="{
        disabled: bookingStartTime == '' && bookingEndTime == '',
      }"
    >
      Book Now
    </button>
  </div>
</template>

<script>
export default {
  props: {
    client: Object,
  },
  data() {
    return {
      clientId: this.client.id,
      services: [],
      bookingDate: moment(new Date()).format("YYYY-MM-DD"),
      bookingStartTime: "",
      bookingEndTime: "",
      error: "",
    };
  },
  mounted() {
    var self = this;

    // control accordian
    $("#bookingAcordion")
      .find(".accordion-toggle")
      .click(function (e) {
        var currentPanel = $(this).closest("div.card.card-default");
        var nextPanel = currentPanel.next();
        e.preventDefault();
        if (self.services.length < 1) {
          self.error = "Please select at least one service";
          return false;
        } else if (self.bookingDate == "") {
          self.error = "Please select a date";
          return false;
        } else {
          self.error = "";
        }
        if ($(this).hasClass("disabled")) {
          self.error = "Please Click the Continue";
          return false;
        } else {
          $(currentPanel).find(".accordion-content").collapse("toggle");
          self.error = "";
        }
      });

    // control accordion with buttons
    $(".btn.btn-continue").click(function (e) {
      e.preventDefault();
      var currentPanel = $(this).closest("div.card.card-default");
      var nextPanel = currentPanel.next();
      if (self.services.length < 1 && $(this).hasClass("btn-service")) {
        self.error = "Please select at least one service";
        return false;
      } else if (self.bookingDate == "" && $(this).hasClass("btn-date")) {
        self.error = "Please select a date";
        return false;
      } else {
        self.error = "";
      }

      if ($(nextPanel).find(".accordion-toggle").hasClass("disabled")) {
        $(nextPanel).find(".accordion-toggle").removeClass("disabled");
        $(nextPanel).find(".accordion-content").collapse("toggle");
      } else {
        $(nextPanel).find(".accordion-content").collapse("toggle");
      }
      return false;
    });

    // handle booking calander
    $("#bookingDate").daterangepicker({
      parentEl: "#bookingDateWrapper",
      singleDatePicker: true,
      timePickerIncrement: 15,
      drops: "down",
      opens: "center",
      startDate: new Date(),
      minDate: new Date(),
      autoUpdateInput: true,
      autoApply: true,
      alwaysShowCalendars: true,
      showCustomRangeLabel: false,
      startDate: "04/29/2022",
      endDate: "05/05/2022",
    });
    $("#bookingDate").trigger("click");
    $("#bookingDate").on("apply.daterangepicker", function (ev, picker) {
      self.bookingDate = picker.startDate.format("YYYY-MM-DD");
    });

    // time slot picker handler
    var picker = new AppointmentSlotPicker(
      document.getElementById("timeSlotSelect"),
      {
        static: true,
        title: "",
        interval: 15,
        mode: "24h",
        startTime: parseInt(this.getOpenHours.open),
        endTime: parseInt(this.getOpenHours.close) + 1,
        disabled: ["16:30", "17:00"],
      }
    );

    $(".appo-picker-list-item").on("click", function (e) {
      let sum = self.services
        .map((s) => s.service_time)
        .reduce(
          (previousValue, currentValue) =>
            parseInt(previousValue) + parseInt(currentValue)
        );
      let slotCount = sum / 15;

      $(".appo-picker-list-item input").removeClass("is-selected");

      if (slotCount == 1) {
        $(this).children().addClass("is-selected");
        self.bookingStartTime = $(this).children().val();
        self.bookingEndTime = $(this).children().val();
      } else {
        if (!$(this).next().hasClass("disabled")) {
          $(this).children().addClass("is-selected");
          let nextEl = $(this).next();
          for (let i = 0; i < slotCount; i++) {
            if (nextEl.hasClass("disabled")) {
              $(".appo-picker-list-item input").removeClass("is-selected");
              return false;
            }
            $(nextEl).children().addClass("is-selected");
            if (i < slotCount - 1) {
              nextEl = nextEl.next();
            }
          }
          self.bookingStartTime = $(this).children().val();
          self.bookingEndTime = $(nextEl).children().val();
          self.error = "";
        } else {
          $(".appo-picker-list-item input").removeClass("is-selected");
          self.error = "Please select valid time range";
        }
      }
    });
  },
  computed: {
    getOpenHours() {
      const weekday = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"];
      const d = new Date();
      let day = weekday[d.getDay()];
      let openHours =
        this.client.open_hours != null
          ? JSON.parse(this.client.open_hours)
          : {};
      let x = Object.entries(openHours).filter((i) => i[0] == day);
      if (x.length > 0) {
        return x[0][1];
      } else {
        return { open: "00.00", close: "00.00" };
      }
    },
    setServiceCharge() {
      return this.services
        .map((s) => s.service_charge)
        .reduce(
          (previousValue, currentValue) =>
            parseInt(previousValue) + parseInt(currentValue),
          0
        );
      // service_charge
    },
  },
  watch: {
    services() {
      this.bookingStartTime = "";
      this.bookingEndTime = "";
      $(".appo-picker-list-item input").removeClass("is-selected");
    },
  },
  methods: {
    submit() {
      if (this.services.length < 1) {
        this.error = "Please select at least one service";
        return false;
      } else if (this.bookingDate == "") {
        this.error = "Please select a date";
        return false;
      } else if (this.bookingStartTime == "" && this.bookingEndTime == "") {
        this.error = "Please select time";
        return false;
      } else {
        this.error = "";
      }

      this.$inertia.post(route("booking.confirm"), { ...this.$data });
      // console.log({...this.$data})
    },
  },
};
</script>

<style scoped>
.accordion .card-header a {
  padding: 0.5rem 1.25rem 0.5rem 2.25rem;
}
.service-item {
  position: relative;
  padding: 2px;
  width: 50px;
  height: 50px;
  line-height: 46px;
  margin: auto;
  margin-bottom: 6px;
  cursor: pointer;
}

.service_checkbox {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
  width: 100%;
  height: 100%;
  z-index: 999;
  cursor: pointer;
}
.service_checkbox:checked ~ .service-item-inner {
  border: 1px solid #2575fc !important;
}
#bookingDateWrapper {
  position: relative;
  top: 0;
  left: 0;
  right: 0;
  width: 100%;
}
.daterangepicker {
  position: relative !important;
}
</style>