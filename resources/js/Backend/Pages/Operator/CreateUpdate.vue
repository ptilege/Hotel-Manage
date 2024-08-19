<template>
    <AppLayout>
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h5>Operator</h5>
              <p>Manage Operators.</p>
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
                  <InputComponent
                    id="email"
                    type="email"
                    label="Email"
                    :isRequired="false"
                    :error="form.errors.email"
                    v-model="form.email"
                  />
                  <InputComponent
                    id="phone"
                    type="phone"
                    label="Mobile No"
                    :isRequired="false"
                    :error="form.errors.phone"
                    v-model="form.phone"
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
                  <InputComponent
                    id="password"
                    type="password"
                    label="Password"
                    :isRequired="false"
                    :error="form.errors.password"
                    v-model="form.password"
                  />
                  <InputComponent
                    id="cpassword"
                    type="password"
                    label="Confirm Password"
                    :isRequired="false"
                    :error="form.errors.cpassword"
                    v-model="form.cpassword"
                  />
                
                  <div class="mb-3 col-md-6">
                    <label for="image" class="form-label me-3">Profile Image</label>
                    <br />
  
                    <FileInputComponent
                      id="image"
                      :prvImage="prvImage"
                      v-model="form.image"
                    />
                    <div class="text-danger">{{ form.errors.image }}</div>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="certificate" class="form-label me-3">Tourism Certificate</label>
                    <br />
  
                    <FileInputComponent
                      id="certificate"
                     :prvImage="prvcertificate"
                      v-model="form.certificate"
                    />
                    <div class="text-danger">{{ form.errors.certificate }}</div>
                    <br />
                    <button
                    class="btn btn-secondary"
                    @click.prevent="openCertificateInNewTab"
                    v-if="data && prvcertificate"
                    >
                    Open
                    </button>
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
  export default {
    components: {
      Link,
      AppLayout,
      InputComponent,
      SelectInputComponent,
      FileInputComponent,
    },
    props: {
      data: Object,
    },
    data() {
      return {
        form: useForm({
          id:"",
          name: "",
          certificate:"",
          image:"",
          status: "",
        }),
      };
    },
    computed: {
      prvImage() {
        return this.data ? this.data?.media.find(e => e.collection_name == 'Operator')?.original_url: ''
      },
      prvcertificate() {
        return this.data ? this.data?.media.find(e => e.collection_name == 'Operatorcertificate')?.original_url: ''
      },
    },
    mounted() {
      if (this.data) {
        this.form.id = this.data.id;
        this.form.name = this.data.name;
        this.form.status = this.data.status;
      }
    },
    methods: {
        openCertificateInNewTab() {
      window.open(this.prvcertificate, '_blank');
    },
      submit() {
        this.form.post(
          this.data
            ? route("operators.update")
            : route("operators.store"),
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
  