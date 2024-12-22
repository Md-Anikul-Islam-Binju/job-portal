<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "Index",
    layout: Layout,
    props: {
        category: Array,
        location: Array,
        job: Array,
        slider:Array,
        company: Array,
        review: Array,
        jobTotal:Object
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



    <div class="hero-section-slider position-relative">
        <div class="swiper heroSlider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div
                        class="slider-image slider-bg-image"
                        style="
								background-image: url('frontend/images/slider-2.jpg');
							"
                    >
                        <div class="container">
                            <div class="slider-content">
                                <h2>Explore your dream job</h2>
                                <p>
                                    We provide online instant cash loans
                                    with quick approval that suit your term
                                    length
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="slider-image slider-bg-image"
                        style="
								background-image: url('frontend/images/slider-1.png');
							"
                    >
                        <div class="container">
                            <div class="slider-content">
                                <h2>
                                    Largest Platform for the rising
                                    workforce
                                </h2>
                                <p>
                                    Join our dynamic team to design
                                    user-centric solutions for our
                                    cutting-edge products. You'll
                                    collaborate with cross-functional
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
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
                    <a href="#" @click.prevent="selectLocation(null)">{{ locale === 'en' ? 'All' : 'সব' }}</a>
                </li>
                <li v-for="locationData in location" :key="locationData.id">
                    <a href="#" @click.prevent="selectLocation(locationData.id)">{{ locale === 'en' ? locationData.name : locationData.name_bn }}</a>
                </li>
            </ul>
            <div class="explore-by-category">
                <h2>{{ locale === 'en' ? 'Explore by Category' : 'বিভাগ অনুসারে অন্বেষণ করুন' }}</h2>
                <a href="#">View All</a>
            </div>
        </div>
    </div>



    <div class="category-section-area section-padding">
        <div class="container">
            <div  class="category-card-wrap d-flex flex-wrap">

                <a v-for="categoryData in category" :key="categoryData.id"  href="#" @click.prevent="selectCategory(categoryData.id)" class="category-card d-flex align-items-center">
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
                        <h3>{{ locale === 'en' ? categoryData.name : categoryData.name_bn }}</h3>
                        <div
                            class="category-content-bottom d-flex align-items-end justify-content-between"
                        >
                            <div
                                class="available-position d-flex flex-column"
                            >
                                <h4> {{ locale === 'en' ? 'Available Position' : 'পদ শূন্য  আছে' }}</h4>
                                <h5>{{ locale === 'en' ? categoryData.jobs_count :   convertToBengaliDigits(categoryData.jobs_count) }}</h5>
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


    <!--    <div class="trusted-company-area">-->
    <!--        <div class="container">-->
    <!--            <div class="trusted-company-content">-->
    <!--                <h4>Trusted by Leading Companies</h4>-->
    <!--                <div class="swiper tcs">-->
    <!--                    <div  class="swiper-wrapper">-->

    <!--                        <div v-for="companyData in company" :key="companyData.id"  class="swiper-slide">-->
    <!--                            <div class="company-logo-img">-->
    <!--                                <img :src="companyData.profile ? getCompanyImageUrl(companyData.profile) : 'frontend/img/company.png'" alt="">-->
    <!--                                <h4> {{ locale === 'en' ? companyData.name : companyData.name_bn }}</h4>-->
    <!--                            </div>-->
    <!--                        </div>-->

    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->

    <div class="user-review-area">
        <div class="container">
            <div class="user-review-heading">
                <h2>User Reviews</h2>
            </div>
        </div>
        <div class="user-review-slider-wrap">
            <div class="swiper userReview">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="user-review-card">
                            <div class="user-image">
                                <img
                                    src="frontend/images/user-review.png"
                                    class="img-fluid"
                                    alt="User Review"
                                    draggable="false"
                                />
                            </div>
                            <div class="user-review-content">
                                <div class="user-rating">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="121"
                                        height="19"
                                        viewBox="0 0 121 19"
                                        fill="none"
                                    >
                                        <path
                                            d="M9.82368 0.231874L12.5214 5.71603L18.5518 6.59566C18.6283 6.60704 18.7002 6.63957 18.7592 6.68957C18.8183 6.73957 18.8622 6.80506 18.886 6.87868C18.9099 6.95229 18.9127 7.0311 18.8942 7.10622C18.8756 7.18135 18.8365 7.24981 18.7812 7.30389L14.4183 11.5718L15.4484 17.5993C15.4617 17.6755 15.4534 17.7539 15.4243 17.8256C15.3953 17.8973 15.3468 17.9594 15.2843 18.005C15.2218 18.0505 15.1478 18.0776 15.0706 18.0832C14.9935 18.0888 14.9163 18.0727 14.8479 18.0367L9.45374 15.1914L4.05961 18.0375C3.99121 18.0736 3.91405 18.0899 3.83688 18.0844C3.75972 18.0788 3.68565 18.0518 3.62309 18.0063C3.56054 17.9608 3.51201 17.8986 3.48301 17.8269C3.45401 17.7552 3.44572 17.6768 3.45907 17.6006L4.48915 11.5718L0.125087 7.30389C0.0697532 7.24981 0.0306183 7.18135 0.01209 7.10622C-0.00643837 7.0311 -0.00362419 6.95229 0.0202156 6.87868C0.0440554 6.80506 0.0879739 6.73957 0.147025 6.68957C0.206076 6.63957 0.277915 6.60704 0.35445 6.59566L6.38488 5.71603L9.0838 0.231874C9.11746 0.162379 9.17001 0.103769 9.23544 0.0627598C9.30087 0.0217505 9.37652 0 9.45374 0C9.53096 0 9.60662 0.0217505 9.67204 0.0627598C9.73747 0.103769 9.79002 0.162379 9.82368 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M35.3471 0.231874L38.0448 5.71603L44.0752 6.59566C44.1518 6.60704 44.2236 6.63957 44.2827 6.68957C44.3417 6.73957 44.3856 6.80506 44.4095 6.87868C44.4333 6.95229 44.4361 7.0311 44.4176 7.10622C44.3991 7.18135 44.3599 7.24981 44.3046 7.30389L39.9418 11.5718L40.9719 17.5993C40.9851 17.6755 40.9768 17.7539 40.9478 17.8256C40.9188 17.8973 40.8703 17.9594 40.8077 18.005C40.7452 18.0505 40.6712 18.0776 40.5941 18.0832C40.5169 18.0888 40.4398 18.0727 40.3713 18.0367L34.9772 15.1914L29.583 18.0375C29.5146 18.0736 29.4375 18.0899 29.3603 18.0844C29.2832 18.0788 29.2091 18.0518 29.1465 18.0063C29.084 17.9608 29.0354 17.8986 29.0064 17.8269C28.9775 17.7552 28.9692 17.6768 28.9825 17.6006L30.0126 11.5718L25.6485 7.30389C25.5932 7.24981 25.5541 7.18135 25.5355 7.10622C25.517 7.0311 25.5198 6.95229 25.5437 6.87868C25.5675 6.80506 25.6114 6.73957 25.6705 6.68957C25.7295 6.63957 25.8014 6.60704 25.8779 6.59566L31.9083 5.71603L34.6072 0.231874C34.6409 0.162379 34.6935 0.103769 34.7589 0.0627598C34.8243 0.0217505 34.9 0 34.9772 0C35.0544 0 35.1301 0.0217505 35.1955 0.0627598C35.2609 0.103769 35.3135 0.162379 35.3471 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M60.8706 0.231874L63.5682 5.71603L69.5987 6.59566C69.6752 6.60704 69.747 6.63957 69.8061 6.68957C69.8652 6.73957 69.9091 6.80506 69.9329 6.87868C69.9568 6.95229 69.9596 7.0311 69.941 7.10622C69.9225 7.18135 69.8834 7.24981 69.828 7.30389L65.4652 11.5718L66.4953 17.5993C66.5086 17.6755 66.5002 17.7539 66.4712 17.8256C66.4422 17.8973 66.3937 17.9594 66.3312 18.005C66.2687 18.0505 66.1946 18.0776 66.1175 18.0832C66.0404 18.0888 65.9632 18.0727 65.8948 18.0367L60.5006 15.1914L55.1065 18.0375C55.0381 18.0736 54.9609 18.0899 54.8838 18.0844C54.8066 18.0788 54.7325 18.0518 54.67 18.0063C54.6074 17.9608 54.5589 17.8986 54.5299 17.8269C54.5009 17.7552 54.4926 17.6768 54.5059 17.6006L55.536 11.5718L51.172 7.30389C51.1166 7.24981 51.0775 7.18135 51.059 7.10622C51.0404 7.0311 51.0433 6.95229 51.0671 6.87868C51.0909 6.80506 51.1348 6.73957 51.1939 6.68957C51.253 6.63957 51.3248 6.60704 51.4013 6.59566L57.4318 5.71603L60.1307 0.231874C60.1643 0.162379 60.2169 0.103769 60.2823 0.0627598C60.3477 0.0217505 60.4234 0 60.5006 0C60.5778 0 60.6535 0.0217505 60.7189 0.0627598C60.7843 0.103769 60.8369 0.162379 60.8706 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M86.394 0.231874L89.0917 5.71603L95.1221 6.59566C95.1986 6.60704 95.2705 6.63957 95.3295 6.68957C95.3886 6.73957 95.4325 6.80506 95.4563 6.87868C95.4802 6.95229 95.483 7.0311 95.4645 7.10622C95.4459 7.18135 95.4068 7.24981 95.3515 7.30389L90.9886 11.5718L92.0187 17.5993C92.032 17.6755 92.0237 17.7539 91.9947 17.8256C91.9657 17.8973 91.9171 17.9594 91.8546 18.005C91.7921 18.0505 91.7181 18.0776 91.6409 18.0832C91.5638 18.0888 91.4866 18.0727 91.4182 18.0367L86.0241 15.1914L80.6299 18.0375C80.5615 18.0736 80.4844 18.0899 80.4072 18.0844C80.33 18.0788 80.256 18.0518 80.1934 18.0063C80.1309 17.9608 80.0823 17.8986 80.0533 17.8269C80.0243 17.7552 80.016 17.6768 80.0294 17.6006L81.0595 11.5718L76.6954 7.30389C76.6401 7.24981 76.6009 7.18135 76.5824 7.10622C76.5639 7.0311 76.5667 6.95229 76.5905 6.87868C76.6144 6.80506 76.6583 6.73957 76.7173 6.68957C76.7764 6.63957 76.8482 6.60704 76.9248 6.59566L82.9552 5.71603L85.6541 0.231874C85.6878 0.162379 85.7403 0.103769 85.8058 0.0627598C85.8712 0.0217505 85.9468 0 86.0241 0C86.1013 0 86.1769 0.0217505 86.2424 0.0627598C86.3078 0.103769 86.3603 0.162379 86.394 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M111.917 0.231874L114.615 5.71603L120.646 6.59566C120.722 6.60704 120.794 6.63957 120.853 6.68957C120.912 6.73957 120.956 6.80506 120.98 6.87868C121.004 6.95229 121.006 7.0311 120.988 7.10622C120.969 7.18135 120.93 7.24981 120.875 7.30389L116.512 11.5718L117.542 17.5993C117.555 17.6755 117.547 17.7539 117.518 17.8256C117.489 17.8973 117.441 17.9594 117.378 18.005C117.316 18.0505 117.242 18.0776 117.164 18.0832C117.087 18.0888 117.01 18.0727 116.942 18.0367L111.547 15.1914L106.153 18.0375C106.085 18.0736 106.008 18.0899 105.931 18.0844C105.853 18.0788 105.779 18.0518 105.717 18.0063C105.654 17.9608 105.606 17.8986 105.577 17.8269C105.548 17.7552 105.539 17.6768 105.553 17.6006L106.583 11.5718L102.219 7.30389C102.164 7.24981 102.124 7.18135 102.106 7.10622C102.087 7.0311 102.09 6.95229 102.114 6.87868C102.138 6.80506 102.182 6.73957 102.241 6.68957C102.3 6.63957 102.372 6.60704 102.448 6.59566L108.479 5.71603L111.178 0.231874C111.211 0.162379 111.264 0.103769 111.329 0.0627598C111.395 0.0217505 111.47 0 111.547 0C111.625 0 111.7 0.0217505 111.766 0.0627598C111.831 0.103769 111.884 0.162379 111.917 0.231874Z"
                                            fill="#2563EB"
                                        />
                                    </svg>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur.
                                    Aliquet diam non pellentesque ut
                                    senectus viverra nec. Pharetra augue
                                    purus imperdiet convallis. Hendrerit
                                    lectus sit tempor dui cras leo lorem.
                                    Dolor quis feugiat purus.
                                </p>
                                <div class="user-name">
                                    <h5>John Doe</h5>
                                    <span>DLDesign.co</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="user-review-card">
                            <div class="user-image">
                                <img
                                    src="frontend/images/user-review.png"
                                    class="img-fluid"
                                    alt="User Review"
                                    draggable="false"
                                />
                            </div>
                            <div class="user-review-content">
                                <div class="user-rating">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="121"
                                        height="19"
                                        viewBox="0 0 121 19"
                                        fill="none"
                                    >
                                        <path
                                            d="M9.82368 0.231874L12.5214 5.71603L18.5518 6.59566C18.6283 6.60704 18.7002 6.63957 18.7592 6.68957C18.8183 6.73957 18.8622 6.80506 18.886 6.87868C18.9099 6.95229 18.9127 7.0311 18.8942 7.10622C18.8756 7.18135 18.8365 7.24981 18.7812 7.30389L14.4183 11.5718L15.4484 17.5993C15.4617 17.6755 15.4534 17.7539 15.4243 17.8256C15.3953 17.8973 15.3468 17.9594 15.2843 18.005C15.2218 18.0505 15.1478 18.0776 15.0706 18.0832C14.9935 18.0888 14.9163 18.0727 14.8479 18.0367L9.45374 15.1914L4.05961 18.0375C3.99121 18.0736 3.91405 18.0899 3.83688 18.0844C3.75972 18.0788 3.68565 18.0518 3.62309 18.0063C3.56054 17.9608 3.51201 17.8986 3.48301 17.8269C3.45401 17.7552 3.44572 17.6768 3.45907 17.6006L4.48915 11.5718L0.125087 7.30389C0.0697532 7.24981 0.0306183 7.18135 0.01209 7.10622C-0.00643837 7.0311 -0.00362419 6.95229 0.0202156 6.87868C0.0440554 6.80506 0.0879739 6.73957 0.147025 6.68957C0.206076 6.63957 0.277915 6.60704 0.35445 6.59566L6.38488 5.71603L9.0838 0.231874C9.11746 0.162379 9.17001 0.103769 9.23544 0.0627598C9.30087 0.0217505 9.37652 0 9.45374 0C9.53096 0 9.60662 0.0217505 9.67204 0.0627598C9.73747 0.103769 9.79002 0.162379 9.82368 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M35.3471 0.231874L38.0448 5.71603L44.0752 6.59566C44.1518 6.60704 44.2236 6.63957 44.2827 6.68957C44.3417 6.73957 44.3856 6.80506 44.4095 6.87868C44.4333 6.95229 44.4361 7.0311 44.4176 7.10622C44.3991 7.18135 44.3599 7.24981 44.3046 7.30389L39.9418 11.5718L40.9719 17.5993C40.9851 17.6755 40.9768 17.7539 40.9478 17.8256C40.9188 17.8973 40.8703 17.9594 40.8077 18.005C40.7452 18.0505 40.6712 18.0776 40.5941 18.0832C40.5169 18.0888 40.4398 18.0727 40.3713 18.0367L34.9772 15.1914L29.583 18.0375C29.5146 18.0736 29.4375 18.0899 29.3603 18.0844C29.2832 18.0788 29.2091 18.0518 29.1465 18.0063C29.084 17.9608 29.0354 17.8986 29.0064 17.8269C28.9775 17.7552 28.9692 17.6768 28.9825 17.6006L30.0126 11.5718L25.6485 7.30389C25.5932 7.24981 25.5541 7.18135 25.5355 7.10622C25.517 7.0311 25.5198 6.95229 25.5437 6.87868C25.5675 6.80506 25.6114 6.73957 25.6705 6.68957C25.7295 6.63957 25.8014 6.60704 25.8779 6.59566L31.9083 5.71603L34.6072 0.231874C34.6409 0.162379 34.6935 0.103769 34.7589 0.0627598C34.8243 0.0217505 34.9 0 34.9772 0C35.0544 0 35.1301 0.0217505 35.1955 0.0627598C35.2609 0.103769 35.3135 0.162379 35.3471 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M60.8706 0.231874L63.5682 5.71603L69.5987 6.59566C69.6752 6.60704 69.747 6.63957 69.8061 6.68957C69.8652 6.73957 69.9091 6.80506 69.9329 6.87868C69.9568 6.95229 69.9596 7.0311 69.941 7.10622C69.9225 7.18135 69.8834 7.24981 69.828 7.30389L65.4652 11.5718L66.4953 17.5993C66.5086 17.6755 66.5002 17.7539 66.4712 17.8256C66.4422 17.8973 66.3937 17.9594 66.3312 18.005C66.2687 18.0505 66.1946 18.0776 66.1175 18.0832C66.0404 18.0888 65.9632 18.0727 65.8948 18.0367L60.5006 15.1914L55.1065 18.0375C55.0381 18.0736 54.9609 18.0899 54.8838 18.0844C54.8066 18.0788 54.7325 18.0518 54.67 18.0063C54.6074 17.9608 54.5589 17.8986 54.5299 17.8269C54.5009 17.7552 54.4926 17.6768 54.5059 17.6006L55.536 11.5718L51.172 7.30389C51.1166 7.24981 51.0775 7.18135 51.059 7.10622C51.0404 7.0311 51.0433 6.95229 51.0671 6.87868C51.0909 6.80506 51.1348 6.73957 51.1939 6.68957C51.253 6.63957 51.3248 6.60704 51.4013 6.59566L57.4318 5.71603L60.1307 0.231874C60.1643 0.162379 60.2169 0.103769 60.2823 0.0627598C60.3477 0.0217505 60.4234 0 60.5006 0C60.5778 0 60.6535 0.0217505 60.7189 0.0627598C60.7843 0.103769 60.8369 0.162379 60.8706 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M86.394 0.231874L89.0917 5.71603L95.1221 6.59566C95.1986 6.60704 95.2705 6.63957 95.3295 6.68957C95.3886 6.73957 95.4325 6.80506 95.4563 6.87868C95.4802 6.95229 95.483 7.0311 95.4645 7.10622C95.4459 7.18135 95.4068 7.24981 95.3515 7.30389L90.9886 11.5718L92.0187 17.5993C92.032 17.6755 92.0237 17.7539 91.9947 17.8256C91.9657 17.8973 91.9171 17.9594 91.8546 18.005C91.7921 18.0505 91.7181 18.0776 91.6409 18.0832C91.5638 18.0888 91.4866 18.0727 91.4182 18.0367L86.0241 15.1914L80.6299 18.0375C80.5615 18.0736 80.4844 18.0899 80.4072 18.0844C80.33 18.0788 80.256 18.0518 80.1934 18.0063C80.1309 17.9608 80.0823 17.8986 80.0533 17.8269C80.0243 17.7552 80.016 17.6768 80.0294 17.6006L81.0595 11.5718L76.6954 7.30389C76.6401 7.24981 76.6009 7.18135 76.5824 7.10622C76.5639 7.0311 76.5667 6.95229 76.5905 6.87868C76.6144 6.80506 76.6583 6.73957 76.7173 6.68957C76.7764 6.63957 76.8482 6.60704 76.9248 6.59566L82.9552 5.71603L85.6541 0.231874C85.6878 0.162379 85.7403 0.103769 85.8058 0.0627598C85.8712 0.0217505 85.9468 0 86.0241 0C86.1013 0 86.1769 0.0217505 86.2424 0.0627598C86.3078 0.103769 86.3603 0.162379 86.394 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M111.917 0.231874L114.615 5.71603L120.646 6.59566C120.722 6.60704 120.794 6.63957 120.853 6.68957C120.912 6.73957 120.956 6.80506 120.98 6.87868C121.004 6.95229 121.006 7.0311 120.988 7.10622C120.969 7.18135 120.93 7.24981 120.875 7.30389L116.512 11.5718L117.542 17.5993C117.555 17.6755 117.547 17.7539 117.518 17.8256C117.489 17.8973 117.441 17.9594 117.378 18.005C117.316 18.0505 117.242 18.0776 117.164 18.0832C117.087 18.0888 117.01 18.0727 116.942 18.0367L111.547 15.1914L106.153 18.0375C106.085 18.0736 106.008 18.0899 105.931 18.0844C105.853 18.0788 105.779 18.0518 105.717 18.0063C105.654 17.9608 105.606 17.8986 105.577 17.8269C105.548 17.7552 105.539 17.6768 105.553 17.6006L106.583 11.5718L102.219 7.30389C102.164 7.24981 102.124 7.18135 102.106 7.10622C102.087 7.0311 102.09 6.95229 102.114 6.87868C102.138 6.80506 102.182 6.73957 102.241 6.68957C102.3 6.63957 102.372 6.60704 102.448 6.59566L108.479 5.71603L111.178 0.231874C111.211 0.162379 111.264 0.103769 111.329 0.0627598C111.395 0.0217505 111.47 0 111.547 0C111.625 0 111.7 0.0217505 111.766 0.0627598C111.831 0.103769 111.884 0.162379 111.917 0.231874Z"
                                            fill="#2563EB"
                                        />
                                    </svg>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur.
                                    Aliquet diam non pellentesque ut
                                    senectus viverra nec. Pharetra augue
                                    purus imperdiet convallis. Hendrerit
                                    lectus sit tempor dui cras leo lorem.
                                    Dolor quis feugiat purus.
                                </p>
                                <div class="user-name">
                                    <h5>John Doe</h5>
                                    <span>DLDesign.co</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="user-review-card">
                            <div class="user-image">
                                <img
                                    src="frontend/images/user-review.png"
                                    class="img-fluid"
                                    alt="User Review"
                                    draggable="false"
                                />
                            </div>
                            <div class="user-review-content">
                                <div class="user-rating">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="121"
                                        height="19"
                                        viewBox="0 0 121 19"
                                        fill="none"
                                    >
                                        <path
                                            d="M9.82368 0.231874L12.5214 5.71603L18.5518 6.59566C18.6283 6.60704 18.7002 6.63957 18.7592 6.68957C18.8183 6.73957 18.8622 6.80506 18.886 6.87868C18.9099 6.95229 18.9127 7.0311 18.8942 7.10622C18.8756 7.18135 18.8365 7.24981 18.7812 7.30389L14.4183 11.5718L15.4484 17.5993C15.4617 17.6755 15.4534 17.7539 15.4243 17.8256C15.3953 17.8973 15.3468 17.9594 15.2843 18.005C15.2218 18.0505 15.1478 18.0776 15.0706 18.0832C14.9935 18.0888 14.9163 18.0727 14.8479 18.0367L9.45374 15.1914L4.05961 18.0375C3.99121 18.0736 3.91405 18.0899 3.83688 18.0844C3.75972 18.0788 3.68565 18.0518 3.62309 18.0063C3.56054 17.9608 3.51201 17.8986 3.48301 17.8269C3.45401 17.7552 3.44572 17.6768 3.45907 17.6006L4.48915 11.5718L0.125087 7.30389C0.0697532 7.24981 0.0306183 7.18135 0.01209 7.10622C-0.00643837 7.0311 -0.00362419 6.95229 0.0202156 6.87868C0.0440554 6.80506 0.0879739 6.73957 0.147025 6.68957C0.206076 6.63957 0.277915 6.60704 0.35445 6.59566L6.38488 5.71603L9.0838 0.231874C9.11746 0.162379 9.17001 0.103769 9.23544 0.0627598C9.30087 0.0217505 9.37652 0 9.45374 0C9.53096 0 9.60662 0.0217505 9.67204 0.0627598C9.73747 0.103769 9.79002 0.162379 9.82368 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M35.3471 0.231874L38.0448 5.71603L44.0752 6.59566C44.1518 6.60704 44.2236 6.63957 44.2827 6.68957C44.3417 6.73957 44.3856 6.80506 44.4095 6.87868C44.4333 6.95229 44.4361 7.0311 44.4176 7.10622C44.3991 7.18135 44.3599 7.24981 44.3046 7.30389L39.9418 11.5718L40.9719 17.5993C40.9851 17.6755 40.9768 17.7539 40.9478 17.8256C40.9188 17.8973 40.8703 17.9594 40.8077 18.005C40.7452 18.0505 40.6712 18.0776 40.5941 18.0832C40.5169 18.0888 40.4398 18.0727 40.3713 18.0367L34.9772 15.1914L29.583 18.0375C29.5146 18.0736 29.4375 18.0899 29.3603 18.0844C29.2832 18.0788 29.2091 18.0518 29.1465 18.0063C29.084 17.9608 29.0354 17.8986 29.0064 17.8269C28.9775 17.7552 28.9692 17.6768 28.9825 17.6006L30.0126 11.5718L25.6485 7.30389C25.5932 7.24981 25.5541 7.18135 25.5355 7.10622C25.517 7.0311 25.5198 6.95229 25.5437 6.87868C25.5675 6.80506 25.6114 6.73957 25.6705 6.68957C25.7295 6.63957 25.8014 6.60704 25.8779 6.59566L31.9083 5.71603L34.6072 0.231874C34.6409 0.162379 34.6935 0.103769 34.7589 0.0627598C34.8243 0.0217505 34.9 0 34.9772 0C35.0544 0 35.1301 0.0217505 35.1955 0.0627598C35.2609 0.103769 35.3135 0.162379 35.3471 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M60.8706 0.231874L63.5682 5.71603L69.5987 6.59566C69.6752 6.60704 69.747 6.63957 69.8061 6.68957C69.8652 6.73957 69.9091 6.80506 69.9329 6.87868C69.9568 6.95229 69.9596 7.0311 69.941 7.10622C69.9225 7.18135 69.8834 7.24981 69.828 7.30389L65.4652 11.5718L66.4953 17.5993C66.5086 17.6755 66.5002 17.7539 66.4712 17.8256C66.4422 17.8973 66.3937 17.9594 66.3312 18.005C66.2687 18.0505 66.1946 18.0776 66.1175 18.0832C66.0404 18.0888 65.9632 18.0727 65.8948 18.0367L60.5006 15.1914L55.1065 18.0375C55.0381 18.0736 54.9609 18.0899 54.8838 18.0844C54.8066 18.0788 54.7325 18.0518 54.67 18.0063C54.6074 17.9608 54.5589 17.8986 54.5299 17.8269C54.5009 17.7552 54.4926 17.6768 54.5059 17.6006L55.536 11.5718L51.172 7.30389C51.1166 7.24981 51.0775 7.18135 51.059 7.10622C51.0404 7.0311 51.0433 6.95229 51.0671 6.87868C51.0909 6.80506 51.1348 6.73957 51.1939 6.68957C51.253 6.63957 51.3248 6.60704 51.4013 6.59566L57.4318 5.71603L60.1307 0.231874C60.1643 0.162379 60.2169 0.103769 60.2823 0.0627598C60.3477 0.0217505 60.4234 0 60.5006 0C60.5778 0 60.6535 0.0217505 60.7189 0.0627598C60.7843 0.103769 60.8369 0.162379 60.8706 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M86.394 0.231874L89.0917 5.71603L95.1221 6.59566C95.1986 6.60704 95.2705 6.63957 95.3295 6.68957C95.3886 6.73957 95.4325 6.80506 95.4563 6.87868C95.4802 6.95229 95.483 7.0311 95.4645 7.10622C95.4459 7.18135 95.4068 7.24981 95.3515 7.30389L90.9886 11.5718L92.0187 17.5993C92.032 17.6755 92.0237 17.7539 91.9947 17.8256C91.9657 17.8973 91.9171 17.9594 91.8546 18.005C91.7921 18.0505 91.7181 18.0776 91.6409 18.0832C91.5638 18.0888 91.4866 18.0727 91.4182 18.0367L86.0241 15.1914L80.6299 18.0375C80.5615 18.0736 80.4844 18.0899 80.4072 18.0844C80.33 18.0788 80.256 18.0518 80.1934 18.0063C80.1309 17.9608 80.0823 17.8986 80.0533 17.8269C80.0243 17.7552 80.016 17.6768 80.0294 17.6006L81.0595 11.5718L76.6954 7.30389C76.6401 7.24981 76.6009 7.18135 76.5824 7.10622C76.5639 7.0311 76.5667 6.95229 76.5905 6.87868C76.6144 6.80506 76.6583 6.73957 76.7173 6.68957C76.7764 6.63957 76.8482 6.60704 76.9248 6.59566L82.9552 5.71603L85.6541 0.231874C85.6878 0.162379 85.7403 0.103769 85.8058 0.0627598C85.8712 0.0217505 85.9468 0 86.0241 0C86.1013 0 86.1769 0.0217505 86.2424 0.0627598C86.3078 0.103769 86.3603 0.162379 86.394 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M111.917 0.231874L114.615 5.71603L120.646 6.59566C120.722 6.60704 120.794 6.63957 120.853 6.68957C120.912 6.73957 120.956 6.80506 120.98 6.87868C121.004 6.95229 121.006 7.0311 120.988 7.10622C120.969 7.18135 120.93 7.24981 120.875 7.30389L116.512 11.5718L117.542 17.5993C117.555 17.6755 117.547 17.7539 117.518 17.8256C117.489 17.8973 117.441 17.9594 117.378 18.005C117.316 18.0505 117.242 18.0776 117.164 18.0832C117.087 18.0888 117.01 18.0727 116.942 18.0367L111.547 15.1914L106.153 18.0375C106.085 18.0736 106.008 18.0899 105.931 18.0844C105.853 18.0788 105.779 18.0518 105.717 18.0063C105.654 17.9608 105.606 17.8986 105.577 17.8269C105.548 17.7552 105.539 17.6768 105.553 17.6006L106.583 11.5718L102.219 7.30389C102.164 7.24981 102.124 7.18135 102.106 7.10622C102.087 7.0311 102.09 6.95229 102.114 6.87868C102.138 6.80506 102.182 6.73957 102.241 6.68957C102.3 6.63957 102.372 6.60704 102.448 6.59566L108.479 5.71603L111.178 0.231874C111.211 0.162379 111.264 0.103769 111.329 0.0627598C111.395 0.0217505 111.47 0 111.547 0C111.625 0 111.7 0.0217505 111.766 0.0627598C111.831 0.103769 111.884 0.162379 111.917 0.231874Z"
                                            fill="#2563EB"
                                        />
                                    </svg>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur.
                                    Aliquet diam non pellentesque ut
                                    senectus viverra nec. Pharetra augue
                                    purus imperdiet convallis. Hendrerit
                                    lectus sit tempor dui cras leo lorem.
                                    Dolor quis feugiat purus.
                                </p>
                                <div class="user-name">
                                    <h5>John Doe</h5>
                                    <span>DLDesign.co</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="user-review-card">
                            <div class="user-image">
                                <img
                                    src="frontend/images/user-review.png"
                                    class="img-fluid"
                                    alt="User Review"
                                    draggable="false"
                                />
                            </div>
                            <div class="user-review-content">
                                <div class="user-rating">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="121"
                                        height="19"
                                        viewBox="0 0 121 19"
                                        fill="none"
                                    >
                                        <path
                                            d="M9.82368 0.231874L12.5214 5.71603L18.5518 6.59566C18.6283 6.60704 18.7002 6.63957 18.7592 6.68957C18.8183 6.73957 18.8622 6.80506 18.886 6.87868C18.9099 6.95229 18.9127 7.0311 18.8942 7.10622C18.8756 7.18135 18.8365 7.24981 18.7812 7.30389L14.4183 11.5718L15.4484 17.5993C15.4617 17.6755 15.4534 17.7539 15.4243 17.8256C15.3953 17.8973 15.3468 17.9594 15.2843 18.005C15.2218 18.0505 15.1478 18.0776 15.0706 18.0832C14.9935 18.0888 14.9163 18.0727 14.8479 18.0367L9.45374 15.1914L4.05961 18.0375C3.99121 18.0736 3.91405 18.0899 3.83688 18.0844C3.75972 18.0788 3.68565 18.0518 3.62309 18.0063C3.56054 17.9608 3.51201 17.8986 3.48301 17.8269C3.45401 17.7552 3.44572 17.6768 3.45907 17.6006L4.48915 11.5718L0.125087 7.30389C0.0697532 7.24981 0.0306183 7.18135 0.01209 7.10622C-0.00643837 7.0311 -0.00362419 6.95229 0.0202156 6.87868C0.0440554 6.80506 0.0879739 6.73957 0.147025 6.68957C0.206076 6.63957 0.277915 6.60704 0.35445 6.59566L6.38488 5.71603L9.0838 0.231874C9.11746 0.162379 9.17001 0.103769 9.23544 0.0627598C9.30087 0.0217505 9.37652 0 9.45374 0C9.53096 0 9.60662 0.0217505 9.67204 0.0627598C9.73747 0.103769 9.79002 0.162379 9.82368 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M35.3471 0.231874L38.0448 5.71603L44.0752 6.59566C44.1518 6.60704 44.2236 6.63957 44.2827 6.68957C44.3417 6.73957 44.3856 6.80506 44.4095 6.87868C44.4333 6.95229 44.4361 7.0311 44.4176 7.10622C44.3991 7.18135 44.3599 7.24981 44.3046 7.30389L39.9418 11.5718L40.9719 17.5993C40.9851 17.6755 40.9768 17.7539 40.9478 17.8256C40.9188 17.8973 40.8703 17.9594 40.8077 18.005C40.7452 18.0505 40.6712 18.0776 40.5941 18.0832C40.5169 18.0888 40.4398 18.0727 40.3713 18.0367L34.9772 15.1914L29.583 18.0375C29.5146 18.0736 29.4375 18.0899 29.3603 18.0844C29.2832 18.0788 29.2091 18.0518 29.1465 18.0063C29.084 17.9608 29.0354 17.8986 29.0064 17.8269C28.9775 17.7552 28.9692 17.6768 28.9825 17.6006L30.0126 11.5718L25.6485 7.30389C25.5932 7.24981 25.5541 7.18135 25.5355 7.10622C25.517 7.0311 25.5198 6.95229 25.5437 6.87868C25.5675 6.80506 25.6114 6.73957 25.6705 6.68957C25.7295 6.63957 25.8014 6.60704 25.8779 6.59566L31.9083 5.71603L34.6072 0.231874C34.6409 0.162379 34.6935 0.103769 34.7589 0.0627598C34.8243 0.0217505 34.9 0 34.9772 0C35.0544 0 35.1301 0.0217505 35.1955 0.0627598C35.2609 0.103769 35.3135 0.162379 35.3471 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M60.8706 0.231874L63.5682 5.71603L69.5987 6.59566C69.6752 6.60704 69.747 6.63957 69.8061 6.68957C69.8652 6.73957 69.9091 6.80506 69.9329 6.87868C69.9568 6.95229 69.9596 7.0311 69.941 7.10622C69.9225 7.18135 69.8834 7.24981 69.828 7.30389L65.4652 11.5718L66.4953 17.5993C66.5086 17.6755 66.5002 17.7539 66.4712 17.8256C66.4422 17.8973 66.3937 17.9594 66.3312 18.005C66.2687 18.0505 66.1946 18.0776 66.1175 18.0832C66.0404 18.0888 65.9632 18.0727 65.8948 18.0367L60.5006 15.1914L55.1065 18.0375C55.0381 18.0736 54.9609 18.0899 54.8838 18.0844C54.8066 18.0788 54.7325 18.0518 54.67 18.0063C54.6074 17.9608 54.5589 17.8986 54.5299 17.8269C54.5009 17.7552 54.4926 17.6768 54.5059 17.6006L55.536 11.5718L51.172 7.30389C51.1166 7.24981 51.0775 7.18135 51.059 7.10622C51.0404 7.0311 51.0433 6.95229 51.0671 6.87868C51.0909 6.80506 51.1348 6.73957 51.1939 6.68957C51.253 6.63957 51.3248 6.60704 51.4013 6.59566L57.4318 5.71603L60.1307 0.231874C60.1643 0.162379 60.2169 0.103769 60.2823 0.0627598C60.3477 0.0217505 60.4234 0 60.5006 0C60.5778 0 60.6535 0.0217505 60.7189 0.0627598C60.7843 0.103769 60.8369 0.162379 60.8706 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M86.394 0.231874L89.0917 5.71603L95.1221 6.59566C95.1986 6.60704 95.2705 6.63957 95.3295 6.68957C95.3886 6.73957 95.4325 6.80506 95.4563 6.87868C95.4802 6.95229 95.483 7.0311 95.4645 7.10622C95.4459 7.18135 95.4068 7.24981 95.3515 7.30389L90.9886 11.5718L92.0187 17.5993C92.032 17.6755 92.0237 17.7539 91.9947 17.8256C91.9657 17.8973 91.9171 17.9594 91.8546 18.005C91.7921 18.0505 91.7181 18.0776 91.6409 18.0832C91.5638 18.0888 91.4866 18.0727 91.4182 18.0367L86.0241 15.1914L80.6299 18.0375C80.5615 18.0736 80.4844 18.0899 80.4072 18.0844C80.33 18.0788 80.256 18.0518 80.1934 18.0063C80.1309 17.9608 80.0823 17.8986 80.0533 17.8269C80.0243 17.7552 80.016 17.6768 80.0294 17.6006L81.0595 11.5718L76.6954 7.30389C76.6401 7.24981 76.6009 7.18135 76.5824 7.10622C76.5639 7.0311 76.5667 6.95229 76.5905 6.87868C76.6144 6.80506 76.6583 6.73957 76.7173 6.68957C76.7764 6.63957 76.8482 6.60704 76.9248 6.59566L82.9552 5.71603L85.6541 0.231874C85.6878 0.162379 85.7403 0.103769 85.8058 0.0627598C85.8712 0.0217505 85.9468 0 86.0241 0C86.1013 0 86.1769 0.0217505 86.2424 0.0627598C86.3078 0.103769 86.3603 0.162379 86.394 0.231874Z"
                                            fill="#2563EB"
                                        />
                                        <path
                                            d="M111.917 0.231874L114.615 5.71603L120.646 6.59566C120.722 6.60704 120.794 6.63957 120.853 6.68957C120.912 6.73957 120.956 6.80506 120.98 6.87868C121.004 6.95229 121.006 7.0311 120.988 7.10622C120.969 7.18135 120.93 7.24981 120.875 7.30389L116.512 11.5718L117.542 17.5993C117.555 17.6755 117.547 17.7539 117.518 17.8256C117.489 17.8973 117.441 17.9594 117.378 18.005C117.316 18.0505 117.242 18.0776 117.164 18.0832C117.087 18.0888 117.01 18.0727 116.942 18.0367L111.547 15.1914L106.153 18.0375C106.085 18.0736 106.008 18.0899 105.931 18.0844C105.853 18.0788 105.779 18.0518 105.717 18.0063C105.654 17.9608 105.606 17.8986 105.577 17.8269C105.548 17.7552 105.539 17.6768 105.553 17.6006L106.583 11.5718L102.219 7.30389C102.164 7.24981 102.124 7.18135 102.106 7.10622C102.087 7.0311 102.09 6.95229 102.114 6.87868C102.138 6.80506 102.182 6.73957 102.241 6.68957C102.3 6.63957 102.372 6.60704 102.448 6.59566L108.479 5.71603L111.178 0.231874C111.211 0.162379 111.264 0.103769 111.329 0.0627598C111.395 0.0217505 111.47 0 111.547 0C111.625 0 111.7 0.0217505 111.766 0.0627598C111.831 0.103769 111.884 0.162379 111.917 0.231874Z"
                                            fill="#2563EB"
                                        />
                                    </svg>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur.
                                    Aliquet diam non pellentesque ut
                                    senectus viverra nec. Pharetra augue
                                    purus imperdiet convallis. Hendrerit
                                    lectus sit tempor dui cras leo lorem.
                                    Dolor quis feugiat purus.
                                </p>
                                <div class="user-name">
                                    <h5>John Doe</h5>
                                    <span>DLDesign.co</span>
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
