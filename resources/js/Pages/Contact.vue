<template>
    <head>
        <title>GarmentsNiyog - Contact Us</title>
    </head>
    <div class="blog-hero-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="jobs-card-wrapper">
                                <div class="found-jobs-count-wrap">
                                  <h3 style="color: black">{{ locale === 'en' ? '24/7 Customer Care for our valued Clients.' : 'যআমাদের মূল্যবান ক্লায়েন্টদের জন্য 24/7 গ্রাহক সেবা' }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-us-section-wrapper">
        <div class="container">
            <div class="contact-information-wrap">
                <div class="contact-left">
                    <h2>
                        {{ locale === 'en' ? 'Contact Us' : 'আমাদের সাথে যোগাযোগ করুন' }}

                    </h2>
                    <p>
                        {{ locale === 'en' ? ' If you have any queries, feel free to reach out to us' : 'যদি আপনার কোন প্রশ্ন থাকে, তাহলে নির্দ্বিধায় আমাদের সাথে যোগাযোগ করুন।' }}
                    </p>
                    <ul>
                        <li>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="21"
                                viewBox="0 0 20 21"
                                fill="none"
                            >
                                <path
                                    d="M8.42917 18.6758C8.93417 19.0925 9.46083 19.4733 10 19.845C10.5403 19.4783 11.0644 19.0882 11.5708 18.6758C12.415 17.9827 13.2095 17.2311 13.9483 16.4267C15.6517 14.5642 17.5 11.8642 17.5 8.83334C17.5 7.84843 17.306 6.87316 16.9291 5.96322C16.5522 5.05328 15.9997 4.22648 15.3033 3.53004C14.6069 2.8336 13.7801 2.28116 12.8701 1.90425C11.9602 1.52734 10.9849 1.33334 10 1.33334C9.01509 1.33334 8.03982 1.52734 7.12987 1.90425C6.21993 2.28116 5.39314 2.8336 4.6967 3.53004C4.00026 4.22648 3.44781 5.05328 3.0709 5.96322C2.69399 6.87316 2.5 7.84843 2.5 8.83334C2.5 11.8642 4.34833 14.5633 6.05167 16.4267C6.79052 17.2314 7.58497 17.9824 8.42917 18.6758ZM10 11.5417C9.28171 11.5417 8.59283 11.2563 8.08492 10.7484C7.57701 10.2405 7.29167 9.55164 7.29167 8.83334C7.29167 8.11505 7.57701 7.42617 8.08492 6.91826C8.59283 6.41035 9.28171 6.12501 10 6.12501C10.7183 6.12501 11.4072 6.41035 11.9151 6.91826C12.423 7.42617 12.7083 8.11505 12.7083 8.83334C12.7083 9.55164 12.423 10.2405 11.9151 10.7484C11.4072 11.2563 10.7183 11.5417 10 11.5417Z"
                                    fill="currentColor"
                                />
                            </svg>
                            {{ locale === 'en' ? siteSetting.address : siteSetting.address_bn }}
                        </li>
                        <li>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="21"
                                viewBox="0 0 20 21"
                                fill="none"
                            >
                                <path
                                    d="M13.7961 11.255L13.4169 11.6325C13.4169 11.6325 12.5144 12.5292 10.0519 10.0808C7.58941 7.6325 8.49191 6.73584 8.49191 6.73584L8.73024 6.4975C9.31941 5.9125 9.37524 4.9725 8.86108 4.28584L7.81108 2.88334C7.17441 2.03334 5.94524 1.92084 5.21608 2.64584L3.90774 3.94584C3.54691 4.30584 3.30524 4.77084 3.33441 5.2875C3.40941 6.61 4.00774 9.45417 7.34441 12.7725C10.8836 16.2908 14.2044 16.4308 15.5619 16.3042C15.9919 16.2642 16.3652 16.0458 16.6661 15.7458L17.8494 14.5692C18.6494 13.775 18.4244 12.4125 17.4011 11.8567L15.8094 10.9908C15.1377 10.6267 14.3211 10.7333 13.7961 11.255Z"
                                    fill="currentColor"
                                />
                            </svg>
                            {{ siteSetting.phone }}
                        </li>
                        <li>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="21"
                                viewBox="0 0 20 21"
                                fill="none"
                            >
                                <path
                                    d="M16.666 3.83334H3.33268C2.41602 3.83334 1.67435 4.58334 1.67435 5.50001L1.66602 15.5C1.66602 16.4167 2.41602 17.1667 3.33268 17.1667H16.666C17.5827 17.1667 18.3327 16.4167 18.3327 15.5V5.50001C18.3327 4.58334 17.5827 3.83334 16.666 3.83334ZM16.666 7.16668L9.99935 11.3333L3.33268 7.16668V5.50001L9.99935 9.66668L16.666 5.50001V7.16668Z"
                                    fill="currentColor"
                                />
                            </svg>
                            {{ siteSetting.email }}
                        </li>
                    </ul>
                </div>
                <div class="contact-right">
                    <img
                        src="frontend/images/contact-us.png"
                        draggable="false"
                        alt="Contact us"
                    />
                </div>
            </div>
        </div>
    </div>
    <div class="subscribe-to-newsletter-section">
        <div class="container">
            <div class="subscribe-to-newsletter-wrap">
                <div class="left-svg">
                    <svg
                        width="151"
                        height="92"
                        viewBox="0 0 151 92"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            opacity="0.2"
                            d="M135.774 -83.7879C164.45 -33.2915 134.913 35.8537 67.3886 70.0689C-0.136045 104.284 -77.4567 89.2842 -106.132 38.7879C-134.808 -11.7085 -105.272 -80.8537 -37.7472 -115.069C29.7775 -149.284 107.098 -134.284 135.774 -83.7879Z"
                            stroke="#F1F5F9"
                            stroke-width="7"
                        />
                    </svg>
                </div>
                <h2>

                    {{ locale === 'en' ? ' Subscribe to our Newsletter' : 'আমাদের নিউজলেটার সদস্যতা' }}
                </h2>
                <form @submit.prevent="submitForm" id="contactForm">

                        <input class="form-control" name="name" v-model="form.name" type="text" placeholder="Enter your name">
                        <input class="form-control" name="email" v-model="form.email" type="email" placeholder="Enter email address">
                        <input class="form-control" name="subject" v-model="form.subject" type="text" placeholder="Enter Subject">
                        <button type="submit">Send</button>
                </form>
                <div class="right-svg">
                    <svg
                        width="159"
                        height="73"
                        viewBox="0 0 159 73"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M291.006 114.5C291.006 175.037 227.559 225.5 147.354 225.5C67.1499 225.5 3.70312 175.037 3.70312 114.5C3.70312 53.9628 67.1499 3.5 147.354 3.5C227.559 3.5 291.006 53.9628 291.006 114.5Z"
                            stroke="white"
                            stroke-width="7"
                        />
                    </svg>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import Layout from "../frontend/Layout.vue";
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name: "Contact",
    layout : Layout,
    props:{
        siteSetting: Object,
        auth:Object,
    },
    data() {
        return {
            locale: localStorage.getItem('locale') || 'bn',  // Default to Bengali if no locale is stored
            form: {
                name: '',
                email: '',
                subject: '',
            },
        };
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('/message', this.form);
                // Display success alert
                Swal.fire({
                    icon: 'success',
                    title: this.locale === 'en' ? response.data.message : "আপনার বার্তা পাঠানো হয়েছে!",
                    confirmButtonText: 'OK'
                });
                // Reset the form
                this.form = { name: '', email: '', subject: '' };
            } catch (error) {
                let errorMessage = '';
                if (error.response) {
                    if (error.response.status === 422) {
                        // Handle validation errors
                        errorMessage = this.locale === 'en' ? "Please check your inputs." : "দয়া করে আপনার ইনপুট পরীক্ষা করুন।";
                    } else {
                        errorMessage = this.locale === 'en' ? "Failed to send your message." : "আপনার বার্তা পাঠাতে ব্যর্থ।";
                    }
                } else {
                    errorMessage = this.locale === 'en' ? "An error occurred." : "একটি ত্রুটি ঘটেছে।";
                }
                // Display error alert
                Swal.fire({
                    icon: 'error',
                    title: errorMessage,
                    confirmButtonText: 'OK'
                });
            }
        }
    }
}
</script>

<style scoped>

</style>
