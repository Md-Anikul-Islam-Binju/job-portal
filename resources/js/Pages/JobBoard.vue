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
            currentPage: 1,
            jobsPerPage: 50,
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

        getCompanyImageUrl(imagePath) {
            if (!imagePath) {
                return 'frontend/img/company.png'; // You might want to return a default image directly here too
            }
            return `${window.location.origin}/images/logo/${imagePath}`; // Adjust the path as necessary
        },
        convertToBengaliDigits(number) {
            return number.toString().replace(/\d/g, (digit) => this.englishToBengaliDigits[digit]);
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
        <title>GarmentsNiyog - Job</title>
    </head>

    <div class="my-jobs-section-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="quick-search">
                        <h2>Quick Search</h2>
                        <form class="jobs-search-form">
                            <input
                                type="text"
                                :placeholder="locale === 'en' ? 'Search by title' : 'অনুসন্ধান করুন'"
                                v-model="searchKeyword" />

                            <select v-model="selectedLocation" name="locationId">
                                <option v-if="locale === 'en'"   value="all">All Locations</option>
                                <option v-else value="all">সকল  লোকেশন</option>
                                <option v-for="loc in locations" :key="loc.id" :value="loc.id">
                                    {{ locale === 'en' ? loc.name : loc.name_bn }}
                                </option>
                            </select>

                            <select v-model="selectedCategory" name="categoryId">
                                <option v-if="locale === 'en'" value="all">All Categories</option>
                                <option v-else value="all">সকল  ক্যাটাগরি </option>
                                <option v-for="cat in category" :key="cat.id" :value="cat.id">
                                    {{ locale === 'en' ? cat.name : cat.name_bn }}
                                </option>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Job List Display -->


                <div class="col-lg-9 col-md-8">
                    <div class="jobs-card-wrapper">
                        <div class="found-jobs-count-wrap">
                            <h3 v-if="job.length === 0">Loading jobs...</h3>
                            <h3 v-else-if="paginatedJobs.length > 0">We found {{ paginatedJobs.length }} jobs</h3>
                            <h3 v-else>No jobs available in this category.</h3>
                        </div>
                        <div class="jobs-card-wrap">
                            <div class="row">
                                <div v-if="paginatedJobs.length > 0" v-for="jobData in paginatedJobs" :key="jobData.id" class="col-md-6 col-12">
                                    <div class="job-card position-relative">
                                        <div class="company-logo">
                                            <img :src="jobData.company.profile ? getCompanyImageUrl(jobData.company.profile) : 'frontend/img/company.png'" alt="">
                                        </div>
                                        <div class="job-card-top">
                                            <h3>
                                                <Link :href="`/job-details/${jobData.id}`"
                                                >{{ locale === 'en' ? jobData.title : jobData.title_bn }}</Link
                                                >
                                            </h3>
                                            <p>{{ locale === 'en' ? jobData.company.name : jobData.company.name_bn }}</p>
                                        </div>
                                        <div class="salary">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                viewBox="0 0 16 16"
                                                fill="none"
                                            >
                                                <path
                                                    d="M7.5 5.23134C6.876 5.40201 6.5 5.88134 6.5 6.33334C6.5 6.78534 6.876 7.26467 7.5 7.43467V5.23134ZM8.5 8.56534V10.768C9.124 10.598 9.5 10.1187 9.5 9.66667C9.5 9.21467 9.124 8.73534 8.5 8.56534Z"
                                                    fill="#388EA9"
                                                />
                                                <path
                                                    fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="M14.6668 8C14.6668 11.682 11.6822 14.6667 8.00016 14.6667C4.31816 14.6667 1.3335 11.682 1.3335 8C1.3335 4.318 4.31816 1.33333 8.00016 1.33333C11.6822 1.33333 14.6668 4.318 14.6668 8ZM8.00016 3.49999C8.13277 3.49999 8.25995 3.55267 8.35372 3.64644C8.44748 3.74021 8.50016 3.86739 8.50016 3.99999V4.21133C9.58683 4.40599 10.5002 5.22266 10.5002 6.33333C10.5002 6.46594 10.4475 6.59311 10.3537 6.68688C10.2599 6.78065 10.1328 6.83333 10.0002 6.83333C9.86755 6.83333 9.74038 6.78065 9.64661 6.68688C9.55284 6.59311 9.50016 6.46594 9.50016 6.33333C9.50016 5.88133 9.12416 5.402 8.50016 5.23133V7.54466C9.58683 7.73933 10.5002 8.55599 10.5002 9.66666C10.5002 10.7773 9.58683 11.594 8.50016 11.7887V12C8.50016 12.1326 8.44748 12.2598 8.35372 12.3535C8.25995 12.4473 8.13277 12.5 8.00016 12.5C7.86755 12.5 7.74038 12.4473 7.64661 12.3535C7.55284 12.2598 7.50016 12.1326 7.50016 12V11.7887C6.4135 11.594 5.50016 10.7773 5.50016 9.66666C5.50016 9.53405 5.55284 9.40688 5.64661 9.31311C5.74038 9.21934 5.86755 9.16666 6.00016 9.16666C6.13277 9.16666 6.25995 9.21934 6.35372 9.31311C6.44748 9.40688 6.50016 9.53405 6.50016 9.66666C6.50016 10.1187 6.87616 10.598 7.50016 10.768V8.45533C6.4135 8.26066 5.50016 7.44399 5.50016 6.33333C5.50016 5.22266 6.4135 4.40599 7.50016 4.21133V3.99999C7.50016 3.86739 7.55284 3.74021 7.64661 3.64644C7.74038 3.55267 7.86755 3.49999 8.00016 3.49999Z"
                                                    fill="#388EA9"
                                                />
                                            </svg>
                                            {{ jobData.salary
                                            ? (locale === 'en' ? jobData.salary : convertToBengaliDigits(jobData.salary))
                                            : (locale === 'en' ? 'Negotiable' : 'আলোচনা সাপেক্ষে') }}
                                        </div>
                                        <ul>
                                            <li>
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    viewBox="0 0 16 16"
                                                    fill="none"
                                                >
                                                    <path
                                                        d="M13.5 4H11C11 3.20435 10.6839 2.44129 10.1213 1.87868C9.55871 1.31607 8.79565 1 8 1C7.20435 1 6.44129 1.31607 5.87868 1.87868C5.31607 2.44129 5 3.20435 5 4H2.5C2.23478 4 1.98043 4.10536 1.79289 4.29289C1.60536 4.48043 1.5 4.73478 1.5 5V12.5C1.5 12.7652 1.60536 13.0196 1.79289 13.2071C1.98043 13.3946 2.23478 13.5 2.5 13.5H13.5C13.7652 13.5 14.0196 13.3946 14.2071 13.2071C14.3946 13.0196 14.5 12.7652 14.5 12.5V5C14.5 4.73478 14.3946 4.48043 14.2071 4.29289C14.0196 4.10536 13.7652 4 13.5 4ZM8 2C8.53043 2 9.03914 2.21071 9.41421 2.58579C9.78929 2.96086 10 3.46957 10 4H6C6 3.46957 6.21071 2.96086 6.58579 2.58579C6.96086 2.21071 7.46957 2 8 2Z"
                                                        fill="currentColor"
                                                    />
                                                </svg>
                                                Full Time
                                            </li>
                                            <li>
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    viewBox="0 0 16 16"
                                                    fill="none"
                                                >
                                                    <path
                                                        d="M6.74333 14.5407C7.14733 14.874 7.56867 15.1787 8 15.476C8.43226 15.1826 8.85155 14.8705 9.25667 14.5407C9.932 13.9862 10.5676 13.3849 11.1587 12.7413C12.5213 11.2513 14 9.09134 14 6.66667C14 5.87874 13.8448 5.09852 13.5433 4.37057C13.2417 3.64262 12.7998 2.98118 12.2426 2.42403C11.6855 1.86688 11.0241 1.42492 10.2961 1.12339C9.56815 0.821866 8.78793 0.666672 8 0.666672C7.21207 0.666672 6.43185 0.821866 5.7039 1.12339C4.97595 1.42492 4.31451 1.86688 3.75736 2.42403C3.20021 2.98118 2.75825 3.64262 2.45672 4.37057C2.15519 5.09852 2 5.87874 2 6.66667C2 9.09134 3.47867 11.2507 4.84133 12.7413C5.43241 13.3851 6.06798 13.9859 6.74333 14.5407ZM8 8.83334C7.42536 8.83334 6.87426 8.60507 6.46794 8.19874C6.06161 7.79241 5.83333 7.24131 5.83333 6.66667C5.83333 6.09204 6.06161 5.54094 6.46794 5.13461C6.87426 4.72828 7.42536 4.50001 8 4.50001C8.57464 4.50001 9.12574 4.72828 9.53206 5.13461C9.93839 5.54094 10.1667 6.09204 10.1667 6.66667C10.1667 7.24131 9.93839 7.79241 9.53206 8.19874C9.12574 8.60507 8.57464 8.83334 8 8.83334Z"
                                                        fill="currentColor"
                                                    />
                                                </svg>
                                                {{ locale === 'en' ? jobData.address : jobData.address_bn }}
                                            </li>
                                        </ul>
                                        <div class="job-card-bottom">
                                            <div class="deadline">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    viewBox="0 0 16 16"
                                                    fill="none"
                                                >
                                                    <path
                                                        d="M8.00016 1.33334C11.6822 1.33334 14.6668 4.31801 14.6668 8.00001C14.6668 11.682 11.6822 14.6667 8.00016 14.6667C4.31816 14.6667 1.3335 11.682 1.3335 8.00001C1.3335 4.31801 4.31816 1.33334 8.00016 1.33334ZM8.00016 4.00001C7.82335 4.00001 7.65378 4.07025 7.52876 4.19527C7.40373 4.3203 7.3335 4.48987 7.3335 4.66668V8.00001C7.33353 8.17681 7.4038 8.34635 7.52883 8.47134L9.52883 10.4713C9.65456 10.5928 9.82297 10.66 9.99776 10.6585C10.1726 10.6569 10.3398 10.5868 10.4634 10.4632C10.587 10.3396 10.6571 10.1724 10.6586 9.99761C10.6601 9.82281 10.5929 9.65441 10.4715 9.52868L8.66683 7.72401V4.66668C8.66683 4.48987 8.59659 4.3203 8.47157 4.19527C8.34654 4.07025 8.17697 4.00001 8.00016 4.00001Z"
                                                        fill="#388EA9"
                                                    />
                                                </svg>
                                                {{ locale === 'en' ? formatDateEnglish(jobData.deadline) : formatDateBengali(jobData.deadline) }}
                                            </div>
                                            <div class="job-card-action">
                                                <Link :href="`/job-details/${jobData.id}`" class="apply-now">
                                                    {{ locale === 'en' ? 'Apply Now' : 'আবেদন করুন' }}
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    </div>
    <!-- are you looking for a job -->
    <div class="are-you-looking-for-a-job section-padding">
        <div class="container">
            <div class="are-you-looking-for-a-job-content">
                <div class="left-content">
                    <h4>Are you looking for a Job?</h4>
                    <h2>GarmentsNiyog is your key to Success!</h2>
                    <h5>
                        Our goal is to make your job search as easy as
                        possible.
                    </h5>
                </div>
                <div class="right-content">
                    <a href="/login" target="_blank">Register as Candidate</a>
                </div>
            </div>
        </div>
    </div>

</template>

<style  scoped>

</style>
