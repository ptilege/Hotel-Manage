<template>
  <div class="form-check text-2 custom-control custom-checkbox">
    <input
      :id="id"
      name="remember"
      class="custom-control-input"
      type="checkbox"
      v-model="model"
    />
    <label class="custom-control-label" :for="id"
      >{{ label }}</label
    >
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