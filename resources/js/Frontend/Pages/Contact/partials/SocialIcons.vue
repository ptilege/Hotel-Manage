<template>
    <li>
        <a target="_blank" :href="link">
            <i :class="iconClass"></i>
        </a>
    </li>
</template>

<script>
export default {
    props: {
        link: {
            type:String,
            required:true,
        },
        iconClass: {
            type:String,
            required:true,
        }
    }
};
</script>

<style></style>
