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
                            <QrcodeVue :value="siteSetting.site_link" :size="100" class="qr-code" />
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
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".5s">
                            <h3 class="footer_title">
                                Important Link
                            </h3>
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
                            <img :src="getLogoUrl(siteSetting?.logo)" style="height: 70px;" alt="">

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
.qr-code {
    margin-left: 155px;
}
</style>
