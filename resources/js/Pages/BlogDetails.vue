<template>
    <head>
        <title>GarmentsNiyog - Blog</title>
    </head>

    <div class="blog-hero-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="jobs-card-wrapper">
                                <div class="found-jobs-count-wrap">
                                    <h3>{{ locale === 'en' ? 'single blog' : 'একক ব্লগ' }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-blog-details">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single-blog-details-content">
                        <div class="feature-img">
                            <img
                                :src="blogs.image ? getBlogImageUrl(blogs.image) : 'frontend/img/defult.png'"
                                alt="Blog Image"  class="img-fluid" style="width: 1500px;"
                            >
                        </div>
                        <h2>{{ locale === 'en' ? blogs.title : blogs.title_bn }}</h2>
                        <p v-html="locale === 'en' ? blogs.details : blogs.details_bn"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "BlogDetails",
    layout: Layout,
    props: {
        siteSetting: Object,
        blogs:Object,
        auth: Object,
    },
    data() {
        return {
            locale: localStorage.getItem("locale") || "bn",
        };
    },
    methods: {
        formatDate(date) {
            const dateObj = new Date(date);
            return `${dateObj.getDate()} ${dateObj.toLocaleString("en-US", { month: "short" })} ${dateObj.getFullYear()}`;
        },
        formatMonth(date) {
            const dateObj = new Date(date);
            return dateObj.toLocaleString("en-US", { month: "long" });
        },
        getBlogImageUrl(imagePath) {
            if (!imagePath) {
                return 'frontend/img/defult.png';
            }
            return `${window.location.origin}/images/blog/${imagePath}`;
        },
    },
}
</script>

<style scoped>

</style>
