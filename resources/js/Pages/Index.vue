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
        company: Array
    },
    data() {
        return {
            locale: localStorage.getItem('locale') || 'bn',
            selectedCategory: null,
            selectedLocation: null,
            searchKeyword: ''
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
        }

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

    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="slider_text">
                            <h3 v-if="locale === 'en'" class="wow fadeInLeft" style="color: #0a0a0a" data-wow-duration="1s" data-wow-delay=".3s">
                                {{ slider.title }}</h3>
                            <h3 v-else class="wow fadeInLeft" style="color: #0a0a0a" data-wow-duration="1s" data-wow-delay=".3s"> {{ slider.title_bn }}</h3>
                            <div class="sldier_btn wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".5s">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ilstration_img wow fadeInRight d-none d-lg-block text-right" data-wow-duration="1s" data-wow-delay=".2s">
            <img :src="getSliderUrl(slider?.image)" alt="">
        </div>
    </div>

    <!-- Location Filter -->
    <div class="catagory_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="popular_search d-flex align-items-center">
                        <!-- Location label -->
                        <span v-if="locale === 'en'">Popular Location:</span>
                        <span v-else>জনপ্রিয় লোকেশন </span>

                        <!-- Location filter list displayed on the same line -->
                        <ul class="d-flex list-inline m-0">
                            <!-- 'All' location option -->
                            <li class="mr-3">
                                <a href="#" @click.prevent="selectLocation(null)">
                                    <h4 v-if="locale === 'en'">All</h4>
                                    <h4 v-else>সব</h4>
                                </a>
                            </li>

                            <!-- Dynamic Location options -->
                            <li v-for="locationData in location" :key="locationData.id" class="mr-3">
                                <a href="#" @click.prevent="selectLocation(locationData.id)">
                                    <span v-if="locale === 'en'">{{ locationData.name }}</span>
                                    <span v-else>{{ locationData.name_bn }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Job Categories Area -->
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
                <div class="single_catagory">
                    <a href="#" @click.prevent="selectCategory(null)">
                        <h4 v-if="locale === 'en'">All</h4>
                        <h4 v-else>সব</h4>
                        <p v-if="locale === 'en'">Available position</p>
                        <p v-else>পদ শূন্য  আছে</p>
                    </a>
                </div>

                <div v-for="categoryData in category" :key="categoryData.id" class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_catagory">
                        <a href="#" @click.prevent="selectCategory(categoryData.id)">
                            <h4 v-if="locale === 'en'">{{ categoryData.name }}</h4>
                            <h4 v-else>{{ categoryData.name_bn }}</h4>
                        </a>
                        <p v-if="locale === 'en'"><span>50</span> Available position</p>
                        <p v-else>পদ শূন্য  আছে</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Job Listing Area -->
    <div class="job_listing_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section_title">
                        <h4 v-if="locale === 'en'">Job Listing</h4>
                        <h4 v-else>কাজের তালিকা</h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="job text-right">
                        <Link href="/job-board">
                            <h4 v-if="locale === 'en'">More Job</h4>
                            <h4 v-else>আরও কাজ</h4>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Job Search Area -->
            <div class="row cat_search">
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
                                    <img src="frontend/img/company.png" alt="" style="height: 50px;">
                                </div>
                                <div class="jobs_conetent">
                                    <a :href="`/job-details/${jobData.id}`">
                                        <h4 v-if="locale === 'en'">{{ jobData.title }}</h4>
                                        <h4 v-else>{{ jobData.title_bn }}</h4>
                                    </a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p v-if="locale === 'en'">
                                                <i class="fa fa-map-marker"></i>
                                                {{ jobData.address }}
                                            </p>
                                            <p v-else>
                                                <i class="fa fa-map-marker"></i>
                                                {{ jobData.address_bn }}
                                            </p>
                                        </div>
                                        <div class="location">
                                            <p>
                                                <i class="fa fa-clock-o"></i>
                                                <span v-if="locale === 'en'">{{ formatDateEnglish(jobData.deadline) }}</span>
                                                <span v-else>{{ formatDateBengali(jobData.deadline) }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a :href="`/job-details/${jobData.id}`" class="boxed-btn3">
                                        <span v-if="locale === 'en'">Apply Now</span>
                                        <span v-else>আবেদন করুন</span>
                                    </a>
                                </div>
                            </div>
                        </div>
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
                        <h3></h3>
                        <h4 v-if="locale === 'en'">Top Companies</h4>
                        <h4 v-else>শীর্ষ কোম্পানি</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div v-for="companyData in company" :key="companyData.id" class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_company">
                        <div class="thumb">
                            <img
                                :src="companyData.profile ? getCompanyImageUrl(companyData.profile) : 'frontend/img/company.png'"
                                alt="Company Image" style="height: 35px;"
                            >
                        </div>
                        <a href="jobs.html">
                            <h3 v-if="locale === 'en'">{{ companyData.name }}</h3>
                            <h3 v-else>{{ companyData.name_bn }}</h3>
                        </a>
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
</style>
