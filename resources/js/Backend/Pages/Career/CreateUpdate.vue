<template>
    <AppLayout>
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h5>Careers</h5>
              <p>Manage Careers.</p>
            </div>
            <hr />
            <div class="card-body">
              <form id="" class="form" @submit.prevent="submit">
                <div class="row">
                  <InputComponent
                    id="title"
                    type="text"
                    label="Title"
                    :isRequired="true"
                    :error="form.errors.title"
                    v-model="form.title"
                  />
                  <InputComponent
                    id="location"
                    type="text"
                    label="Location"
                    :isRequired="true"
                    :error="form.errors.location"
                    v-model="form.location"
                  />
                  <TextAreaComponent
                    id="job_description"
                    type="text"
                    label="Job Description"
                    :isRequired="true"
                    :error="form.errors.job_description"
                    v-model="form.job_description"
                  />
                  <TextAreaComponent
                    id="about_role"
                    type="text"
                    label="About Role"
                    :isRequired="true"
                    :error="form.errors.about_role"
                    v-model="form.about_role"
                    :placeholder="'Enter About Role with ,  Ex:- Design and Develop, Trableshooting, .. '"
                  />
                  <TextAreaComponent
                    id="about_you"
                    type="text"
                    label="About You"
                    :isRequired="true"
                    :error="form.errors.about_you"
                    v-model="form.about_you"
                    :placeholder="'Enter About You with ,  Ex:- 3+ Experience, Related Degree, .. '"
                  />
                  <TextAreaComponent
                    id="iframe_link"
                    type="text"
                    label="Form Iframe"
                    :isRequired="true"
                    :error="form.errors.iframe_link"
                    v-model="form.iframe_link"
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
  import FileInputComponent from '../../Components/FileInputComponent.vue';
  import TextAreaComponent from "../../Components/TextAreaComponent.vue";
  export default {
    components: {
      Link,
      AppLayout,
      InputComponent,
      SelectInputComponent,
      FileInputComponent,
      TextAreaComponent,
    },
    props: {
      data: Object,
    },
    data() {
      return {
        form: useForm({
          id:"",
          title: "",
          location: "",
          job_description:"",
          about_role:"",
          about_you:"",
          iframe_link:"",
          status: "",
        }),
      };
    },
    computed: {
  
    },
    mounted() {
      if (this.data) {
        this.form.id = this.data.id;
        this.form.title = this.data.title;
        this.form.location = this.data.location;
        this.form.job_description = this.data.job_description;
        this.form.about_role = this.data.about_role;
        this.form.about_you = this.data.about_you;
        this.form.iframe_link = this.data.iframe_link;
        this.form.status = this.data.status;
      }
    },
    methods: {
      submit() {
        this.form.post(
          this.data
            ? route("careers.update")
            : route("careers.store"),
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
  