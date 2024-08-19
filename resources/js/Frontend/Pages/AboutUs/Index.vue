<template>
    <InnerLayout title="About Us">
        <template #breadcrumb>
            <li><Link href="/">Home </Link></li>
            <li>About Us</li>
        </template>

        <section class="about-wrap style3 pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="section-title style2 text-center mb-40">
                            <span>ABOUT US</span>
                            <h2>Fela Awesome Story</h2>
                            <p>
                                Best Strategic planning dolor sit amet
                                consectetur adipiscing elit. Scel erus isque
                                ametus odio velit auctor nam elit nulla eget
                                sodales dui pulvinar. Best strategic planning
                                dolor sit sectetur.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="about-img-wrap">
                    <div class="row">
                        <div class="col-5">
                            <div class="about-bg-2 bg-f"></div>
                        </div>
                        <div class="col-4">
                            <div class="about-bg-3 bg-f"></div>
                        </div>
                        <div class="col-3">
                            <div class="about-bg-4 bg-f"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </InnerLayout>
</template>

<script>
import InnerLayout from "@@/Layouts/InnerLayout";
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components: {
        InnerLayout,
        Link,
    },
};
</script>

<style></style>
