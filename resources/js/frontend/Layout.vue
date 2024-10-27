<script>

import Navbar from "./Nabbar.vue";
import Footer from "./Footer.vue";

export default {
    name: "Layout",
    props: {
        siteSetting: Object // Accept the siteSetting prop
    },
    components: {
        Navbar,
        Footer
    }
}
</script>

<template>
    <div>
        <Navbar :siteSetting="siteSetting"  />
        <slot/>
        <Footer :siteSetting="siteSetting"/>
    </div>

</template>

<style scoped>

</style>
