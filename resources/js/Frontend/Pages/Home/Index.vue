<template>
    <AppLayout>
        <section class="hero-wrap style2">
            <div class="container-fluid">
                <div class="hero-slider-one owl-carousel">
                    <div class="hero-slide-item hero-slide-1 bg-f">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-8 col-sm-10">
                                    <div class="hero-content">
                                        <h1>
                                            Modern Urban Lofts with
                                            <span
                                                >Modern<img
                                                    src="frontend/img/hero/hero-shape-2.png"
                                                    alt="Image"
                                            /></span>
                                            Amenities
                                        </h1>
                                        <p>
                                            Proin gravida nibh vel velit auctor
                                            aliquet aenean sollicitudin lorem
                                            quis bibendum auct nisi elit
                                            consequat ipsum nec sagittis sem
                                            nibh elit.
                                        </p>
                                        <a href="about.html" class="btn style2"
                                            >Learn More</a
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-slide-item hero-slide-2 bg-f">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-8 col-sm-10">
                                    <div class="hero-content">
                                        <h1>
                                            Modern Urban Lofts with
                                            <span
                                                >Modern<img
                                                    src="frontend/img/hero/hero-shape-2.png"
                                                    alt="Image"
                                            /></span>
                                            Amenities
                                        </h1>
                                        <p>
                                            Proin gravida nibh vel velit auctor
                                            aliquet aenean sollicitudin lorem
                                            quis bibendum auct nisi elit
                                            consequat ipsum nec sagittis sem
                                            nibh elit.
                                        </p>
                                        <a href="about.html" class="btn style2"
                                            >Learn More</a
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-slide-item hero-slide-3 bg-f">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-8 col-sm-10">
                                    <div class="hero-content">
                                        <h1>
                                            Modern Urban Lofts with
                                            <span
                                                >Modern<img
                                                    src="frontend/img/hero/hero-shape-2.png"
                                                    alt="Image"
                                            /></span>
                                            Amenities
                                        </h1>
                                        <p>
                                            Proin gravida nibh vel velit auctor
                                            aliquet aenean sollicitudin lorem
                                            quis bibendum auct nisi elit
                                            consequat ipsum nec sagittis sem
                                            nibh elit.
                                        </p>
                                        <a href="about.html" class="btn style2"
                                            >Learn More</a
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script>
import AppLayout from "@@/Layouts/AppLayout";

export default {
    components: {
        AppLayout,
    },
    props: {
        categories: {
            type: Object,
        },
        locations: Object,
        services: Object,
    },
    data() {
        return {
            form: {},
            vr: "",
        };
    },
    mounted() {
        let self = this;
        $(".hero-slider-one").owlCarousel({
            nav: true,
            dots: false,
            loop: true,
            margin: 20,
            items: 1,
            navText: [
                '<i class="flaticon-back"></i>',
                '<i class="flaticon-next-1"></i>',
            ],
            thumbs: false,
            smartSpeed: 1300,
            autoplay: false,
            autoplayTimeout: 4000,
            autoplayHoverPause: false,
            responsiveClass: true,
            autoHeight: true,
        });
        
        $(".select2").select2();

        // Hotels Check In Date
        $(".date-range-picker").daterangepicker({
            singleDatePicker: true,
            autoApply: true,
            minDate: moment(),
            autoUpdateInput: false,
        });

        $(".date-range-picker").on(
            "apply.daterangepicker",
            function (evt, picker) {
                $("#" + evt.target.id).val(
                    picker.startDate.format("DD-MM-YYYY")
                );
                let varName = $(evt.target).data("field-name");
                self.form[varName] = $(evt.target).val();
            }
        );

        $(".booking-search-form").on("change", function (evt) {
            let varName = $(evt.target).data("field-name");
            self.form[varName] = $(evt.target).val();
        });

        if (this.categories && this.categories.length > 0) {
            let formField = JSON.parse(this.categories[0].search_form);
            if (formField && formField.length > 0) {
                formField.forEach((el) => {
                    this.form[el.field.variable] = "";
                });
            }
        }
    },
    methods: {
        onCategoryChange(category) {
            this.$data.form = {};
            // if (this.categories && this.categories.length > 0) {
            let formField = JSON.parse(category.search_form);
            if (formField && formField.length > 0) {
                formField.forEach((el) => {
                    if (typeof el.field.variable == "object") {
                        console.log(el.field.variable);
                        el.field.variable.forEach((i) => {
                            this.form[i] = "";
                        });
                    } else {
                        this.form[el.field.variable] = "";
                    }
                });
            }
            // }
        },
        submit(category) {
            this.$inertia.visit(route("search.list", category.slug), {
                method: "get",
                data: { category: category.slug, ...this.$data.form },
            });
        },
    },
};
</script>

<style></style>
