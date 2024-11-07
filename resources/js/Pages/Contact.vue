<template>
    <head>
        <title>GarmentsNiyog - Contact Us</title>
    </head>
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3 style="color: black" v-if="locale === 'en'">Contact</h3>
                        <h3 style="color: black" v-else>যোগাযোগ</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="contact-section section_padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 v-if="locale === 'en'" class="contact-title">Get in Touch</h2>
                    <h2 v-else class="contact-title">যোগাযোগ করুন</h2>
                </div>
                <div class="col-lg-8">
                    <form @submit.prevent="submitForm" id="contactForm" novalidate="novalidate">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="name" v-model="form.name" type="text" placeholder="Enter your name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="email" v-model="form.email" type="email" placeholder="Enter email address">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" v-model="form.subject" type="text" placeholder="Enter Subject">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm btn_4 boxed-btn">Send Message</button>
                        </div>
                    </form>




                </div>
                <div class="col-lg-4">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3 v-if="locale === 'en'">{{ siteSetting.address }}</h3>
                            <h3 v-else>{{ siteSetting.address_bn }}</h3>


                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>{{ siteSetting.phone }}</h3>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>{{ siteSetting.email }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
