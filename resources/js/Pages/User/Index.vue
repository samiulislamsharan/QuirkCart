<template>
    <UserLayout>
        <!-- main content start -->
        <div class="bg-white">
            <div class="max-w-2xl px-4 py-16 mx-auto sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Latest Products</h2>

                <div class="grid grid-cols-1 mt-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    <div v-for="product in products" :key="product.id" class="relative group">
                        <div
                            class="w-full overflow-hidden transition-all bg-white rounded-md aspect-h-1 aspect-w-1 lg:aspect-none group-hover:opacity-75 lg:h-80">
                            <img v-if="product.product_images.length > 0" :src="product.product_images[0].image"
                                :alt="product.imageAlt"
                                class="object-contain object-center w-full h-full lg:h-full lg:w-full" />
                            <img v-else
                                src="https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg"
                                class="object-contain object-center w-full h-full lg:h-full lg:w-full" />

                            <!-- add to cart hover button start-->
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-0 cursor-pointer group-hover:opacity-100">
                                <div class="p-2 bg-white rounded-full" @click="addToCart(product)">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
                                    </svg>
                                </div>
                            </div>
                            <!-- add to cart hover button end-->
                        </div>
                        <div class="flex justify-between mt-4">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a :href="product.href">
                                        <span aria-hidden="true" class="absolute inset-0" />
                                        {{ product.title }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ product.brand.name }}</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">&#2547 {{ product.price }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main content end -->
    </UserLayout>
</template>

<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import UserLayout from './Layouts/UserLayout.vue';

defineProps({
    products: Array
})

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>
