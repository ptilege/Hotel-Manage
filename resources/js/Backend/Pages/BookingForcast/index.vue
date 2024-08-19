<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Bookings Forecast</h5>
            <p>Manage Bookings Forecast.</p>
            <div class="row">
              <div class="col-md-4">
                <label for="startDate">Start Date:</label>
                <input type="date" v-model="startDate" class="form-control" @change="onDateChange()">
              </div>
              <div class="col-md-4">
                <label for="endDate">End Date:</label>
                <input type="date" v-model="endDate" class="form-control" @change="onDateChange()">
              </div>
            </div>
             <div class="mt-3">
    <p style="color: red;">
       Today to 1 week bookings Show Here. You can adjust the calendar to see other bookings.
    </p>
</div>
            

          </div>
          <div class="card-body">
            <data-table
              ref="datatable"
              :id="'mytable'"
              :url="route('bookingforcast.getdata')"
              :columns="columns"
              :columnDefs="columnDefs"
            >
              <template #header>
                <tr>
                  <th width="10%">
                    <div class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        class="form-check-input"
                        id="selectAll"
                        @click="selectAll($event)"
                      />
                      <label class="form-check-label" for="selectAll"></label>
                    </div>
                  </th>
                  <th>Invoice No.</th>
                  <th>Customer Name</th>
                  <th>Check-in</th>
                  <th>Check-out</th>
                  <th>Partial Paid Amount</th>
                  <th>Total Amount</th>
                  <th>Status</th>
                 
                </tr>
              </template>
            </data-table>
          </div>
        </div>
      </div>
      
    </div>
  </AppLayout>
</template>

<script>
import { Link, useForm } from "@inertiajs/inertia-vue3";

import AppLayout from "@/Layouts/AppLayout";
import DataTable from "@/Components/DataTable";
import axios from 'axios';

export default {
  components: {
    Link,
    AppLayout,
    DataTable,
  },

  data() {
    return {
      startDate: null,
    endDate: null,
      
      columns: [
        {
          data: "check",
          name: "check",
          orderable: false,
          searchable: false,
        },
        {
          data: "inv_id",
          name: "inv_id",
          orderable: true,
          searchable: true,
        },
        {
          data: "customer",
          name: "customer",
          orderable: true,
          searchable: true,
        },
        {
          data: "checkin_date",
          name: "checkin_date",
          orderable: false,
          searchable: true,
        },
        {
          data: "checkout_date",
          name: "checkout_date",
          orderable: false,
          searchable: true,
        },
        {
          data: "patial_amount",
          name: "patial_amount",
          orderable: false,
          searchable: true,
        },
        {
          data: "total_amount",
          name: "total_amount",
          orderable: false,
          searchable: true,
        },
        { data: "status", name: "status", orderable: true },
       
      ],
      columnDefs: [{ className: "text-center", targets: [] }],
      order: [[1, "desc"]],

      form: useForm({
        id: "",
        status: "",
      }),
    };
  },
  
  computed: {
    getDataUrl() {
       return route('bookingforcast.selecteDate', {
        startDate: this.startDate,
        endDate: this.endDate
      });
    }
  },
 
   methods: {
   
        
        onDateChange() {
        
        if (this.startDate && this.endDate) {
            this.fetchData();
        }
    },
    fetchData() {
  axios.get(this.getDataUrl)

      .then(response => {
          console.log('Data received:', response.data);
          this.reloadTable();
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });
   
},
    
    reloadTable() {
      this.$refs.datatable.reloadDatatable();
    },

      
    selectAll(evt) {
      var self = this;
      if ($(evt.target).is(":checked")) {
        $(".item-check input[type=checkbox]").prop("checked", true);
        $(".item-check input[type=checkbox]:checked").each(function () {
          if (!self.selectedRows.includes(this.value)) {
            self.getSelectedItems(this.value);
          }
        });
        this.$data.isDisabled = false;
      } else {
        $(".item-check input[type=checkbox]").prop("checked", false);
        $(".item-check input[type=checkbox]").each(function () {
          if (self.selectedRows.includes(this.value)) {
            self.removeUnselectedItem(this.value);
          }
        });
        this.$data.isDisabled = true;
      }
    },
    removeUnselectedItem(value) {
      this.selectedRows = this.selectedRows.filter(function (val) {
        return val != value;
      });
      if (this.selectedRows.length <= 0) {
        $("#selectAll").prop("checked", false);
        this.$data.isDisabled = true;
      }
    },
    
    
    
  },
};

</script>