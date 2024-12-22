<template>
    <head>
        <title>GarmentsNiyog - Job Details</title>
    </head>
    <div
        class="job-details-top-section"
        style="
				background-image: url('http://127.0.0.1:8000/frontend/images/job-details-top-banner.png');
			"
    >
        <div class="container">
            <div class="job-details-top-wrapper">
                <div class="job-details-top-left">
                    <h5>{{ locale === 'en' ? 'Job Details' : 'কাজের বিবরণ'}}</h5>
                    <h2>{{ locale === 'en' ? job.title : job.title_bn }}</h2>
                    <ul>
                        <li>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="17"
                                viewBox="0 0 16 17"
                                fill="none"
                            >
                                <path
                                    d="M7.33816 14.4998H6.4035C4.0135 14.4998 2.81883 14.4998 2.07616 13.7432C1.3335 12.9865 1.3335 11.7685 1.3335 9.33317C1.3335 6.89784 1.3335 5.67984 2.07616 4.92317C2.81883 4.1665 4.0135 4.1665 6.4035 4.1665H8.93883C11.3288 4.1665 12.5242 4.1665 13.2668 4.92317C13.8382 5.50517 13.9695 6.3605 14.0002 7.83317"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M13.345 13.8486L14.667 15.1666M10.667 4.16659L10.6003 3.95992C10.2703 2.93325 10.1057 2.41992 9.71299 2.12659C9.31966 1.83325 8.79833 1.83325 7.75366 1.83325H7.57833C6.53499 1.83325 6.01299 1.83325 5.62033 2.12659C5.22699 2.41992 5.06233 2.93325 4.73233 3.95992L4.66699 4.16659M14.0357 12.1839C14.0409 11.8718 13.984 11.5619 13.8682 11.272C13.7524 10.9822 13.5801 10.7183 13.3612 10.4957C13.1424 10.2732 12.8815 10.0964 12.5936 9.97579C12.3058 9.85513 11.9968 9.79299 11.6847 9.79299C11.3725 9.79299 11.0636 9.85513 10.7757 9.97579C10.4879 10.0964 10.2269 10.2732 10.0081 10.4957C9.78924 10.7183 9.61691 10.9822 9.50112 11.272C9.38533 11.5619 9.3284 11.8718 9.33366 12.1839C9.34404 12.8006 9.5963 13.3885 10.0361 13.8209C10.4758 14.2533 11.0679 14.4957 11.6847 14.4957C12.3014 14.4957 12.8935 14.2533 13.3332 13.8209C13.773 13.3885 14.0253 12.8006 14.0357 12.1839Z"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            {{ locale === 'en' ? 'Vacancy: ' + job.vacancy : 'শূন্যপদ: ' + convertToBengaliDigits(job.vacancy) }}
                        </li>
                        <li>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="17"
                                viewBox="0 0 16 17"
                                fill="none"
                            >
                                <path
                                    d="M10.6668 4.49992C10.6668 3.24259 10.6668 2.61459 10.2762 2.22392C9.8855 1.83325 9.2575 1.83325 8.00016 1.83325C6.74283 1.83325 6.11483 1.83325 5.72416 2.22392C5.3335 2.61459 5.3335 3.24259 5.3335 4.49992M1.3335 9.83325C1.3335 7.31925 1.3335 6.06192 2.11483 5.28125C2.89616 4.50059 4.15283 4.49992 6.66683 4.49992H9.3335C11.8475 4.49992 13.1048 4.49992 13.8855 5.28125C14.6662 6.06259 14.6668 7.31925 14.6668 9.83325C14.6668 12.3473 14.6668 13.6046 13.8855 14.3853C13.1042 15.1659 11.8475 15.1666 9.3335 15.1666H6.66683C4.15283 15.1666 2.8955 15.1666 2.11483 14.3853C1.33416 13.6039 1.3335 12.3473 1.3335 9.83325Z"
                                    stroke="currentColor"
                                />
                                <path
                                    d="M8.00033 12.0552C8.73699 12.0552 9.33366 11.5578 9.33366 10.9445C9.33366 10.3312 8.73699 9.83317 8.00033 9.83317C7.26366 9.83317 6.66699 9.33584 6.66699 8.72184C6.66699 8.1085 7.26366 7.61117 8.00033 7.61117M8.00033 12.0552C7.26366 12.0552 6.66699 11.5578 6.66699 10.9445M8.00033 12.0552V12.4998M8.00033 7.61117V7.1665M8.00033 7.61117C8.73699 7.61117 9.33366 8.1085 9.33366 8.72184"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                />
                            </svg>
                            {{ locale === 'en' ? 'Salary: ' + job.salary : 'বেতন: ' + convertToBengaliDigits(job.salary) }}
                        </li>
                        <li>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="17"
                                viewBox="0 0 16 17"
                                fill="none"
                            >
                                <path
                                    d="M9.5 7.5C9.5 7.10218 9.34196 6.72064 9.06066 6.43934C8.77936 6.15804 8.39782 6 8 6C7.60218 6 7.22064 6.15804 6.93934 6.43934C6.65804 6.72064 6.5 7.10218 6.5 7.5C6.5 7.89782 6.65804 8.27936 6.93934 8.56066C7.22064 8.84196 7.60218 9 8 9C8.39782 9 8.77936 8.84196 9.06066 8.56066C9.34196 8.27936 9.5 7.89782 9.5 7.5ZM14 7.5C14 10.374 10.903 13.516 9.159 15.058C8.84011 15.3428 8.42754 15.5002 8 15.5002C7.57246 15.5002 7.15989 15.3428 6.841 15.058C5.097 13.516 2 10.374 2 7.5C2 6.71207 2.15519 5.93185 2.45672 5.2039C2.75825 4.47595 3.20021 3.81451 3.75736 3.25736C4.31451 2.70021 4.97595 2.25825 5.7039 1.95672C6.43185 1.65519 7.21207 1.5 8 1.5C8.78793 1.5 9.56815 1.65519 10.2961 1.95672C11.0241 2.25825 11.6855 2.70021 12.2426 3.25736C12.7998 3.81451 13.2417 4.47595 13.5433 5.2039C13.8448 5.93185 14 6.71207 14 7.5ZM13 7.5C13 6.17392 12.4732 4.90215 11.5355 3.96447C10.5979 3.02678 9.32608 2.5 8 2.5C6.67392 2.5 5.40215 3.02678 4.46447 3.96447C3.52678 4.90215 3 6.17392 3 7.5C3 8.608 3.615 9.895 4.57 11.183C5.504 12.441 6.657 13.56 7.503 14.309C7.63912 14.4324 7.81628 14.5007 8 14.5007C8.18372 14.5007 8.36088 14.4324 8.497 14.309C9.343 13.56 10.497 12.442 11.43 11.183C12.385 9.895 13 8.608 13 7.5Z"
                                    fill="currentColor"
                                />
                            </svg>
                            {{ locale === 'en' ? job.address : job.address_bn }}
                        </li>
                        <li>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="17"
                                viewBox="0 0 16 17"
                                fill="none"
                            >
                                <path
                                    d="M5.84676 2.16659C5.66454 2.23147 5.48676 2.30347 5.31343 2.38259M3.61676 3.47725C3.46568 3.60931 3.32065 3.74811 3.18209 3.89325M2.02143 5.54325C1.89698 5.79214 1.78876 6.04925 1.69676 6.31459M1.34409 8.09459C1.32943 8.35392 1.33009 8.61859 1.34543 8.87792M1.71209 10.6773C1.80098 10.9261 1.90409 11.1684 2.02143 11.4039M3.12743 12.9953C3.29009 13.1699 3.46187 13.3357 3.64276 13.4926M5.18409 14.5039C5.44854 14.6315 5.72114 14.7416 6.00009 14.8333M8.00009 15.1666C11.6821 15.1666 14.6668 12.1819 14.6668 8.49992C14.6668 4.81792 11.6821 1.83325 8.00009 1.83325"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M8 9.5C8.26522 9.5 8.51957 9.39464 8.70711 9.20711C8.89464 9.01957 9 8.76522 9 8.5C9 8.23478 8.89464 7.98043 8.70711 7.79289C8.51957 7.60536 8.26522 7.5 8 7.5M8 9.5C7.73478 9.5 7.48043 9.39464 7.29289 9.20711C7.10536 9.01957 7 8.76522 7 8.5C7 8.23478 7.10536 7.98043 7.29289 7.79289C7.48043 7.60536 7.73478 7.5 8 7.5M8 9.5V11.1667M8 7.5V4.5"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            {{ locale === 'en' ? 'Published Date: ' + formatDateEnglish(job.created_at) : 'প্রকাশের তারিখ: ' + formatDateBengali(job.created_at) }}
                        </li>
                    </ul>
                </div>
                <div class="job-details-top-right">
                    <div class="job-details-top-image">

                        <img :src="job.company.profile ? getCompanyImageUrl(job.company.profile) : 'frontend/img/company.png'" draggable="false" alt="">
                    </div>
                    <a
                        :href="`/jobs/apply/${job.id}`"
                        @click.prevent="applyJobDirectly"
                        :class="{ disabled: hasApplied }"
                    >
                        {{ hasApplied ? (locale === 'en' ? 'Already Applied' : 'ইতিমধ্যে আবেদন করেছেন') : (locale === 'en' ? 'Apply Now' : 'এখনই আবেদন করুন') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="job-details-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="job-details-content">
                        <h2>Details</h2>
                        <p v-html="locale === 'en' ? job.details : job.details_bn"></p>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="jobs-card-wrapper">
                                <h2>Similar Jobs</h2>
                                <div class="jobs-card-wrap">
                                    <div class="row">
                                        <div  v-for="jobData in jobNew" :key="jobData.id" class="col-md-6 col-12">
                                            <div
                                                class="job-card position-relative"
                                            >
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
                                                <div
                                                    class="job-card-bottom"
                                                >
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
                                                    <div
                                                        class="job-card-action"
                                                    >
                                                        <Link :href="`/job-details/${jobData.id}`" class="apply-now">
                                                            {{ locale === 'en' ? 'Apply Now' : 'আবেদন করুন' }}
                                                        </Link>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- are you looking for a job -->
    <div class="are-you-looking-for-a-job training-details-aylgfaj">
        <div class="container">
            <div
                class="are-you-looking-for-a-job-content training-page-aylgfaj"
            >
                <div class="left-content">
                    <h4>Are you looking for a Job?</h4>
                    <h2>GarmentsNiyog is your key to Success!</h2>
                    <h5>
                        Our goal is to make your job search as easy as
                        possible.
                    </h5>
                </div>
                <div class="right-content">
                    <a href="#">Register as Candidate</a>
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
        jobNew: Array,
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

        getCompanyImageUrl(imagePath) {
            if (!imagePath) {
                return 'frontend/img/company.png'; // You might want to return a default image directly here too
            }
            return `${window.location.origin}/images/logo/${imagePath}`; // Adjust the path as necessary
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
