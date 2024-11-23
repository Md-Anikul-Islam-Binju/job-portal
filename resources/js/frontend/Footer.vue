<script>
import QrcodeVue from 'qrcode.vue';

export default {
    name: "Footer",
    components: {
        QrcodeVue,
    },
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
                                <Link href="/">
                                    <img :src="getLogoUrl(siteSetting?.logo)" alt="">
                                </Link>
                            </div>
                            <p>
                                {{ siteSetting.email }} <br>
                                {{ siteSetting.phone }} <br>
                                {{ siteSetting.address }}
                            </p>
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
                                    <li>
                                        <a :href="siteSetting.youtube_link">
                                            <i class="fa fa-youtube"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".4s">
                            <h3 class="footer_title">
                                {{ locale === 'en' ? 'Important Link' : 'গুরুত্বপূর্ণ লিঙ্ক' }}
                            </h3>
                            <ul>
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

                            </ul>

                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".5s">
                            <h3 class="footer_title">
                                {{ locale === 'en' ? 'Important Link' : 'গুরুত্বপূর্ণ লিঙ্ক' }}
                            </h3>
                            <ul>
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
                                    <Link href="/login">
                                        <b>{{ locale === 'en' ? 'SignUp / SignIn' : 'লগইন/রেজিস্ট্রেশন' }}</b>
                                    </Link>
                                </li>
                                <li>
                                    <Link href="/company-registration-start">
                                        <b>{{ locale === 'en' ? 'Company Join' : 'কোম্পানি যোগদান' }}</b>
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".6s">
                            <h3 class="footer_title">
                                {{ locale === 'en' ? 'Scan The QR cODE & Download The App' : 'QR কোড স্ক্যান করুন এবং অ্যাপটি ডাউনলোড করুন' }}
                            </h3>
                            <QrcodeVue :value="siteSetting.site_link" :size="100" class="qr-code" />
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
                            Copyright All rights reserved | This is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://www.facebook.com/BDBhawalIT/" target="_blank">Bhawal Tech Ltd</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>
.qr-code {
    margin-left: 155px;
}
</style>
