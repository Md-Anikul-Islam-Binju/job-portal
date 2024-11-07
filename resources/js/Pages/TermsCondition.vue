<template>
    <head>
        <title>GarmentsNiyog - Terms & Condition</title>
    </head>
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3 style="color: black" v-if="locale === 'en'">Terms & Condition</h3>
                        <h3 style="color: black" v-else>শর্তাবলী</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="sample-text-area">
        <div class="container box_1170">
            <span  v-if="locale === 'en'">
                 <p v-html="terms.details"></p>
            </span>
            <span  v-else>
                 <p v-html="terms.details_bn"></p>
            </span>
        </div>
    </section>
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
