<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="row">
                <!-- Total Income Container -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div
                            class="card-header d-flex align-items-center justify-content-between"
                        >
                            <h6 class="card-title m-0 me-2">Income</h6>
                            <div class="dropdown">
                                <button
                                    class="btn btn-sm p-0"
                                    type="button"
                                    id="referralsList"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    All <i class="bx bx-chevron-down"></i>
                                </button>
                                <div
                                    class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="referralsList2"
                                >
                                    <a
                                        class="dropdown-item incomeDropdown"
                                        href="javascript:void(0);"
                                        data-value="All"
                                        >All</a
                                    >
                                    <a
                                        class="dropdown-item incomeDropdown"
                                        href="javascript:void(0);"
                                        data-value="Last Week"
                                        >Last Week</a
                                    >
                                    <a
                                        class="dropdown-item incomeDropdown"
                                        href="javascript:void(0);"
                                        data-value="Last Month"
                                        >Last Month</a
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div
                                class="avatar avatar-md border-5 border-light-info rounded-circle mx-auto mb-4"
                            >
                                <span
                                    class="avatar-initial rounded-circle bg-label-info"
                                    ><i class="bx bx-money bx-sm"></i
                                ></span>
                            </div>
                            <!-- <h3 class="card-title mb-1 me-2">{{ this.$root.formatPrice(totalIncome,
                            $page.props.configs.app_currency ?? '') }}</h3> -->
                            <h3 id="allIncomes" class="card-title mb-1 me-2">
                                {{ income.AllIncome }}
                            </h3>
                            <h3
                                id="lastWeekIncomes"
                                class="card-title mb-1 me-2 d-none"
                            >
                                {{ income.IncomeLastWeek }}
                            </h3>
                            <h3
                                id="lastMonthIncomes"
                                class="card-title mb-1 me-2 d-none"
                            >
                                {{ income.IncomeLastMonth }}
                            </h3>
                            <small class="d-block mb-2">Income</small>
                        </div>
                    </div>
                </div>
                <!-- Total Active Properties Container -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div
                            class="card-header d-flex align-items-center justify-content-between"
                        >
                            <h6 class="card-title m-0 me-2">Properties</h6>
                            <div class="dropdown">
                                <button
                                    class="btn btn-sm p-0"
                                    type="button"
                                    id="referralsList"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    All <i class="bx bx-chevron-down"></i>
                                </button>
                                <div
                                    class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="referralsList2"
                                >
                                    <a
                                        class="dropdown-item propertiesDropdown"
                                        href="javascript:void(0);"
                                        data-value="All"
                                        >All</a
                                    >
                                    <a
                                        class="dropdown-item propertiesDropdown"
                                        href="javascript:void(0);"
                                        data-value="Last Week"
                                        >Last Week</a
                                    >
                                    <a
                                        class="dropdown-item propertiesDropdown"
                                        href="javascript:void(0);"
                                        data-value="Last Month"
                                        >Last Month</a
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div
                                class="avatar avatar-md border-5 border-light-success rounded-circle mx-auto mb-4"
                            >
                                <span
                                    class="avatar-initial rounded-circle bg-label-success"
                                    ><i class="bx bx-buildings bx-sm"></i
                                ></span>
                            </div>
                            <h3 id="allProperties" class="card-title mb-1 me-2">
                                {{ counts.AllPropertiesCount }}
                            </h3>
                            <h3
                                id="lastWeekProperties"
                                class="card-title mb-1 me-2 d-none"
                            >
                                {{ counts.PropertiesCountLastWeek }}
                            </h3>
                            <h3
                                id="lastMonthProperties"
                                class="card-title mb-1 me-2 d-none"
                            >
                                {{ counts.PropertiesCountLastMonth }}
                            </h3>
                            <small class="d-block mb-2"
                                >Active Properties</small
                            >
                        </div>
                    </div>
                </div>
                <!-- Total Bookings Container -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div
                            class="card-header d-flex align-items-center justify-content-between"
                        >
                            <h6 class="card-title m-0 me-2">Bookings</h6>
                            <div class="dropdown">
                                <button
                                    class="btn btn-sm p-0"
                                    type="button"
                                    id="referralsList"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    All <i class="bx bx-chevron-down"></i>
                                </button>
                                <div
                                    class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="referralsList4"
                                >
                                    <a
                                        class="dropdown-item bookingDropdown"
                                        href="javascript:void(0);"
                                        data-value="All"
                                        >All</a
                                    >
                                    <a
                                        class="dropdown-item bookingDropdown"
                                        href="javascript:void(0);"
                                        data-value="Last Week"
                                        >Last Week</a
                                    >
                                    <a
                                        class="dropdown-item bookingDropdown"
                                        href="javascript:void(0);"
                                        data-value="Last Month"
                                        >Last Month</a
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <div
                                class="avatar avatar-md border-5 border-light-warning rounded-circle mx-auto mb-4"
                            >
                                <span
                                    class="avatar-initial rounded-circle bg-label-warning"
                                    ><i class="bx bx-archive bx-sm"></i
                                ></span>
                            </div>
                            <h3 id="allBooking" class="card-title mb-1 me-2">
                                {{ counts.BookingsCount }}
                            </h3>
                            <h3
                                id="lastWeekBooking"
                                class="card-title mb-1 me-2 d-none"
                            >
                                {{ counts.BookingsLastWeekCount }}
                            </h3>
                            <h3
                                id="lastMonthBooking"
                                class="card-title mb-1 me-2 d-none"
                            >
                                {{ counts.BookingsLastMonthCount }}
                            </h3>
                            <small class="d-block mb-2">Bookings</small>
                        </div>
                    </div>
                </div>
                <!-- Total Active patners Container -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title m-0 me-2">Property Types</h6>
                            <div class="dropdown pt-2 pb-3">
                                <button
                                    type="button"
                                    class="btn btn-sm p-0"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    {{
                                        selectedPropertyType === ""
                                            ? "Select Property Type"
                                            : propertytype.find(
                                                  (type) =>
                                                      type.id ===
                                                      selectedPropertyType
                                              )?.name || "Select Property Type"
                                    }}
                                    <i class="bx bx-chevron-down"></i>
                                </button>
                                <div
                                    class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="propertyTypeDropdown"
                                >
                                    <a
                                        v-for="type in propertytype"
                                        :key="type.id"
                                        class="dropdown-item"
                                        href="javascript:void(0);"
                                        @click="
                                            selectPropertyType(
                                                type.id,
                                                type.active_properties,
                                                type.inactive_properties,
                                                type.name,
                                                type.status
                                            )
                                        "
                                        >{{ type.name }}</a
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="card-title mb-1">
                                        {{ selectedactivePropertiesCount }}
                                    </h3>
                                    <small class="d-block mb-2 text-success"
                                        >Active</small
                                    >
                                    <!-- <small class="d-block mb-2 text-success" v-if="selectedPropertyTypeStatus === 1">Active</small> -->
                                    <!-- <small class="d-block mb-2 text-danger" v-else>Deactive</small> -->
                                </div>
                                <div class="col-6">
                                    <h3 class="card-title mb-1">
                                        {{ selectedinactivePropertiesCount }}
                                    </h3>
                                    <small class="d-block mb-2 text-danger"
                                        >Inactive</small
                                    >
                                    <!-- <small class="d-block mb-2 text-danger" v-if="selectedPropertyTypeStatus === 0">InActive</small>
                    <small class="d-block mb-2 text-danger" v-else>Deactive</small> -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <small class="d-block mb-2">{{
                                        selectedPropertyTypeName
                                    }}</small>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="card-header d-flex align-items-center justify-content-between">
                        <h6 class="card-title m-0 me-2">Partners</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm p-0" type="button" id="referralsList" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            All <i class="bx bx-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="referralsList2">
                            <a class="dropdown-item patnersDropdown" href="javascript:void(0);" data-value="All">All</a>
                            <a class="dropdown-item patnersDropdown" href="javascript:void(0);" data-value="Last Week">Last Week</a>
                            <a class="dropdown-item patnersDropdown" href="javascript:void(0);" data-value="Last Month">Last Month</a>
                            </div>
                        </div>
                        </div>
                        <div class="card-body text-center">
                        <div class="avatar avatar-md border-5 border-light-success rounded-circle mx-auto mb-4">
                            <span class="avatar-initial rounded-circle bg-label-success"><i class='bx bx-user bx-sm'></i></span>
                        </div>
                        <h3 id="allPatners" class="card-title mb-1 me-2">{{ counts.PartnerCount }}</h3>
                        <h3 id="lastWeekPatners" class="card-title mb-1 me-2 d-none">{{ counts.PartnerLastWeekCount }}</h3>
                        <h3 id="lastMonthPatners" class="card-title mb-1 me-2 d-none">{{ counts.PartnerLastMonthCount }}</h3>
                    
                        <small class="d-block mb-2">Partners</small>

                        </div> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 col-xl-4 mb-4">
                    <div class="card">
                        <div
                            class="card-header d-flex justify-content-between mb-3"
                        >
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Top Booking Properties</h5>
                                <small class="text-muted"
                                    >Top Booking Properties Overview</small
                                >
                            </div>
                            <!-- <div class="dropdown">
                        <button class="btn p-0" type="button" id="salesByCountry" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesByCountry">
                        <a class="dropdown-item" href="javascript:void(0);">View All</a>
                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div> -->
                        </div>
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                <li
                                    class="d-flex mb-4 pb-1"
                                    v-for="item in topProperties"
                                    :key="item.name"
                                >
                                    <div
                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2"
                                    >
                                        <div class="me-2">
                                            <small class="text-muted"
                                                >Property</small
                                            >
                                            <h6
                                                class="mb-0"
                                                style="width: 160px"
                                            >
                                                {{ item.name }}
                                            </h6>
                                        </div>
                                        <div class="user-progress">
                                            <small class="text-muted"
                                                >Bookings</small
                                            >
                                            <h6 class="mb-0">
                                                {{ item.booking_count }}
                                            </h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-8 mb-md-0 mb-4">
                    <div class="card" style="overflow: auto">
                        <div
                            class="card-header d-flex align-items-center justify-content-between"
                        >
                            <h5 class="card-title m-0 me-2">Properties</h5>
                            <div class="dropdown">
                                <button
                                    class="btn p-0"
                                    type="button"
                                    id="teamMemberList"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div
                                    class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="teamMemberList"
                                >
                                    <Link
                                        class="dropdown-item"
                                        :href="route('properties.index')"
                                        >View All</Link
                                    >
                                    <!-- <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>PROPERTY NAME</th>
                                        <th>STATUS</th>
                                        <!-- <th>Task</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="property in propertyDetails"
                                        :key="property.name"
                                    >
                                        <td>
                                            <div
                                                class="d-flex justify-content-start align-items-center"
                                            >
                                                <div class="avatar me-2">
                                                    <span
                                                        class="avatar-initial rounded-circle bg-label-warning"
                                                    >
                                                        <!-- <i class='bx bx-user bx-sm'></i> -->
                                                        <!-- <img :src="property.image_path" alt="" style="border-radius: 50%;"> -->
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6
                                                        class="mb-0 text-truncate"
                                                    >
                                                        {{ property.name }}
                                                    </h6>
                                                    <small
                                                        class="text-truncate text-muted"
                                                        >Address:
                                                        {{ property.address_1 }}
                                                    </small>
                                                    <!-- <small class="text-muted">Subscription Plan</small>
                                    <h6 class="mb-0">test</h6>  -->
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-label-success rounded-pill text-uppercase"
                                                v-if="property.status == 1"
                                                style="font-size: 8px"
                                                >ACTIVE</span
                                            >
                                            <span
                                                class="badge bg-label-danger rounded-pill text-uppercase"
                                                v-else
                                                >INACTIVE</span
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-12 mb-md-0 mb-4">
                    <div class="card" style="height: 650px; overflow: auto">
                        <div
                            class="card-header d-flex align-items-center justify-content-between"
                        >
                            <h5 class="card-title m-0 me-2">Bookings</h5>
                            <div class="dropdown">
                                <button
                                    class="btn p-0"
                                    type="button"
                                    id="teamMemberList"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div
                                    class="dropdown-menu dropdown-menu-end"
                                    aria-labelledby="teamMemberList"
                                >
                                    <Link
                                        class="dropdown-item"
                                        :href="route('booking.index')"
                                        >View All</Link
                                    >
                                    <!-- <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>CUSTOMER NAME</th>
                                        <th>CUSTOMER ADDRESS</th>
                                        <th>TOTAL AMOUNT</th>
                                        <th>STATUS</th>
                                        <!-- <th>Task</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="booking in bookingDetails"
                                        :key="booking.name"
                                    >
                                        <td>
                                            <div
                                                class="d-flex justify-content-start align-items-center"
                                            >
                                                <div class="d-flex flex-column">
                                                    <h6
                                                        class="mb-0 text-truncate"
                                                    >
                                                        {{
                                                            booking.first_name
                                                        }}
                                                        {{ booking.last_name }}
                                                    </h6>
                                                    <small
                                                        class="text-truncate text-muted"
                                                        >Email:
                                                        {{ booking.email }}
                                                    </small>
                                                    <!-- <small class="text-muted">Subscription Plan</small>
                                    <h6 class="mb-0">test</h6>  -->
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="d-flex justify-content-start align-items-center"
                                            >
                                                <div class="d-flex flex-column">
                                                    <h6
                                                        class="mb-0 text-truncate"
                                                    >
                                                        {{ booking.address }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="d-flex justify-content-start align-items-center"
                                            >
                                                <div class="d-flex flex-column">
                                                    <h6
                                                        class="mb-0 text-truncate"
                                                    >
                                                        {{
                                                            booking.total_amount
                                                        }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-label-success rounded-pill text-uppercase"
                                                v-if="
                                                    booking.status == 'confirm'
                                                "
                                                style="font-size: 8px"
                                                >Confirm</span
                                            >
                                            <span
                                                class="badge bg-label-info rounded-pill text-uppercase"
                                                v-if="
                                                    booking.status == 'pending'
                                                "
                                                >Pending</span
                                            >
                                            <span
                                                class="badge bg-label-danger rounded-pill text-uppercase"
                                                v-if="
                                                    booking.status == 'cancel'
                                                "
                                                >Cancel</span
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </AppLayout>
</template>
<script>
import { Link, useForm } from "@inertiajs/inertia-vue3";

import DataTable from "@/Components/DataTable";

export default {
    data() {
        return {
            propertytype: [], // Set this array to the data received from Laravel
            selectedPropertyType:
                this.propertytype.length > 0 ? this.propertytype[0].id : "",
            selectedpropertyTypeCount:
                this.propertytype.length > 0
                    ? this.propertytype[0].property_count
                    : "",
            selectedPropertyTypeName:
                this.propertytype.length > 0 ? this.propertytype[0].name : "",
            selectedPropertyTypeStatus:
                this.propertytype.length > 0 ? this.propertytype[0].status : "",
            selectedactivePropertiesCount:
                this.propertytype.length > 0
                    ? this.propertytype[0].active_properties
                    : "",
            selectedinactivePropertiesCount:
                this.propertytype.length > 0
                    ? this.propertytype[0].inactive_properties
                    : "",
        };
    },
    components: {
        Link,
        DataTable,
    },
    props: {
        counts: Object,
        income: Object,
        topProperties: Array,
        propertyDetails: Object,
        propertytype: Array,

        bookingDetails: Object,
    },

    methods: {
        selectPropertyType(
            propertyTypeId,
            activePropertiesCount,
            inactivePropertiesCount,
            propertyTypeName,
            propertyTypeStatus
        ) {
            this.selectedPropertyType = propertyTypeId;
            this.selectedactivePropertiesCount = activePropertiesCount;
            this.selectedinactivePropertiesCount = inactivePropertiesCount;
            this.selectedPropertyTypeName = propertyTypeName;
            this.selectedPropertyTypeStatus = propertyTypeStatus;
        },
    },
    mounted() {
        // Income Dropdown
        $(document).ready(function () {
            $(".incomeDropdown").on("click", function () {
                var selectedValue = $(this).data("value");
                console.log(selectedValue);
                if (selectedValue == "Last Week") {
                    $("#lastWeekIncomes").removeClass("d-none");
                    $("#lastMonthIncomes").addClass("d-none");
                    $("#allIncomes").addClass("d-none");
                } else if (selectedValue == "Last Month") {
                    $("#lastMonthIncomes").removeClass("d-none");
                    $("#lastWeekIncomes").addClass("d-none");
                    $("#allIncomes").addClass("d-none");
                } else {
                    $("#allIncomes").removeClass("d-none");
                    $("#lastMonthIncomes").addClass("d-none");
                    $("#lastWeekIncomes").addClass("d-none");
                }
                var dropdownButton = $(this).closest(".dropdown").find(".btn");
                dropdownButton.html(
                    selectedValue + ' <i class="bx bx-chevron-down"></i>'
                );
            });
        });
        // Booking Dropdown
        $(document).ready(function () {
            $(".bookingDropdown").on("click", function () {
                var selectedValue = $(this).data("value");
                console.log(selectedValue);
                if (selectedValue == "Last Week") {
                    $("#lastWeekBooking").removeClass("d-none");
                    $("#lastMonthBooking").addClass("d-none");
                    $("#allBooking").addClass("d-none");
                } else if (selectedValue == "Last Month") {
                    $("#lastMonthBooking").removeClass("d-none");
                    $("#lastWeekBooking").addClass("d-none");
                    $("#allBooking").addClass("d-none");
                } else {
                    $("#allBooking").removeClass("d-none");
                    $("#lastMonthBooking").addClass("d-none");
                    $("#lastWeekBooking").addClass("d-none");
                }
                var dropdownButton = $(this).closest(".dropdown").find(".btn");
                dropdownButton.html(
                    selectedValue + ' <i class="bx bx-chevron-down"></i>'
                );
            });
        });
        // Properties Dropdown
        $(document).ready(function () {
            $(".propertiesDropdown").on("click", function () {
                var selectedValue = $(this).data("value");
                console.log(selectedValue);
                if (selectedValue == "Last Week") {
                    $("#lastWeekProperties").removeClass("d-none");
                    $("#lastMonthProperties").addClass("d-none");
                    $("#allProperties").addClass("d-none");
                } else if (selectedValue == "Last Month") {
                    $("#lastMonthProperties").removeClass("d-none");
                    $("#lastWeekProperties").addClass("d-none");
                    $("#allProperties").addClass("d-none");
                } else {
                    $("#allProperties").removeClass("d-none");
                    $("#lastMonthProperties").addClass("d-none");
                    $("#lastWeekProperties").addClass("d-none");
                }
                var dropdownButton = $(this).closest(".dropdown").find(".btn");
                dropdownButton.html(
                    selectedValue + ' <i class="bx bx-chevron-down"></i>'
                );
            });
        });
        // Patners Dropdown
        $(document).ready(function () {
            $(".patnersDropdown").on("click", function () {
                var selectedValue = $(this).data("value");
                console.log(selectedValue);
                if (selectedValue == "Last Week") {
                    $("#lastWeekPatners").removeClass("d-none");
                    $("#lastMonthPatners").addClass("d-none");
                    $("#allPatners").addClass("d-none");
                } else if (selectedValue == "Last Month") {
                    $("#lastMonthPatners").removeClass("d-none");
                    $("#lastWeekPatners").addClass("d-none");
                    $("#allPatners").addClass("d-none");
                } else {
                    $("#allPatners").removeClass("d-none");
                    $("#lastMonthPatners").addClass("d-none");
                    $("#lastWeekPatners").addClass("d-none");
                }
                var dropdownButton = $(this).closest(".dropdown").find(".btn");
                dropdownButton.html(
                    selectedValue + ' <i class="bx bx-chevron-down"></i>'
                );
            });
        });
    },
};
</script>
