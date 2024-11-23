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
                                        <img :src="getLogoUrl(siteSetting?.logo)" alt="">
                                    </Link>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li>
                                                <Link href="/">
                                                    <b>{{ locale === 'en' ? 'Home' : 'হোম' }}</b>
                                                </Link>
                                            </li>
                                            <li>
                                                <Link href="/about-us">
                                                    <b>{{ locale === 'en' ? 'About Us' : 'আমাদের সম্পর্কে' }}</b>
                                                </Link>
                                            </li>

                                            <li>
                                                <Link href="/job-board">
                                                    <b>{{ locale === 'en' ? 'Browse Job' : 'জব' }}</b>
                                                </Link>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <b>{{ locale === 'en' ? 'Page' : 'পেজ' }}</b>
                                                    <i class="ti-angle-down"></i>
                                                </a>
                                                <ul class="submenu">
                                                    <li>
                                                        <Link href="/blog">
                                                            <b>{{ locale === 'en' ? 'Blog' : 'ব্লগ' }}</b>
                                                        </Link>
                                                    </li>
                                                    <li>
                                                        <Link href="/terms-condition">
                                                            <b>{{ locale === 'en' ? 'Terms & Condition' : 'শর্তাবলী' }}</b>
                                                        </Link>
                                                    </li>
                                                    <li>
                                                        <Link href="/loginn">
                                                            <b>{{ locale === 'en' ? 'SignUp / SignIn' : 'লগইন/রেজিস্ট্রেশন' }}</b>
                                                        </Link>
                                                    </li>
                                                    <li>
                                                        <Link href="/company-registration-start">
                                                            <b>{{ locale === 'en' ? 'Company Join ' : 'কোম্পানি যোগদান' }}</b>
                                                        </Link>
                                                    </li>

                                                    <li>
                                                        <a @click="changeLanguage(locale === 'en' ? 'bn' : 'en')">
                                                            <b>{{ locale === 'en' ? 'বাংলা' : 'English' }}</b>
                                                        </a>
                                                    </li>



                                                </ul>
                                            </li>

                                            <li>
                                                <Link href="/contact">
                                                    <b>{{ locale === 'en' ? 'Contact Us' : 'যোগাযোগ' }}</b>
                                                </Link>
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
                                            <span>{{ locale === 'en' ? 'SignUp / SignIn ' : 'লগইন/রেজিস্ট্রেশন' }}</span>
                                        </a>
                                    </div>



                                    <div>
                                        <a class="btn btn-warning mr-2" href="/company-registration-start" target="_blank">
                                            <span>{{ locale === 'en' ? 'Company ' : 'কোম্পানি' }}</span>
                                        </a>
                                    </div>
                                    <div>
                                        <a class="btn btn-dark" @click="changeLanguage(locale === 'en' ? 'bn' : 'en')">
                                            <b>{{ locale === 'en' ? 'বাংলা' : 'English' }}</b>
                                        </a>
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





