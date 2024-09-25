<template>
    <!-- navbar start -->
    <Navbar />
    <!-- navbar end -->

    <!-- main content start -->

    <slot />
    <!-- main content end -->

    <!-- footer start -->
    <Footer />
    <!-- footer end -->

</template>

<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

import Navbar from '../Components/Navbar.vue';
import Footer from '../Components/Footer.vue';

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
