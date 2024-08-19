<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Meal Types</h5>
            <p>Manage Meal Types.</p>
          </div>
          <hr />
          <div class="card-body">
            <form id="" class="form" @submit.prevent="submit">
              <div class="row" v-for="(row, i) in form.mealTypes" :key="i">
                <SelectInputComponent
                  :id="'type'+i"
                  className="mb-3 col-md-6"
                  label="Meal Type"
                  :isRequired="true"
                  :error="form.errors[`mealTypes.${i}.type`]"
                  :options="mealTypes"
                  v-model="form.mealTypes[i].type"
                />
                <SelectInputComponent
                  :id="'status'+i"
                  className="mb-3 col-md-5"
                  label="Status"
                  :error="form.errors[`mealTypes.${i}.status`]"
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
                  v-model="form.mealTypes[i].status"
                />
                <div class="col-1 d-flex align-items-center">
                  <i class="fa fa-times" @click="removeMealType(i)" style="cursor:pointer;"></i>
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
                <button class="btn btn-outline-primary" @click.prevent="addMealType">
                  Add Meal Type
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
    mealTypes: Array,
    data: Object,
  },
  data() {
    return {
      form: useForm({
        mealTypes: [
        ],
      }),
    };
  },
  mounted() {
    if (this.data) {
      this.form.mealTypes = [];
      this.data.forEach((m, i) => {
        var mealType = {
        type: m.id,
        status: m.status,
      };
        this.form.mealTypes.push(mealType);
      });
    }
  },
  methods: {
    addMealType() {
      var mealType = {
        type: "",
        quantity: 1,
        status: "",
      };

      this.form.mealTypes.push(mealType);
    },
    removeMealType(index){
      var confirm = window.confirm('Delete');
      if(confirm) {
        this.form.mealTypes.splice(index, 1);
      }
    },
    submit() {
      this.form.post(
        route("property.meal-types.update"),
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
