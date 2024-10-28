<template>
    <head>
        <title>Job Details</title>
    </head>
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Software Engineer</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="job_details_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="img/svg_icon/1.svg" alt="">
                                </div>
                                <div class="jobs_conetent">
                                    <a href="#">
                                        <h4 v-if="locale === 'en'">{{ job.title }}</h4>
                                        <h4 v-else>{{ job.title_bn }}</h4>
                                    </a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p v-if="locale === 'en'">
                                                <i class="fa fa-map-marker"></i>
                                                {{ job.address }}
                                            </p>
                                            <p v-else>
                                                <i class="fa fa-map-marker"></i>
                                                {{ job.address_bn }}
                                            </p>
                                        </div>
                                        <div class="location">
                                            <p>
                                                <i class="fa fa-clock-o"></i>
                                                <span v-if="locale === 'en'">{{ formatDateEnglish(job.deadline) }}</span>
                                                <span v-else>{{ formatDateBengali(job.deadline) }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">


                            <h4 v-if="locale === 'en'">Job description</h4>
                            <h4 v-else>কাজের বিবরণ</h4>

                            <span  v-if="locale === 'en'">
                                 <p v-html="job.details"></p>
                            </span>
                            <span  v-else>
                                 <p v-html="job.details_bn"></p>
                            </span>

                        </div>
                    </div>
                    <div class="apply_job_form white-bg">
                        <div class="container">
                            <a
                                :href="`/jobs/apply/${job.id}`"
                                @click.prevent="applyJobDirectly"
                                class="boxed-btn3 w-100"
                                :class="{ disabled: hasApplied }"
                            >
                                {{ hasApplied ? (locale === 'en' ? 'Already Applied' : 'ইতিমধ্যে আবেদন করেছেন') : (locale === 'en' ? 'Apply Now' : 'এখনই আবেদন করুন') }}
                            </a>
                        </div>
                    </div>



                </div>
                <div class="col-lg-4">
                    <div class="job_sumary">
                        <div class="summery_header">
                            <h3></h3>

                            <h4 v-if="locale === 'en'">Job Summery</h4>
                            <h4 v-else>কাজের সারাংশ</h4>


                        </div>
                        <div class="job_content">
                            <ul>
                                <li v-if="locale === 'en'">Published Date: <span>{{ formatDateEnglish(job.created_at) }}</span></li>
                                <li v-else>প্রকাশের তারিখ: <span>{{ formatDateBengali(job.created_at) }}</span></li>

                                <li v-if="locale === 'en'">Vacancy: <span> {{ job.vacancy }}</span></li>
                                <li v-else>শূন্যপদ: <span> {{ convertToBengaliDigits(job.vacancy) }}</span></li>

                                <li v-if="locale === 'en'">Salary: <span> {{ job.salary }}</span></li>
                                <li v-else>বেতন: <span> {{ convertToBengaliDigits(job.salary) }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Layout from "../frontend/Layout.vue";
import Swal from "sweetalert2";

export default {
    name: "JobDetails",
    layout: Layout,
    props: {
        job: Array,
        siteSetting: Object,
        auth:Object,
        appliedJobs: Array,
    },
    data() {
        return {
            isAuthenticated: !!window.user,
            locale: localStorage.getItem('locale') || 'bn',  // Default to Bengali if no locale is stored
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

    computed: {
        hasApplied() {
            return this.appliedJobs.includes(this.job.id);
        }
    },

    methods: {
        applyJobDirectly(event) {
            event.preventDefault();

            axios.get(event.target.href)
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: this.locale === 'en' ? response.data.message : "আবেদন সফল হয়েছে!",
                        confirmButtonText: 'OK'
                    });
                })
                .catch(error => {
                    if (error.response && error.response.status === 409) {
                        Swal.fire({
                            icon: 'warning',
                            title: this.locale === 'en' ? "You have already applied for this job." : "আপনি ইতিমধ্যে এই কাজের জন্য আবেদন করেছেন।",
                            confirmButtonText: 'OK'
                        });
                    } else if (error.response && error.response.status === 401) {
                        Swal.fire({
                            icon: 'warning',
                            title: this.locale === 'en' ? "Please login to apply for the job." : "দয়া করে আবেদন করতে লগইন করুন।",
                            confirmButtonText: 'OK'
                        });
                        window.location.href = '/login';
                    } else {
                        console.error("Error applying for job:", error);
                    }
                });
        },

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
            const day = dateObj.getDate().toString().replace(/\d/g, (digit) => this.englishToBengaliDigits[digit]);
            const month = dateObj.toLocaleString('en-US', { month: 'long' });
            const bengaliMonth = englishToBengaliMonths[month];
            const year = dateObj.getFullYear().toString().replace(/\d/g, (digit) => this.englishToBengaliDigits[digit]);

            return `${day} ${bengaliMonth} ${year}`;
        },

        // Helper method to convert English digits to Bengali digits
        convertToBengaliDigits(number) {
            return number.toString().replace(/\d/g, (digit) => this.englishToBengaliDigits[digit]);
        },
    },
}
</script>
<style scoped>
</style>
