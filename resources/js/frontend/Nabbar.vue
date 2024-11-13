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
                                <Link href="/">
                                    <img :src="getLogoUrl(siteSetting?.logo)" alt="Logo" height="100">
                                </Link>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation" >
                                        <li>
                                            <Link href="/">
                                                <h5 style="color: orangered" v-if="locale === 'en'">Home</h5>
                                                <h5 style="color: orangered" v-else>হোম</h5>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link href="/job-board">
                                                <h5 style="color: orangered" v-if="locale === 'en'">Job</h5>
                                                <h5 style="color: orangered" v-else>জব</h5>
                                            </Link>
                                        </li>
                                        <li>
                                            <Link href="/contact">
                                                <h5 style="color: orangered" v-if="locale === 'en'">Contact Us</h5>
                                                <h5 style="color: orangered" v-else>যোগাযোগ</h5>
                                            </Link>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span style="color: orangered" v-if="locale === 'en'">Our Page</span>
                                                <span style="color: orangered" v-else>আমাদের পেজ</span>
                                                <i class="ti-angle-down ml-1"></i>
                                            </a>
                                            <ul class="submenu">
                                                <li>
                                                    <Link href="/blog">
                                                        <h5 style="color: orangered" v-if="locale === 'en'">Blog</h5>
                                                        <h5 style="color: orangered" v-else>ব্লগ</h5>
                                                    </Link>
                                                </li>
                                                <li>
                                                    <Link href="/about-us">
                                                        <h5 style="color: orangered" v-if="locale === 'en'">About Us</h5>
                                                        <h5 style="color: orangered" v-else>আমাদের সম্পর্কে</h5>
                                                    </Link>
                                                </li>
                                                <li>
                                                    <Link href="/terms-condition">
                                                        <h5 style="color: orangered" v-if="locale === 'en'">Terms & Condition</h5>
                                                        <h5 style="color: orangered" v-else>শর্তাবলী</h5>
                                                    </Link>
                                                </li>



                                                <li>
                                                    <Link href="/login">
                                                        <h5 style="color: orangered" v-if="locale === 'en'">Login / Registration</h5>
                                                        <h5 style="color: orangered" v-else>লগইন/রেজিস্ট্রেশন করুন</h5>
                                                    </Link>
                                                </li>

                                                <li>
                                                    <Link href="/company-registration-start">
                                                        <h5 style="color: orangered" v-if="locale === 'en'">Join Us</h5>
                                                        <h5 style="color: orangered" v-else>যোগদান করুন</h5>
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

                                        <span v-if="locale === 'en'"> {{ auth.name }}</span>
                                        <span v-else> {{ auth.name_bn }}</span>
                                    </a>
                                </div>
                                <div v-else>
                                    <a href="/login" class="btn btn-warning mr-2" target="_blank">
                                        <span v-if="locale === 'en'">Login / Registration</span>
                                        <span v-else>লগইন/রেজিস্ট্রেশন করুন</span>
                                    </a>
                                </div>

                                <div>
                                    <a href="/company-registration-start" class="btn btn-danger mr-2" target="_blank">
                                        <span v-if="locale === 'en'">Join Us</span>
                                        <span v-else>যোগদান করুন</span>
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





