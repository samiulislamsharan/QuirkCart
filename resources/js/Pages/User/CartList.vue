<template>
    <UserLayout>
        <div class="text-4xl text-center bg-yellow-300">
            <section class="py-8 antialiased bg-white dark:bg-gray-900 md:py-16">
                <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
                    <h2 class="text-xl font-semibold text-gray-900 text-start dark:text-white sm:text-2xl">Shopping Cart
                        Details
                    </h2>

                    <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                        <div class="flex-none w-full mx-auto lg:max-w-2xl xl:max-w-4xl">
                            <div class="space-y-6">
                                <div v-for="product in products" :key="product.id"
                                    class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                    <div
                                        class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                        <a href="#" class="shrink-0 md:order-1">
                                            <img v-if="product.product_images.length > 0"
                                                class="object-contain w-20 h-20"
                                                :src="`/${product.product_images[0].image}`" alt="product image" />
                                            <img v-else
                                                src="https://png.pngtree.com/png-vector/20221125/ourmid/pngtree-no-image-available-icon-flatvector-illustration-pic-design-profile-vector-png-image_40966566.jpg"
                                                class="object-contain object-center w-full h-full lg:h-full lg:w-full" />
                                        </a>

                                        <label for="counter-input" class="sr-only">Choose quantity:</label>
                                        <div class="flex items-center justify-between md:order-3 md:justify-end">
                                            <div class="flex items-center">
                                                <button
                                                    @click.prevent="update(product, carts[itemId(product.id)].quantity - 1)"
                                                    type="button" :id="'decrement-button-' + product.id"
                                                    :data-input-counter-decrement="'counter-input-' + product.id"
                                                    :disabled="carts[itemId(product.id)].quantity <= 1"
                                                    :class="[carts[itemId(product.id)].quantity > 1 ? 'cursor-pointer' : 'cursor-not-allowed text-gray-300 dark:text-gray-500', 'inline-flex items-center justify-center w-5 h-5 bg-gray-100 border border-gray-300 rounded-md shrink-0 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700']">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 18 2">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                    </svg>
                                                </button>
                                                <input type="text" id="counter-input" data-input-counter
                                                    class="w-10 text-sm font-medium text-center text-gray-900 bg-transparent border-0 shrink-0 focus:outline-none focus:ring-0 dark:text-white"
                                                    placeholder="" value="2" required />
                                                <button type="button" id="increment-button"
                                                    data-input-counter-increment="counter-input"
                                                    class="inline-flex items-center justify-center w-5 h-5 bg-gray-100 border border-gray-300 rounded-md shrink-0 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 18 18">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M9 1v16M1 9h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="text-end md:order-4 md:w-32">
                                                <p class="text-base font-bold text-gray-900 dark:text-white">
                                                    &#2547 {{ product.price }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex-1 w-full min-w-0 space-y-4 md:order-2 md:max-w-md text-start">
                                            <a href="#"
                                                class="text-base font-medium text-gray-900 hover:underline dark:text-white">
                                                {{ product.title }}
                                            </a>

                                            <div class="flex items-center gap-4">
                                                <button type="button"
                                                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                                                    <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                                    </svg>
                                                    Add to Favorites
                                                </button>

                                                <button @click="remove(product)" type="button"
                                                    class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                    <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18 17.94 6M18 18 6.06 6" />
                                                    </svg>
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden xl:mt-8 xl:block">
                                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">People also bought</h3>
                                <div class="grid grid-cols-3 gap-4 mt-6 sm:mt-8">
                                    <div
                                        class="p-6 space-y-6 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
                                        <a href="#" class="overflow-hidden rounded">
                                            <img class="mx-auto h-44 w-44 dark:hidden"
                                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg"
                                                alt="imac image" />
                                            <img class="hidden mx-auto h-44 w-44 dark:block"
                                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg"
                                                alt="imac image" />
                                        </a>
                                        <div>
                                            <a href="#"
                                                class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">iMac
                                                27”</a>
                                            <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">This
                                                generation has some improvements, including a longer continuous battery
                                                life.</p>
                                        </div>
                                        <div>
                                            <p class="text-lg font-bold text-gray-900 dark:text-white">
                                                <span class="line-through"> &#2547 399,99 </span>
                                            </p>
                                            <p class="text-lg font-bold leading-tight text-red-600 dark:text-red-500">
                                                &#2547 299</p>
                                        </div>
                                        <div class="mt-6 flex items-center gap-2.5">
                                            <button data-tooltip-target="favourites-tooltip-1" type="button"
                                                class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                                <svg class="w-5 h-5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"></path>
                                                </svg>
                                            </button>
                                            <div id="favourites-tooltip-1" role="tooltip"
                                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                Add to favourites
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>
                                            <button type="button"
                                                class="inline-flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
                                                </svg>
                                                Add to cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1 max-w-4xl mx-auto mt-6 space-y-6 lg:mt-0 lg:w-full">
                            <div
                                class="p-4 space-y-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">Address</p>

                                <div class="space-y-4">
                                    <div class="space-y-2">
                                        <dl class="flex flex-col items-center justify-between gap-4 text-start">
                                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Shipping
                                                Address:
                                            </dt>
                                            <dd class="text-base font-medium text-gray-900 dark:text-white">
                                                1234 Elm Street, New York, NY 10001
                                            </dd>
                                        </dl>

                                        <dl class="flex flex-col items-center justify-between gap-4 text-start">
                                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Billing
                                                Address:
                                            </dt>
                                            <dd class="text-base font-medium text-gray-900 dark:text-white">
                                                1234 Elm Street, New York, NY 10001
                                            </dd>
                                        </dl>
                                    </div>
                                </div>

                                <a href="#"
                                    class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <span>
                                        <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                        </svg>
                                    </span>

                                    Edit Address
                                </a>
                            </div>

                            <div
                                class="p-4 space-y-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

                                <div class="space-y-4">
                                    <div class="space-y-2">
                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Original
                                                price</dt>
                                            <dd class="text-base font-medium text-gray-900 dark:text-white">&#2547
                                                7,592.00
                                            </dd>
                                        </dl>

                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Savings
                                            </dt>
                                            <dd class="text-base font-medium text-green-600">-&#2547 299.00</dd>
                                        </dl>

                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Store
                                                Pickup</dt>
                                            <dd class="text-base font-medium text-gray-900 dark:text-white">&#2547 99
                                            </dd>
                                        </dl>

                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                                            <dd class="text-base font-medium text-gray-900 dark:text-white">&#2547 799
                                            </dd>
                                        </dl>
                                    </div>

                                    <dl
                                        class="flex items-center justify-between gap-4 pt-2 border-t border-gray-200 dark:border-gray-700">
                                        <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                        <dd class="text-base font-bold text-gray-900 dark:text-white">&#2547 {{ total }}
                                        </dd>
                                    </dl>
                                </div>

                                <a href="#"
                                    class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Proceed
                                    to Checkout</a>

                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                                    <a href="#" title=""
                                        class="inline-flex items-center gap-2 text-sm font-medium text-blue-700 underline hover:no-underline dark:text-blue-500">
                                        Continue Shopping
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div
                                class="p-4 space-y-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                                <form class="space-y-4">
                                    <div>
                                        <label for="voucher"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Do you
                                            have a voucher or gift card? </label>
                                        <input type="text" id="voucher"
                                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                            placeholder="" required />
                                    </div>
                                    <button type="submit"
                                        class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Apply
                                        Code</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </UserLayout>
</template>

<script setup>
import { computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import UserLayout from './Layouts/UserLayout.vue';

const carts = computed(() => usePage().props.cart.data.items)
const total = computed(() => usePage().props.cart.data.total)
const products = computed(() => usePage().props.cart.data.products)

const itemId = (id) => carts.value.findIndex((item) => item.product_id === id)
const update = (product, quantity) =>
    router.patch(route('cart.update', product),
        {
            quantity,
        }
    );

const remove = (product) => router.delete(route('cart.destroy', product));
</script>
