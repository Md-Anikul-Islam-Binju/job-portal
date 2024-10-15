<script>
export default {
    name: "Navbar",
    data() {
        return {
            locale: localStorage.getItem('locale') || 'bn'  // Default to Bengali if no locale is stored
        };
    },
    methods: {
        changeLanguage(lang) {
            this.locale = lang;
            localStorage.setItem('locale', lang);
            window.location.reload();  // Reload the page to reflect the language change
        }
    }
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
                                    <img src="frontend/img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li>
                                            <a href="index.html">
                                                <span v-if="locale === 'en'">Home</span>
                                                <span v-else>হোম</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="jobs.html">
                                                <span v-if="locale === 'en'">Job</span>
                                                <span v-else>জব</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="contact.html">
                                                <span v-if="locale === 'en'">Contact</span>
                                                <span v-else>যোগাযোগ</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span v-if="locale === 'en'">Page</span>
                                                <span v-else>পেজ</span>
                                                <i class="ti-angle-down"></i>
                                            </a>
                                            <ul class="submenu">
                                                <li>
                                                    <a href="candidate.html">
                                                        <span v-if="locale === 'en'">Service</span>
                                                        <span v-else>সেবা</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="job_details.html">
                                                        <span v-if="locale === 'en'">FAQ</span>
                                                        <span v-else>প্রশ্নাবলী</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>


                                    </ul>
                                </nav>
                            </div>
                        </div>


                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">
                                    <div class="d-none d-lg-block">
                                        <a class="btn btn-success" href="#">
                                            <span v-if="locale === 'en'">Log in</span>
                                            <span v-else>লগ ইন করুন</span>
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





