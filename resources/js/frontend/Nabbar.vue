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
                                        <li><a href="index.html">home</a></li>
                                        <li><a href="jobs.html">Browse Job</a></li>
                                        <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="candidate.html">Candidates </a></li>
                                                <li><a href="job_details.html">job details </a></li>
                                                <li><a href="elements.html">elements</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="contact.html">
                                                <span v-if="locale === 'en'">Contact</span>
                                                <span v-else>যোগাযোগ</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="Appointment">
                                <div class="phone_num d-none d-xl-block">
                                    <a href="#">Log in</a>
                                </div>
                                <div class="d-none d-lg-block">
                                    <a class="boxed-btn3" href="#">
                                        <span v-if="locale === 'en'">Job</span>
                                        <span v-else>চাকরি</span>
                                    </a>
                                </div>
                                <!-- Language Switcher -->
                                <div class="language_switcher">
                                    <button @click="changeLanguage('en')">English</button> |
                                    <button @click="changeLanguage('bn')">বাংলা</button>
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

<style scoped>
.language_switcher button {
    background: none;
    border: none;
    cursor: pointer;
    color: #333;
    margin-right: 10px;
}
</style>
