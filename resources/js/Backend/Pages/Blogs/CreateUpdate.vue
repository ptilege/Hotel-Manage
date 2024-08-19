<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="nav-align-top mb-4">
          <div class="tab-content">
            <TabPanel
              addClass="show active"
              id="navs-top-general"
              title="Blogs"
              subtitle="Manage Blogs Details"
            >
              <div class="card-body">
                <form id="blogForm" class="form" @submit.prevent="submit" enctype="multipart/form-data">
                  <div class="row">
                    <InputComponent
                      id="title"
                      type="text"
                      label="Title"
                      :isRequired="true"
                      :error="form.errors.title"
                      v-model="form.title"
                    />
                    <!-- <TextAreaComponent
                      id="description"
                      type="text"
                      label="Description"
                      :error="form.errors.description"
                      v-model="form.description"
                    /> -->
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
                  v-model="form.description"
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

                    <SelectInputComponent
                      id="status"
                      label="Status"
                      :error="form.errors.status"
                      :options="[
                        {
                          id: 'active',
                          name: 'Active',
                        },
                        {
                          id: 'inactive',
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
import { reactive } from "vue";


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
    errors: Object,
    data: Object,
  },

  data() {
    return {
      form: useForm({
        id: "",
        title: "",
        description: "",
        image: "",
        status: "active",
      }),
    };
  },

  mounted() {
    if (this.data) {
      this.form.id = this.data.id;
      this.form.title = this.data.title;
      this.form.description = this.data.description;
      
      this.form.status = this.data.status;
    }
  },
  computed: {
    prvImage() {
      if(this.data && this.data.media) {
        console.log(this.data);
        let fImage = this.data?.media.filter(i => i.collection_name == 'Blog')
        return fImage.length > 0 ? fImage[0].original_url : '';
      } else {
        return '';
      }

      // return this.data ? this.data?.media.filter(i => i.collection_name == 'Room') : "";
    },
  },

  methods: {
    async submit() {
      try {
        await this.form.post(
          this.data ? route("blogs.update") : route("blogs.store"),
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
              this.$root.showMessage(
                "error",
                '<span class="text-danger">Error</span><br>',
                "Something went wrong! "
              );
            },
          }
        );
      } catch (error) {
        console.error("Form submission error:", error);
      }
    },
  },
};
</script>