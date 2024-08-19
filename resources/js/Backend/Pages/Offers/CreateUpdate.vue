<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Offers</h5>
            <p>Manage Offers.</p>
          </div>
          <hr />
          <div class="card-body">
            <form id class="form" @submit.prevent="submit">
              <div class="row align-items-center">
                <SelectInputComponent
                  id="offer_type"
                  label="Select offer type"
                  :error="form.errors.type"
                  :options="types"
                  v-model="form.offer_type"
                />
              </div>

              <hr />
              <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                  <TabPane addClass="active" title="General" target="navs-top-general" />
                  <TabPane addClass title="Offer Price" target="navs-top-price" />
                  <TabPane addClass title="Condition" target="navs-top-conditions" />
                </ul>
                <div class="tab-content">
                  <TabPanel addClass="show active" id="navs-top-general" title subtitle>
                    <div class="row">

                      <InputComponent
                        id="name"
                        type="text"
                        label="Name"
                        :isRequired="true"
                        :error="form.errors.name"
                        v-model="form.name"
                      />

                      <TextAreaComponentVue
                        id="description"
                        label="description"
                        :isRequired="false"
                        :error="form.errors.description"
                        v-model="form.description"
                      />

                      <SelectInputComponent
                        id="room_type"
                        label="Room Type"
                        :isRequired="true"
                        :isMultiple="true"
                        :error="form.errors.room_type"
                        :options="room_types"
                        v-model="form.room_type"
                      />

                      <SelectInputComponent
                        id="meal_type"
                        label="Meal Type"
                        :isRequired="true"
                        :isMultiple="true"
                        :error="form.errors.meal_type"
                        :options="mealTypes"
                        v-model="form.meal_type"
                      />

                      <SelectInputComponent
                        id="bed_type"
                        label="Bed Type"
                        :isRequired="true"
                        :isMultiple="true"
                        :error="form.errors.bed_type"
                        :options="bedTypes"
                        v-model="form.bed_type"
                      />   

                      <FileInputComponent
                        id="image"
                        label="image"
                        :isRequired="false"
                        :prvImage="prvImage"
                        :error="form.errors.image"
                        v-model="form.image"
                      />                   
                      
                      <SelectInputComponent
                        id="is_featured"
                        label="Featured Status"
                        :error="form.errors.is_featured"
                        :options="[
                          {
                            id: 1,
                            name: 'Featured',
                          },
                          {
                            id: 0,
                            name: 'Not Featured',
                          },
                        ]"
                        v-model="form.is_featured"
                      />

                      <InputComponent
                        id="code"
                        type="text"
                        label="Offer Code"
                        :isRequired="false"
                        :error="form.errors.code"
                        v-model="form.code"
                      />

                      <InputComponent
                        id="max"
                        type="text"
                        label="Max Usage"
                        :isRequired="false"
                        :error="form.errors.max"
                        v-model="form.max"
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
                  </TabPanel>
                  <TabPanel addClass id="navs-top-price" title subtitle>
                    <div class="row">

                      <SelectInputComponent
                        id="base_rate"
                        label="Base Rate"
                        :error="form.errors.base_rate"
                        :options="baseRates"
                        v-model="form.base_rate"
                       
                      />
                      <SelectInputComponent
                        id="rate_type"
                        label="Local Rate Change Type"
                        :error="form.errors.rate_type"
                        :options="[
                        { id: 'add_amount', name: 'Add to base rate by amount' },
                        { id: 'add_percentage', name: 'Add to base rate by percentage' },
                        { id: 'reduce_amount', name: 'Reduce to base rate by amount' },
                        { id: 'reduce_percentage', name: 'Reduce to base rate by percentage' },
                        ]"
                        v-model="form.rate_type"
                      />

                      <InputComponent
                        id="local_price"
                        type="number"
                        label="Value ( Local Rate )"
                        :isRequired="false"
                        :error="form.errors.local_price"
                        v-model="form.local_price"
                      />

                      <InputComponent
                        id="foreign_price"
                        type="number"
                        label="Value ( Foreign Rate )"
                        :isRequired="false"
                        :error="form.errors.foreign_price"
                        v-model="form.foreign_price"
                       
                      />
                    </div>
                  </TabPanel>
                  <TabPanel addClass id="navs-top-conditions" title subtitle>
                    <div class="row">
                      <InputComponent
                        id="from_date"
                        type="date"
                        label="From Date"
                        :error="form.errors.from_date"
                        v-model="form.from_date"
                       
                      />
                      <InputComponent
                        id="to_date"
                        type="date"
                        label="To Date"
                        :error="form.errors.to_date"
                        v-model="form.to_date"
                       
                      />
                    </div>
                  </TabPanel>
                </div>
              </div>
              <div class="mt-2">
                <button
                  type="submit"
                  class="btn btn-primary me-2"
                  :disabled="form.processing"
                >{{ offer ? "Update" : "Save" }}</button>
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
import TabPane from "../../Components/TabPane.vue";
import TabPanel from "../../Components/TabPanel.vue";
import TextAreaComponentVue from "../../Components/TextAreaComponent.vue";

export default {
  components: {
    Link,
    AppLayout,
    InputComponent,
    FileInputComponent,
    SelectInputComponent,
    TabPane,
    TabPanel,
    TextAreaComponentVue
  },
  props: {
    errors: Object,
    offer: Object,
    types: Object,
    room_types: Object,
    mealTypes: Object,
    bedTypes: Object,
    baseRates: Object,

  },
  data() {
    return {
      form: useForm({ 
        id: "",
        offer_type: "",
        name: "",
        description: "",
        room_type: "",
        meal_type: "",
        bed_type: "",
        image: "",
        is_featured: "",
        code: "",
        max: "",
        status: "",
        base_rate: "",
        rate_type: "",
        local_price: "",
        foreign_price: "",
        from_date: "",
        to_date: "",
    })
    };
  },
  
  mounted() {
    let self = this;
    if (this.offer) {
        this.form.id = this.offer.id;
        this.form.offer_type = this.offer.type;
        this.form.name = this.offer.name;
        this.form.description = this.offer.description;
        this.form.room_type = JSON.parse(this.offer.room_type_id);
        this.form.meal_type = JSON.parse(this.offer.meal_type_id);
        this.form.bed_type = JSON.parse(this.offer.bed_type_id);
        // this.form.image = this.offer.;
        this.form.is_featured = this.offer.is_featured;
        this.form.code = this.offer.offer_code;
        this.form.max = this.offer.max_usage;
        this.form.status = this.offer.status;
        this.form.base_rate = this.offer.rate_id;
        this.form.rate_type = this.offer.rate_type;
        this.form.local_price = this.offer.local_price;
        this.form.foreign_price = this.offer.foreign_price;
        this.form.from_date = this.offer.from_date;
        this.form.to_date = this.offer.to_date;
    }
  },
  computed: {
    prvImage() {
      return this.offer ? this.offer?.image ?? "" : "";
    },
  },
  methods: {
    submit() {
      this.form.post(
        this.offer
          ? route("offer.update")
          : route("offer.store"),
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
          }
        }
      );
    }
  }
};
</script>
