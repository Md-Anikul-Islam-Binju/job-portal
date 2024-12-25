<template>
    <div
        class="learning-details-section-area"
        :style="{ backgroundImage: 'url(' + baseUrl + '/frontend/images/bg-image.png)' }"
    >
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div
                        class="learning-details-hero-content position-relative"
                    >
                        <h4>Training / Course</h4>
                        <h1>{{ locale === "en"? training.title : training.title_bn}}</h1>
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
                                        ? formatDateEnglish(
                                            training.training_date
                                        )
                                        : formatDateBengali(
                                            training.training_date
                                        )
                                }}
                            </li>
                            <li>
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="17"
                                    viewBox="0 0 16 17"
                                    fill="none"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M8.00033 15.8333C12.0503 15.8333 15.3337 12.55 15.3337 8.50001C15.3337 4.45001 12.0503 1.16667 8.00033 1.16667C3.95033 1.16667 0.666992 4.45001 0.666992 8.50001C0.666992 12.55 3.95033 15.8333 8.00033 15.8333ZM8.00033 14.5C7.21239 14.5 6.43218 14.3448 5.70423 14.0433C4.97627 13.7418 4.31484 13.2998 3.75768 12.7426C3.20053 12.1855 2.75858 11.5241 2.45705 10.7961C2.15552 10.0682 2.00033 9.28794 2.00033 8.50001C2.00033 7.71207 2.15552 6.93186 2.45705 6.2039C2.75858 5.47595 3.20053 4.81452 3.75768 4.25736C4.31484 3.70021 4.97627 3.25826 5.70423 2.95673C6.43218 2.6552 7.21239 2.50001 8.00033 2.50001C9.59162 2.50001 11.1177 3.13215 12.243 4.25736C13.3682 5.38258 14.0003 6.90871 14.0003 8.50001C14.0003 10.0913 13.3682 11.6174 12.243 12.7426C11.1177 13.8679 9.59162 14.5 8.00033 14.5ZM8.66699 4.50001V8.50001H7.33366V4.50001H8.66699Z"
                                        fill="currentColor"
                                    />
                                </svg>
                                {{
                                    locale === "en"
                                        ? training.training_duration
                                        : convertToBengaliDigits(
                                            training.training_duration
                                        )
                                }}
                            </li>
                        </ul>
                        <div class="learning-details-pricing">
                            <h2><span> {{locale === "en"? 'Training Price':  'প্রশিক্ষণ মূল্য'}}</span> {{locale === "en"?  training.training_fee:  convertToBengaliDigits(training.training_fee)}}</h2>
                            <p>

                            </p>
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
                        <h2>{{ locale === "en"? training.title : training.title_bn }}</h2>
                        <p v-html="locale === 'en' ? training.details : training.details_bn"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Related Traning -->
    <div class="related-traning-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="jobs-card-wrapper">
                        <div class="found-jobs-count-wrap">
                            <h3>
                                {{
                                    locale === "en"
                                        ? "Smilar Traning"
                                        : "অনুরূপ প্রশিক্ষণ"
                                }}
                            </h3>
                            <div class="">
                                <!-- search -->
                                <div class="search-wrap">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div
                    v-for="trainingData in trainings" :key="trainingData.id"
                    class="col-lg-3 col-md-4 col-sm-6 col-12"
                >
                    <div class="training-card">
                        <div>
                            <Link
                                class="d-inline-block w-100"
                                :href="`/training-details/${trainingData.id}`"
                            >
                                <div class="training-card-img">
                                    <img
                                        :src="
                                            trainingData.image
                                                ? getTrainingImageUrl(
                                                      trainingData.image
                                                  )
                                                : 'frontend/img/defult.png'
                                        "
                                        alt="Training"
                                    />
                                </div>
                            </Link>
                            <div class="training-card-content">
                                <h4>
                                    {{
                                        locale === "en"
                                            ? trainingData.title
                                            : trainingData.title_bn
                                    }}
                                </h4>
                                <p
                                    v-html="(locale === 'en'? trainingData.details: trainingData.details_bn
                                        ).length > 250
                                            ? (locale === 'en'
                                                  ? trainingData.details
                                                  : trainingData.details_bn
                                              ).substring(0, 100) + '...'
                                            : locale === 'en'
                                            ? trainingData.details
                                            : trainingData.details_bn
                                    "
                                ></p>
                                <div class="trainer">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 16 16"
                                        fill="none"
                                    >
                                        <path
                                            d="M7.99967 7.58999C7.4499 7.58999 6.97901 7.39399 6.58701 7.00199C6.19501 6.60999 5.99923 6.13932 5.99967 5.58999C6.00012 5.04066 6.1959 4.56954 6.58701 4.17666C6.97812 3.78377 7.44901 3.58843 7.99967 3.59066C8.55034 3.59288 9.02123 3.78843 9.41234 4.17732C9.80345 4.56621 9.99923 5.03732 9.99967 5.59066C10.0001 6.14399 9.80434 6.61466 9.41234 7.00266C9.02034 7.39066 8.54945 7.58599 7.99967 7.58999ZM3.33301 12.4107V11.3133C3.33301 11.0382 3.41301 10.7809 3.57301 10.5413C3.73345 10.3013 3.94901 10.1151 4.21967 9.98266C4.84901 9.68088 5.47879 9.45466 6.10901 9.30399C6.73879 9.15288 7.36901 9.07732 7.99967 9.07732C8.63034 9.07732 9.26079 9.15288 9.89101 9.30399C10.5212 9.4551 11.1506 9.68132 11.779 9.98266C12.0501 10.1151 12.2657 10.3013 12.4257 10.5413C12.5861 10.7809 12.6663 11.0382 12.6663 11.3133V12.4107H3.33301Z"
                                            fill="#388EA9"
                                        />
                                    </svg>
                                    Trainer
                                </div>
                                <div class="date-and-time">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 16 16"
                                        fill="none"
                                    >
                                        <path
                                            d="M13.5 4H11C11 3.20435 10.6839 2.44129 10.1213 1.87868C9.55871 1.31607 8.79565 1 8 1C7.20435 1 6.44129 1.31607 5.87868 1.87868C5.31607 2.44129 5 3.20435 5 4H2.5C2.23478 4 1.98043 4.10536 1.79289 4.29289C1.60536 4.48043 1.5 4.73478 1.5 5V12.5C1.5 12.7652 1.60536 13.0196 1.79289 13.2071C1.98043 13.3946 2.23478 13.5 2.5 13.5H13.5C13.7652 13.5 14.0196 13.3946 14.2071 13.2071C14.3946 13.0196 14.5 12.7652 14.5 12.5V5C14.5 4.73478 14.3946 4.48043 14.2071 4.29289C14.0196 4.10536 13.7652 4 13.5 4ZM8 2C8.53043 2 9.03914 2.21071 9.41421 2.58579C9.78929 2.96086 10 3.46957 10 4H6C6 3.46957 6.21071 2.96086 6.58579 2.58579C6.96086 2.21071 7.46957 2 8 2Z"
                                            fill="#FC8500"
                                        />
                                    </svg>

                                    {{
                                        locale === "en"
                                            ? formatDateEnglish(
                                                trainingData.training_date
                                            )
                                            : formatDateBengali(
                                                trainingData.training_date
                                            )
                                    }}

                                </div>
                                <div class="training-price">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="16"
                                        height="16"
                                        viewBox="0 0 16 16"
                                        fill="none"
                                    >
                                        <path
                                            d="M7.5 5.23132C6.876 5.40199 6.5 5.88132 6.5 6.33332C6.5 6.78532 6.876 7.26466 7.5 7.43466V5.23132ZM8.5 8.56532V10.768C9.124 10.598 9.5 10.1187 9.5 9.66666C9.5 9.21466 9.124 8.73532 8.5 8.56532Z"
                                            fill="#388EA9"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M14.6663 8.00001C14.6663 11.682 11.6817 14.6667 7.99967 14.6667C4.31767 14.6667 1.33301 11.682 1.33301 8.00001C1.33301 4.31801 4.31767 1.33334 7.99967 1.33334C11.6817 1.33334 14.6663 4.31801 14.6663 8.00001ZM7.99967 3.50001C8.13228 3.50001 8.25946 3.55269 8.35323 3.64646C8.447 3.74023 8.49967 3.8674 8.49967 4.00001V4.21134C9.58634 4.40601 10.4997 5.22268 10.4997 6.33334C10.4997 6.46595 10.447 6.59313 10.3532 6.6869C10.2595 6.78066 10.1323 6.83334 9.99967 6.83334C9.86707 6.83334 9.73989 6.78066 9.64612 6.6869C9.55235 6.59313 9.49967 6.46595 9.49967 6.33334C9.49967 5.88134 9.12367 5.40201 8.49967 5.23134V7.54468C9.58634 7.73934 10.4997 8.55601 10.4997 9.66668C10.4997 10.7773 9.58634 11.594 8.49967 11.7887V12C8.49967 12.1326 8.447 12.2598 8.35323 12.3536C8.25946 12.4473 8.13228 12.5 7.99967 12.5C7.86707 12.5 7.73989 12.4473 7.64612 12.3536C7.55235 12.2598 7.49967 12.1326 7.49967 12V11.7887C6.41301 11.594 5.49967 10.7773 5.49967 9.66668C5.49967 9.53407 5.55235 9.40689 5.64612 9.31312C5.73989 9.21936 5.86707 9.16668 5.99967 9.16668C6.13228 9.16668 6.25946 9.21936 6.35323 9.31312C6.447 9.40689 6.49967 9.53407 6.49967 9.66668C6.49967 10.1187 6.87567 10.598 7.49967 10.768V8.45534C6.41301 8.26068 5.49967 7.44401 5.49967 6.33334C5.49967 5.22268 6.41301 4.40601 7.49967 4.21134V4.00001C7.49967 3.8674 7.55235 3.74023 7.64612 3.64646C7.73989 3.55269 7.86707 3.50001 7.99967 3.50001Z"
                                            fill="#388EA9"
                                        />
                                    </svg>
                                    {{locale === "en"?  trainingData.training_fee:  convertToBengaliDigits(trainingData.training_fee)}}

                                </div>
                            </div>
                        </div>
                        <div class="register-training">
                            <a href="/user-registration-start">
                                Register Now
                            </a>
                        </div>
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
    name: "TrainingDetails",
    layout: Layout,
    props: {
        siteSetting: Object,
        training: Object,
        auth: Object,
        trainings: Array,
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
    computed: {
        baseUrl() {
            return window.location.origin;
        },
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
            return `${window.location.origin}/images/training/${imagePath}`;
        },

    },
}
</script>

<style scoped>

</style>
