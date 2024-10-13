<script>

import Navbar from "./Nabbar.vue";
import Footer from "./Footer.vue";

export default {
    name: "Layout",
    components: {
        Navbar,
        Footer
    }
}
</script>

<template>
    <head>
        <title>Job Board</title>
    </head>
    <div>
        <Navbar />
        <slot/>
        <Footer/>
    </div>

</template>

<style scoped>

</style>
