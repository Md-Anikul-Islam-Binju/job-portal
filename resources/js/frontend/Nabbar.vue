<script>
export default {
    name: "Navbar",
    props: {
        siteSetting: Object,
        auth: Object
    },
    data() {
        return {
            locale: localStorage.getItem('locale') || 'bn'
        };
    },
    methods: {
        getLogoUrl(logoPath) {
            if (!logoPath) {
                return 'default-logo.png';
            }
            return `${window.location.origin}/${logoPath}`;
        },

        changeLanguage(lang) {
            this.locale = lang;
            localStorage.setItem('locale', lang);
            window.location.reload();
        },
        redirectToDashboard() {
            window.location.href = "/user/dashboard";
        }
    },
}
</script>

<template>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid ">
                <div class="header_bottom_border">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo">
                                <a href="index.html">
<!--                                    <img :src="siteSetting?.logo || 'default-logo.png'" alt="Logo" height="100">-->

                                    <img :src="getLogoUrl(siteSetting?.logo)" alt="Logo" height="100">


                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation" >
                                        <li>
                                            <Link href="/">
                                                <span style="color: orangered" v-if="locale === 'en'">Home</span>
                                                <span style="color: orangered" v-else>হোম</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link href="/job-board">
                                                <span style="color: orangered" v-if="locale === 'en'">Job</span>
                                                <span style="color: orangered" v-else>জব</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link href="/contact">
                                                <span style="color: orangered" v-if="locale === 'en'">Contact</span>
                                                <span style="color: orangered" v-else>যোগাযোগ</span>
                                            </Link>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span style="color: orangered" v-if="locale === 'en'">Page</span>
                                                <span style="color: orangered" v-else>পেজ</span>
                                                <i class="ti-angle-down ml-1"></i>
                                            </a>
                                            <ul class="submenu">
                                                <li>
                                                    <Link href="/about-us">
                                                        <span style="color: orangered" v-if="locale === 'en'">About Us</span>
                                                        <span style="color: orangered" v-else>আমাদের সম্পর্কে</span>
                                                    </Link>
                                                </li>
                                                <li>
                                                    <Link href="/terms-condition">
                                                        <span style="color: orangered" v-if="locale === 'en'">Terms & Condition</span>
                                                        <span style="color: orangered" v-else>শর্তাবলী</span>
                                                    </Link>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="Appointment">
                                <div v-if="auth && auth.role === 'user'">
                                    <a @click="redirectToDashboard" class="btn btn-success mr-2">
                                        {{ auth.name }}
                                    </a>
                                </div>
                                <div v-else>
                                    <a href="/login" class="btn btn-success mr-2">
                                        <span v-if="locale === 'en'">Login / Registration</span>
                                        <span v-else>লগইন/রেজিস্ট্রেশন করুন</span>
                                    </a>
                                </div>

                                <div>
                                    <button class="btn btn-dark" @click="changeLanguage(locale === 'en' ? 'bn' : 'en')">
                                        <span v-if="locale === 'en'">বাংলা</span>
                                        <span v-else>English</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>





