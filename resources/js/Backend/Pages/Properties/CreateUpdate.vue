<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="nav-align-top mb-4">
          <ul class="nav nav-tabs" role="tablist">
            <TabPane
              addClass="active"
              title="General"
              target="navs-top-general"
            />
            <TabPane
              addClass=""
              title="Gallery"
              target="navs-top-gallery"
              v-if="data"
            />
            <TabPane
              addClass=""
              title="Contact Details"
              target="navs-top-contact"
              v-if="data"
            />
            <TabPane
              addClass=""
              title="Policy"
              target="navs-top-policy"
              v-if="data"
            />
            <TabPane
              addClass=""
              title="Configurations"
              target="navs-top-configurations"
              v-if="data"
            />
          </ul>
          <div class="tab-content">
            <TabPanel
              addClass="show active"
              id="navs-top-general"
              title="Properties"
              subtitle="Manage Property Details"
            >
              <div class="card-body">
                <form id="" class="form" @submit.prevent="submit">
                  <div class="row">
                    <InputComponent
                      id="name"
                      type="text"
                      label="Property Name"
                      @input="generateSlug(false)"
                      :isRequired="true"
                      :error="form.errors.name"
                      v-model="form.name"
                    />
                    <InputComponent
                      id="slug"
                      type="text"
                      label="Slug"
                      @input="generateSlug(true)"
                      :isRequired="true"
                      :error="form.errors.slug"
                      v-model="form.slug"
                    />
                    <TextAreaComponent
                      id="description"
                      label="Description"
                      :error="form.errors.description"
                      v-model="form.description"
                    />
                    <SelectInputComponent
                      id="type"
                      label="Type"
                      :error="form.errors.type"
                      :options="types"
                      :isRequired="true"
                      v-model="form.type"
                    />
                    <SelectInputComponent
                      id="destination"
                      label="Destination"
                      :error="form.errors.destination"
                      :options="destinations"
                      v-model="form.destination"
                    />
                    <SelectInputComponent
                      id="amenity"
                      label="Amenities"
                      :error="form.errors.amenities"
                      :isMultiple="true"
                      :options="amenities"
                      v-model="form.amenities"
                    />
                    <InputComponent
                      id="assigned_user"
                      type="text"
                      label="Assigned Users"
                      :isRequired="false"
                      :isMultiple="true"
                      :error="form.errors.assigned_users"
                      v-model="form.assigned_users"
                    />
                    <!-- <SelectInputComponent
                        id="partner"
                        label="Partner"
                        :error="form.errors.partners"
                        :options="partners"
                        :isRequired="true"
                        v-model="form.partners"
                      /> -->
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
                    <SelectInputComponent
                      id="partner"
                      label="Partner"
                      :error="form.errors.partner_id"
                      :options="partners"
                      v-model="form.partner_id"
                    />
                    <InputComponent
                      id="video"
                      type="text"
                      label="Youtube Video URL"
                      :isRequired="true"
                      :error="form.errors.video"
                      v-model="form.video"
                    />
                    <InputComponent
                      id="stars"
                      type="number"
                      label="Property Stars"
                      :isRequired="true"
                      :error="form.errors.stars"
                      v-model="form.stars"
                    />
                    
                    <div class="mb-3 col-md-6">
                      <label for="image" class="form-label me-3">Logo</label>
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
                      {{ data ? "Update" : "Save" }}
                    </button>
                  </div>
                </form>
              </div>
            </TabPanel>
            <TabPanel
              addClass=""
              id="navs-top-gallery"
              title="Properties"
              subtitle="Manage Gallery Images"
            >
              <div class="col-12">
                <div class="card-body">
                  <form class="form-repeater featured-images">
                    <div class="row">
                      <InputComponent
                        id="gallery_title"
                        type="text"
                        label="Title"
                        :isRequired="false"
                        :error="form.errors.gallery_title"
                        v-model="feturedImage.title"
                      />
                      <div class="mb-3 col-md-6">
                        <label for="image" class="form-label me-3"
                          >Featured Images</label
                        >
                        <br />
                        <!-- <FileInputComponent
                          id="gallery"
                          :prvImage="propertyLogo"
                          v-model="form.gallery"
                        /> -->
                        <div class="multi-file-upload">
                          <div
                            class="drop-area"
                            @dragover="handleDragOver"
                            @drop="handleDrop"
                          >
                            <ul>
                              <li
                                v-for="image in featuredImages"
                                :key="image.id"
                              >
                                <div class="remove-image">
                                  <i
                                    class="fa fa-times"
                                    @click="deleteImage(image.id)"
                                  ></i>
                                </div>
                                <img
                                  :src="image.original_url"
                                  :alt="image.id"
                                  style="
                                    width: 80px;
                                    height: 80px;
                                    object-fit: cover;
                                  "
                                />
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="row"
                      v-for="(gallery, index) in galleryImages.gallery"
                      :key="index"
                    >
                      <InputComponent
                        :id="'gallery_title_' + index"
                        type="text"
                        label="Title"
                        :isRequired="false"
                        v-model="galleryImages.gallery[index].title"
                      />
                      <div class="mb-3 col-md-6">
                        <label for="image" class="form-label me-3"
                          >Images</label
                        >
                        <br />
                        <div class="multi-file-upload">
                          <div
                            class="drop-area"
                            @dragover="handleDragOver"
                            @drop="($event) => handleDropGallery($event, index)"
                          >
                            <ul>
                              <li
                                v-for="image in galleryImages.gallery[index]
                                  .preImages"
                                :key="image.id"
                              >
                                <div class="remove-image">
                                  <i
                                    class="fa fa-times"
                                    @click="deleteImage(image.id)"
                                  ></i>
                                </div>
                                <img
                                  :src="image.original_url"
                                  :alt="image.id"
                                  style="
                                    width: 80px;
                                    height: 80px;
                                    object-fit: cover;
                                  "
                                />
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary" @click="addGallery">
                      Add Gallery
                    </button>
                  </form>
                </div>
              </div>
            </TabPanel>
            <TabPanel
              addClass=""
              id="navs-top-contact"
              title="Properties"
              subtitle="Manage Property Contact Details"
            >
              <div class="card-body">
                <form id="" class="form" @submit.prevent="submit">
                  <div class="row">
                    <InputComponent
                      id="email"
                      type="email"
                      label="Email"
                      :isRequired="true"
                      :error="form.errors.email"
                      v-model="form.email"
                    />
                    <InputComponent
                      id="phone"
                      type="text"
                      label="Contact No 1"
                      :isRequired="true"
                      :error="form.errors.contact_no"
                      v-model="form.contact_no"
                    />
                    <InputComponent
                      id="reservation_phone"
                      type="text"
                      label="Contact No 2"
                      :isRequired="false"
                      :error="form.errors.contact_2"
                      v-model="form.contact_2"
                    />
                    <InputComponent
                      id="address_1"
                      type="text"
                      label="Address Line 1"
                      :isRequired="true"
                      :error="form.errors.address"
                      v-model="form.address"
                    />
                    <InputComponent
                      id="address_2"
                      type="text"
                      label="Address Line 2"
                      :isRequired="false"
                      :error="form.errors.address_2"
                      v-model="form.address_2"
                    />
                    <!-- <InputComponent
                      id="country"
                      type="text"
                      label="Country"
                      :isRequired="false"
                      :error="form.errors.country"
                      v-model="form.country"
                    /> -->
                    <InputComponent
                      id="fax"
                      type="text"
                      label="Fax"
                      :isRequired="false"
                      :error="form.errors.fax"
                      v-model="form.fax"
                    />
                    <TextAreaComponent
                      id="map_location"
                      label="Map Location"
                      :error="form.errors.map_location"
                      v-model="form.map_location"
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
            </TabPanel>
            <TabPanel
              addClass=""
              id="navs-top-policy"
              title="Properties"
              subtitle="Manage Property Plicies"
            >
              <div class="card-body">
                <form id="" class="form" @submit.prevent="submit">
                  <h5></h5>
                  <div class="row">
                    <TinyMceEditor
                      api-key="vw4ubmg1a3lka0446gbr2zl6hoyieci6cv2wpw8czi7giive"
                      :init="{
                        height: 500,
                        menubar: false,
                        plugins: [
                          'advlist autolink lists link image charmap print preview anchor',
                          'searchreplace visualblocks code fullscreen',
                          'insertdatetime media table paste code help wordcount',
                        ],
                        toolbar:
                          'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help',
                      }"
                      v-model="form.policy"
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
            </TabPanel>
            <TabPanel
              addClass=""
              id="navs-top-configurations"
              title="Properties"
              subtitle="Manage Property Configurations"
            >
              <div class="card-body">
                <form id="" class="form" @submit.prevent="submit">
                  <h5>Partial Pay</h5>
                  <div class="row">
                    <SelectInputComponent
                      id="partial_pay_type"
                      label="Type"
                      :error="form.errors.partial_pay_type"
                      :options="[
                        {
                          id: 'amount',
                          name: 'Amount',
                        },
                        {
                          id: 'percentage',
                          name: 'Percentage',
                        },
                      ]"
                      v-model="form.partial_pay_type"
                    />
                    <InputComponent
                      id="partial_pay"
                      type="number"
                      label="Partial Pay"
                      :isRequired="false"
                      :error="form.errors.partial_pay"
                      v-model="form.partial_pay"
                    />
                  </div>
                  <h5 class="mt-3">Currencies</h5>
                  <div class="row">
                    <SelectInputComponent
                      id="base_currency"
                      label="Base Currency"
                      :error="form.errors.base_currency"
                      :options="currencies"
                      v-model="form.base_currency"
                    />
                    <SelectInputComponent
                      id="secondary_currency"
                      label="Secondary Currency"
                      :error="form.errors.secondary_currency"
                      :options="currencies"
                      v-model="form.secondary_currency"
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
            </TabPanel>
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
import TextAreaComponent from "../../Components/TextAreaComponent.vue";
import TabPane from "../../Components/TabPane.vue";
import TabPanel from "../../Components/TabPanel.vue";
import { Inertia } from "@inertiajs/inertia";
import TinyMceEditor from "@tinymce/tinymce-vue";
import { reactive  } from "vue";

