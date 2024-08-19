<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Facilities</h5>
            <p>Manage Facilities.</p>
            <div class="d-flex">
              <Link
                class="btn btn-primary btn-sm"
                :href="route('facilities.create')"
                v-if="$root.hasPermission('facility.create')"
              >
                <i class="bx bx-plus"></i> Create
              </Link>
            </div>
            <!-- <div class="d-flex filter-section">
              <SelectInputComponent id="property_filter" label="Select Property" :options="properties" v-model="dataTableForm.property"/>
            </div> -->
          </div>
          <div class="card-body">
            <data-table
              ref="datatable"
              :id="'mytable'"
              :url="route('facilities.getdata')"
              :reOrderUrl="route('facilities.reorder')"
              :columns="columns"
              :columnDefs="columnDefs"
              :submitData="dataTableForm"
            >
              <template #header>
                <tr>
                  <th>--</th>
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
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </template>
            </data-table>
          </div>
        </div>
      </div>
      <!-- model -->
      <div
        class="modal modal-top fade"
        id="deleteConfirm"
        tabindex="-1"
        aria-hidden="true"
        data-bs-backdrop="false"
      >
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header px-3 pb-2">
              <h5 class="modal-title" id="exampleModalLabel2">Are You Sure?</h5>
            </div>
            <form id="formAccountDelete" @submit.prevent="deleteSelectedItems">
              <div class="modal-body py-0 px-3">
                <div class="row">
                  <div class="col mb-1">
                    <p>Are you sure you want to delete?</p>
                  </div>
                </div>
              </div>
              <div class="modal-footer px-3 pb-3">
                <button
                  type="button"
                  class="btn btn-sm btn-label-secondary"
                  data-bs-dismiss="modal"
                  @click="resetForm"
                >
                  Close
                </button>
                <button type="submit" class="btn btn-sm btn-primary">
                  Yes
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- model -->
    </div>
  </AppLayout>
</template>
<script>
import { Link, useForm } from "@inertiajs/inertia-vue3";

import AppLayout from "@/Layouts/AppLayout";
import DataTable from "@/Components/DataTable";
import SelectInputComponent from '../../Components/SelectInputComponent.vue';
import { Inertia } from '@inertiajs/inertia';

export default {
  components: {
    Link,
    AppLayout,
    DataTable,
    SelectInputComponent,
  },
props:{
  properties:Array,
},
  data() {
    return {
      columns: [
        {
          data: "position",
          name: "position",
          orderable: true,
          searchable: false,
          // visible: false,
          className: 'reorder'
        },
        {
          data: "check",
          name: "check",
          orderable: false,
          searchable: false,
        },
        {
          data: "name",
          name: "name",
          orderable: true,
          searchable: true,
        },
        { data: "status", name: "status", orderable: true },
        { data: "action", name: "action", orderable: true },
      ],
      columnDefs: [{ className: "text-center", targets: [] }],
      order: [[1, "desc"]],
      url:route('facilities.getdata')+'?property=',
      form: useForm({
        id: "",
        status: "",
      }),
      dataTableForm:{
        property:""
      }
    };
  },
  mounted() {
    var self = this;
    $('#property_filter').on('change', function(evt) {
      self.dataTableForm.property = evt.target.value;
      // self.url = self.url+evt.target.value
        self.reloadTable();
    })
    $("#mytable tbody").on("click", "tr .action_delete", (evt) => {
      const data = $(evt.target).data("item-id");
      this.selectedRows = [];
      this.getSelectedItems(data);
    });
    $("#mytable tbody").on("click", "tr .action_edit", (evt) => {
      const id = $(evt.target).data("item-id");
      this.$inertia.visit(route("facilities.edit", id));
    });

    $("#mytable tbody").on("click", "tr .action_status_change", (evt) => {
      const id = $(evt.target).data("item-id");
      const status = $(evt.target).data("status");
      this.updateStatus(id, status);
    });

    $("#mytable tbody").on(
      "click",
      ".item-check input[type=checkbox]",
      (evt) => {
        const checkedVal = $(evt.target).val();
        if (
          $(evt.target).prop("checked") &&
          !this.selectedRows.includes(checkedVal)
        ) {
          this.getSelectedItems(checkedVal);
        } else {
          this.removeUnselectedItem(checkedVal);
        }
      }
    );
  },
  methods: {
    reloadTable() {
      this.$refs.datatable.reloadDatatable();
    },
    getSelectedItems(value) {
      this.selectedRows.push(value);
      if (this.selectedRows.length > 0) {
        this.$data.isDisabled = false;
      }
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
    updateStatus(id, status) {
      this.form.id = id;
      this.form.status = status;
      this.form.put(route("facilities.status"), {
        preserveScroll: true,
        onSuccess: () => {
          this.form.reset();
          this.reloadTable();
          this.$root.showMessage(
            "success",
            '<span class="text-success">Success</span><br/>',
            "Staus Updated Successfully! "
          );
        },
        onError: () => {
          this.$root.showMessage(
            "error",
            '<span class="text-danger">Error</span><br>',
            "Something went wrong! "
          );
        },
      });
    },
    deleteSelectedItems() {
      this.form
        .transform((data) => ({
          ...data,
          ids: [...this.selectedRows],
        }))
        .post(route("facilities.delete"), {
          onSuccess: () => {
            this.resetForm();
            this.reloadTable();
            this.$root.showMessage(
              "success",
              '<span class="text-success">Success</span><br/>',
              "A Record Was Created Successfully! "
            );
          },
          onError: () => {
            this.$root.showMessage(
              "error",
              '<span class="text-danger">Error</span><br>',
              "Something went wrong! "
            );
          },
          onFinish: () => {
            $("#deleteConfirm").modal("hide");
            this.resetForm();
          },
        });
    },
    resetForm() {
      this.form.reset("id", "status");
    },
  },
};
</script>