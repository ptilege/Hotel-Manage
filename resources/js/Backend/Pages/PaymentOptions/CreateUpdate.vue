<template>
    <AppLayout>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h5>Payment Options</h5>
                        <p>Manage Payment options.</p>
                    </div>
                    <hr />
                    <div class="card-body">
                        <form id="" class="form" @submit.prevent="submit">
                            <div class="row">
                                <SelectInputComponent
                                    id="payment-option"
                                    label="Select Gateway"
                                    :error="form.errors.option"
                                    :options="options"
                                    v-model="form.option"
                                />
                                <InputComponent
                                    id="name"
                                    type="text"
                                    label="Name"
                                    :error="form.errors.name"
                                    v-model="form.name"
                                />
                                <InputComponent
                                    id="description"
                                    type="text"
                                    label="Description"
                                    :isRequired="true"
                                    :error="form.errors.description"
                                    v-model="form.description"
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
                                <div v-if="form.option != 'bank-transfer'">
                                <hr>
                                <InputComponent
                                    id="key"
                                    type="text"
                                    label="Key"
                                    :error="form.errors.key"
                                    v-model="form.key"
                                /><InputComponent
                                    id="secret"
                                    type="text"
                                    label="Secret"
                                    :error="form.errors.secret"
                                    v-model="form.secret"
                                /><SelectInputComponent
                                    id="mode"
                                    label="Mode"
                                    :error="form.errors.mode"
                                    :options="[
                                        {
                                            id: 1,
                                            name: 'Sandbox',
                                        },
                                        {
                                            id: 0,
                                            name: 'Live',
                                        },
                                    ]"
                                    v-model="form.mode"
                                />
                                </div>
                            </div>
                            <div class="mt-2">
                                <button
                                    type="submit"
                                    class="btn btn-primary me-2"
                                    :disabled="form.processing"
                                >
                                    {{ paymentOption ? "Update" : "Save" }}
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
        options:Array,
        errors: Object,
        paymentOption: Object,
    },
    data() {
        return {
            form: useForm({
                id:"",
                name: "",
                description: "",
                option:"bank-transfer",
                key: "",
                secret: "",
                mode: "",
                status: "",
            }),
        };
    },
    mounted() {
        let self = this;
        if (this.paymentOption) {
            this.form.id = this.paymentOption.id;
            this.form.name = this.paymentOption.name;
            this.form.description = this.paymentOption.description;
            this.form.key = this.paymentOption.key;
            this.form.secret = this.paymentOption.secret;
            this.form.mode = this.paymentOption.is_test_mode;
            this.form.status = this.paymentOption.status;
        }
    },
    methods: {
        submit() {
            this.form.post(
                this.paymentOption
                    ? route("payment-options.update")
                    : route("payment-options.store"),
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
