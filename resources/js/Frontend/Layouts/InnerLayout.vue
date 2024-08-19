<template>
    <div class="page-wrapper">
        <NavBar />
        <div class="content-wrapper">
            <Breadcrumb :title="title">
                <slot name="breadcrumb" />
            </Breadcrumb>
            <section class="contact-us-wrap ptb-100">
                <div class="container">
                    <slot />
                </div>
            </section>
        </div>
        <FooterBar />
    </div>
    <a href="javascript:void(0)" @click="backToTop()" class="back-to-top bounce"
        ><i class="ri-arrow-up-s-line"></i
    ></a>
</template>

<script>
import NavBar from "@@/Layouts/Partials/NavBar";
import Breadcrumb from "@@/Layouts/Partials/Breadcrumb";
import FooterBar from "@@/Layouts/Partials/FooterBar";

export default {
    components: {
        NavBar,
        Breadcrumb,
        FooterBar,
    },
    props: {
        title: {
            type: String,
            required: true,
        },
    },
    mounted() {
        var sticky = $(".header-wrap");
        $(window).on("scroll", function () {
            var scroll = $(window).scrollTop();
            if (scroll < 100) {
                sticky.removeClass("sticky");
            } else {
                sticky.addClass("sticky");
            }
        });

        $(window).on("resize", function () {
            if ($(window).width() <= 1199) {
                $(".collapse.navbar-collapse").removeClass("collapse");
            } else {
                $(".navbar-collapse").addClass("collapse");
            }
        });
    },
    methods: {
        backToTop() {
            $(".back-to-top").on("click", function () {
                $("html, body").animate(
                    {
                        scrollTop: 0,
                    },
                    100
                );
                return false;
            });
            $(document).scroll(function () {
                var y = $(this).scrollTop();
                if (y > 600) {
                    $(".back-to-top").fadeIn();
                    $(".back-to-top").addClass("open");
                } else {
                    $(".back-to-top").fadeOut();
                    $(".back-to-top").removeClass("open");
                }
            });
        },
    },
};
</script>

<style></style>
