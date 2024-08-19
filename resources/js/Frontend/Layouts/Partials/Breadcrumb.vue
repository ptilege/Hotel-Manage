<template>
    <div class="breadcrumb-wrap bg-f br-2">
        <div class="container">
            <div class="breadcrumb-title">
                <h2>{{title}}</h2>
                <ul class="breadcrumb-menu list-style">
                    <slot></slot>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title:{
            type:String,
            required:true,
        },
    }
};
</script>

<style></style>
