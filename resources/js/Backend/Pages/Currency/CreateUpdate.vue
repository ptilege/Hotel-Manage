<template>
    <AppLayout>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h5>Currencies</h5>
                        <p>Manage Currencies.</p>
                    </div>
                    <hr />
                    <div class="card-body">
                        <form id="" class="form" @submit.prevent="submit">
                            <div class="row">
                                <InputComponent
                                    id="name"
                                    type="text"
                                    label="Currency Name"
                                    :error="form.errors.name"
                                    v-model="form.name"
                                />
                                <InputComponent
                                    id="symbol"
                                    type="text"
                                    label="Currency Symbol"
                                    :error="form.errors.symbol"
                                    v-model="form.symbol"
                                />
                                <InputComponent
                                    id="decimal_places"
                                    type="number"
                                    label="Decimal Places"
                                    min="2"
                                    :error="form.errors.decimal_places"
                                    v-model="form.decimal_places"
                                />
                                <SelectInputComponent
                                    id="symbol_pos"
                                    label="Symbol Position"
                                    :error="form.errors.symbol_pos"
                                    :options="[
                                        {
                                            id: 'before',
                                            name: 'Before (ex:$1.00)',
                                        },
                                        {
                                            id: 'after',
                                            name: 'After (ex:1.00$)',
                                        },
                                    ]"
                                    v-model="form.symbol_pos"
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
                            <div class="mt-2">
                                <button
                                    type="submit"
                                    class="btn btn-primary me-2"
                                    :disabled="form.processing"
                                >
                                    {{ currency ? "Update" : "Save" }}
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
        currency: Object,
    },

    data() {
        return {
            form: useForm({
                id: "",
                name: "",
                symbol: "",
                decimal_places: "",
                symbol_pos: "",
                status: "",
            }),
        };
    },
    mounted() {
        let self = this;

        if (this.currency) {
            this.form.id = this.currency.id;
            this.form.name = this.currency.name;
            this.form.symbol = this.currency.symbol;
            this.form.decimal_places = this.currency.decimal_places;
            this.form.symbol_pos = this.currency.symbol_pos;
            this.form.status = this.currency.status;
        }
    },
    methods: {
        submit() {
            this.form.post(
                this.currency
                    ? route("currencies.update")
                    : route("currencies.store"),
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
                        // this.form.reset("password", "password_confirmation");
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
