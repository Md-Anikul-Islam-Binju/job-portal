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
    <footer class="footer-area">
        <div class="container">
            <div class="footer-content-wrap">
                <div class="footer-about">
                    <div class="footer-logo-area">
                        <Link href="/">
                            <img :src="getLogoUrl(siteSetting?.logo)" alt="">
                        </Link>
                    </div>
                    <p v-html="locale === 'en' ? siteSetting.short_description : siteSetting.short_description_bn"></p>

                    <ul>
                        <li>
                            <a :href="siteSetting.twitter_link" target="_blank">
                                <svg
                                    width="16"
                                    height="14"
                                    viewBox="0 0 16 14"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M15.9991 2.20027C15.3991 2.46565 14.7658 2.63151 14.0992 2.73103C14.7658 2.33296 15.2991 1.70269 15.5325 0.939726C14.8992 1.30462 14.1992 1.57 13.4326 1.73586C12.8326 1.10559 11.966 0.70752 11.0327 0.70752C9.23282 0.70752 7.76623 2.1671 7.76623 3.9584C7.76623 4.22378 7.79957 4.45599 7.86623 4.68819C5.16638 4.55551 2.73318 3.26179 1.09994 1.27145C0.833287 1.76903 0.666629 2.29979 0.666629 2.89689C0.666629 4.02475 1.23326 5.01992 2.13321 5.61702C1.59991 5.58385 1.09994 5.45116 0.633298 5.21895V5.25212C0.633298 6.84439 1.76657 8.17128 3.26648 8.46983C2.99983 8.53618 2.69985 8.56935 2.39987 8.56935C2.19988 8.56935 1.96656 8.53618 1.76657 8.50301C2.19988 9.79673 3.39981 10.7587 4.83306 10.7587C3.69979 11.6212 2.29987 12.152 0.766624 12.152C0.499972 12.152 0.23332 12.152 0 12.1188C1.46658 13.0476 3.16649 13.5784 5.03305 13.5784C11.066 13.5784 14.3659 8.60252 14.3659 4.29013C14.3659 4.15744 14.3659 3.99158 14.3659 3.85889C14.9992 3.42765 15.5658 2.86372 15.9991 2.20027Z"
                                        fill="currentColor"
                                    />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a :href="siteSetting.facebook_link" target="_blank">
                                <svg
                                    width="10"
                                    height="18"
                                    viewBox="0 0 10 18"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M3.01283 17.4824V9.56865H0.336914V6.48451H3.01283V4.21005C3.01283 1.57056 4.63268 0.133301 6.99859 0.133301C8.13188 0.133301 9.10589 0.217274 9.38974 0.254807V3.01323L7.74886 3.01398C6.46214 3.01398 6.213 3.62248 6.213 4.51543V6.48451H9.2817L8.88214 9.56865H6.213V17.4824H3.01283Z"
                                        fill="currentColor"
                                    />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a :href="siteSetting.linkedin_link" target="_blank">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 1C1.44772 1 1 1.44772 1 2V13C1 13.5523 1.44772 14 2 14H13C13.5523 14 14 13.5523 14 13V2C14 1.44772 13.5523 1 13 1H2ZM3.05 6H4.95V12H3.05V6ZM5.075 4.005C5.075 4.59871 4.59371 5.08 4 5.08C3.4063 5.08 2.925 4.59871 2.925 4.005C2.925 3.41129 3.4063 2.93 4 2.93C4.59371 2.93 5.075 3.41129 5.075 4.005ZM12 8.35713C12 6.55208 10.8334 5.85033 9.67449 5.85033C9.29502 5.83163 8.91721 5.91119 8.57874 6.08107C8.32172 6.21007 8.05265 6.50523 7.84516 7.01853H7.79179V6.00044H6V12.0047H7.90616V8.8112C7.8786 8.48413 7.98327 8.06142 8.19741 7.80987C8.41156 7.55832 8.71789 7.49825 8.95015 7.46774H9.02258C9.62874 7.46774 10.0786 7.84301 10.0786 8.78868V12.0047H11.9847L12 8.35713Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a :href="siteSetting.linkedin_link" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M22.0617 6.93984C21.9422 6.49462 21.7078 6.0886 21.382 5.76243C21.0563 5.43625 20.6505 5.20136 20.2055 5.08125C18.5672 4.64063 12 4.64062 12 4.64062C12 4.64062 5.43281 4.64062 3.79453 5.07891C3.34927 5.19862 2.94334 5.43339 2.61751 5.75962C2.29169 6.08586 2.05744 6.49208 1.93828 6.9375C1.5 8.57812 1.5 12 1.5 12C1.5 12 1.5 15.4219 1.93828 17.0602C2.17969 17.9648 2.89219 18.6773 3.79453 18.9188C5.43281 19.3594 12 19.3594 12 19.3594C12 19.3594 18.5672 19.3594 20.2055 18.9188C21.1102 18.6773 21.8203 17.9648 22.0617 17.0602C22.5 15.4219 22.5 12 22.5 12C22.5 12 22.5 8.57813 22.0617 6.93984ZM9.91406 15.1406V8.85938L15.3516 11.9766L9.91406 15.1406Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="footer-others-info">
                    <div class="company-link">
                        <h2> {{ locale === 'en' ? 'Important Link' : 'গুরুত্বপূর্ণ লিঙ্ক' }}</h2>
                        <ul>
                            <li>
                                <Link href="/">
                                    {{ locale === 'en' ? 'Home' : 'হোম' }}
                                </Link>
                            </li>
                            <li>
                                <Link href="/about-us">
                                    {{ locale === 'en' ? 'About Us' : 'আমাদের সম্পর্কে' }}
                                </Link>
                            </li>

                            <li>
                                <Link href="/job-board">
                                    {{ locale === 'en' ? 'Browse Job' : 'জব' }}
                                </Link>
                            </li>
                            <li>
                                <Link href="/blog">
                                    {{ locale === 'en' ? 'Blog' : 'ব্লগ' }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <div class="help-link">
                        <h2>{{ locale === 'en' ? 'Help' : 'সাহায্য' }}</h2>
                        <ul>
                            <li>
                                <Link href="/terms-condition">
                                    {{ locale === 'en' ? 'Terms & Condition' : 'শর্তাবলী' }}
                                </Link>
                            </li>
                            <li>
                                <Link href="/login">
                                    {{ locale === 'en' ? 'SignUp / SignIn' : 'লগইন/রেজিস্ট্রেশন' }}
                                </Link>
                            </li>
                            <li>
                                <Link href="/company-registration-start">
                                    {{ locale === 'en' ? 'Company Join' : 'কোম্পানি যোগদান' }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <div class="qr-code">
                        <div class="qr-code-img">
                            <QrcodeVue :value="siteSetting.site_link" :size="100" class="qr-code" />
                        </div>
                        <p>{{ locale === 'en' ? 'Scan The QR code & Download The App' : 'QR কোড স্ক্যান করুন এবং অ্যাপটি ডাউনলোড করুন' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <b>Powered By  Bhawal Tech Ltd.</b>
        </div>

    </footer>
</template>

<style scoped>
.qr-code {
    margin-left: 155px;
}
</style>
