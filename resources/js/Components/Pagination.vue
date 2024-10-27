<template>
    <nav aria-label="product page pagination">
        <ul class="inline-flex h-10 -space-x-px text-base">
            <li v-for="link in pagination.links" :key="link.label">
                <Link preserve-scroll :href="link.url ?? ''" v-html="link.label"
                    :class="{ 'text-blue-600 border border-blue-300 bg-blue-50': link.active, '!text-gray-400  cursor-not-allowed': !link.url }"
                    class="flex items-center justify-center h-10 px-4 leading-tight text-gray-800 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white me-1" />
            </li>
        </ul>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    pagination: Object
})
</script>
