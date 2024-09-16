<template>
    <!-- navbar start -->
    <Navbar />
    <!-- navbar end -->

    <!-- main content start -->

    <!-- hero section start -->
    <Hero />
    <!-- hero section end -->

    <slot />
    <!-- main content end -->

    <!-- footer start -->
    <Footer />
    <!-- footer end -->

</template>

<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

import Hero from '../Components/Hero.vue';
import Navbar from '../Components/Navbar.vue';
import Footer from '../Components/Footer.vue';

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
