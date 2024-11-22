<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "Index",
    layout: Layout,
    props: {
        category: Array,
        location: Array,
        job: Array,
        slider:Object,
        company: Array,
        review: Array
    },
    data() {
        return {
            locale: localStorage.getItem('locale') || 'bn',
            selectedCategory: null,
            selectedLocation: null,
            searchKeyword: '',
            englishToBengaliDigits: {
                "0": "০",
                "1": "১",
                "2": "২",
                "3": "৩",
                "4": "৪",
                "5": "৫",
                "6": "৬",
                "7": "৭",
                "8": "৮",
                "9": "৯"
            }
        };
    },
    methods: {
        // Convert English Date Format to "Day Month Year" (e.g., "20 October 2024")
        formatDateEnglish(date) {
            const dateObj = new Date(date);
            const day = dateObj.getDate();
            const month = dateObj.toLocaleString('en-US', { month: 'long' });
            const year = dateObj.getFullYear();
            return `${day} ${month} ${year}`;
        },

        // Convert to Bengali Date Format (e.g., "২০ অক্টোবর ২০২৪")
        formatDateBengali(date) {
            const englishToBengaliDigits = {
                "0": "০", "1": "১", "2": "২", "3": "৩", "4": "৪",
                "5": "৫", "6": "৬", "7": "৭", "8": "৮", "9": "৯"
            };

            const englishToBengaliMonths = {
                "January": "জানুয়ারি", "February": "ফেব্রুয়ারি", "March": "মার্চ",
                "April": "এপ্রিল", "May": "মে", "June": "জুন", "July": "জুলাই",
                "August": "আগস্ট", "September": "সেপ্টেম্বর", "October": "অক্টোবর",
                "November": "নভেম্বর", "December": "ডিসেম্বর"
            };

            const dateObj = new Date(date);
            const day = dateObj.getDate().toString().replace(/\d/g, (digit) => englishToBengaliDigits[digit]);
            const month = dateObj.toLocaleString('en-US', { month: 'long' });
            const bengaliMonth = englishToBengaliMonths[month];
            const year = dateObj.getFullYear().toString().replace(/\d/g, (digit) => englishToBengaliDigits[digit]);

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
                return 'default-slider.png'; // Ensure this default image path is correct
            }
            // Update this line to prepend the correct path
            const fullUrl = `${window.location.origin}/images/slider/${sliderPath}`;
            console.log('Slider URL:', fullUrl); // Debugging output
            return fullUrl;
        },
        getCompanyImageUrl(imagePath) {
            if (!imagePath) {
                return 'frontend/img/company.png'; // You might want to return a default image directly here too
            }
            return `${window.location.origin}/images/logo/${imagePath}`; // Adjust the path as necessary
        },

        getReviewUserImageUrl(imagePath) {
            if (!imagePath) {
                return 'No Image'; // You might want to return a default image directly here too
            }
            return `${window.location.origin}/images/review/${imagePath}`; // Adjust the path as necessary
        },

        convertToBengaliDigits(number) {
            return number.toString().replace(/\d/g, (digit) => this.englishToBengaliDigits[digit]);
        },

    },
    computed: {

        // filteredJobs() {
        //     return this.job.filter((jobData) => {
        //         const matchesCategory = !this.selectedCategory || jobData.category_id === this.selectedCategory;
        //         const matchesKeyword =
        //             !this.searchKeyword ||
        //             jobData.title.toLowerCase().includes(this.searchKeyword.toLowerCase()) ||
        //             (jobData.title_bn && jobData.title_bn.toLowerCase().includes(this.searchKeyword.toLowerCase()));
        //
        //         return matchesCategory && matchesKeyword;
        //     });
        // }
        filteredJobs() {
            return this.job.filter((jobData) => {
                const matchesCategory = !this.selectedCategory || jobData.category_id === this.selectedCategory;
                const matchesLocation = !this.selectedLocation || jobData.location_id === this.selectedLocation;
                const matchesKeyword =
                    !this.searchKeyword ||
                    jobData.title.toLowerCase().includes(this.searchKeyword.toLowerCase()) ||
                    (jobData.title_bn && jobData.title_bn.toLowerCase().includes(this.searchKeyword.toLowerCase()));

                return matchesCategory && matchesLocation && matchesKeyword;
            });
        }
    }
}
</script>

