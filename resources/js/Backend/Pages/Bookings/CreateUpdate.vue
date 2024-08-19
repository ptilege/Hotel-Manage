<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card" style="background: none; box-shadow: none">
          <div class="card-body">
            <div class="row invoice-preview">
              <!-- Invoice -->
              <div
                class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4"
                id="invoice-preview"
              >
                <div class="card invoice-preview-card">
                  <div class="card-body">
                    <div
                      class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0"
                    >
                      <div class="mb-xl-0 mb-4">
                        <div class="d-flex svg-illustration mb-3 gap-2">
                          <span class="app-brand-logo demo">
                            <img
                              src="/images/logo-dark.png"
                              width="165"
                              alt=""
                            />
                          </span>
                        </div>
                        <p class="mb-1">Office 149, 450 South Brand Brooklyn</p>
                        <p class="mb-1">San Diego County, CA 91905, USA</p>
                        <p class="mb-0">
                          +1 (123) 456 7891, +44 (876) 543 2198
                        </p>
                      </div>
                      <div>
                        <h4>Invoice #INV-{{ booking.id }}</h4>
                        <div class="mb-2">
                          <span class="me-1">Date Issues:</span>
                          <span class="fw-semibold">{{
                            booking.created_at
                          }}</span>
                        </div>
                        <!-- <div>
                        <span class="me-1">Date Due:</span>
                        <span class="fw-semibold">29/08/2020</span>
                      </div> -->
                      </div>
                    </div>
                  </div>
                  <hr class="my-0" />
                  <div class="card-body">
                    <div class="row p-sm-3 p-0">
                      <div class="col-xl-6 col-md-6 col-sm-12 col-12">
                        <h6 class="pb-2">Customer Details:</h6>
                        <table>
                          <tbody>
                            <tr>
                              <td class="pe-3">Name:</td>
                              <td>
                                {{ booking.first_name }} {{ booking.last_name }}
                              </td>
                            </tr>
                            <tr>
                              <td class="pe-3">Email:</td>
                              <td>{{ booking.email }}</td>
                            </tr>
                            <tr>
                              <td class="pe-3">Contact No.:</td>
                              <td>{{ booking.mobile }}</td>
                            </tr>
                            <tr>
                              <td class="pe-3">NIC/Passport No.:</td>
                              <td>{{ booking.nic }}</td>
                            </tr>
                            <tr>
                              <td class="pe-3">Address:</td>
                              <td>
                                {{ booking.address }}, {{ booking.city }},
                                {{ booking.country }}
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-xl-6 col-md-6 col-sm-12 col-12">
                        <table class="table border">
                          <tbody>
                            <tr>
                              <td class="pe-3">
                                <div class="text-center">
                                  <div style="font-size: 14px">Check In</div>
                                  <div
                                    style="font-weight: 600; font-size: 15px"
                                  >
                                    {{
                                      new Date(
                                        booking.checkin_date
                                      ).toLocaleDateString("en-GB", {
                                        day: "2-digit",
                                        month: "short",
                                        year: "numeric",
                                      })
                                    }}
                                  </div>
                                </div>
                              </td>
                              <td class="pe-3">
                                <div class="text-center">
                                  <div style="font-size: 14px">Check Out</div>
                                  <div
                                    style="font-weight: 600; font-size: 15px"
                                  >
                                    {{
                                      new Date(
                                        booking.checkout_date
                                      ).toLocaleDateString("en-GB", {
                                        day: "2-digit",
                                        month: "short",
                                        year: "numeric",
                                      })
                                    }}
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td
                                colspan="2"
                                class="text-center"
                                style="font-weight: 600; font-size: 15px"
                              >
                                {{
                                  Math.ceil(
                                    new Date(booking.checkout_date).getDate() -
                                      new Date(booking.checkin_date).getDate()
                                  )
                                }}
                                Night(s)
                              </td>
                            </tr>
                            <tr>
                              <td class="pe-3">
                                <div>Payment Method : <b>Visa/Master</b></div>
                                <div>
                                  Payment Status :
                                  <span class="badge bg-success">Success</span>
                                </div>
                              </td>
                              <td>
                                <div>
                                  Booking Status :
                                  <span class="badge bg-success">Success</span>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive px-4">
                    <table class="table border-top m-0">
                      <thead>
                        <tr>
                          <th class="text-center">Room</th>
                          <th class="text-center">Bed Type</th>
                          <th class="text-center">Meal Type</th>
                          <th class="text-center">Extra Child</th>
                          <th class="text-center">Extra Adults</th>
                          <th class="text-center">Qty</th>
                          <th class="text-center">Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="item in booking.items" :key="item.id">
                          <td class="text-nowrap text-center">
                            {{ item.room ? item.room.name : "" }}
                          </td>
                          <td class="text-nowrap text-center">
                            {{ item.bed_type ? item.bed_type.name : "" }}
                          </td>
                          <td class="text-center">
                            {{ item.meal_type ? item.meal_type.name : "" }}
                          </td>
                          <td class="text-center">{{ item.extra_child }}</td>
                          <td class="text-center">{{ item.extra_beds }}</td>
                          <td class="text-center">{{ item.qty }}</td>
                          <td class="text-end">
                            {{
                              Number(
                                item.partial_amount
                                  ? item.partial_amount
                                  : item.total_amount
                              ).toLocaleString("en-US", {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2,
                              })
                            }}
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5" class="align-top px-4 py-5">
                            <p class="mb-2">
                              <span class="me-1 fw-semibold">Salesperson:</span>
                              <span>Alfie Solomons</span>
                            </p>
                            <span>Thanks for your business</span>
                          </td>
                          <td class="text-end px-4 py-5">
                            <p class="mb-2">Subtotal:</p>
                            <p class="mb-2">Discount:</p>
                            <p class="mb-2">Tax:</p>
                            <p class="mb-0">Total:</p>
                          </td>
                          <td class="px-4 py-5 text-end">
                            <p class="fw-semibold mb-2">$154.25</p>
                            <p class="fw-semibold mb-2">$00.00</p>
                            <p class="fw-semibold mb-2">$50.00</p>
                            <p class="fw-semibold mb-0">$204.25</p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <!-- <span class="fw-semibold">Note:</span> -->
                        <!-- <span
                          >It was a pleasure working with you and your team. We
                          hope you will keep us in mind for future freelance
                          projects. Thank You!</span
                        > -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Invoice -->

              <!-- Invoice Actions -->
              <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                <div class="card">
                  <div class="card-body">
                    <!-- <button
                      class="btn btn-primary d-grid w-100 mb-3"
                      data-bs-toggle="offcanvas"
                      data-bs-target="#sendInvoiceOffcanvas"
                    >
                      <span
                        class="d-flex align-items-center justify-content-center text-nowrap"
                        ><i class="bx bx-paper-plane bx-xs me-1"></i>Send
                        Invoice</span
                      >
                    </button> -->
                    <!-- <button class="btn btn-label-secondary d-grid w-100 mb-3">
                      Download
                    </button> -->
                    <a
                      class="btn btn-label-secondary d-grid w-100 mb-3"
                      id="print"
                    >
                      Print
                    </a>
                    <!-- <a
                      href="./app-invoice-edit.html"
                      class="btn btn-label-secondary d-grid w-100 mb-3"
                    >
                      Edit Invoice
                    </a> -->
                    <!-- <button
                      class="btn btn-primary d-grid w-100"
                      data-bs-toggle="offcanvas"
                      data-bs-target="#addPaymentOffcanvas"
                    >
                      <span
                        class="d-flex align-items-center justify-content-center text-nowrap"
                        ><i class="bx bx-dollar bx-xs me-1"></i>Add
                        Payment</span
                      >
                    </button> -->
                  </div>
                </div>
              </div>
              <!-- /Invoice Actions -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
