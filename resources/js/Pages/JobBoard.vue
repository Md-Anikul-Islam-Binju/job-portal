<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "JobBoard",
    layout: Layout,
    props: {
        category: Array,
        job: Array,
        locations: Array,
        siteSetting: Object,
        auth: Object,
    },
    data() {
        return {
            locale: localStorage.getItem('locale') || 'bn',
            selectedCategory: 'all',
            selectedLocation: 'all',
            searchKeyword: '',
            filteredJobs: [],
            currentPage: 1,   // Track current page
            jobsPerPage: 50,  // Number of jobs to show per page
        };
    },
    watch: {
        job: {
            immediate: true,
            handler(newJobs) {
                console.log("Job data loaded:", newJobs);
                if (newJobs && newJobs.length > 0) {
                    this.$nextTick(() => {
                        this.filterJobs();
                    });
                }
            },
        },
        selectedCategory() {
            this.filterJobs();
        },
        selectedLocation() {
            this.filterJobs();
        },
        searchKeyword() {
            this.filterJobs();
        },
    },
    computed: {
        // Paginate filtered jobs based on currentPage and jobsPerPage
        paginatedJobs() {
            const startIndex = (this.currentPage - 1) * this.jobsPerPage;
            const endIndex = startIndex + this.jobsPerPage;
            return this.filteredJobs.slice(startIndex, endIndex);
        },
        // Calculate the total number of pages
        totalPages() {
            return Math.ceil(this.filteredJobs.length / this.jobsPerPage);
        }
    },
    methods: {
        filterJobs() {
            this.$nextTick(() => {
                const keyword = this.searchKeyword.toLowerCase().trim();
                this.filteredJobs = this.job.filter((job) => {
                    const matchesCategory =
                        this.selectedCategory === 'all' || job.category_id === parseInt(this.selectedCategory);
                    const matchesLocation =
                        this.selectedLocation === 'all' || job.location_id === parseInt(this.selectedLocation);
                    const matchesKeyword =
                        keyword === '' ||
                        job.title.toLowerCase().includes(keyword) ||
                        (job.title_bn && job.title_bn.toLowerCase().includes(keyword));
                    return matchesCategory && matchesLocation && matchesKeyword;
                });
                // Reset to the first page after filtering
                this.currentPage = 1;
                console.log("Filtered Jobs:", this.filteredJobs);
            });
        },
        formatDateEnglish(date) {
            const dateObj = new Date(date);
            const day = dateObj.getDate();
            const month = dateObj.toLocaleString('en-US', { month: 'long' });
            const year = dateObj.getFullYear();
            return `${day} ${month} ${year}`;
        },
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
        // Method to change the page
        goToPage(pageNumber) {
            if (pageNumber >= 1 && pageNumber <= this.totalPages) {
                this.currentPage = pageNumber;
            }
        },
    },
    mounted() {
        if (this.job.length === 0) {
            this.$inertia.get('/jobs').then((response) => {
                console.log("Fetched Job Data:", response);
                this.job = response.data;
            });
        }
    }
};
</script>

<template>
    <head>
        <title>Job Board</title>
    </head>

    <div class="job-board-container">
        <!-- Header Section -->
        <div class="bradcam_area bradcam_bg_1">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bradcam_text">
                            <h3 style="color: black">4536+ Jobs Available</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Listing Area -->
        <div class="job_listing_area plus_padding flex-fill">
            <div class="container h-100 d-flex">
                <div class="row w-100">
                    <!-- Filter Sidebar -->
                    <div class="col-lg-3">
                        <div class="job_filter white-bg">
                            <div class="form_inner white-bg">
                                <h3>Filter</h3>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="single_field">
                                                <input
                                                    type="text"
                                                    placeholder="Search by title"
                                                    v-model="searchKeyword" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Main Job List Section -->
                    <div class="col-lg-9 d-flex flex-column">
                        <div class="recent_joblist_wrap">
                            <div class="recent_joblist white-bg ">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h4>Job Listing</h4>
                                    </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Category Dropdown -->
                                        <div class="custom-dropdown d-flex justify-content-end">
                                            <select v-model="selectedCategory" class="custom-select">
                                                <option value="all">All Categories</option>
                                                <option v-for="cat in category" :key="cat.id" :value="cat.id">
                                                    {{ locale === 'en' ? cat.name : cat.name_bn }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Location Dropdown -->
                                        <div class="custom-dropdown d-flex justify-content-end">
                                            <select v-model="selectedLocation" class="custom-select">
                                                <option value="all">All Locations</option>
                                                <option v-for="loc in locations" :key="loc.id" :value="loc.id">
                                                    {{ locale === 'en' ? loc.name : loc.name_bn }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>


                        <!-- Job List Display -->
                        <p v-if="job.length === 0">Loading jobs...</p>
                        <p v-else-if="paginatedJobs.length > 0">Showing {{ paginatedJobs.length }} jobs</p>
                        <p v-else>No jobs available in this category.</p>

                        <!-- Display Paginated Jobs -->
                        <div class="job_lists m-0 flex-grow-1 overflow-auto">
                            <div class="row">
                                <div v-if="paginatedJobs.length > 0" v-for="jobData in paginatedJobs" :key="jobData.id" class="col-lg-12 col-md-12">
                                    <div class="single_jobs white-bg d-flex justify-content-between">
                                        <div class="jobs_left d-flex align-items-center">
                                            <div class="jobs_conetent">
                                                <Link :href="`/job-details/${jobData.id}`">
                                                    <h4 v-if="locale === 'en'">{{ jobData.title }}</h4>
                                                    <h4 v-else>{{ jobData.title_bn }}</h4>
                                                </Link>
                                                <div class="links_locat d-flex align-items-center">
                                                    <div class="location">
                                                        <p v-if="locale === 'en'">
                                                            <i class="fa fa-map-marker"></i> {{ jobData.address }}
                                                        </p>
                                                        <p v-else>
                                                            <i class="fa fa-map-marker"></i> {{ jobData.address_bn }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="jobs_right">
                                            <div class="apply_now">
                                                <Link :href="`/job-details/${jobData.id}`" class="boxed-btn3">Apply Now</Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination Controls -->
                        <div class="pagination-controls mt-4 d-flex justify-content-center" v-if="totalPages > 1">
                            <button class="btn btn-primary mx-1" @click="goToPage(currentPage - 1)" :disabled="currentPage === 1">
                                Previous
                            </button>
                            <button
                                v-for="page in totalPages"
                                :key="page"
                                class="btn"
                                :class="{ 'btn-primary': page === currentPage, 'btn-secondary': page !== currentPage }"
                                @click="goToPage(page)"
                            >
                                {{ page }}
                            </button>
                            <button class="btn btn-primary mx-1" @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


