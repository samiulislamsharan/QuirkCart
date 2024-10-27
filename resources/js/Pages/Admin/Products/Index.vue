<template>
    <AdminLayout>
        <ProductList :products="products" :pagination="products" />
    </AdminLayout>
</template>

<script setup>
defineProps({
    products: Object,
    categories: Array,
    brands: Array,
})

import AdminLayout from '../Components/AdminLayout.vue';
import ProductList from './ProductList.vue';
</script>
