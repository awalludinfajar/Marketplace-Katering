<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import CartHeader from './Partials/CartHeader.vue';
import InputQuantity from './Partials/Components/InputQuantity.vue';
import AddCartButton from './Partials/Components/AddCartButton.vue';
import BuyNowButton from './Partials/Components/BuyNowButton.vue';
import TextDescription from './Partials/Components/TextDescription.vue';
import ImageDetail from './Partials/Components/ImageDetail.vue';

const pageData = usePage().props.menu;

</script>

<template>
    <Head title="Menu Detail" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <CartHeader />
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <button onclick="history.back()" class="flex items-center text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 111.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back
                </button>
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="relative ">
                            <div class="w-full mx-auto px-4 sm:px-6 lg:px-0">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mx-auto max-md:px-2 ">
                                    <ImageDetail :data="pageData"/>
                                    <div
                                        class="data w-full lg:pr-2 pr-0 xl:justify-start justify-center flex items-center max-lg:pb-10 xl:my-2 lg:my-5 my-0">
                                        <div class="data w-full max-w-xl">
                                            <TextDescription :data="pageData"/>

                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 py-8">
                                                <InputQuantity />
                                                <AddCartButton />
                                            </div>
                                            <div class="flex items-center gap-3">
                                                <BuyNowButton />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>          
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>