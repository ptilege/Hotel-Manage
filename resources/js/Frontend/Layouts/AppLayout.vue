<template>
    <div class="page-wrapper">
        <NavBar />
        <div class="content-wrapper">
            <slot />
        </div>
        <FooterBar />
    </div>
    <a href="javascript:void(0)" @click="backToTop()" class="back-to-top bounce"
        ><i class="ri-arrow-up-s-line"></i
    ></a>
</template>

<script>
import NavBar from "@@/Layouts/Partials/NavBar";
import FooterBar from "@@/Layouts/Partials/FooterBar";

export default {
    components: {
        NavBar,
        FooterBar,
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
