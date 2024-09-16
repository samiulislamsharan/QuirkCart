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
