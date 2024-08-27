<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <!-- Navbar -->
        <Navbar />

        <!-- Sidebar -->
        <Sidebar />

        <!-- Main Content -->
        <main class="h-auto p-4 pt-20 md:ml-64">
            <slot />
        </main>
    </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Navbar from './Navbar.vue';
import Sidebar from './Sidebar.vue';

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
