<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Destinations</h5>
            <p>Manage Destinations.</p>
          </div>
          <hr />
          <div class="card-body">
            <form id="" class="form" @submit.prevent="submit">
              <div class="row">
                <InputComponent
                  id="name"
                  type="text"
                  label="Name"
                  :error="form.errors.name"
                  v-model="form.name"
                  @input="slugify($event)"
                />
                <InputComponent
                  id="slug"
                  type="text"
                  label="Slug"
                  :error="form.errors.slug"
                  v-model="form.slug"
                  @input="slugify($event)"
                />
                <TextAreaComponent
                  id="description"
                  type="text"
                  label="Description"
                  :error="form.errors.description"
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
                  id="activities"
                  label="Select Activities"
                  :error="form.errors.activities"
                  :options="activities"
                  v-model="form.activities"
                  :isMultiple="true"
                />
                <SelectInputComponent
                  id="features"
                  label="Select Destination Features"
                  :error="form.errors.features"
                  :options="features"
                  v-model="form.features"
                  :isMultiple="true"
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
import FileInputComponent from "@/Components/FileInputComponent.vue";
import InputComponent from "@/Components/InputComponent.vue";
import SelectInputComponent from "@/Components/SelectInputComponent.vue";
import TextAreaComponent from "../../Components/TextAreaComponent.vue";
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
    data:Object,
    activities: Array,
    features: Array,
  },
  data() {
    return {
      form: useForm({
        id:"",
        name: "",
        slug: "",
        description: "",
        activities: [],
        features: [],
        image: "",
        status: "" 
        }),
    };
  },
  mounted() {
    if (this.data) {
      this.form.id = this.data.id;
      this.form.name = this.data.name;
      this.form.slug = this.data.slug;
      this.form.description = this.data.description;
      this.form.activities = this.data?.activities?.map((i)=>i.id);
      this.form.features = this.data?.destination_features?.map((i)=>i.id);
      this.form.status = this.data.status;
    }
  },
    computed: {
    prvImage() {
      return this.data ? this.data?.image ?? "" : "";
    },
  },
  methods: {
    slugify(e) {
      var text = e.target.value;
      console.log(text);
      const a = "àáäâèéëêìíïîòóöôùúüûñçßÿỳýœæŕśńṕẃǵǹḿǘẍźḧ";
      const b = "aaaaeeeeiiiioooouuuuncsyyyoarsnpwgnmuxzh";
      const p = new RegExp(a.split("").join("|"), "g");
      this.form.slug = text
        .toString()
        .toLowerCase()
        .replace(/[\s_]+/g, "-")
        .replace(p, (c) => b.charAt(a.indexOf(c)))
        .replace(/&/g, `-and-`)
        .replace(/[^\w-]+/g, "")
        .replace(/--+/g, "-")
        .replace(/^-+|-+$/g, "");
    },
    submit() {
      this.form.post(
        this.data
          ? route("destinations.update")
          : route("destinations.store"),
        {
          onSuccess: () => {
            this.form.reset();
            this.$root.showMessage(
              "success",
              '<span class="text-success">Success</span><br/>',
              this.data ? "A Record Was Updated Successfully! " : "A Record Was Created Successfully! "
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
