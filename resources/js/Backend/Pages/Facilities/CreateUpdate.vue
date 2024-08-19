<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Facilities</h5>
            <p>Manage Facilities.</p>
          </div>
          <hr />
          <div class="card-body">
            <form id="" class="form" @submit.prevent="submit">
              <div class="row">
                <InputComponent
                  id="facilities_name"
                  type="text"
                  label="Facility Name"
                  :error="form.errors.name"
                  v-model="form.name"
                />
                <div class="mb-3 col-md-6">
                  <label for="icon_select" class="form-label"
                    >Select Icon</label
                  >
                  <select
                    class="select2 form-control"
                    id="icon_select"
                    v-model="form.icon"
                  >
                    <option selected value="">-- Select --</option>
                    <option :value="icon" v-for="(icon, i) in icons" :key="i">
                      {{ icon }}
                    </option>
                  </select>
                  <!-- <div>
                    Refer :
                    <a href="https://fontawesome.com/v5/cheatsheet/free"
                      >https://fontawesome.com/v5/cheatsheet/free</a
                    >
                  </div> -->
                  <div class="text-danger">
                    {{ form.errors.icon }}
                  </div>
                </div>
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
                <TextAreaComponent
                  id="sub_facilities"
                  type="text"
                  label="Sub Facility Names"
                  :error="form.errors.sub_facilities"
                  v-model="form.sub_facilities"
                  
                />
               
              </div>
              <div class="mt-2">
                <button
                  type="submit"
                  class="btn btn-primary me-2"
                  :disabled="form.processing"
                >
                  {{ facilities ? "Update" : "Save" }}
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
import FileInputComponent from "@/Components/FileInputComponent.vue";
import InputComponent from "@/Components/InputComponent.vue";
import SelectInputComponent from "@/Components/SelectInputComponent.vue";
import TextAreaComponent from "@/Components/TextAreaComponent.vue";

export default {
  components: {
    Link,
    AppLayout,
    InputComponent,
    FileInputComponent,
    SelectInputComponent,
    TextAreaComponent,
  },
  props: {
    errors: Object,
    facilities: Object,
    icons: Array,
  
  },
  data() {
    return {
      form: useForm({ name: "", status: "" ,icon: "", sub_facilities: "" ,}),
    };
  },
  mounted() {
    let self = this;
    if (this.facilities) {
      this.form.name = this.facilities.name;
      this.form.icon = this.facilities.icon;
      this.form.sub_facilities = this.facilities.sub_facilities;
      this.form.status = this.facilities.status;
      
    }
    $(document).ready(function(){
        $(".select2#icon_select").select2({
            dropdownParent: $('#icon_select').parent(),
      templateResult: function (state) {
        if (!state.id) {
          return state.text;
        }
        var $state = $(
          '<span><i class="' +
            state.text +
            '" style="width: 24px;font-size: 18px;"></i> ' +
            state.text +
            "</span>"
        );
        return $state;
      },
    });
    })



    $(".card-body").on("change", "#icon_select", function (evt) {
      self.form.icon = evt.target.value;
      
    });
  },
  computed: {
    
  },
  methods: {
    submit() {
      this.form.post(
        this.facilities ? route("facilities.update") : route("facilities.store"),
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
  },
};
</script>
