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
                                        ? "Event"
                                        : "ইভেন্ট"
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
                    v-for="eventData in paginatedEvents"
                    :key="eventData.id"
                    class="col-lg-3 col-md-4 col-sm-6 col-12"
                >
                    <div class="training-card">
                        <div>
                            <Link
                                class="d-inline-block w-100"
                                :href="`/event-details/${eventData.id}`"
                            >
                                <div class="training-card-img">
                                    <img
                                        :src="
                                            eventData.image
                                                ? getEventImageUrl(
                                                      eventData.image
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
                                            ? eventData.title
                                            : eventData.title_bn
                                    }}
                                </h4>
                                <p
                                    v-html="(locale === 'en'? eventData.details: eventData.details_bn
                                        ).length > 250
                                            ? (locale === 'en'
                                                  ? eventData.details
                                                  : eventData.details_bn
                                              ).substring(0, 100) + '...'
                                            : locale === 'en'
                                            ? eventData.details
                                            : eventData.details_bn
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
                                    {{
                                        locale === "en"
                                            ? "Event"
                                            : "ইভেন্ট"
                                    }}
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
                                            ? `${formatDateEnglish(eventData.event_date)} ${eventData.event_time}`
                                            : `${formatDateBengali(eventData.event_date)} ${eventData.event_time}`
                                    }}
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
        events: Array, // All training data passed from the backend
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
        filteredEvent() {
            // Filter trainings based on search keyword
            return this.events.filter((eventData) => {
                const title = this.locale === "en" ? eventData.title : eventData.title_bn;
                return title.toLowerCase().includes(this.searchKeyword.toLowerCase());
            });
        },
        paginatedEvents() {
            // Paginate filtered events
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.filteredEvent.slice(startIndex, endIndex);
        },
        totalPages() {
            // Calculate total pages for pagination
            return Math.ceil(this.filteredEvent.length / this.itemsPerPage);
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
        getEventImageUrl(imagePath) {
            if (!imagePath) {
                return "frontend/img/defult.png";
            }
            return `${window.location.origin}/images/event/${imagePath}`;
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
