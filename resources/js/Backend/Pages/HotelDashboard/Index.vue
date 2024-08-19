<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
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
                        <div class="card-header d-flex align-items-center justify-content-between">
                        <h6 class="card-title m-0 me-2">Income</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm p-0" type="button" id="referralsList" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            All <i class="bx bx-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="referralsList2">
                            <a class="dropdown-item incomeDropdown" href="javascript:void(0);" data-value="All">All</a>
                            <a class="dropdown-item incomeDropdown" href="javascript:void(0);" data-value="Last Week">Last Week</a>
                            <a class="dropdown-item incomeDropdown" href="javascript:void(0);" data-value="Last Month">Last Month</a>
                            </div>
                        </div>
                        </div>
                        <div class="card-body text-center">
                        <div class="avatar avatar-md border-5 border-light-info rounded-circle mx-auto mb-4">
                            <span class="avatar-initial rounded-circle bg-label-info"><i class='bx bx-money bx-sm'></i></span>
                        </div>
                        <!-- <h3 class="card-title mb-1 me-2">{{ this.$root.formatPrice(totalIncome,
                            $page.props.configs.app_currency ?? '') }}</h3> -->
                        <h3 id="allIncomes" class="card-title mb-1 me-2">{{ income.AllIncome }}</h3>
                        <h3 id="lastWeekIncomes" class="card-title mb-1 me-2 d-none">{{ income.IncomeLastWeek }}</h3>
                        <h3 id="lastMonthIncomes" class="card-title mb-1 me-2 d-none">{{ income.IncomeLastMonth }}</h3>  
                        <small class="d-block mb-2">Income</small>

                        </div>
                    </div>
                </div>
                <!-- Total Bookings Container -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                    <h6 class="card-title m-0 me-2">Bookings</h6>
                    <div class="dropdown">
                        <button class="btn btn-sm p-0" type="button" id="referralsList" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        All <i class="bx bx-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="referralsList4">
                        <a class="dropdown-item bookingDropdown" href="javascript:void(0);" data-value="All">All</a>
                        <a class="dropdown-item bookingDropdown" href="javascript:void(0);" data-value="Last Week">Last Week</a>
                        <a class="dropdown-item bookingDropdown" href="javascript:void(0);" data-value="Last Month">Last Month</a>
                        </div>
                    </div>
                    </div>
                    <div class="card-body text-center">
                    <div class="avatar avatar-md border-5 border-light-warning rounded-circle mx-auto mb-4">
                        <span class="avatar-initial rounded-circle bg-label-warning"><i class='bx bx-archive bx-sm'></i></span>
                    </div>
                    <h3 id="allBooking" class="card-title mb-1 me-2">{{ counts.BookingsCount }}</h3>
                    <h3 id="lastWeekBooking" class="card-title mb-1 me-2 d-none">{{ counts.BookingsLastWeekCount }}</h3>
                    <h3 id="lastMonthBooking" class="card-title mb-1 me-2 d-none">{{ counts.BookingsLastMonthCount }}</h3>
                    <small class="d-block mb-2">Confirm Bookings</small>

                    </div>
                </div>
                </div>
                <!-- Total Bookings Container -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                    <h6 class="card-title m-0 me-2">Bookings</h6>
                    <div class="dropdown">
                        <button class="btn btn-sm p-0" type="button" id="referralsList" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        All <i class="bx bx-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="referralsList4">
                        <a class="dropdown-item bookingpDropdown" href="javascript:void(0);" data-value="All">All</a>
                        <a class="dropdown-item bookingpDropdown" href="javascript:void(0);" data-value="Last Week">Last Week</a>
                        <a class="dropdown-item bookingpDropdown" href="javascript:void(0);" data-value="Last Month">Last Month</a>
                        </div>
                    </div>
                    </div>
                    <div class="card-body text-center">
                    <div class="avatar avatar-md border-5 border-light-warning rounded-circle mx-auto mb-4">
                        <span class="avatar-initial rounded-circle bg-label-warning"><i class='bx bx-archive bx-sm'></i></span>
                    </div>
                    <h3 id="allPBooking" class="card-title mb-1 me-2">{{ counts.PBookingsCount }}</h3>
                    <h3 id="lastWeekPBooking" class="card-title mb-1 me-2 d-none">{{ counts.PBookingsLastWeekCount }}</h3>
                    <h3 id="lastMonthPBooking" class="card-title mb-1 me-2 d-none">{{ counts.PBookingsLastMonthCount }}</h3>
                    <small class="d-block mb-2">Pending Bookings</small>

                    </div>
                </div>
                </div>
                <!-- Total Overview Container -->
                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between pb-3" >
                    <h6 class="card-title m-0 me-2" >Overview</h6>
                   
                    </div>
                    <div class="card-body text-left">
                    <small class="d-block mb-1">Income</small>
                    <div class="d-flex justify-content-left align-items-center">
                        <div class="progress w-100 me-2" style="height: 8px;">
                        <div class="progress-bar bg-warning" :style="{ width: incomeprecentage + '%' }" role="progressbar" :aria-valuenow="incomeprecentage"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="d-block">{{ incomeprecentage }}%</small>
                    </div>
                    <small class="d-block mb-1 mt-2">Confirm Bookings</small>
                    <div class="d-flex justify-content-left align-items-center">
                        <div class="progress w-100 me-2" style="height: 8px;">
                        <div class="progress-bar bg-warning" :style="{ width: bookingconfirmprecentage + '%' }" role="progressbar" :aria-valuenow="bookingconfirmprecentage"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="d-block">{{ bookingconfirmprecentage }}%</small>
                    </div>
                    <small class="d-block mb-1 mt-2">Pending Bookings</small>
                    <div class="d-flex justify-content-left align-items-center">
                        <div class="progress w-100 me-2" style="height: 8px;">
                        <div class="progress-bar bg-warning" :style="{ width: bookingpendingprecentage + '%' }" role="progressbar" :aria-valuenow="bookingpendingprecentage"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="d-block">{{bookingpendingprecentage}}%</small>
                    </div>
                   

                    </div>
                </div>
                </div>
                  
           </div>
           <div class="row">
            <div class="col-md-6 col-lg-4 col-xl-4 mb-4">
                <div class="card" style="height: 450px; overflow: auto;">
                    <div class="card-header d-flex justify-content-between mb-3">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">New Offers</h5>
                        <small class="text-muted">New Offers Overview</small>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="salesByCountry" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesByCountry">
                        <Link class="dropdown-item" :href="route('offer.index')">View All</Link>
                        <!-- <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                        <a class="dropdown-item" href="javascript:void(0);">Share</a> -->
                        </div>
                    </div>
                    </div>
                    <div class="card-body">
                    <ul class="p-0 m-0">

                        <li class="d-flex mb-4 pb-1" v-for="item in topOffers" :key="item.name">
                        <!-- <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-danger">
                            <img :src="item.image_path" alt="">
                            </span>
                        </div> -->
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                            <div class="d-flex align-items-center">

                                <!-- <h6 class="mb-0 me-1">fod</h6> -->
                                <!-- <small class="text-success fw-semibold">
                                    <i class='bx bx-chevron-up'></i>
                                    25.8%
                                </small> -->
                            </div>
                            <small class="text-muted">Name</small>
                            <h6 class="mb-0">{{ item.name }}</h6>
                            </div>
                            <div class="user-progress">
                            <small class="text-muted">Status</small>
                            <h6 class="mb-0 text-success" v-if="item.status==1">Active</h6>
                            <h6 class="mb-0 text-danger" v-else>Deactive</h6>
                            </div>
                        </div>
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
                <div class="col-md-6 col-lg-8 mb-md-0 mb-4">
                    <div class="card" style="height: 450px; overflow: auto;">
                        <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Rates</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="teamMemberList" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="teamMemberList">
                            <Link class="dropdown-item" :href="route('rates.index')">View All</Link>
                            <!-- <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a> -->
                            </div>
                        </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>RATE NAME</th>
                                <th>ROOM TYPE</th>
                                <th>STATUS </th>
                           
                                <!-- <th>Task</th> -->

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="rate in rates" :key="rate.name">
                                <td>
                                <div class="d-flex justify-content-start align-items-center">
                            
                                    <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-truncate">{{ rate.name }}</h6>
                                    <small class="text-truncate text-muted">Type: {{ rate.type }} </small>
                                    <!-- <small class="text-muted">Subscription Plan</small>
                                    <h6 class="mb-0">test</h6>  -->
                                    </div>
                                </div>
                                </td>
                                <td>
                                <div class="d-flex justify-content-start align-items-center">
                            
                                    <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-truncate">{{ rate.type }}</h6>
                                  
                                    </div>
                                </div>
                                </td>
                                <td>
                                <span class="badge bg-label-success rounded-pill text-uppercase" v-if="rate.status == 1"
                                    style="font-size: 8px;">ACTIVE</span>
                                <span class="badge bg-label-danger rounded-pill text-uppercase" v-else>DEACTIVE</span>
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
                    <div class="card" style="height: 650px; overflow: auto;">
                        <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Bookings</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="teamMemberList" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="teamMemberList">
                            <Link class="dropdown-item" :href="route('booking.index')">View All</Link>
                            <!-- <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a> -->
                            </div>
                        </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>

                                <th>INVOICE ID</th>
                                <th>CUSTOMER NAME</th>
                                <th>CUSTOMER ADDRESS</th>
                                <th>TOTAL AMOUNT</th>
                                <th>STATUS</th>
                                <!-- <th>Task</th> -->

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="booking in bookingDetails" :key="booking.name">
                                <td>
                                    <div class="d-flex justify-content-start align-items-center">
                                   
                                    <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-truncate">{{ booking.id }}</h6>
                                  
                                   
                                    </div>
                                </div>
                                </td>
                                <td>
                                <div class="d-flex justify-content-start align-items-center">
                    
                                    <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-truncate">{{ booking.first_name }} {{ booking.last_name }}</h6>
                                    <small class="text-truncate text-muted">Email: {{ booking.email }} </small>
                                    <!-- <small class="text-muted">Subscription Plan</small>
                                    <h6 class="mb-0">test</h6>  -->
                                    </div>
                                </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center">
                                   
                                    <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-truncate">{{ booking.address }}</h6>
                                  
                                   
                                    </div>
                                </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center">
                                   
                                    <div class="d-flex flex-column">
                                    <h6 class="mb-0 text-truncate">{{ booking.total_amount }}</h6>
                                  
                                   
                                    </div>
                                </div>
                                </td>
                                <td>
                                <span class="badge bg-label-success rounded-pill text-uppercase" v-if="booking.status == 'confirm'"
                                    style="font-size: 8px;">Confirm</span>
                                <span class="badge bg-label-info rounded-pill text-uppercase" v-if="booking.status == 'pending'">Pending</span>
                                <span class="badge bg-label-danger rounded-pill text-uppercase" v-if="booking.status == 'cancel'">Cancel</span>
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
            selectedPropertyType: (this.propertytype.length > 0) ? this.propertytype[0].id : '',
            selectedpropertyTypeCount:(this.propertytype.length > 0) ? this.propertytype[0].property_count : '',
            selectedPropertyTypeName: (this.propertytype.length > 0) ? this.propertytype[0].name : '',
            selectedPropertyTypeStatus: (this.propertytype.length > 0) ? this.propertytype[0].status : '',
           
        };
    },
  components: {
    Link,
    DataTable,
  },
  props:{
    counts: Object,
    income:Object,
    topOffers: Array,
    propertyDetails: Object,
    propertytype:Array,
    bookingDetails:Object,
    rates:Object,
    incomeprecentage:String,
    bookingconfirmprecentage: String,
    bookingpendingprecentage: String,
  },
 
    methods: {
        selectPropertyType(propertyTypeId, propertyTypeCount, propertyTypeName, propertyTypeStatus) {
            this.selectedPropertyType = propertyTypeId;
            this.selectedpropertyTypeCount = propertyTypeCount;
            this.selectedPropertyTypeName = propertyTypeName;
            this.selectedPropertyTypeStatus = propertyTypeStatus;
        },
        // Your other Vue component methods
    },
  mounted(){
    // Income Dropdown 
    $(document).ready(function () {
      $('.incomeDropdown').on('click', function () {
        var selectedValue = $(this).data('value');
        console.log(selectedValue);
        if (selectedValue == 'Last Week') {
          $('#lastWeekIncomes').removeClass('d-none');
          $('#lastMonthIncomes').addClass('d-none');
          $('#allIncomes').addClass('d-none');
        } else if (selectedValue == 'Last Month') {
          $('#lastMonthIncomes').removeClass('d-none');
          $('#lastWeekIncomes').addClass('d-none');
          $('#allIncomes').addClass('d-none');
        } else {
          $('#allIncomes').removeClass('d-none');
          $('#lastMonthIncomes').addClass('d-none');
          $('#lastWeekIncomes').addClass('d-none');
        }
        var dropdownButton = $(this).closest('.dropdown').find('.btn');
        dropdownButton.html(selectedValue + ' <i class="bx bx-chevron-down"></i>');
      });

    });
    // Booking Dropdown 
    $(document).ready(function () {
      $('.bookingDropdown').on('click', function () {
        var selectedValue = $(this).data('value');
        console.log(selectedValue);
        if (selectedValue == 'Last Week') {
          $('#lastWeekBooking').removeClass('d-none');
          $('#lastMonthBooking').addClass('d-none');
          $('#allBooking').addClass('d-none');
        } else if (selectedValue == 'Last Month') {
          $('#lastMonthBooking').removeClass('d-none');
          $('#lastWeekBooking').addClass('d-none');
          $('#allBooking').addClass('d-none');
        } else {
          $('#allBooking').removeClass('d-none');
          $('#lastMonthBooking').addClass('d-none');
          $('#lastWeekBooking').addClass('d-none');
        }
        var dropdownButton = $(this).closest('.dropdown').find('.btn');
        dropdownButton.html(selectedValue + ' <i class="bx bx-chevron-down"></i>');
      });

    });
    // pBooking Dropdown 
    $(document).ready(function () {
      $('.bookingpDropdown').on('click', function () {
        var selectedValue = $(this).data('value');
        console.log(selectedValue);
        if (selectedValue == 'Last Week') {
          $('#lastWeekPBooking').removeClass('d-none');
          $('#lastMonthPBooking').addClass('d-none');
          $('#allPBooking').addClass('d-none');
        } else if (selectedValue == 'Last Month') {
          $('#lastMonthPBooking').removeClass('d-none');
          $('#lastWeekPBooking').addClass('d-none');
          $('#allPBooking').addClass('d-none');
        } else {
          $('#allPBooking').removeClass('d-none');
          $('#lastMonthPBooking').addClass('d-none');
          $('#lastWeekPBooking').addClass('d-none');
        }
        var dropdownButton = $(this).closest('.dropdown').find('.btn');
        dropdownButton.html(selectedValue + ' <i class="bx bx-chevron-down"></i>');
      });

    });
   
  }
}
</script>