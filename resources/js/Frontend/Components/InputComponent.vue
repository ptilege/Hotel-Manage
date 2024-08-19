<template>
  <div class="form-group">
    <label :for="id">{{ label }} <sup v-if="isRequired">*</sup> </label>
    <input
      :type="type"
      :id="id"
      :class="'form-control ' + classStr"
      :placeholder="label"
      v-model="model"
      required=""
    />
    <div class="text-danger">{{ error }}</div>
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
    type: {
      type: String,
      default: "text",
    },
    classStr: {
      type: String,
      default: "",
    },
    error: {
      type: String,
      default: "",
    },
    isRequired: {
      type: Boolean,
      default: false,
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
  watch: {
    model(currentValue) {
      this.$emit("update:modelValue", currentValue);
    },
    modelValue(currentValue) {
      this.model = currentValue;
    },
  },
};
</script>

<style>
</style>