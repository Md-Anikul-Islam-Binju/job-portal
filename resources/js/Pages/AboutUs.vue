<template>
    <head>
        <title>GarmentsNiyog - About Us</title>
    </head>
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3 style="color: black" v-if="locale === 'en'">About Us</h3>
                        <h3 style="color: black" v-else>আমাদের সম্পর্কে</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <!-- Start Sample Area -->
    <section class="sample-text-area">
        <div class="container box_1170">
            <h2 v-if="locale === 'en'">
                {{about.title}}
            </h2>
            <h2 v-else>
                {{about.title_bn}}
            </h2>
            <span  v-if="locale === 'en'">
                 <p v-html="about.details"></p>
            </span>
            <span  v-else>
                 <p v-html="about.details_bn"></p>
            </span>
        </div>
    </section>
</template>

<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "AboutUs",
    layout : Layout,
    props:{
        about:Object,
        siteSetting:Object,
        auth:Object,
    },

    data() {
        return {
            locale: localStorage.getItem('locale') || 'bn'  // Default to Bengali if no locale is stored
        };
    },
}
</script>

<style scoped>

</style>
