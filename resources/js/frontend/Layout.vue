<script>

import Navbar from "./Nabbar.vue";
import Footer from "./Footer.vue";

export default {
    name: "Layout",
    props: {
        siteSetting: Object,
        auth: Object
    },
    components: {
        Navbar,
        Footer
    }
}
</script>

<template>
    <div>
        <Navbar :siteSetting="siteSetting"  :auth="auth"  />
        <slot/>
        <Footer :siteSetting="siteSetting"/>
    </div>

</template>

<style scoped>

</style>
