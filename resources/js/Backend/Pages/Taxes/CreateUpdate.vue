<template>
    <AppLayout>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h5>Taxes</h5>
                        <p>Manage Taxes.</p>
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
                                /><InputComponent
                                    id="value"
                                    type="number"
                                    label="Value"
                                    :error="form.errors.value"
                                    v-model="form.value"
                                /><SelectInputComponent
                                    id="is_amount"
                                    label="Type"
                                    :error="form.errors.is_amount"
                                    :options="[
                                        {
                                            id: 1,
                                            name: 'Amount',
                                        },
                                        {
                                            id: 0,
                                            name: 'Percentage',
                                        },
                                    ]"
                                    v-model="form.is_amount"
                                /><SelectInputComponent
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
                                    {{ tax ? "Update" : "Save" }}
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
export default {
    components: {
        Link,
        AppLayout,
        InputComponent,
        FileInputComponent,
        SelectInputComponent,
    },
    props: {
        errors: Object,
        tax: Object,
    },
    data() {
        return {
            form: useForm({id:"", name: "", value: "", is_amount: "", status: "" }),
        };
    },
    mounted() {
        let self = this;
        if (this.tax) {
            this.form.id = this.tax.id;
            this.form.name = this.tax.name;
            this.form.value = this.tax.value;
            this.form.is_amount = this.tax.is_amount;
            this.form.status = this.tax.status;
        }
    },
    methods: {
        submit() {
            this.form.post(
                this.tax
                    ? route("tax.update")
                    : route("tax.store"),
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
