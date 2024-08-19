<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Activities</h5>
            <p>Manage Activities.</p>
          </div>
          <hr />
          <div class="card-body">
            <form id="" class="form" @submit.prevent="submit">
              <div class="row">
                <InputComponent
                  id="name"
                  type="text"
                  label="Name"
                  :isRequired="false"
                  :error="form.errors.name"
                  v-model="form.name"
                />
                <SelectInputComponent
                  id="status"
                  label="Status"
                  :error="form.errors.status"
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
                  v-model="form.status"
                />
              </div>
              <div class="mt-2">
                <button
                  type="submit"
                  class="btn btn-primary me-2"
                  :disabled="form.processing"
                >
                  {{ data ? "Update" : "Save" }}
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
    data: Object,
  },
  data() {
    return {
      form: useForm({
        id:"",
        name: "",
        status: "",
      }),
    };
  },
  mounted() {
    if (this.data) {
      this.form.id = this.data.id;
      this.form.name = this.data.name;
      this.form.status = this.data.status;
    }
  },
  methods: {
    submit() {
      this.form.post(
        this.data
          ? route("activity.update")
          : route("activity.store"),
        {
          onSuccess: () => {
            this.form.reset();
            this.$root.showMessage(
              "success",
              '<span class="text-success">Success</span><br/>',
              this.data?"A Record Was Updated Successfully! ":"A Record Was Created Successfully!"
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
