<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "Index",
    layout: Layout,
    props: {
        category: Array,
        job: Array
    },
    data() {
        return {
            locale: localStorage.getItem('locale') || 'bn',  // Default to Bengali if no locale is stored
            selectedCategory: null,  // This will store the selected category ID or null for "All"
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
        }
    },
    computed: {
        // Compute filtered jobs based on selected category
        // filteredJobs() {
        //     if (!this.selectedCategory) {
        //         return this.job;
        //     }
        //     return this.job.filter(jobData => jobData.category_id === this.selectedCategory);
        // }
        filteredJobs() {
            return this.job.filter((jobData) => {
                const matchesCategory = !this.selectedCategory || jobData.category_id === this.selectedCategory;
                const matchesKeyword =
                    !this.searchKeyword ||
                    jobData.title.toLowerCase().includes(this.searchKeyword.toLowerCase()) ||
                    (jobData.title_bn && jobData.title_bn.toLowerCase().includes(this.searchKeyword.toLowerCase()));

                return matchesCategory && matchesKeyword;
            });
        }
    }
}
</script>

<template>
    <head>
        <title>Job</title>
    </head>
    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="slider_text">
                            <h3 v-if="locale === 'en'" class="wow fadeInLeft" style="color: #0a0a0a" data-wow-duration="1s" data-wow-delay=".3s">Find your Dream Job</h3>
                            <h3 v-else class="wow fadeInLeft" style="color: #0a0a0a" data-wow-duration="1s" data-wow-delay=".3s">আপনার স্বপ্নের চাকরি খুঁজুন</h3>
                            <div class="sldier_btn wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".5s">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ilstration_img wow fadeInRight d-none d-lg-block text-right" data-wow-duration="1s" data-wow-delay=".2s">
            <img src="frontend/img/banner/illustration.png" alt="">
        </div>
    </div>

    <!-- category_area -->
    <div class="catagory_area">
        <div class="container">
            <div class="row cat_search">
                <div class="col-lg-12 col-md-4">
                    <div class="single_input">
                        <input
                            type="text"
                            placeholder="Search by title"
                            v-model="searchKeyword"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- popular_category_area_start  -->
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
                        <p  v-if="locale === 'en'">
                            <span>50</span>
                            Available position
                        </p>
                        <p  v-else>
                            <span>50</span>
                             পদ শূন্য  আছে
                        </p>
                    </a>
                </div>

                <div v-for="categoryData in category" :key="categoryData.id" class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_catagory">
                        <a href="#" @click.prevent="selectCategory(categoryData.id)">
                            <h4 v-if="locale === 'en'">{{ categoryData.name }}</h4>
                            <h4 v-else>{{ categoryData.name_bn }}</h4>
                        </a>
                        <p  v-if="locale === 'en'">
                            <span>50</span>
                            Available position
                        </p>
                        <p  v-else>
                            <span>50</span>
                            পদ শূন্য  আছে
                        </p>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- job_listing_area_start  -->



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
                    <div class="brouse_job text-right">
                        <Link href="/job-board" class="boxed-btn4">
                            <span v-if="locale === 'en'">More Job</span>
                            <span v-else>আরও কাজ</span>
                        </Link>
                    </div>
                </div>
            </div>
            <div class="job_lists">
                <div class="row">
                    <div v-for="jobData in filteredJobs" :key="jobData.id" class="col-lg-12 col-md-12">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="frontend/img/svg_icon/1.svg" alt="">
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
                <div class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_company">
                        <div class="thumb">
                            <img src="frontend/img/svg_icon/5.svg" alt="">
                        </div>
                        <a href="jobs.html"><h3>Snack Studio</h3></a>
                        <p> <span>50</span> Available position</p>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_company">
                        <div class="thumb">
                            <img src="frontend/img/svg_icon/4.svg" alt="">
                        </div>
                        <a href="jobs.html"><h3>Snack Studio</h3></a>
                        <p> <span>50</span> Available position</p>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_company">
                        <div class="thumb">
                            <img src="frontend/img/svg_icon/3.svg" alt="">
                        </div>
                        <a href="jobs.html"><h3>Snack Studio</h3></a>
                        <p> <span>50</span> Available position</p>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_company">
                        <div class="thumb">
                            <img src="img/svg_icon/1.svg" alt="">
                        </div>
                        <a href="jobs.html"><h3>Snack Studio</h3></a>
                        <p> <span>50</span> Available position</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