export default {
  components: {
    Link,
    AppLayout,
    TabPane,
    TabPanel,
    InputComponent,
    FileInputComponent,
    SelectInputComponent,
    TextAreaComponent,
    TinyMceEditor,
  },
  props: {
    types: Array,
    destinations: Array,
    amenities: Array,
    data: Object,
    partners: Array,
    currencies:Array,
  },
  data() {
    return {
      form: useForm({
        id: "",
        name: "",
        slug: "",
        description: "",
        type: "",
        destination: "",
        amenities: [],
        assigned_users: "",
        video:"",
        stars:0,
        image: "",
        status: "",
        email: "",
        contact_no: "",
        contact_2: "",
        address: "",
        address_2: "",
        country: "",
        fax: "",
        map_location: "",
        partial_pay_type: "",
        partial_pay: 0,
        policy: "",
        partner_id: "", // Add partner field
        base_currency:"",
        secondary_currency:"",
      }),
      feturedImage: useForm({
        id: "",
        title: "featured",
        images: [],
      }),
      featuredImages: [],
      galleryImages: useForm({
        id: "",
        gallery: Array(),
        displayImages: [],
      }),
    };
  },
  watch:{
    'form.stars'(newValue) {
      // Ensure the value is between 0 and 5
      if (newValue < 0 || newValue > 5) {
        this.form.errors.stars = 'Please enter a value between 0 and 5.';
      } else {
        this.form.errors.stars = null;
      }
    },
  },
  mounted() {
    if (this.data) {
      this.form.id = this.data.id;
      this.form.name = this.data.name;
      this.form.slug = this.data.slug;
      this.form.description = this.data.description;
      this.form.type = this.data.property_type_id;
      this.form.destination = this.data.destination_id;
      this.form.amenities = this.data?.amenities?.map((i) => i.id);
      this.form.status = this.data.status;
      this.form.video = this.data.video_url;
      this.form.stars = this.data.stars;
      this.form.email = this.data.email;
      this.form.contact_no = this.data.contact_1;
      this.form.contact_2 = this.data.contact_2;
      this.form.address = this.data.address_1;
      this.form.address_2 = this.data.address_2;
      this.form.country = this.data.country_id;
      this.form.fax = this.data.fax;
      this.form.map_location = this.data.map_location;
      this.form.partial_pay_type = this.data.partial_pay_type;
      this.form.partial_pay = this.data.partial_pay_amount;
      this.form.partner_id = this.data?.partner_id;
      this.form.policy = this.data.hotel_policy;
      this.form.base_currency = this.data.currencies.find(c => c.pivot.default == 1)?.id;
      this.form.secondary_currency = this.data.currencies.find(c => c.pivot.default == 0)?.id;

      // Populate the partner field
      this.form.partner = this.data.id;
      this.feturedImage.id = this.data.id;
      this.galleryImages.id = this.data.id;

      this.featuredImages = this.data?.media.filter((el) =>
        el.custom_properties.hasOwnProperty("category")
          ? el.custom_properties.category == "featured"
          : false
      );
      var galleryImages = this?.data.media
        .filter(
          (i) =>
            i.custom_properties.category != "featured" &&
            i.custom_properties.category
        )
        .reduce((g, i) => {
          const { custom_properties } = i;

          g[custom_properties.category] = g[custom_properties.category] ?? [];
          g[custom_properties.category].push(i);
          return g;
        }, {});

      Object.keys(galleryImages ?? {}).forEach((key, i) => {
        var gallery = { title: key, images: [], preImages: galleryImages[key] };
        this.galleryImages.gallery.push(gallery);
      });
    }
  },
  updated() {
    if (this.data) {
      this.featuredImages = this.data?.media.filter((el) =>
        el.custom_properties.hasOwnProperty("category")
          ? el.custom_properties.category == "featured"
          : false
      );

      var galleryImages = this?.data.media
        .filter(
          (i) =>
            i.custom_properties.category != "featured" &&
            i.custom_properties.category
        )
        .reduce((g, i) => {
          const { custom_properties } = i;

          g[custom_properties.category] = g[custom_properties.category] ?? [];
          g[custom_properties.category].push(i);
          return g;
        }, {});
      this.galleryImages.gallery = [];
      Object.keys(galleryImages ?? {}).forEach((key, i) => {
        var gallery = { title: key, images: [], preImages: galleryImages[key] };
        this.galleryImages.gallery.push(gallery);
      });
    }
  },
  computed: {
    prvImage() {
      return this.data ? this.data?.image ?? "" : "";
    },
  },
  methods: {
    generateSlug(focus = false) {
      if (focus) {
        this.form.slug = this.form.slug
          .toLowerCase()
          .replace(/[^a-z0-9\s]+/g, "-")
          // .replace(/\s+/g, '-')
          .replace(/^-+|-+$/g, "")
          .replace(" ", "-"); // Remove leading/trailing hyphens
      } else {
        this.form.slug = this.form.name
          .toLowerCase()
          .replace(/[^a-z0-9]+/g, "-")
          .replace(/^-+|-+$/g, ""); // Remove leading/trailing hyphens
      }
    },
    submit() {
      this.form.post(
        this.data ? route("properties.update") : route("properties.store"),
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
    handleDragOver(event) {
      event.preventDefault();
    },
    handleDrop(event) {
      event.preventDefault();
      const files = event.dataTransfer.files;
      this.uploadFiles(files);
    },
    handleDropGallery(event, index) {
      event.preventDefault();
      const files = event.dataTransfer.files;
      this.uploadFilesGallery(files, index);
    },
    uploadFiles(files) {
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        file.previewURL = URL.createObjectURL(file);
        this.feturedImage.images.push(files[i]);

        // You can perform additional actions like uploading files to a server
      }
      this.feturedImage.post(route("properties.upload.gallery"), {
        // errorBag: "updateProfileInformation",
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
          this.feturedImage.reset("images");
          Inertia.reload({ preserveScroll: true });
          this.$root.showMessage(
            "success",
            '<span class="text-success">Success</span><br/>',
            "Image(s) Uploded Successfully! "
          );
        },
      });
    },
    uploadFilesGallery(files, index) {
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        file.previewURL = URL.createObjectURL(file);
        this.galleryImages.gallery[index].images.push(files[i]);
      }
      this.galleryImages.post(route("properties.upload.gallery"), {
        preserveScroll: true,
        forceFormData: true,
        only: ["data"],
        onSuccess: () => {
          this.galleryImages.reset("gallery");
          Inertia.reload({ preserveScroll: true });
          this.$root.showMessage(
            "success",
            '<span class="text-success">Success</span><br/>',
            "Image(s) Uploded Successfully! "
          );
        },
      });
    },
    deleteImage(id) {
      Inertia.post(route("properties.delete.gallery", id), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
          // this.feturedImage.reset("images");
          Inertia.reload({
            preserveScroll: true,
          });
          this.$root.showMessage(
            "success",
            '<span class="text-success">Success</span><br/>',
            "Image Deleted Successfully! "
          );
        },
      });
    },
    addGallery() {
      var gallery = { title: "", images: [] };
      this.galleryImages.gallery.push(gallery);
    },
  },
  beforeDestroy() {
    // Clean up the preview URLs when the component is destroyed
    for (let i = 0; i < this.uploadedFiles.length; i++) {
      URL.revokeObjectURL(this.uploadedFiles[i].previewURL);
    }
  },
};
</script>
