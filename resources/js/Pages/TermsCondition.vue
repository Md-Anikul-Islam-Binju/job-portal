<template>
    <head>
        <title>GarmentsNiyog - Terms & Condition</title>
    </head>
    <div class="blog-hero-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="jobs-card-wrapper">
                                <div class="found-jobs-count-wrap">
                                    <h3 style="color: black" v-if="locale === 'en'">Terms & Condition</h3>
                                    <h3 style="color: black" v-else>শর্তাবলী</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="terms-and-condition-content-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="terms-and-condition-content">
                        <ul>
                            <li>
                               <span  v-if="locale === 'en'">
                                     <p v-html="terms.details"></p>
                                </span>
                                                    <span  v-else>
                                     <p v-html="terms.details_bn"></p>
                                </span>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Layout from "../frontend/Layout.vue";

export default {
    name: "TermsCondition",
    layout : Layout,
    props:{
        terms:Object,
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
