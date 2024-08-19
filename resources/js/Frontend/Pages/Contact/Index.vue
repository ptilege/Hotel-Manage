<template>
    <InnerLayout title="Contact">
        <template #breadcrumb>
            <li><Link href="/">Home </Link></li>
            <li>Contact</li>
        </template>

        <div class="row justify-content-center pb-75">
            <div class="col-xl-4 col-lg-4 col-md-6">
                <ContactItemCard
                    title="Visit Us Anytime"
                    iconClass="flaticon-map"
                >
                    <p>
                        342/A Brooklyn St, Milson Avenue, <br />
                        New York, USA
                    </p>
                </ContactItemCard>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <ContactItemCard
                    title="Send An Email"
                    iconClass="flaticon-email-2"
                >
                    <a
                        href="/cdn-cgi/l/email-protection#533b363f3f3c1335363f327d303c3e"
                        ><span
                            class="__cf_email__"
                            data-cfemail="18707d747477587e7d7479367b7775"
                            >[email&#160;protected]</span
                        ></a
                    >
                    <a
                        href="/cdn-cgi/l/email-protection#61121411110e13152107040d004f020e0c"
                        ><span
                            class="__cf_email__"
                            data-cfemail="17646267677865635771727b763974787a"
                            >[email&#160;protected]</span
                        ></a
                    >
                </ContactItemCard>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <ContactItemCard
                    title="Call Center"
                    iconClass="flaticon-call-2"
                >
                    <a href="tel:88098787868">+44 587 154765</a>
                    <a href="tel:88098787869">+55 576 234532</a>
                </ContactItemCard>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="contact-content">
                    <div class="content-title style1">
                        <span>Contact Us</span>
                        <h2>How Can We Help You?</h2>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing
                            elit. Maiores pariatur a eius ea similique quod
                            dicta ipsa vel quidem repellendus, beatae nulla
                            veniam, quaerat veritatis architecto. Aliquid
                            doloremque nesciunt nobis, debitis, quas veniam
                            dolore culpa corrupti maxime cum similique.
                        </p>
                    </div>
                    <ul class="social-profile list-style style1">
                        <SocialIcons
                            link="https://facebook.com"
                            iconClass="ri-facebook-fill"
                        />
                        <SocialIcons
                            link="https://twitter.com"
                            iconClass="ri-twitter-fill"
                        />
                        <SocialIcons
                            link="https://instagram.com"
                            iconClass="ri-instagram-line"
                        />
                        <SocialIcons
                            link="https://linkedin.com"
                            iconClass="ri-linkedin-fill"
                        />
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <ContactForm />
            </div>
        </div>
    </InnerLayout>
</template>

<script>
import InnerLayout from "@@/Layouts/InnerLayout";
import { Link } from "@inertiajs/inertia-vue3";
import ContactItemCard from "./partials/ContactItemCard";
import SocialIcons from "./partials/SocialIcons";
import ContactForm from "./partials/ContactForm";
export default {
    components: {
        InnerLayout,
        Link,
        ContactItemCard,
        SocialIcons,
        ContactForm,
    },
};
</script>

<style></style>
