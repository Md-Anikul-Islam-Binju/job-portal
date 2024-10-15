<script>


import Layout from "../frontend/Layout.vue";

export default {
    name: "Index",
    layout : Layout,
    props: {
        category: Array,
        job: Array
    },
    data() {
        return {
            locale: localStorage.getItem('locale') || 'bn'  // Default to Bengali if no locale is stored
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
            };

            const englishToBengaliMonths = {
                "January": "জানুয়ারি",
                "February": "ফেব্রুয়ারি",
                "March": "মার্চ",
                "April": "এপ্রিল",
                "May": "মে",
                "June": "জুন",
                "July": "জুলাই",
                "August": "আগস্ট",
                "September": "সেপ্টেম্বর",
                "October": "অক্টোবর",
                "November": "নভেম্বর",
                "December": "ডিসেম্বর"
            };

            const dateObj = new Date(date);
            const day = dateObj.getDate().toString().replace(/\d/g, (digit) => englishToBengaliDigits[digit]);
            const month = dateObj.toLocaleString('en-US', { month: 'long' });
            const bengaliMonth = englishToBengaliMonths[month];
            const year = dateObj.getFullYear().toString().replace(/\d/g, (digit) => englishToBengaliDigits[digit]);

            return `${day} ${bengaliMonth} ${year}`;
        }
    }
}

</script>

<template>
    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="slider_text">
                            <h5 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".2s">4536+ Jobs listed</h5>
                            <h3 class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">Find your Dream Job</h3>
                            <p class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".4s">We provide online instant cash loans with quick approval that suit your term length</p>
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
                <div class="col-lg-3 col-md-4">
                    <div class="single_input">
                        <input type="text" placeholder="Search keyword">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="single_input">
                        <select class="wide" >
                            <option data-display="Location">Location</option>
                            <option value="1">Dhaka</option>
                            <option value="2">Rangpur</option>
                            <option value="4">Sylet</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="single_input">
                        <select class="wide">
                            <option data-display="Category">Category</option>
                            <option value="1">Category 1</option>
                            <option value="2">Category 2</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="job_btn">
                        <a href="#" class="boxed-btn3">Find Job</a>
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
                    <div class="section_title mb-40">
                        <h4 v-if="locale === 'en'">Popular Categories</h4>
                        <h4 v-else>কাজের তালিকা</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div v-for="categoryData in category" :key="categoryData.id" class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_catagory">
                        <a href="#">
                            <h4 v-if="locale === 'en'">{{ categoryData.name }}</h4>
                            <h4 v-else>{{ categoryData.name_bn }}</h4>
                        </a>

                        <p  v-if="locale === 'en'">
                            <span>50</span>
                            Available position
                        </p>

                        <p  v-else>
                            <span>50</span>
                            উপলব্ধ পদ
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
                        <a href="jobs.html" class="boxed-btn4">
                            <span v-if="locale === 'en'">More Job</span>
                            <span v-else>আরও কাজ</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="job_lists">
                <div class="row">
                    <div  v-for="jobData in job" :key="jobData.id"  class="col-lg-12 col-md-12">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="frontend/img/svg_icon/1.svg" alt="">
                                </div>
                                <div class="jobs_conetent">
                                    <a href="job_details.html">
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
                                    <a href="job_details.html" class="boxed-btn3">Apply Now</a>
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

    <!-- job_searcing_wrap  -->
    <div class="job_searcing_wrap overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-1 col-md-6">
                    <div class="searching_text">
                        <h3>Looking for a Job?</h3>
                        <p>We provide online instant cash loans with quick approval </p>
                        <a href="#" class="boxed-btn3">Browse Job</a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 col-md-6">
                    <div class="searching_text">
                        <h3>Looking for a Expert?</h3>
                        <p>We provide online instant cash loans with quick approval </p>
                        <a href="#" class="boxed-btn3">Post a Job</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
