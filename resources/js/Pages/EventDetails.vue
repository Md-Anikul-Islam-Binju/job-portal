<template>
    <div
        class="learning-details-section-area"
        style="background-image: url('http://127.0.0.1:8000/frontend/images/bg-image.png')"
    >
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div
                        class="learning-details-hero-content position-relative"
                    >
                        <h4>Event</h4>
                        <h1>{{ locale === "en"? event.title : event.title_bn}}</h1>
                        <ul>
                            <li>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="17"
                                    viewBox="0 0 16 17"
                                    fill="none"
                                >
                                    <path
                                        d="M12.6667 4.5H3.33333C2.59695 4.5 2 5.09695 2 5.83333V13.1667C2 13.903 2.59695 14.5 3.33333 14.5H12.6667C13.403 14.5 14 13.903 14 13.1667V5.83333C14 5.09695 13.403 4.5 12.6667 4.5Z"
                                        stroke="currentColor"
                                    />
                                    <path
                                        d="M2 7.16667C2 5.90933 2 5.28133 2.39067 4.89067C2.78133 4.5 3.40933 4.5 4.66667 4.5H11.3333C12.5907 4.5 13.2187 4.5 13.6093 4.89067C14 5.28133 14 5.90933 14 7.16667H2Z"
                                        fill="currentColor"
                                    />
                                    <path
                                        d="M4.66699 2.5V4.5M11.3337 2.5V4.5"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                    />
                                </svg>
                                {{
                                    locale === "en"
                                        ? `${formatDateEnglish(event.event_date)} ${event.event_time}`
                                        : `${formatDateBengali(event.event_date)} ${event.event_time}`
                                }}
                            </li>

                        </ul>
                        <div class="learning-details-pricing">
                            <a href="/user-registration-start">Register</a>
                            <div class="contact-details">
                                <div class="contact-item">
                                    <h3>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                        >
                                            <path
                                                d="M20.0002 10.999H22.0002C22.0002 5.869 18.1272 2 12.9902 2V4C17.0522 4 20.0002 6.943 20.0002 10.999Z"
                                                fill="#388EA9"
                                            />
                                            <path
                                                d="M13.0003 7.99999C15.1033 7.99999 16.0003 8.89699 16.0003 11H18.0003C18.0003 7.77499 16.2253 5.99999 13.0003 5.99999V7.99999ZM16.4223 13.443C16.2302 13.2681 15.9777 13.1748 15.7181 13.1828C15.4585 13.1909 15.2122 13.2996 15.0313 13.486L12.6383 15.947C12.0623 15.837 10.9043 15.476 9.71228 14.287C8.52028 13.094 8.15928 11.933 8.05228 11.361L10.5113 8.96699C10.6977 8.78612 10.8064 8.53982 10.8144 8.2802C10.8225 8.02059 10.7292 7.76804 10.5543 7.57599L6.85928 3.51299C6.68432 3.32035 6.44116 3.2035 6.18143 3.18725C5.92171 3.17101 5.66588 3.25665 5.46828 3.42599L3.29828 5.28699C3.12539 5.46051 3.0222 5.69145 3.00828 5.93599C2.99328 6.18599 2.70728 12.108 7.29928 16.702C11.3053 20.707 16.3233 21 17.7053 21C17.9073 21 18.0313 20.994 18.0643 20.992C18.3086 20.9776 18.5392 20.874 18.7123 20.701L20.5723 18.53C20.7417 18.3325 20.8276 18.0768 20.8115 17.817C20.7954 17.5573 20.6788 17.3141 20.4863 17.139L16.4223 13.443Z"
                                                fill="#388EA9"
                                            />
                                        </svg>

                                        {{ locale === "en"? 'Contact' : 'যোগাযোগ'}}
                                    </h3>
                                    <h3>{{ locale === "en"? siteSetting.phone : convertToBengaliDigits(siteSetting.phone)}}</h3>


                                </div>
                                <div class="contact-item">
                                    <h3>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                        >
                                            <path
                                                d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z"
                                                fill="#388EA9"
                                            />
                                        </svg>

                                        {{ locale === "en"? 'Email' : 'ইমেইল'}}
                                    </h3>
                                    <h3>{{ siteSetting.email }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="learning-details-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="learning-details-content-wrap">
                        <h2>{{ locale === "en"? event.title : event.title_bn }}</h2>
                        <p v-html="locale === 'en' ? event.details : event.details_bn"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- are you looking for a job -->
    <div class="are-you-looking-for-a-job training-details-aylgfaj">
        <div class="container">
            <div
                class="are-you-looking-for-a-job-content training-page-aylgfaj"
            >
                <div class="left-content">
                    <h4> {{ locale === 'en' ? 'Are you looking for a Job?' : 'আপনি কি চাকরি খুঁজছেন?' }}</h4>
                    <h2>{{ locale === 'en' ? 'GarmentsNiyog is your key to Success!?' : 'গার্মেন্টস নিয়োগ আপনার সাফল্যের চাবিকাঠি!' }}</h2>
                    <h5>
                        {{ locale === 'en' ? 'Our goal is to make your job search as easy as possible.' : 'আমাদের লক্ষ্য হল আপনার চাকরি খোঁজা যতটা সম্ভব সহজ করা।' }}
                    </h5>
                </div>
                <div class="right-content">
                    <a href="/user-registration-start" target="_blank">{{ locale === 'en' ? 'Register as Candidate' : 'প্রার্থী হিসেবে নিবন্ধন করুন' }}</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "EventDetails",
    layout: Layout,
    props: {
        siteSetting: Object,
        event: Object,
        auth: Object,
    },
    data() {
        return {
            locale: localStorage.getItem("locale") || "bn",
            englishToBengaliDigits: {
                0: "০",
                1: "১",
                2: "২",
                3: "৩",
                4: "৪",
                5: "৫",
                6: "৬",
                7: "৭",
                8: "৮",
                9: "৯",
            },
        };
    },
    methods: {
        formatDate(date) {
            const dateObj = new Date(date);
            return `${dateObj.getDate()} ${dateObj.toLocaleString("en-US", {
                month: "short",
            })} ${dateObj.getFullYear()}`;
        },

        formatDateEnglish(date) {
            const dateObj = new Date(date);
            const day = dateObj.getDate();
            const month = dateObj.toLocaleString("en-US", { month: "long" });
            const year = dateObj.getFullYear();
            return `${day} ${month} ${year}`;
        },

        // Convert to Bengali Date Format (e.g., "২০ অক্টোবর ২০২৪")
        formatDateBengali(date) {
            const englishToBengaliDigits = {
                0: "০",
                1: "১",
                2: "২",
                3: "৩",
                4: "৪",
                5: "৫",
                6: "৬",
                7: "৭",
                8: "৮",
                9: "৯",
            };

            const englishToBengaliMonths = {
                January: "জানুয়ারি",
                February: "ফেব্রুয়ারি",
                March: "মার্চ",
                April: "এপ্রিল",
                May: "মে",
                June: "জুন",
                July: "জুলাই",
                August: "আগস্ট",
                September: "সেপ্টেম্বর",
                October: "অক্টোবর",
                November: "নভেম্বর",
                December: "ডিসেম্বর",
            };

            const dateObj = new Date(date);
            const day = dateObj
                .getDate()
                .toString()
                .replace(/\d/g, (digit) => englishToBengaliDigits[digit]);
            const month = dateObj.toLocaleString("en-US", { month: "long" });
            const bengaliMonth = englishToBengaliMonths[month];
            const year = dateObj
                .getFullYear()
                .toString()
                .replace(/\d/g, (digit) => englishToBengaliDigits[digit]);

            return `${day} ${bengaliMonth} ${year}`;
        },
        convertToBengaliDigits(number) {
            return number
                .toString()
                .replace(/\d/g, (digit) => this.englishToBengaliDigits[digit]);
        },
        getTrainingImageUrl(imagePath) {
            if (!imagePath) {
                return "frontend/img/defult.png";
            }
            return `${window.location.origin}/images/event/${imagePath}`;
        },

    },
}
</script>

<style scoped>

</style>
