<template>
    <InnerLayout title="How It Works">
        <template #breadcrumb>
            <li><Link href="/">Home </Link></li>
            <li>How It Works</li>
        </template>

        <div class="row align-items-center pb-100">
            <div class="col-md-6">
                <div class="hw-card style2">
                    <div class="hw-img">
                        <img
                            src="assets/img/how-it-works/hw-shape-2.png"
                            alt="Image"
                            class="hw-shape-one"
                        />
                        <img
                            src="assets/img/how-it-works/hw-1.png"
                            alt="Image"
                        />
                        <span>01</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="content-title style1">
                    <h2>Search &amp; Select</h2>
                    <p>
                        Best Strategic planning dolor sit amet consectetur
                        adipiscing elit. Scel erus isque ametus odio velit
                        auctor nam elit nulla eget sodales dui pulvinar. Best
                        strategic planning dolor sit sectetur morethe.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor sodales dui pulvina amet.
                    </p>
                </div>
            </div>
        </div>

        <div class="row align-items-center pb-100">
            <div class="col-md-6 order-md-1 order-2">
                <div class="content-title style1">
                    <h2>Reserve The Property</h2>
                    <p>
                        Best Strategic planning dolor sit amet consectetur
                        adipiscing elit. Scel erus isque ametus odio velit
                        auctor nam elit nulla eget sodales dui pulvinar. Best
                        strategic planning dolor sit sectetur morethe.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor sodales dui pulvina amet.
                    </p>
                </div>
            </div>
            <div class="col-md-6 order-md-2 order-1">
                <div class="hw-card style2">
                    <div class="hw-img">
                        <img
                            src="assets/img/how-it-works/hw-shape-2.png"
                            alt="Image"
                            class="hw-shape-one"
                        />
                        <img
                            src="assets/img/how-it-works/hw-2.png"
                            alt="Image"
                        />
                        <span>02</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-center pb-100">
            <div class="col-md-6">
                <div class="hw-card style2">
                    <div class="hw-img">
                        <img
                            src="assets/img/how-it-works/hw-shape-2.png"
                            alt="Image"
                            class="hw-shape-one"
                        />
                        <img
                            src="assets/img/how-it-works/hw-3.png"
                            alt="Image"
                        />
                        <span>03</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="content-title style1">
                    <h2>Confirm Reservation</h2>
                    <p>
                        Best Strategic planning dolor sit amet consectetur
                        adipiscing elit. Scel erus isque ametus odio velit
                        auctor nam elit nulla eget sodales dui pulvinar. Best
                        strategic planning dolor sit sectetur morethe.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        sed do eiusmod tempor sodales dui pulvina amet.
                    </p>
                </div>
            </div>
        </div>
    </InnerLayout>
</template>

<script>
import InnerLayout from "@@/Layouts/InnerLayout";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        InnerLayout,
        Link,
    },
};
</script>

<style></style>
