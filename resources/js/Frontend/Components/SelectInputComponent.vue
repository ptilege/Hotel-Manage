<template>
  <div class="form-row">
    <div class="col-lg-12 form-group">
      <select :id="id" class="custom-select select2">
        <option selected="selected" value="">{{ label }}</option>
      <option :value="option.id" v-for="option in options" :key="option.id">
        {{ option.name }}
      </option>
      </select>
      <span class="icon-inside"><i class="fas fa-map-marker-alt"></i></span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: true,
    },
    options: {
      type: Array,
      default: [],
    },
    modelValue: {
      default: "",
    },
  },
  data() {
    return {
      model: this.modelValue,
    };
  },
  mounted() {
    var thisFn = this;
    $(".form.form-horizontal").on("change", "#" + thisFn.id, function (evt) {
      thisFn.$emit("update:modelValue", $(evt.target).val());
    });

    $('.select2').select2();
  },
  watch: {
    modelValue(currentValue) {
      this.model = currentValue;
    },
  },
};
</script>

<style>
.select2-container--default .select2-selection--single{
   padding: 0.7rem 0.96rem;
    height: 50px;
    font-size: 1.2em;  
    position: relative;
    outline:none;
}
.select2-search__field:focus-visible {
  outline: none;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
  display:none
}
</style>