<template>
    <head>
        <title>GarmentsNiyog - Home</title>
    </head>

    <div class="slider_area">
        <div class="banner-slider">
            <div class="single_slider  d-flex align-items-center">
                <img :src="getSliderUrl(slider.image)" class="position-absolute w-100 h-100 top-0 left-0" alt="">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-md-6">
                            <div class="slider_text">
                                <h3 v-if="locale === 'en'" class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">
                                    {{ slider.title }}</h3>
                                <h3 v-else class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s"> {{ slider.title_bn }}</h3>
                                <p class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".4s">We provide online
                                    instant cash loans with quick approval that suit your term length</p>
                                <div class="sldier_btn wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".5s">
                                    <a href="#job" class="boxed-btn3">Find Dream Job</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="catagory_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="popular_search d-flex align-items-center">
                        <span v-if="locale === 'en'">Location:</span>
                        <span v-else>লোকেশন </span>
                        <ul>
                            <li>
                                <a href="#" @click.prevent="selectLocation(null)">{{ locale === 'en' ? 'All' : 'সব' }}</a>
                            </li>
                            <li v-for="locationData in location" :key="locationData.id">
                                <a href="#" @click.prevent="selectLocation(locationData.id)">{{ locale === 'en' ? locationData.name : locationData.name_bn }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="popular_catagory_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title mb-3">
                        <h4 v-if="locale === 'en'">All Categories</h4>
                        <h4 v-else>সকল ক্যাটাগরি </h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_catagory">
                        <a href="#" @click.prevent="selectCategory(null)">
                            <h4 v-if="locale === 'en'">All</h4>
                            <h4 v-else>সব</h4>
                            <p v-if="locale === 'en'">Available position</p>
                            <p v-else>পদ শূন্য  আছে</p>
                        </a>
                    </div>
                </div>

                <div v-for="categoryData in category" :key="categoryData.id" class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_catagory">
                        <a href="#" @click.prevent="selectCategory(categoryData.id)">
                            <h4 v-if="locale === 'en'">{{ categoryData.name }}</h4>
                            <h4 v-else>{{ categoryData.name_bn }}</h4>
                        </a>
                        <p v-if="locale === 'en'"><span>{{ categoryData.jobs_count }}</span> Available position</p>
                        <p v-else><span>{{ convertToBengaliDigits(categoryData.jobs_count) }}</span>পদ শূন্য  আছে</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div  class="job_listing_area">
        <div class="container">
            <div  class="row align-items-center">
                <div class="col-lg-6">
                    <div id="job" class="section_title">
                        <h4>{{ locale === 'en' ? 'Job Listing' : 'কাজের তালিকা' }}</h4>
                    </div>
                </div>
            </div>

            <!-- Job Search Area -->
            <div  class="row cat_search">
                <div class="col-lg-12 col-md-4">
                    <div class="single_input">
                        <input
                            type="text"
                            :placeholder="locale === 'en' ? 'Search by title' : 'অনুসন্ধান করুন'"
                            v-model="searchKeyword"
                        />
                    </div>
                </div>
            </div>

            <!-- Filtered Jobs List -->
            <div class="job_lists">
                <div class="row">
                    <div v-for="jobData in filteredJobs" :key="jobData.id" class="col-lg-12 col-md-12">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <img :src="jobData.company.profile ? getCompanyImageUrl(jobData.company.profile) : 'frontend/img/company.png'" alt="" style="height: 50px;">
                                </div>
                                <div class="jobs_conetent">
                                    <Link :href="`/job-details/${jobData.id}`">
                                        <h5>{{ locale === 'en' ? jobData.title : jobData.title_bn }}</h5>
                                        <h6>{{ locale === 'en' ? jobData.company.name : jobData.company.name_bn }}</h6>
                                    </Link>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p>
                                                <i class="fa fa-map-marker"></i>
                                                {{ locale === 'en' ? jobData.address : jobData.address_bn }}
                                            </p>
                                        </div>
                                        <div class="location">
                                            <p>
                                                <i class="fa fa-clock-o"></i>
                                                <span v-if="locale === 'en'">{{ formatDateEnglish(jobData.deadline) }}</span>
                                                <span v-else>{{ formatDateBengali(jobData.deadline) }}</span>
                                            </p>
                                        </div>

                                        <div class="location">
                                            <p>
                                                <i class="fa fa-money"></i>
                                                <span v-if="locale === 'en'">
                                                    {{ jobData.salary ? jobData.salary : 'Negotiable' }}
                                                </span>
                                                                                        <span v-else>
                                                    {{ jobData.salary ? convertToBengaliDigits(jobData.salary) : 'আলোচনা সাপেক্ষে' }}
                                                </span>
                                            </p>
                                        </div>

                                        <div class="location">
                                            <p>
                                                <i class="fa fa-user"></i>
                                                <span v-if="locale === 'en'">{{ (jobData.vacancy) }}</span>
                                                <span v-else>{{ convertToBengaliDigits(jobData.vacancy) }}</span>
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <Link :href="`/job-details/${jobData.id}`" class="boxed-btn3">
                                        <span v-if="locale === 'en'">Apply Now</span>
                                        <span v-else>আবেদন করুন</span>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="featured_candidates_area candidate_page_padding">
        <div class="container">
            <div class="row align-items-center mb-40">
                <div class="col-lg-6 col-md-6">
                    <div class="section_title">
                        <h4> {{ locale === 'en' ? 'Companies' : 'কোম্পানি' }}</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div v-for="companyData in company" :key="companyData.id" class="col-md-6 col-lg-3">
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            <img :src="companyData.profile ? getCompanyImageUrl(companyData.profile) : 'frontend/img/company.png'" alt="">
                        </div>
                        <h4> {{ locale === 'en' ? companyData.name : companyData.name_bn }}</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="top_companies_area">
        <div class="container">
            <div class="row align-items-center mb-40">
                <div class="col-lg-6 col-md-6">
                    <div class="section_title">
                        <h4> {{ locale === 'en' ? 'User Feedback' : 'ব্যবহারকারীর প্রতিক্রিয়া' }}</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div v-for="reviewData in review" :key="reviewData.id" class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_company">
                        <div class="thumb">
                            <img :src="reviewData.image ? getReviewUserImageUrl(reviewData.image) : 'No Image'" style="height: 65px;">
                        </div>
                        <h3>{{ locale === 'en' ? reviewData.name : reviewData.name_bn }}</h3>
                        <p
                            v-html="locale === 'en' ? reviewData.details : reviewData.details_bn"
                            class="truncate-text">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>
.single_input input{
    height: 50px;
    border: 1px solid #E8E8E8;
    padding: 20px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    width: 100%;
}
.truncate-text {
    display: -webkit-box;
    -webkit-line-clamp: 4; /* Limits to 4 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
