<template>
    <head>
        <title>GarmentsNiyog - Blog</title>
    </head>
    <div>
        <!-- Blog Header Area -->
        <div class="bradcam_area bradcam_bg_1">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bradcam_text">
                            <h3 style="color: black">{{ locale === 'en' ? 'Blog' : 'ব্লগ' }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Area Section -->
        <section class="blog_area section-padding">
            <div class="container">
                <div class="row">
                    <!-- Blog List (Main Content) -->
                    <div class="col-lg-12 mb-5 mb-lg-0">
                        <div class="blog_left_sidebar">
                            <!-- Search Input -->
                            <div class="row cat_search">
                                <div class="col-lg-12 col-md-4">
                                    <div class="single_input">
                                        <input
                                            type="text"
                                            :placeholder="locale === 'en' ? 'Search by title' : 'অনুসন্ধান করুন'"
                                            v-model="searchKeyword"
                                            @input="onSearch"
                                        />
                                    </div>
                                </div>
                            </div>
                            <br>

                            <!-- Blog List Display -->
                            <div v-for="blogData in paginatedBlogs" :key="blogData.id" class="blog_item">
                                <div class="blog_item_img">
                                    <img
                                        :src="blogData.image ? getBlogImageUrl(blogData.image) : 'frontend/img/defult.png'"
                                        alt="Blog Image"  class="img-fluid" style="width: 1200px;"
                                    >
                                    <a href="#" class="blog_item_date">
                                        <h3>{{ formatDate(blogData.created_at) }}</h3>
                                        <p>{{ formatMonth(blogData.created_at) }}</p>
                                    </a>
                                </div>
                                <div class="blog_details">
                                    <Link class="d-inline-block" :href="`/blog-details/${blogData.id}`">
                                        <h2>{{ locale === 'en' ? blogData.title : blogData.title_bn }}</h2>
                                    </Link>
                                    <p v-html="locale === 'en' ? blogData.details : blogData.details_bn"></p>
                                </div>
                            </div>

                            <!-- Pagination -->
                            <nav class="blog-pagination justify-content-center d-flex">
                                <ul class="pagination">
                                    <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                        <a href="#" class="page-link" @click.prevent="changePage(currentPage - 1)">
                                            <i class="ti-angle-left"></i>
                                        </a>
                                    </li>
                                    <li
                                        v-for="page in totalPages"
                                        :key="page"
                                        :class="{ active: page === currentPage }"
                                        class="page-item"
                                    >
                                        <a href="#" class="page-link" @click.prevent="changePage(page)">
                                            {{ page }}
                                        </a>
                                    </li>
                                    <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                                        <a href="#" class="page-link" @click.prevent="changePage(currentPage + 1)">
                                            <i class="ti-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "Blog",
    layout: Layout,
    props: {
        siteSetting: Object,
        blogs: Array, // All blog data passed from the backend
        auth: Object,
    },
    data() {
        return {
            locale: localStorage.getItem("locale") || "bn",
            searchKeyword: "",
            currentPage: 1,
            itemsPerPage: 10, // Adjust as needed
        };
    },
    computed: {
        filteredBlogs() {
            // Filter blogs based on search keyword
            let filtered = this.blogs;

            if (this.searchKeyword) {
                filtered = filtered.filter((blog) =>
                    blog.title.toLowerCase().includes(this.searchKeyword.toLowerCase()) ||
                    (blog.title_bn && blog.title_bn.toLowerCase().includes(this.searchKeyword.toLowerCase()))
                );
            }

            return filtered;
        },
        totalPages() {
            return Math.ceil(this.filteredBlogs.length / this.itemsPerPage);
        },
        paginatedBlogs() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.filteredBlogs.slice(start, end);
        },
    },
    methods: {
        onSearch() {
            this.currentPage = 1; // Reset to page 1 on search
        },
        changePage(pageNumber) {
            if (pageNumber >= 1 && pageNumber <= this.totalPages) {
                this.currentPage = pageNumber;
            }
        },
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
};
</script>

<style scoped>
.single_input input {
    height: 50px;
    border: 1px solid #e8e8e8;
    padding: 20px;
    border-radius: 5px;
    width: 100%;
}
</style>
