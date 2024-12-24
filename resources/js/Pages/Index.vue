<script>
import Layout from "../frontend/Layout.vue";
export default {
    name: "Index",
    layout: Layout,

    props: {
        category: Array,
        location: Array,
        job: Array,
        slider: Array,
        company: Array,
        review: Array,
        jobTotal: Object,
    },
    data() {
        return {
            locale: localStorage.getItem("locale") || "bn",
            selectedCategory: null,
            selectedLocation: null,
            searchKeyword: "",
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
        // Convert English Date Format to "Day Month Year" (e.g., "20 October 2024")
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

        // Method to select category and filter jobs
        selectCategory(categoryId) {
            this.selectedCategory = categoryId;
        },
        selectLocation(locationId) {
            this.selectedLocation = locationId;
        },
        getSliderUrl(sliderPath) {
            if (!sliderPath) {
                return "default-slider.png"; // Ensure this default image path is correct
            }
            // Update this line to prepend the correct path
            const fullUrl = `${window.location.origin}/images/slider/${sliderPath}`;
            console.log("Slider URL:", fullUrl); // Debugging output
            return fullUrl;
        },
        getCompanyImageUrl(imagePath) {
            if (!imagePath) {
                return "frontend/img/company.png"; // You might want to return a default image directly here too
            }
            return `${window.location.origin}/images/logo/${imagePath}`; // Adjust the path as necessary
        },

        getReviewUserImageUrl(imagePath) {
            if (!imagePath) {
                return "No Image"; // You might want to return a default image directly here too
            }
            return `${window.location.origin}/images/review/${imagePath}`; // Adjust the path as necessary
        },

        convertToBengaliDigits(number) {
            return number
                .toString()
                .replace(/\d/g, (digit) => this.englishToBengaliDigits[digit]);
        },
    },
    computed: {
        filteredJobs() {
            return this.job.filter((jobData) => {
                const matchesCategory =
                    !this.selectedCategory ||
                    jobData.category_id === this.selectedCategory;
                const matchesLocation =
                    !this.selectedLocation ||
                    jobData.location_id === this.selectedLocation;
                const matchesKeyword =
                    !this.searchKeyword ||
                    jobData.title
                        .toLowerCase()
                        .includes(this.searchKeyword.toLowerCase()) ||
                    (jobData.title_bn &&
                        jobData.title_bn
                            .toLowerCase()
                            .includes(this.searchKeyword.toLowerCase()));

                return matchesCategory && matchesLocation && matchesKeyword;
            });
        },
    },
};
</script>

<template>
    <head>
        <title>GarmentsNiyog - Home</title>
    </head>

    <!-- Slider -->
    <div class="hero-section-slider position-relative">
        <div
            id="carouselExampleIndicators"
            class="carousel slide"
            data-bs-ride="carousel"
            data-bs-touch="true"
            data-bs-interval="5000"
        >
            <div class="carousel-indicators">
                <button
                    type="button"
                    data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="0"
                    class="active"
                    aria-current="true"
                    aria-label="Slide 1"
                ></button>
                <button
                    type="button"
                    data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="1"
                    aria-label="Slide 2"
                ></button>
            </div>

            <div class="carousel-inner">
                <div
                    v-for="(sliderData, index) in slider"
                    :key="sliderData.id"
                    :class="['carousel-item', { active: index === 0 }]"
                >
                    <div
                        class="slider-image slider-bg-image"
                        :style="{
                            backgroundImage:
                                'url(' + getSliderUrl(sliderData?.image) + ')',
                        }"
                    >
                        <div class="container">
                            <div class="slider-content">
                                <h2>
                                    {{
                                        locale === "en"
                                            ? sliderData.title
                                            : sliderData.title_bn
                                    }}
                                </h2>
                                <p
                                    v-html="
                                        locale === 'en'
                                            ? sliderData.details
                                            : sliderData.details_bn
                                    "
                                ></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel Navigation Buttons -->
            <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev"
            >
                <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                ></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next"
            >
                <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                ></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container">
            <div class="hero-container-wrapper">
                <div class="hero-content">
                    <form
                        class="find-a-jobs-wrap"
                        method="GET"
                        action="https://jobshubglobal.com/all-jobs"
                    >
                        <div class="input-group search-jobs">
                            <div class="search-icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >
                                    <path
                                        d="M21.0002 21L16.6572 16.657M16.6572 16.657C17.4001 15.9141 17.9894 15.0322 18.3914 14.0616C18.7935 13.0909 19.0004 12.0506 19.0004 11C19.0004 9.94942 18.7935 8.90911 18.3914 7.93848C17.9894 6.96785 17.4001 6.08591 16.6572 5.34302C15.9143 4.60014 15.0324 4.01084 14.0618 3.6088C13.0911 3.20675 12.0508 2.99982 11.0002 2.99982C9.9496 2.99982 8.90929 3.20675 7.93866 3.6088C6.96803 4.01084 6.08609 4.60014 5.34321 5.34302C3.84288 6.84335 3 8.87824 3 11C3 13.1218 3.84288 15.1567 5.34321 16.657C6.84354 18.1574 8.87842 19.0002 11.0002 19.0002C13.122 19.0002 15.1569 18.1574 16.6572 16.657Z"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>
                            <input
                                type="text"
                                name="job_title"
                                class="form-control"
                                placeholder="Job Title"
                                value=""
                            />
                        </div>
                    </form>
                </div>
            </div>
            <div class="jobs-information">
                <div class="info-card">
                    <h2><span class="number">3</span></h2>
                    <h4>Vacancies</h4>
                </div>
                <div class="info-card">
                    <h2><span class="number">2</span>+</h2>
                    <h4>Company</h4>
                </div>
                <div class="info-card">
                    <h2><span class="number">3</span>+</h2>
                    <h4>Live Jobs</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="district-section-wrapper">
        <div class="container">
            <ul class="district-wrap">
                <li>
                    <a href="#" @click.prevent="selectLocation(null)">{{
                        locale === "en" ? "All" : "সব"
                    }}</a>
                </li>
                <li v-for="locationData in location" :key="locationData.id">
                    <a
                        href="#"
                        @click.prevent="selectLocation(locationData.id)"
                        >{{
                            locale === "en"
                                ? locationData.name
                                : locationData.name_bn
                        }}</a
                    >
                </li>
            </ul>
            <div class="explore-by-category">
                <h2>
                    {{
                        locale === "en"
                            ? "Explore by Category"
                            : "বিভাগ অনুসারে অন্বেষণ করুন"
                    }}
                </h2>
                <a href="#">View All</a>
            </div>
        </div>
    </div>

    <div class="category-section-area section-padding">
        <div class="container">
            <div class="category-card-wrap d-flex flex-wrap">
                <a
                    v-for="categoryData in category"
                    :key="categoryData.id"
                    href="#"
                    @click.prevent="selectCategory(categoryData.id)"
                    class="category-card d-flex align-items-center"
                >
                    <div class="category-image-wrap">
                        <img
                            src="https://jobshubglobal.com/images/category/1733758409.jpg"
                            draggable="false"
                            alt="Category Image"
                        />
                    </div>
                    <div
                        class="category-content d-flex flex-column justify-content-between"
                    >
                        <h3>
                            {{
                                locale === "en"
                                    ? categoryData.name
                                    : categoryData.name_bn
                            }}
                        </h3>
                        <div
                            class="category-content-bottom d-flex align-items-end justify-content-between"
                        >
                            <div class="available-position d-flex flex-column">
                                <h4>
                                    {{
                                        locale === "en"
                                            ? "Available Position"
                                            : "পদ শূন্য  আছে"
                                    }}
                                </h4>
                                <h5>
                                    {{
                                        locale === "en"
                                            ? categoryData.jobs_count
                                            : convertToBengaliDigits(
                                                  categoryData.jobs_count
                                              )
                                    }}
                                </h5>
                            </div>
                            <div class="svg-icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="14"
                                    height="15"
                                    viewBox="0 0 14 15"
                                    fill="none"
                                >
                                    <path
                                        d="M9.91667 4.58337L3.5 11"
                                        stroke="currentColor"
                                        stroke-width="0.875"
                                        stroke-linecap="round"
                                    />
                                    <path
                                        d="M6.4165 4.07673C6.4165 4.07673 9.70271 3.79971 10.2015 4.29841C10.7002 4.79711 10.4231 8.08335 10.4231 8.08335"
                                        stroke="currentColor"
                                        stroke-width="0.875"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Job Listing -->
    <section class="job-listing-area">
        <div class="container">
            <div class="job-listing-heading">
                <h2>Job Listing</h2>
                <form
                    class="find-a-jobs-wrap"
                    method="GET"
                    action="https://jobshubglobal.com/all-jobs"
                >
                    <div class="input-group search-jobs">
                        <input
                            type="text"
                            name="job_title"
                            class="form-control"
                            :placeholder="
                                locale === 'en'
                                    ? 'Search by title'
                                    : 'অনুসন্ধান করুন'
                            "
                            v-model="searchKeyword"
                        />
                    </div>
                </form>
            </div>
        </div>
        <div class="jobs-list-area">
            <div class="container">
                <div class="row">
                    <div
                        class="col-md-6 col-12"
                        v-for="jobData in filteredJobs"
                        :key="jobData.id"
                    >
                        <div class="home-job-card">
                            <div class="home-job-card-img">
                                <img
                                    :src="
                                        jobData.company.profile
                                            ? getCompanyImageUrl(
                                                  jobData.company.profile
                                              )
                                            : 'frontend/img/company.png'
                                    "
                                    alt=""
                                />
                            </div>
                            <div class="home-job-card-details">
                                <div class="home-job-card-top">
                                    <div class="job-card-title">
                                        <Link
                                            :href="`/job-details/${jobData.id}`"
                                        >
                                            <h2>
                                                {{
                                                    locale === "en"
                                                        ? jobData.title
                                                        : jobData.title_bn
                                                }}
                                            </h2>
                                        </Link>
                                        <p>
                                            {{
                                                locale === "en"
                                                    ? jobData.company.name
                                                    : jobData.company.name_bn
                                            }}
                                        </p>
                                    </div>
                                    <Link :href="`/job-details/${jobData.id}`">
                                        {{
                                            locale === "en"
                                                ? "Apply Now"
                                                : "আবেদন করুন"
                                        }}
                                    </Link>
                                </div>
                                <ul>
                                    <li>
                                        <div class="icon-wrap">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                viewBox="0 0 16 16"
                                                fill="none"
                                            >
                                                <path
                                                    d="M11.7711 3.53601C9.68843 1.48735 6.31177 1.48735 4.2291 3.53601C3.73462 4.0191 3.34171 4.59617 3.07345 5.23328C2.80518 5.8704 2.66699 6.55472 2.66699 7.24601C2.66699 7.9373 2.80518 8.62162 3.07345 9.25874C3.34171 9.89586 3.73462 10.4729 4.2291 10.956L7.99977 14.666L11.7711 10.956C12.2656 10.4729 12.6585 9.89586 12.9268 9.25874C13.195 8.62162 13.3332 7.9373 13.3332 7.24601C13.3332 6.55472 13.195 5.8704 12.9268 5.23328C12.6585 4.59617 12.2656 4.0191 11.7711 3.53601ZM7.99977 8.99935C7.55444 8.99935 7.13644 8.82601 6.8211 8.51134C6.50894 8.19851 6.33362 7.77462 6.33362 7.33268C6.33362 6.89074 6.50894 6.46684 6.8211 6.15401C7.13577 5.83935 7.55444 5.66601 7.99977 5.66601C8.4451 5.66601 8.86377 5.83935 9.17843 6.15401C9.4906 6.46684 9.66592 6.89074 9.66592 7.33268C9.66592 7.77462 9.4906 8.19851 9.17843 8.51134C8.86377 8.82601 8.4451 8.99935 7.99977 8.99935Z"
                                                    fill="currentColor"
                                                />
                                            </svg>
                                        </div>
                                        {{
                                            locale === "en"
                                                ? jobData.address
                                                : jobData.address_bn
                                        }}
                                    </li>
                                    <li>
                                        <div class="icon-wrap">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                viewBox="0 0 16 16"
                                                fill="none"
                                            >
                                                <path
                                                    d="M8.00016 1.3335C11.6822 1.3335 14.6668 4.31816 14.6668 8.00016C14.6668 11.6822 11.6822 14.6668 8.00016 14.6668C4.31816 14.6668 1.3335 11.6822 1.3335 8.00016C1.3335 4.31816 4.31816 1.3335 8.00016 1.3335ZM8.00016 4.00016C7.82335 4.00016 7.65378 4.0704 7.52876 4.19543C7.40373 4.32045 7.3335 4.49002 7.3335 4.66683V8.00016C7.33353 8.17696 7.4038 8.3465 7.52883 8.4715L9.52883 10.4715C9.65456 10.5929 9.82297 10.6601 9.99776 10.6586C10.1726 10.6571 10.3398 10.587 10.4634 10.4634C10.587 10.3398 10.6571 10.1726 10.6586 9.99776C10.6601 9.82297 10.5929 9.65456 10.4715 9.52883L8.66683 7.72416V4.66683C8.66683 4.49002 8.59659 4.32045 8.47157 4.19543C8.34654 4.0704 8.17697 4.00016 8.00016 4.00016Z"
                                                    fill="currentColor"
                                                />
                                            </svg>
                                        </div>
                                        {{
                                            locale === "en"
                                                ? formatDateEnglish(
                                                      jobData.deadline
                                                  )
                                                : formatDateBengali(
                                                      jobData.deadline
                                                  )
                                        }}
                                    </li>
                                    <li>
                                        <div class="icon-wrap">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                viewBox="0 0 16 16"
                                                fill="none"
                                            >
                                                <path
                                                    d="M7.5 5.23145C6.876 5.40211 6.5 5.88145 6.5 6.33345C6.5 6.78545 6.876 7.26478 7.5 7.43478V5.23145ZM8.5 8.56544V10.7681C9.124 10.5981 9.5 10.1188 9.5 9.66678C9.5 9.21478 9.124 8.73545 8.5 8.56544Z"
                                                    fill="currentColor"
                                                />
                                                <path
                                                    fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="M14.6668 8.00016C14.6668 11.6822 11.6822 14.6668 8.00016 14.6668C4.31816 14.6668 1.3335 11.6822 1.3335 8.00016C1.3335 4.31816 4.31816 1.3335 8.00016 1.3335C11.6822 1.3335 14.6668 4.31816 14.6668 8.00016ZM8.00016 3.50016C8.13277 3.50016 8.25995 3.55284 8.35372 3.64661C8.44748 3.74038 8.50016 3.86755 8.50016 4.00016V4.2115C9.58683 4.40616 10.5002 5.22283 10.5002 6.3335C10.5002 6.4661 10.4475 6.59328 10.3537 6.68705C10.2599 6.78082 10.1328 6.8335 10.0002 6.8335C9.86755 6.8335 9.74038 6.78082 9.64661 6.68705C9.55284 6.59328 9.50016 6.4661 9.50016 6.3335C9.50016 5.8815 9.12416 5.40216 8.50016 5.2315V7.54483C9.58683 7.7395 10.5002 8.55616 10.5002 9.66683C10.5002 10.7775 9.58683 11.5942 8.50016 11.7888V12.0002C8.50016 12.1328 8.44748 12.2599 8.35372 12.3537C8.25995 12.4475 8.13277 12.5002 8.00016 12.5002C7.86755 12.5002 7.74038 12.4475 7.64661 12.3537C7.55284 12.2599 7.50016 12.1328 7.50016 12.0002V11.7888C6.4135 11.5942 5.50016 10.7775 5.50016 9.66683C5.50016 9.53422 5.55284 9.40704 5.64661 9.31328C5.74038 9.21951 5.86755 9.16683 6.00016 9.16683C6.13277 9.16683 6.25995 9.21951 6.35372 9.31328C6.44748 9.40704 6.50016 9.53422 6.50016 9.66683C6.50016 10.1188 6.87616 10.5982 7.50016 10.7682V8.4555C6.4135 8.26083 5.50016 7.44416 5.50016 6.3335C5.50016 5.22283 6.4135 4.40616 7.50016 4.2115V4.00016C7.50016 3.86755 7.55284 3.74038 7.64661 3.64661C7.74038 3.55284 7.86755 3.50016 8.00016 3.50016Z"
                                                    fill="currentColor"
                                                />
                                            </svg>
                                        </div>
                                        {{
                                            locale === "en"
                                                ? jobData.salary || "Negotiable"
                                                : jobData.salary
                                                ? convertToBengaliDigits(
                                                      jobData.salary
                                                  )
                                                : "আলোচনা সাপেক্ষে"
                                        }}
                                    </li>
                                    <li>
                                        <div class="icon-wrap">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                viewBox="0 0 16 16"
                                                fill="none"
                                            >
                                                <path
                                                    d="M8 4C7.50555 4 7.0222 4.14662 6.61108 4.42133C6.19995 4.69603 5.87952 5.08648 5.6903 5.54329C5.50108 6.00011 5.45157 6.50277 5.54804 6.98773C5.6445 7.47268 5.8826 7.91814 6.23223 8.26777C6.58187 8.6174 7.02732 8.8555 7.51228 8.95196C7.99723 9.04843 8.4999 8.99892 8.95671 8.8097C9.41353 8.62048 9.80397 8.30005 10.0787 7.88893C10.3534 7.4778 10.5 6.99445 10.5 6.5C10.5 5.83696 10.2366 5.20107 9.76777 4.73223C9.29893 4.26339 8.66304 4 8 4Z"
                                                    fill="currentColor"
                                                />
                                                <path
                                                    d="M8 1C6.61553 1 5.26216 1.41054 4.11101 2.17971C2.95987 2.94888 2.06266 4.04213 1.53285 5.32122C1.00303 6.6003 0.86441 8.00776 1.13451 9.36563C1.4046 10.7235 2.07129 11.9708 3.05026 12.9497C4.02922 13.9287 5.2765 14.5954 6.63437 14.8655C7.99224 15.1356 9.3997 14.997 10.6788 14.4672C11.9579 13.9373 13.0511 13.0401 13.8203 11.889C14.5895 10.7378 15 9.38447 15 8C14.9979 6.14413 14.2597 4.36489 12.9474 3.05259C11.6351 1.7403 9.85587 1.00212 8 1ZM11.9965 12.463C11.9868 11.807 11.7196 11.1811 11.2526 10.7203C10.7855 10.2596 10.1561 10.0008 9.5 10H6.5C5.84402 10.001 5.21469 10.2597 4.74776 10.7205C4.28083 11.1813 4.01371 11.8071 4.004 12.463C3.09729 11.6534 2.45787 10.5874 2.17042 9.40633C1.88297 8.22523 1.96105 6.98467 2.39432 5.84893C2.82759 4.71319 3.59561 3.73583 4.59669 3.04628C5.59776 2.35673 6.78467 1.98751 8.00025 1.98751C9.21583 1.98751 10.4027 2.35673 11.4038 3.04628C12.4049 3.73583 13.1729 4.71319 13.6062 5.84893C14.0395 6.98467 14.1175 8.22523 13.8301 9.40633C13.5426 10.5874 12.9032 11.6534 11.9965 12.463Z"
                                                    fill="currentColor"
                                                />
                                            </svg>
                                        </div>
                                        {{
                                            locale === "en"
                                                ? jobData.vacancy
                                                : convertToBengaliDigits(
                                                      jobData.vacancy
                                                  )
                                        }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trusted company -->
    <div class="trusted-company-area">
        <div class="container">
            <div class="trusted-company-content">
                <h4>Trusted by Leading Companies</h4>
                <div class="d-flex align-items-center justify-content-between">
                    <div
                        v-for="companyData in company"
                        :key="companyData.id"
                        class="company-logo-img"
                    >
                        <img
                            :src="
                                companyData.profile
                                    ? getCompanyImageUrl(companyData.profile)
                                    : 'frontend/img/company.png'
                            "
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
