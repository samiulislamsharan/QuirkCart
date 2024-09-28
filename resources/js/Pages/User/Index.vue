<template>
    <UserLayout>

        <!-- hero section start -->
        <Hero />
        <!-- hero section end -->

        <!-- main content start -->
        <div class="bg-white">
            <div class="max-w-2xl px-4 py-16 mx-auto sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Latest Products</h2>

                <Product :products="products"></Product>
            </div>

            <div class="flex justify-center">
                <Link :href="route('product.index')" as="button"
                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 transition-all">
                Show More
                </Link>
            </div>
        </div>
        <!-- main content end -->
    </UserLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import UserLayout from './Layouts/UserLayout.vue';
import Hero from './Components/Hero.vue';
import Product from './Components/Product.vue';

defineProps({
    products: Array,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})

const addToCart = (product) => {
    console.log(product);

    router.post(route('cart.store', product), {
        onSuccess: page => {
            Swal.fire({
                title: page.props.flash.success,
                icon: 'success',
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                timer: 3000,
                timerProgressBar: true,
            })
        },
    })
}
</script>
