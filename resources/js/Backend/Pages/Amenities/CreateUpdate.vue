<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Amenities</h5>
            <p>Manage Amenities.</p>
          </div>
          <hr />
          <div class="card-body">
            <form id="" class="form" @submit.prevent="submit">
              <div class="row">
                <InputComponent
                  id="name"
                  type="text"
                  label="Amenities Name"
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
                  <div>
                    Refer :
                    <a href="https://fontawesome.com/v5/cheatsheet/free"
                      >https://fontawesome.com/v5/cheatsheet/free</a
                    >
                  </div>
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
                <div class="mb-3 col-md-6">
                  <label for="image" class="form-label me-3">Image</label>
                  <br />

                  <FileInputComponent
                    id="image"
                    :prvImage="prvImage"
                    v-model="form.image"
                  />
                  <div class="text-danger">{{ form.errors.image }}</div>
                </div>
              </div>
              <div class="mt-2">
                <button
                  type="submit"
                  class="btn btn-primary me-2"
                  :disabled="form.processing"
                >
                  {{ amenities ? "Update" : "Save" }}
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
    amenities: Object,
    icons: Array,
  },
  data() {
    return {
      form: useForm({id:"", name: "", icon: "", status: "" ,  image: "",}),
    };
  },
  mounted() {
    let self = this;
    if (this.amenities) {
      this.form.id = this.amenities.id;
      this.form.name = this.amenities.name;
      this.form.icon = this.amenities.icon;
      this.form.status = this.amenities.status;
      
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
    prvImage() {
      if(this.amenities) {
        console.log(this.amenities);
        let fImage = this.amenities?.media.filter(i => i.collection_name == 'amenities')
        return fImage.length > 0 ? fImage[0].original_url : '';
      } else {
        return '';
      }

      // return this.data ? this.data?.media.filter(i => i.collection_name == 'Room') : "";
    },
  },
  methods: {
    submit() {
      this.form.post(
        this.amenities ? route("amenities.update") : route("amenities.store"),
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
