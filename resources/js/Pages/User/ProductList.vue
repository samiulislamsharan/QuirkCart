<template>
    <UserLayout>
        <div class="bg-white">
            <div>
                <!-- Mobile filter dialog -->
                <TransitionRoot as="template" :show="mobileFiltersOpen">
                    <Dialog class="relative z-40 lg:hidden" @close="mobileFiltersOpen = false">
                        <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
                            enter-from="opacity-0" enter-to="opacity-100"
                            leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
                            leave-to="opacity-0">
                            <div class="fixed inset-0 bg-black bg-opacity-25" />
                        </TransitionChild>

                        <div class="fixed inset-0 z-40 flex">
                            <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                                enter-from="translate-x-full" enter-to="translate-x-0"
                                leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                                leave-to="translate-x-full">
                                <DialogPanel
                                    class="relative flex flex-col w-full h-full max-w-xs py-4 pb-12 ml-auto overflow-y-auto bg-white shadow-xl">
                                    <div class="flex items-center justify-between px-4">
                                        <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                                        <button type="button"
                                            class="flex items-center justify-center w-10 h-10 p-2 -mr-2 text-gray-400 bg-white rounded-md"
                                            @click="mobileFiltersOpen = false">
                                            <span class="sr-only">Close menu</span>
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18 17.94 6M18 18 6.06 6" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Filters -->
                                    <form class="mt-4 border-t border-gray-200">
                                        <!-- price filter start -->
                                        <Disclosure as="div" class="px-4 py-6 border-t border-gray-200"
                                            v-slot="{ open }">
                                            <h3 class="flow-root -my-3">
                                                <DisclosureButton
                                                    class="flex items-center justify-between w-full py-3 text-sm text-gray-400 bg-white hover:text-gray-500">
                                                    <span class="font-medium text-gray-900">Price</span>
                                                    <span class="flex items-center ml-6">
                                                        <svg v-if="!open" class="w-5 h-5 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M5 12h14m-7 7V5" />
                                                        </svg>

                                                        <svg v-else class="w-5 h-5 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                                                        </svg>
                                                    </span>
                                                </DisclosureButton>
                                            </h3>
                                            <DisclosurePanel class="pt-6">
                                                <div class="space-y-4">
                                                    <div
                                                        class="flex items-center justify-between px-4 py-6 space-x-3 border-t border-gray-200">
                                                        <div class="basis-1/3">
                                                            <label for="filter-price-from"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                                From
                                                            </label>
                                                            <input v-model="filterPrices.prices[0]" type="number"
                                                                id="filter-price-from"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                min="0">
                                                        </div>

                                                        <div class="basis-1/3">
                                                            <label for="filter-price-to"
                                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                                To
                                                            </label>
                                                            <input v-model="filterPrices.prices[1]" type="number"
                                                                id="filter-price-to"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                min="0">
                                                        </div>

                                                        <button @click="applyPriceFilter()" type="button"
                                                            class="self-end text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                            Apply
                                                        </button>
                                                    </div>
                                                </div>
                                            </DisclosurePanel>
                                        </Disclosure>
                                        <!-- price filter end -->

                                        <!-- brand filter start -->
                                        <Disclosure as="div" class="px-4 py-6 border-t border-gray-200"
                                            v-slot="{ open }">
                                            <h3 class="flow-root -my-3">
                                                <DisclosureButton
                                                    class="flex items-center justify-between w-full py-3 text-sm text-gray-400 bg-white hover:text-gray-500">
                                                    <span class="font-medium text-gray-900">Brands</span>
                                                    <span class="flex items-center ml-6">
                                                        <svg v-if="!open" class="w-5 h-5 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M5 12h14m-7 7V5" />
                                                        </svg>

                                                        <svg v-else class="w-5 h-5 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                                                        </svg>
                                                    </span>
                                                </DisclosureButton>
                                            </h3>
                                            <DisclosurePanel class="pt-6">
                                                <div class="space-y-4">
                                                    <div v-for="brand in brands" :key="brand.id"
                                                        class="flex items-center">
                                                        <input :id="`filter-${brand.id}`" :value="brand.id"
                                                            v-model="selectedBrands" type="checkbox"
                                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                                                        <label :for="`filter-${brand.id}`"
                                                            class="ml-3 text-sm text-gray-600">
                                                            {{ brand.name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </DisclosurePanel>
                                        </Disclosure>
                                        <!-- brand filter end -->

                                        <!-- category filter start -->
                                        <Disclosure as="div" class="px-4 py-6 border-t border-gray-200"
                                            v-slot="{ open }">
                                            <h3 class="flow-root -my-3">
                                                <DisclosureButton
                                                    class="flex items-center justify-between w-full py-3 text-sm text-gray-400 bg-white hover:text-gray-500">
                                                    <span class="font-medium text-gray-900">Categories</span>
                                                    <span class="flex items-center ml-6">
                                                        <svg v-if="!open" class="w-5 h-5 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M5 12h14m-7 7V5" />
                                                        </svg>

                                                        <svg v-else class="w-5 h-5 text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                                                        </svg>
                                                    </span>
                                                </DisclosureButton>
                                            </h3>
                                            <DisclosurePanel class="pt-6">
                                                <div class="space-y-4">
                                                    <div v-for="category in categories" :key="category.id"
                                                        class="flex items-center">
                                                        <input :id="`filter-${category.id}`" :value="category.id"
                                                            v-model="selectedCategories" type="checkbox"
                                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                                                        <label :for="`filter-${category.id}`"
                                                            class="ml-3 text-sm text-gray-600">
                                                            {{ category.name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </DisclosurePanel>
                                        </Disclosure>
                                        <!-- category filter end -->
                                    </form>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </Dialog>
                </TransitionRoot>

                <main class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex items-baseline justify-between pt-24 pb-6 border-b border-gray-200">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900">New Arrivals</h1>

                        <div class="flex items-center">
                            <Menu as="div" class="relative inline-block text-left">
                                <div>
                                    <MenuButton
                                        class="inline-flex justify-center text-sm font-medium text-gray-700 group hover:text-gray-900">
                                        Sort

                                        <svg class="flex-shrink-0 w-5 h-5 ml-1 -mr-1 text-gray-400 group-hover:text-gray-500"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m8 10 4 4 4-4" />
                                        </svg>

                                    </MenuButton>
                                </div>

                                <transition enter-active-class="transition duration-100 ease-out"
                                    enter-from-class="transform scale-95 opacity-0"
                                    enter-to-class="transform scale-100 opacity-100"
                                    leave-active-class="transition duration-75 ease-in"
                                    leave-from-class="transform scale-100 opacity-100"
                                    leave-to-class="transform scale-95 opacity-0">
                                    <MenuItems
                                        class="absolute right-0 z-10 w-40 mt-2 origin-top-right bg-white rounded-md shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <div class="py-1">
                                            <MenuItem v-for="option in sortOptions" :key="option.name"
                                                v-slot="{ active }">
                                            <a :href="option.href"
                                                :class="[option.current ? 'font-medium text-gray-900' : 'text-gray-500', active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm']">{{
                                                    option.name }}</a>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>

                            <button type="button" class="p-2 ml-5 -m-2 text-gray-400 hover:text-gray-500 sm:ml-7">
                                <span class="sr-only">View grid</span>
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857Zm10 0A1.857 1.857 0 0 0 13 14.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 19.143v-4.286A1.857 1.857 0 0 0 19.143 13h-4.286Z"
                                        clip-rule="evenodd" />
                                </svg>

                            </button>
                            <button type="button"
                                class="p-2 ml-4 -m-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden"
                                @click="mobileFiltersOpen = true">
                                <span class="sr-only">Filters</span>
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M5.05 3C3.291 3 2.352 5.024 3.51 6.317l5.422 6.059v4.874c0 .472.227.917.613 1.2l3.069 2.25c1.01.742 2.454.036 2.454-1.2v-7.124l5.422-6.059C21.647 5.024 20.708 3 18.95 3H5.05Z" />
                                </svg>

                            </button>
                        </div>
                    </div>

                    <category aria-labelledby="products-heading" class="pt-6 pb-24">
                        <h2 id="products-heading" class="sr-only">Products</h2>

                        <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                            <!-- Filters -->
                            <form class="hidden lg:block">
                                <!-- price filter start -->
                                <h3 class="font-medium text-gray-900">Price</h3>
                                <ul role="list"
                                    class="pb-6 space-y-4 text-sm font-medium text-gray-900 border-b border-gray-200">
                                    <li>
                                        <div class="flex items-center justify-between space-x-3">
                                            <div class="basis-1/3">
                                                <label for="filter-price-from"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    From
                                                </label>
                                                <input v-model="filterPrices.prices[0]" type="number"
                                                    id="filter-price-from"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    min="0">
                                            </div>

                                            <div class="basis-1/3">
                                                <label for="filter-price-to"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    To
                                                </label>
                                                <input v-model="filterPrices.prices[1]" type="number"
                                                    id="filter-price-to"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    min="0">
                                            </div>

                                            <button @click="applyPriceFilter()" type="button"
                                                class="self-end text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                Apply
                                            </button>

                                        </div>
                                    </li>
                                </ul>
                                <!-- price filter end -->

                                <!-- brand filter start -->
                                <Disclosure as="div" class="py-6 border-b border-gray-200" v-slot="{ open }">
                                    <h3 class="flow-root -my-3">
                                        <DisclosureButton
                                            class="flex items-center justify-between w-full py-3 text-sm text-gray-400 bg-white hover:text-gray-500">
                                            <span class="font-medium text-gray-900">Brands</span>
                                            <span class="flex items-center ml-6">
                                                <svg v-if="!open" class="w-5 h-5 text-gray-800 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                                                </svg>

                                                <svg v-else class="w-5 h-5 text-gray-800 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                                                </svg>
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel class="pt-6">
                                        <div class="space-y-4">
                                            <div v-for="brand in brands" :key="brand.id" class="flex items-center">
                                                <input :id="`filter-${brand.id}`" :value="brand.id"
                                                    v-model="selectedBrands" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                                                <label :for="`filter-${brand.id}`" class="ml-3 text-sm text-gray-600">
                                                    {{ brand.name }}
                                                </label>
                                            </div>
                                        </div>
                                    </DisclosurePanel>
                                </Disclosure>
                                <!-- brand filter end -->

                                <!-- category filter start -->
                                <Disclosure as="div" class="py-6 border-b border-gray-200" v-slot="{ open }">
                                    <h3 class="flow-root -my-3">
                                        <DisclosureButton
                                            class="flex items-center justify-between w-full py-3 text-sm text-gray-400 bg-white hover:text-gray-500">
                                            <span class="font-medium text-gray-900">Categories</span>
                                            <span class="flex items-center ml-6">
                                                <svg v-if="!open" class="w-5 h-5 text-gray-800 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                                                </svg>

                                                <svg v-else class="w-5 h-5 text-gray-800 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                                                </svg>
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel class="pt-6">
                                        <div class="space-y-4">
                                            <div v-for="category in categories" :key="category.id"
                                                class="flex items-center">
                                                <input :id="`filter-${category.id}`" :value="category.id"
                                                    v-model="selectedCategories" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                                                <label :for="`filter-${category.id}`"
                                                    class="ml-3 text-sm text-gray-600">
                                                    {{ category.name }}
                                                </label>
                                            </div>
                                        </div>
                                    </DisclosurePanel>
                                </Disclosure>
                                <!-- category filter end -->
                            </form>

                            <!-- Product grid start -->
                            <div class="lg:col-span-3">
                                <!-- Your content -->
                                <Product :products="products.data"></Product>

                                <div class="my-4 text-center">
                                    <Pagination :pagination="products.meta" />
                                </div>
                            </div>
                            <!-- Product grid end -->
                        </div>
                    </category>
                </main>
            </div>
        </div>
    </UserLayout>
</template>

<script setup>
import UserLayout from './Layouts/UserLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import Product from './Components/Product.vue';
import { router, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue'
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'

defineProps({
    products: Array,
    categories: Array,
    brands: Array,
})

const sortOptions = [
    { name: 'Most Popular', href: '#', current: true },
    { name: 'Best Rating', href: '#', current: false },
    { name: 'Newest', href: '#', current: false },
    { name: 'Price: Low to High', href: '#', current: false },
    { name: 'Price: High to Low', href: '#', current: false },
]

const mobileFiltersOpen = ref(false)
const selectedBrands = ref([])
const selectedCategories = ref([])

const filterPrices = useForm({
    prices: [0, 100000]
})

const applyPriceFilter = () => {
    filterPrices.transform((data) => (
        {
            ...data,
            prices: {
                from: filterPrices.prices[0],
                to: filterPrices.prices[1]
            }
        }
    )).get('products', {
        preserveState: true,
        replace: true,
    })
}

const updateFilteredProducts = () => {
    router.get('products', {
        brands: selectedBrands.value,
        categories: selectedCategories.value
    }, {
        preserveState: true,
        replace: true,
    })
}

watch(selectedBrands, () => {
    updateFilteredProducts()
})

watch(selectedCategories, () => {
    updateFilteredProducts()
})

</script>
