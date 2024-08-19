<template>
    <header class="header-wrap style1">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <NavBarLogo />
                <div
                    class="collapse navbar-collapse main-menu-wrap"
                    id="navbarSupportedContent"
                >
                    <div class="menu-close d-lg-none">
                        <a href="javascript:void(0)">
                            <i class="ri-close-line"></i
                        ></a>
                    </div>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Home
                                <i class="ri-add-line"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="index.html" class="nav-link"
                                        >Home One</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a href="index-2.html" class="nav-link"
                                        >Home Two</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a href="index-3.html" class="nav-link"
                                        >Home Three</a
                                    >
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="about.html" class="nav-link"> About Us </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Listings
                                <i class="ri-add-line"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="listings-one.html" class="nav-link"
                                        >Listing Style One
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="listings-two.html" class="nav-link"
                                        >Listing Style Two
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a
                                        href="listing-details.html"
                                        class="nav-link"
                                        >Single Listings</a
                                    >
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Agents
                                <i class="ri-add-line"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="agents.html" class="nav-link"
                                        >Agent List</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        href="agent-details.html"
                                        class="nav-link"
                                        >Agent Details</a
                                    >
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Pages
                                <i class="ri-add-line"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="how-it-works.html" class="nav-link"
                                        >How It Works</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a href="faq.html" class="nav-link">FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="testimonials.html" class="nav-link"
                                        >Testimonials</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        href="terms-of-service.html"
                                        class="nav-link"
                                        >Terms of Service</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        href="privacy-policy.html"
                                        class="nav-link"
                                        >Privacy Policy</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a href="error-404.html" class="nav-link"
                                        >404 Error Page</a
                                    >
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Blog
                                <i class="ri-add-line"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="blog.html" class="nav-link">
                                        Blog
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Single Blog
                                        <i class="ri-add-line"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a
                                                href="blog-details-no-sidebar.html"
                                                class="nav-link"
                                                >Blog Details No Sidebar</a
                                            >
                                        </li>
                                        <li class="nav-item">
                                            <a
                                                href="blog-details-left-sidebar.html"
                                                class="nav-link"
                                                >Blog Details Left Sidebar</a
                                            >
                                        </li>
                                        <li class="nav-item">
                                            <a
                                                href="blog-details-right-sidebar.html"
                                                class="nav-link"
                                                >Blog Details Right Sidebar</a
                                            >
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="contact.html" class="nav-link active"
                                >Contact Us</a
                            >
                        </li>
                        <li class="nav-item d-lg-none">
                            <button
                                type="button"
                                class="btn style3"
                                data-bs-toggle="modal"
                                data-bs-target="#signIn"
                            >
                                Sign In
                            </button>
                        </li>
                        <li class="nav-item d-lg-none">
                            <button
                                type="button"
                                class="btn style1"
                                data-bs-toggle="modal"
                                data-bs-target="#signUp"
                            >
                                Sign Up
                            </button>
                        </li>
                    </ul>
                    <div class="others-options md-none">
                        <div class="header-btn">
                            <button
                                type="button"
                                class="btn style3"
                                data-bs-toggle="modal"
                                data-bs-target="#signIn"
                            >
                                Sign In
                            </button>
                            <button
                                type="button"
                                class="btn style1"
                                data-bs-toggle="modal"
                                data-bs-target="#signUp"
                            >
                                Sign Up
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="mobile-bar-wrap">
                <div class="mobile-menu d-lg-none">
                    <a href="javascript:void(0)"
                        ><i class="ri-menu-line"></i
                    ></a>
                </div>
            </div>
        </div>
    </header>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import NavBarLogo from "./NavBarLogo.vue";
export default {
    components: {
        Link,
        NavBarLogo,
    },

    data() {
        return {};
    },
    created() {},
    mounted() {
        $(".mobile-menu a").on("click", function () {
            $(".main-menu-wrap").addClass("open");
            $(".collapse.navbar-collapse").removeClass("collapse");
        });
        $(".mobile_menu a").on("click", function () {
            $(this).parent().toggleClass("open");
            $(".main-menu-wrap").toggleClass("open");
        });
        $(".menu-close").on("click", function () {
            $(".main-menu-wrap").removeClass("open");
        });
        $(".mobile-top-bar").on("click", function () {
            $(".header-top").addClass("open");
        });
        $(".close-header-top button").on("click", function () {
            $(".header-top").removeClass("open");
        });
        var $offcanvasNav = $(".navbar-nav"),
            $offcanvasNavSubMenu = $offcanvasNav.find(".dropdown-menu");
        $offcanvasNavSubMenu
            .parent()
            .prepend(
                '<span class="menu-expand"><i class="ri-arrow-down-s-line"></i></span>'
            );
        $offcanvasNavSubMenu.slideUp();
        $offcanvasNav.on("click", "li a, li .menu-expand", function (e) {
            var $this = $(this);
            if ($this.attr("href") === "#" || $this.hasClass("menu-expand")) {
                e.preventDefault();
                if ($this.siblings("ul:visible").length) {
                    $this.siblings("ul").slideUp("slow");
                } else {
                    $this
                        .closest("li")
                        .siblings("li")
                        .find("ul:visible")
                        .slideUp("slow");
                    $this.siblings("ul").slideDown("slow");
                }
            }
            if (
                $this.is("a") ||
                $this.is("span") ||
                $this.attr("class").match(/\b(menu-expand)\b/)
            ) {
                $this.parent().toggleClass("menu-open");
            } else if (
                $this.is("li") &&
                $this.attr("class").match(/\b('dropdown-menu')\b/)
            ) {
                $this.toggleClass("menu-open");
            }
        });
    },
    computed: {},
    methods: {
        logout() {
            console.log("logout");
            this.$inertia.post(route("logout"));
        },
    },
};
</script>

<style scoped>
.sidebar-toggle-icon {
    width: 2rem;
    height: 2rem;
}
</style>
