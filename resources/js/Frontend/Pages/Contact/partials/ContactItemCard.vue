<template>
    <div class="contact-item">
        <span class="contact-icon">
            <i :class="iconClass"></i>
        </span>
        <div class="contact-info">
            <h3>{{ title }}</h3>
            <slot />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            required: true,
        },
        iconClass: {
            type: String,
            required: true,
        },
    },
};
</script>

<style></style>
