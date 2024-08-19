<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Bed Types</h5>
            <p>Manage Bed Types.</p>
          </div>
          <hr />
          <div class="card-body">
            <form id="" class="form" @submit.prevent="submit">
              <div class="row" v-for="(row, i) in form.bedTypes" :key="i">
                <SelectInputComponent
                  :id="'type'+i"
                  className="mb-3 col-md-4"
                  label="Bed Type"
                  :isRequired="true"
                  :error="form.errors[`bedTypes.${i}.type`]"
                  :options="bedTypes"
                  v-model="form.bedTypes[i].type"
                />
                <InputComponent
                  :id="'quantity'+i"
                  className="mb-3 col-md-4"
                  type="number"
                  label="Maximum Amount of People"
                  :isRequired="true"
                  :error="form.errors[`bedTypes.${i}.quantity`]"
                  v-model="form.bedTypes[i].quantity"
                />
                <SelectInputComponent
                  :id="'status'+i"
                  className="mb-3 col-md-3"
                  label="Status"
                  :error="form.errors[`bedTypes.${i}.status`]"
                  :options="[
                    {
                      id: 1,
                      name: 'Active',
                    },
                    {
                      id: 0,
                      name: 'Inactive',
                    },
                  ]"
                  v-model="form.bedTypes[i].status"
                />
                <div class="col-1 d-flex align-items-center">
                  <i class="fa fa-times" @click="removeBedType(i)" style="cursor:pointer;"></i>
                </div>
              </div>
              <div class="mt-4">
                <button
                  type="submit"
                  class="btn btn-primary me-2"
                  :disabled="form.processing"
                >
                  {{ data ? "Update" : "Save" }}
                </button>
                <button class="btn btn-outline-primary" @click.prevent="addBedType">
                  Add Bed Type
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
<script>
import { Link, useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout";
import InputComponent from "@/Components/InputComponent.vue";
import SelectInputComponent from "@/Components/SelectInputComponent.vue";
export default {
  components: {
    Link,
    AppLayout,
    InputComponent,
    SelectInputComponent,
  },
  props: {
    bedTypes: Array,
    data: Object,
  },
  data() {
    return {
      form: useForm({
        bedTypes: [
        ],
      }),
    };
  },
  mounted() {
    if (this.data) {
      this.form.bedTypes = [];
      this.data.forEach((t, i) => {
        var bedType = {
        type: t.id,
        quantity: t.quantity,
        status: t.status,
      };
        this.form.bedTypes.push(bedType);
      });
    }
  },
  methods: {
    addBedType() {
      var bedType = {
        type: "",
        quantity: 1,
        status: "",
      };

      this.form.bedTypes.push(bedType);
    },
    removeBedType(index){
      var confirm = window.confirm('Delete');
      if(confirm) {
        this.form.bedTypes.splice(index, 1);
      }
    },
    submit() {
      this.form.post(
        route("property.bed-types.update"),
        {
          onSuccess: () => {
            // this.form.reset();
            this.$root.showMessage(
              "success",
              '<span class="text-success">Success</span><br/>',
              "A Record(s) Was Updated Successfully!"
            );
          },
          onError: () => {
            this.$root.showMessage(
              "error",
              '<span class="text-danger">Error</span><br>',
              "Something went wrong! "
            );
          },
        }
      );
    },
  },
};
</script>
