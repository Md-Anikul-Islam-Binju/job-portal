<script>
export default {
    name: "Footer",
    props:{
        siteSetting: Object
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
    },

}

</script>
<template>
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="footer_logo">
                              <img :src="getLogoUrl(siteSetting?.logo)" alt="Logo" height="100">
                            </div>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a :href="siteSetting.facebook_link">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a :href="siteSetting.linkedin_link">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".4s">


                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".5s">
                            <h3 v-if="locale === 'en'" class="footer_title">Company</h3>
                            <h3 v-else class="footer_title">কোম্পানি </h3>
                            <ul>
                                <li>
                                    <Link  href="/about-us">
                                        <b v-if="locale === 'en'">About Us</b>
                                        <b v-else>আমাদের সম্পর্কে</b>
                                    </Link>
                                </li>
                                <li>
                                    <Link  href="/terms-condition">
                                        <b v-if="locale === 'en'">Terms & Condition</b>
                                        <b v-else>শর্তাবলী</b>
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".6s">
                            <h3 v-if="locale === 'en'" class="footer_title">
                                Subscribe
                            </h3>
                            <h3 v-else class="footer_title">
                                সাবস্ক্রিভেশন
                            </h3>
                            <form action="#" class="newsletter_form">
                                <input type="text" placeholder="Enter your mail">
                                <button type="submit">Subscribe</button>
                            </form>
                            <p v-if="locale === 'en'" class="newsletter_text">Please Connect with Us</p>
                            <p v-else class="newsletter_text">আমাদের সাথে সংযোগ করুন</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".3s">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            Copyright 2024 All rights reserved <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#" target="_blank">CoderNetix</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>

</style>
