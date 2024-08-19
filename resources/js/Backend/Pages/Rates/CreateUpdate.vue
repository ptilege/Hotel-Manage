<template>
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h5>Rates</h5>
            <p>Manage Rates.</p>
          </div>
          <hr />
          <div class="card-body">
            <div class="row align-items-center">
            <SelectInputComponent
              id="plan_type"
              label="Select rate plan type"
              :error="form.errors.plan_type"
              :options="[
                { id: 'base', name: 'Base Plan' },
                { id: 'normal', name: 'Normal Plan' },
              ]"
              v-model="form.plan_type"
            />
            <div class="col-md-6" style="color:red;font-size: 25px;font-weight: 600;" v-if="form.plan_type == 'normal'">LKR {{selectedBaseRate? selectedBaseRate.price : 0}} - USD {{selectedBaseRate? selectedBaseRate.foreign_price : 0}}</div>
            </div>

            <hr />
            <form id="" class="form" @submit.prevent="submit">
              <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                  <TabPane
                    addClass="active"
                    title="General"
                    target="navs-top-general"
                  />
                  <TabPane
                    addClass=""
                    title="Price & Condition"
                    target="navs-top-price"
                  />
                </ul>
                <div class="tab-content">
                  <TabPanel
                    addClass="show active"
                    id="navs-top-general"
                    title=""
                    subtitle=""
                  >
                    <div class="row">
                      <InputComponent
                        id="name"
                        type="text"
                        label="Name"
                        :className="
                          form.plan_type == 'base' || form.plan_type == ''
                            ? 'mb-3 col-12'
                            : 'mb-3 col-md-6'
                        "
                        :isRequired="true"
                        :error="form.errors.name"
                        v-model="planName"
                        :disabled="true"
                      />
                      <SelectInputComponent
                        id="base_rate"
                        label="Base Rate"
                        :error="form.errors.base_rate"
                        :options="baseRates"
                        v-model="form.base_rate"
                        v-if="form.plan_type == 'normal'"
                      />
                      <SelectInputComponent
                        id="room_type"
                        label="Room Type"
                        :error="form.errors.room_type"
                        :options="rooms"
                        v-model="form.room_type"
                      />
                      <SelectInputComponent
                        id="meal_type"
                        label="Meal Type"
                        :error="form.errors.meal_type"
                        :options="mealTypes"
                        v-model="form.meal_type"
                      />
                      <SelectInputComponent
                        id="bed_type"
                        label="Bed Type"
                        :error="form.errors.bed_type"
                        :options="bedTypes"
                        v-model="form.bed_type"
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
                  <TabPanel
                    addClass=""
                    id="navs-top-price"
                    title=""
                    subtitle=""
                  >
                    <div class="row">
                      <h5 v-if="form.plan_type == 'base'">Condition</h5>
                      <InputComponent
                        id="from_date"
                        type="date"
                        label="From Date"
                        :error="form.errors.from_date"
                        v-model="form.from_date"
                        v-if="form.plan_type == 'base'"
                      />
                      <InputComponent
                        id="to_date"
                        type="date"
                        label="To Date"
                        :error="form.errors.to_date"
                        v-model="form.to_date"
                        v-if="form.plan_type == 'base'"
                      />
                      <h5 class="py-2">Price</h5>
                      <SelectInputComponent
                        id="price_per"
                        label="Price Per"
                        :error="form.errors.price_per"
                        :options="[{ id: 'per_booking', name: 'Per Booking' }]"
                        v-model="form.price_per"
                        v-if="form.plan_type == 'base'"
                      />
                      <SelectInputComponent
                        id="price_per"
                        label="Local Rate Change Type"
                        :error="form.errors.price_per"
                        :options="[
                        { id: 'add_amount', name: 'Add to base rate by amount' },
                        { id: 'add_percentage', name: 'Add to base rate by percentage' },
                        { id: 'reduce_amount', name: 'Reduce to base rate by amount' },
                        { id: 'reduce_percentage', name: 'Reduce to base rate by percentage' },
                        ]"
                        v-model="form.price_per"
                        v-if="form.plan_type == 'normal'"
                      />
                      <InputComponent
                        id="local_price"
                        type="number"
                        label="Local Price"
                        :error="form.errors.local_price"
                        v-model="form.local_price"
                      />
                      <InputComponent
                        id="local_price_extra_person"
                        type="number"
                        label="Extra Person ( Local Rate )"
                        :error="form.errors.local_price_extra_person"
                        v-model="form.local_price_extra_person"
                        v-if="form.plan_type == 'base'"
                      />
                      <InputComponent
                        id="local_price_extra_child"
                        type="number"
                        label="Child Rate (Local Rate)"
                        :error="form.errors.local_price_extra_child"
                        v-model="form.local_price_extra_child"
                        v-if="form.plan_type == 'base'"
                      />
                      <SelectInputComponent
                        id="price_per_foreign"
                        label="Foreign Rate Change Type"
                        :error="form.errors.price_per_foreign"
                        :options="[
                        { id: 'add_amount', name: 'Add to base rate by amount' },
                        { id: 'add_percentage', name: 'Add to base rate by percentage' },
                        { id: 'reduce_amount', name: 'Reduce to base rate by amount' },
                        { id: 'reduce_percentage', name: 'Reduce to base rate by percentage' },
                        ]"
                        v-model="form.price_per_foreign"
                        v-if="form.plan_type == 'normal'"
                      />
                      <InputComponent
                        id="foreign_price"
                        type="number"
                        label="Foreign Price"
                        :error="form.errors.foreign_price"
                        v-model="form.foreign_price"
                      />
                      <InputComponent
                        id="foreign_price_extra_person"
                        type="number"
                        label="Extra Person (Foreign Rate )"
                        :error="form.errors.foreign_price_extra_person"
                        v-model="form.foreign_price_extra_person"
                        v-if="form.plan_type == 'base'"
                      />
                      <InputComponent
                        id="foreign_price_extra_child"
                        type="number"
                        label="Child Rate (Foreign Rate)"
                        :error="form.errors.foreign_price_extra_child"
                        v-model="form.foreign_price_extra_child"
                        v-if="form.plan_type == 'base'"
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
import TabPane from "../../Components/TabPane.vue";
import TabPanel from "../../Components/TabPanel.vue";
export default {
  components: {
    Link,
    AppLayout,
    InputComponent,
    FileInputComponent,
    SelectInputComponent,
    TextAreaComponent,
    TabPane,
    TabPanel,
  },
  props: {
    data: Object,
    mealTypes: Array,
    bedTypes: Array,
    rooms: Array,
    amenities: Array,
    policies: Array,
    baseRates: Array,
  },
  data() {
    return {
      form: useForm({
        id: "",
        name: "",
        plan_type: "",
        room_type: "",
        meal_type: "",
        bed_type: "",
        from_date: "",
        to_date: "",
        price_per: "",
        price_per_foreign:"",
        local_price: 0,
        local_price_extra_person: 0,
        local_price_extra_child: 0,
        foreign_price: 0,
        foreign_price_extra_person: 0,
        foreign_price_extra_child: 0,
        base_rate: "",
        status: "",
      }),
    };
  },
  updated() {
    // this.form.name = this.rooms.filter((el) => el.id == this.form.room_type).first().name;
  },
  mounted() {
    var self = this;
    if (this.data) {
      this.form.id = this.data.id;
      this.form.name = this.data.name;
      this.form.plan_type = this.data.type;
      this.form.room_type = this.data.room_id;
      this.form.meal_type = this.data.meal_type_id;
      this.form.bed_type = this.data.bed_type_id;
      this.form.from_date = this.data.from_date;
      this.form.to_date = this.data.to_date;
      this.form.price_per = this.data.price_per;
      this.form.price_per_foreign = this.data.price_per_foreign;
      this.form.local_price = this.data.price;
      this.form.base_rate = this.data.base_rate_id;
      this.form.local_price_extra_person = this.data.price_extra_person;
      this.form.local_price_extra_child = this.data.price_extra_child;
      this.form.foreign_price = this.data.foreign_price;
      this.form.foreign_price_extra_person = this.data.foreign_price_extra_person;
      this.form.foreign_price_extra_child = this.data.foreign_price_extra_child;
      this.form.status = this.data.status;
    }
  },
  computed:{
    planName() {
     var type = this.form.plan_type == 'base'?'Base Rate':'';
      var room = this.rooms?.find(el => el.id == this.form.room_type);
       var bed = this.bedTypes?.find(el => el.id == this.form.bed_type);
       var meal = this.mealTypes?.find(el => el.id == this.form.meal_type);
      //  console.log(type);
       this.form.name = type + ' - ' + (room ? room.name:'') + ' - ' + (bed?bed.name:'') + ' - ' + (meal?meal.name:'');
      return type + ' - ' + (room ? room.name:'') + ' - ' + (bed?bed.name:'') + ' - ' + (meal?meal.name:'');
    },
    selectedBaseRate() {
      var baseRate = this.baseRates.find(el => el.id == this.form.base_rate);

      return baseRate;
    }
  },
  methods: {
    submit() {
      this.form.name = this.planName;
      this.form.post(this.data ? route("rates.update") : route("rates.store"), {
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
        },
      });
    },
  },
};
</script>
