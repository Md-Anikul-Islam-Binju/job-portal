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
                                    <h3>
                                        {{ locale === "en" ? "Blog" : "ব্লগ" }}
                                    </h3>
                                    <div class="">
                                        <!-- search -->
                                        <div class="search-wrap">
                                            <input
                                                type="text"
                                                class="search-input"
                                                :placeholder="
                                                    locale === 'en'
                                                        ? 'Search by title'
                                                        : 'অনুসন্ধান করুন'
                                                "
                                                v-model="searchKeyword"
                                                @input="onSearch"
                                            />
                                            <button class="search-btn">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="14"
                                                    height="15"
                                                    viewBox="0 0 14 15"
                                                    fill="none"
                                                >
                                                    <path
                                                        d="M10.208 10.7083L12.833 13.3333"
                                                        stroke="#388EA9"
                                                        stroke-width="1.125"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                    />
                                                    <path
                                                        d="M11.667 6.91667C11.667 4.01717 9.31651 1.66667 6.41699 1.66667C3.5175 1.66667 1.16699 4.01717 1.16699 6.91667C1.16699 9.81618 3.5175 12.1667 6.41699 12.1667C9.31651 12.1667 11.667 9.81618 11.667 6.91667Z"
                                                        stroke="#388EA9"
                                                        stroke-width="1.125"
                                                        stroke-linejoin="round"
                                                    />
                                                </svg>
                                            </button>
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
    <div class="blog-card-area">
        <div class="container">
            <div class="row">
                <div
                    v-for="blogData in paginatedBlogs"
                    :key="blogData.id"
                    class="col-md-6"
                >
                    <Link
                        class="blog-card"
                        :href="`/blog-details/${blogData.id}`"
                    >
                        <div class="blog-card-image">
                            <img
                                :src="
                                    blogData.image
                                        ? getBlogImageUrl(blogData.image)
                                        : 'frontend/img/defult.png'
                                "
                                draggable="false"
                                class="img-fluid w-100"
                                alt="Blog Card"
                            />
                        </div>
                        <div class="blog-card-details">
                            <h4>{{ formatDate(blogData.created_at) }}</h4>
                            <Link
                                class="d-inline-block"
                                :href="`/blog-details/${blogData.id}`"
                            >
                                <h4>
                                    {{
                                        locale === "en"
                                            ? blogData.title
                                            : blogData.title_bn
                                    }}
                                </h4>
                            </Link>
                            <p
                                v-html="
                                    locale === 'en'
                                        ? blogData.details
                                        : blogData.details_bn
                                "
                            ></p>
                        </div>
                    </Link>
                </div>

                <div class="pagination-area">
                    <div class="prev-next">
                        <!-- Previous Button -->
                        <a
                            href="#"
                            class="prev"
                            :class="{ disabled: currentPage === 1 }"
                            @click.prevent="changePage(currentPage - 1)"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                            >
                                <path
                                    d="M15.8337 9.99996H4.16699M4.16699 9.99996L10.0003 15.8333M4.16699 9.99996L10.0003 4.16663"
                                    stroke="currentColor"
                                    stroke-width="1.67"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            Previous
                        </a>
                    </div>
                    <div class="prev-next">
                        <!-- Next Button -->
                        <a
                            href="#"
                            class="next"
                            :class="{ disabled: currentPage === totalPages }"
                            @click.prevent="changePage(currentPage + 1)"
                        >
                            Next
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                            >
                                <path
                                    d="M4.16699 9.99996H15.8337M15.8337 9.99996L10.0003 4.16663M15.8337 9.99996L10.0003 15.8333"
                                    stroke="currentColor"
                                    stroke-width="1.67"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
            itemsPerPage: 8, // Adjust as needed
        };
    },
    computed: {
        filteredBlogs() {
            // Filter blogs based on search keyword
            let filtered = this.blogs;

            if (this.searchKeyword) {
                filtered = filtered.filter(
                    (blog) =>
                        blog.title
                            .toLowerCase()
                            .includes(this.searchKeyword.toLowerCase()) ||
                        (blog.title_bn &&
                            blog.title_bn
                                .toLowerCase()
                                .includes(this.searchKeyword.toLowerCase()))
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
            return `${dateObj.getDate()} ${dateObj.toLocaleString("en-US", {
                month: "short",
            })} ${dateObj.getFullYear()}`;
        },
        formatMonth(date) {
            const dateObj = new Date(date);
            return dateObj.toLocaleString("en-US", { month: "long" });
        },
        getBlogImageUrl(imagePath) {
            if (!imagePath) {
                return "frontend/img/defult.png";
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