<script>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout";
import FileInputComponent from "@/Components/FileInputComponent.vue";
import InputComponent from "@/Components/InputComponent.vue";
import SelectInputComponent from "@/Components/SelectInputComponent.vue";
import { jsPDF } from "jspdf";
export default {
  components: {
    Link,
    AppLayout,
    InputComponent,
    FileInputComponent,
    SelectInputComponent,
  },
  props: {
    errors: Object,
    booking: Object,
  },
  data() {
    return {
      form: useForm({ checkin_date: "", checkout_date: "", status: "" }),
    };
  },
  mounted() {
    let self = this;
    if (this.booking) {
      this.form.checkin_date = this.booking.checkin_date;
      this.form.checkout_date = this.booking.checkout_date;
      this.form.status = this.booking.status;
    }

    $("#print").on("click", function () {
      const pdf = new jsPDF({
        orientation: "p",
        unit: "mm",
        format: "a4",
        putOnlyUsedFonts: true,
      });
      pdf.viewerPreferences({ FitWindow: true }, true);
      const element = document.getElementById("invoice-preview");

      pdf.html(element, {
        callback: function (pdf) {
          pdf.save("output.pdf");
        },
        x: 10,
        y: 10,
        width: 254,
        windowWidth: 1220,
        autoPaging: 'text',
      });
    });
  },
  methods: {
    submit() {
      this.form.post(
        this.booking ? route("booking.update") : route("booking.store"),
        {
          onSuccess: () => {
            this.form.reset();
            this.$root.showMessage(
              "success",
              '<span class="text-success">Success</span><br/>',
              "A Record Was Created Successfully! "
            );
          },
          onError: () => {
            this.form.reset("add field names here");
            this.$root.showMessage(
              "error",
              '<span class="text-danger">Error</span><br>',
              "Something went wrong! "
            );
          },
        }
      );
    },
    printDiv() {},
  },
};
</script>
