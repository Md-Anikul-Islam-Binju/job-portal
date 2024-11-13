<template>
    <head>
        <title>GarmentsNiyog - Blog</title>
    </head>
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3></h3>
                        <h3 style="color: black">{{ locale === 'en' ? 'single blog' : 'একক ব্লগ' }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img
                                :src="blogs.image ? getBlogImageUrl(blogs.image) : 'frontend/img/defult.png'"
                                alt="Blog Image"  class="img-fluid" style="width: 1200px;"
                            >
                        </div>
                        <div class="blog_details">
                            <h2>{{ locale === 'en' ? blogs.title : blogs.title_bn }}</h2>
                            <p v-html="locale === 'en' ? blogs.details : blogs.details_bn"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
