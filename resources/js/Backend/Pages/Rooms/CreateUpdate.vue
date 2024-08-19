<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Rooms</h5>
            <p>Manage Rooms.</p>
          </div>
          <hr />
          <div class="card-body">
            <form id class="form" @submit.prevent="submit">
              <div class="row">
                <InputComponent
                  id="name"
                  type="text"
                  label="Name"
                  :isRequired="true"
                  :error="form.errors.name"
                  v-model="form.name"
                />
                <InputComponent
                  id="no_of_rooms"
                  type="number"
                  label="Number of Rooms"
                  :isRequired="true"
                  :error="form.errors.quantity"
                  v-model="form.quantity"
                />
                <InputComponent
                  id="max_adults"
                  type="number"
                  label="Maximum Amount of Adults in Room"
                  :error="form.errors.max_adults"
                  v-model="form.max_adults"
                />
                <InputComponent
                  id="max_child"
                  type="number"
                  label="Maximum Amount of Children in Room"
                  :error="form.errors.max_child"
                  v-model="form.max_child"
                />
                <InputComponent
                  id="max_extra_beds"
                  type="number"
                  label="Maximum Amount of Extra beds in Room"
                  :error="form.errors.max_extra_beds"
                  v-model="form.max_extra_beds"
                />
                <InputComponent
                  id="default_web"
                  type="number"
                  label="Default Web Inventory (how many rooms to show in online booking page as available)"
                  :error="form.errors.default_web"
                  v-model="form.default_web"
                />
                <SelectInputComponent
                  id="meal_type"
                  label="Meal Types"
                  :error="form.errors.meal_type"
                  :options="mealTypes"
                  v-model="form.meal_type"
                  :isMultiple="true"
                />
                <SelectInputComponent
                  id="bed_type"
                  label="Bed Types"
                  :error="form.errors.bed_type"
                  :options="bedTypes"
                  v-model="form.bed_type"
                  :isMultiple="true"
                />
                <SelectInputComponent
                  id="amenities"
                  label="Amenities"
                  :error="form.errors.amenities"
                  :options="amenities"
                  v-model="form.amenities"
                  :isMultiple="true"
                />
                <SelectInputComponent
                  id="policies"
                  label="Policies"
                  :error="form.errors.policies"
                  :options="policies"
                  v-model="form.policies"
                  :isMultiple="true"
                />
                <TextAreaComponent
                  id="description"
                  label="Description"
                  :error="form.errors.description"
                  v-model="form.description"
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
                <!-- <div class="mb-3 col-md-6">
                  <label for="image" class="form-label me-3">Image</label>
                  <br />

                  <FileInputComponent
                    id="image"
                    :prvImage="prvImage"
                    v-model="form.image"
                  />
                  <div class="text-danger">{{ form.errors.image }}</div>
                </div>-->

                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="image" class="form-label me-3">Images</label>
                    <br />
                    <div class="multi-file-upload">
                      <div class="drop-area" @dragover="handleDragOver" @drop="handleDrop">
                        <div class="row">
                          <div
                            v-for="(image, index) in form.featuredImages.images"
                            :key="index"
                            class="uploaded-image"
                          >
                            <img
                              style="width: 80px; height: 80px; object-fit: cover;"
                              :src="image.previewURL"
                              alt="Uploaded Image"
                              class="img-thumbnail"
                            />
                            <button type="button" class="close-icon" @click="removeImage(index)">
                              <i class="fas fa-times" style="font-size: 15px;"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mt-2">
                <button
                  type="submit"
                  class="btn btn-primary me-2"
                  :disabled="form.processing"
                >{{ data ? "Update" : "Save" }}</button>
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
import { Inertia } from "@inertiajs/inertia";
import SelectInputComponent from "@/Components/SelectInputComponent.vue";
import TextAreaComponent from "../../Components/TextAreaComponent.vue";
export default {
  components: {
    Link,
    AppLayout,
    InputComponent,
    FileInputComponent,
    SelectInputComponent,
    TextAreaComponent
  },
  props: {
    data: Object,
    mealTypes: Array,
    bedTypes: Array,
    amenities: Array,
    policies: Array
  },
  data() {
    return {
      form: useForm({
        id: "",
        name: "",
        quantity: 1,
        max_adults: 0,
        max_child: 0,
        max_extra_beds: 0,
        default_web: 1,
        meal_type: [],
        bed_type: [],
        amenities: [],
        // image: "",
        policies: [],
        description: "",
        status: "",
        featuredImages: {
          id: "",
          title: "room",
          images: []
        }
      }),
      featuredImages: []
    };
  },
  mounted() {
    if (this.data) {
      this.form.id = this.data.id;
      this.form.name = this.data.name;
      this.form.quantity = this.data.quantity ?? 0;
      this.form.max_adults = this.data.max_adults ?? 0;
      this.form.max_child = this.data.max_child ?? 0;
      this.form.max_extra_beds = this.data.max_extra_beds ?? 0;
      this.form.default_web = this.data.default_web ?? 0;
      this.form.policies = this.data.policies;
      this.form.amenities = this.data.amenities;
      this.form.description = this.data.description;
      this.form.status = this.data.status;

      this.form.meal_type = this.data?.meal_types?.map(el => {
        return el.id;
      });
      this.form.bed_type = this.data?.bed_types?.map(el => {
        return el.id;
      });
      this.form.featuredImages.images =
        this.data?.media.map(image => ({
          id: image.id, // Include the image ID or any other relevant information
          previewURL: image.original_url
          // Include other details as needed
        })) || [];
      let test = this.data?.media.filter(i => i.collection_name == "Room");
      console.log(test[0]);
    }
  },
  computed: {},
  methods: {
    handleDragOver(event) {
      event.preventDefault();
    },
    handleDrop(event) {
      event.preventDefault();
      const files = event.dataTransfer.files;
      console.log("Dropped files:", files);
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        file.previewURL = URL.createObjectURL(file);
        this.form.featuredImages.images.push(files[i]);
      }
      console.log(
        "Featured Images after drop:",
        this.form.featuredImages.images
      ); // Add this line
    },
    removeImage(index) {
      // Remove the image at the specified index from the form's images array
      const removedImage = this.form.featuredImages.images.splice(index, 1)[0];

      if (removedImage && removedImage.id) {
        // If the removed image has an ID, use it to delete the image
        Inertia.post(route("room.delete.gallery", removedImage.id), {
          preserveScroll: true,
          forceFormData: true,
          onSuccess: () => {
            // Handle success actions if needed
            Inertia.reload({
              preserveScroll: true
            });
            this.$root.showMessage(
              "success",
              '<span class="text-success">Success</span><br/>',
              "Image Deleted Successfully! "
            );
          }
        });
      }
    },

    submit() {
      this.form.post(this.data ? route("room.update") : route("room.store"), {
        onSuccess: () => {
          this.form.reset();
          this.$root.showMessage(
            "success",
            '<span class="text-success">Success</span><br/>',
            "A Record Was Created Successfully! "
          );
        },
        onError: () => {
          this.form.reset();
          this.$root.showMessage(
            "error",
            '<span class="text-danger">Error</span><br>',
            "Something went wrong! "
          );
        }
      });
    }
  }
};
</script>
<style>
.uploaded-image {
  position: relative;
  width: 100px;
  object-fit: cover;
  padding-right: 5px;
  padding-bottom: 5px;
}

.close-icon {
  position: absolute;
  top: 1px;
  right: 13px;
  background: transparent;
  padding: 0;
  color: white;
  border: 0;
}
</style>