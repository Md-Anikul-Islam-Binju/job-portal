<template>
    <div class="training-top-part">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="jobs-card-wrapper">
                        <div class="found-jobs-count-wrap">
                            <h3>
                                {{
                                    locale === "en"
                                        ? "Training & Workshop"
                                        : "প্রশিক্ষণ ও কর্মশালা"
                                }}
                            </h3>
                            <div class="">
                                <!-- search -->
                                <div class="search-wrap">
                                    <input
                                        type="text"
                                        class="search-input"
                                        :placeholder="
                                            locale === 'en'
                                                ? 'Search by title'
                                                : 'অনুসন্ধান করুন'
                                        "
                                        v-model="searchKeyword"
                                        @input="onSearch"
                                    />
                                    <button class="search-btn">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="14"
                                            height="15"
                                            viewBox="0 0 14 15"
                                            fill="none"
                                        >
                                            <path
                                                d="M10.208 10.7083L12.833 13.3333"
                                                stroke="#388EA9"
                                                stroke-width="1.125"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                            <path
                                                d="M11.667 6.91667C11.667 4.01717 9.31651 1.66667 6.41699 1.66667C3.5175 1.66667 1.16699 4.01717 1.16699 6.91667C1.16699 9.81618 3.5175 12.1667 6.41699 12.1667C9.31651 12.1667 11.667 9.81618 11.667 6.91667Z"
                                                stroke="#388EA9"
                                                stroke-width="1.125"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div
                    v-for="trainingData in paginatedTrainings"
                    :key="trainingData.id"
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

                <nav class="training-pagination justify-content-center d-flex">
                    <ul class="pagination">
                        <li
                            class="page-item"
                            :class="{ disabled: currentPage === 1 }"
                        >
                            <a
                                href="#"
                                class="page-link"
                                @click.prevent="changePage(currentPage - 1)"
                            >
                                <i class="ti-angle-left"></i>
                            </a>
                        </li>
                        <li
                            v-for="page in totalPages"
                            :key="page"
                            :class="{ active: page === currentPage }"
                            class="page-item"
                        >
                            <a
                                href="#"
                                class="page-link"
                                @click.prevent="changePage(page)"
                            >
                                {{ page }}
                            </a>
                        </li>
                        <li
                            class="page-item"
                            :class="{ disabled: currentPage === totalPages }"
                        >
                            <a
                                href="#"
                                class="page-link"
                                @click.prevent="changePage(currentPage + 1)"
                            >
                                <i class="ti-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- are you looking for a job -->
    <div class="are-you-looking-for-a-job section-padding">
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
    name: "Training",
    layout: Layout,
    props: {
        siteSetting: Object,
        trainings: Array, // All training data passed from the backend
        auth: Object,
    },
    data() {
        return {
            locale: localStorage.getItem("locale") || "bn",
            searchKeyword: "",
            currentPage: 1,
            itemsPerPage: 10, // Adjust as needed
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
        filteredTrainings() {
            // Filter trainings based on search keyword
            let filtered = this.trainings;

            if (this.searchKeyword) {
                filtered = filtered.filter(
                    (training) =>
                        training.title
                            .toLowerCase()
                            .includes(this.searchKeyword.toLowerCase()) ||
                        (training.title_bn &&
                            training.title_bn
                                .toLowerCase()
                                .includes(this.searchKeyword.toLowerCase()))
                );
            }

            return filtered;
        },
        totalPages() {
            return Math.ceil(this.filteredTrainings.length / this.itemsPerPage);
        },
        paginatedTrainings() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.filteredTrainings.slice(start, end);
        },
    },
    methods: {
        onSearch() {
            this.currentPage = 1; // Reset to page 1 on search
        },
        changePage(pageNumber) {
            if (pageNumber >= 1 && pageNumber <= this.totalPages) {
                this.currentPage = pageNumber;
            }
        },
        formatDate(date) {
            const dateObj = new Date(date);
            return `${dateObj.getDate()} ${dateObj.toLocaleString("en-US", {
                month: "short",
            })} ${dateObj.getFullYear()}`;
        },
        formatMonth(date) {
            const dateObj = new Date(date);
            return dateObj.toLocaleString("en-US", { month: "long" });
        },
        getTrainingImageUrl(imagePath) {
            if (!imagePath) {
                return "frontend/img/defult.png";
            }
            return `${window.location.origin}/images/training/${imagePath}`;
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
    },
};
</script>
