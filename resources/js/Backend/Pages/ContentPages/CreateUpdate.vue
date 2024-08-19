<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Default Hotel Policy</h5>
            <p>Manage Default Hotel Policy.</p>
          </div>
          <hr />
          <div class="card-body">
            <form id="" class="form" @submit.prevent="submit">
              <div class="row">
                <TinyMceEditor
                api-key="no-api-key"
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
import TinyMceEditor from "@tinymce/tinymce-vue";
export default {
  components: {
    Link,
    AppLayout,
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
        policy:""
      }),
    };
  },
  mounted() {
    let self = this;
    // if (this.data) {
      this.form.policy = this.data.value;
    // }
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
route("property.policy.update"),
        {
          onSuccess: () => {
            // this.form.reset();
            this.$root.showMessage(
              "success",
              '<span class="text-success">Success</span><br/>',
              this.data
                ? "A Record Was Updated Successfully! "
                : "A Record Was Created Successfully! "
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
