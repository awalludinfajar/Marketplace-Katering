<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import CartHeader from '../Cart/Components/CartHeader.vue';
import InputQuantity from './Partials/Components/InputQuantity.vue';
import AddCartButton from './Partials/Components/AddCartButton.vue';
import BuyNowButton from './Partials/Components/BuyNowButton.vue';
import TextDescription from './Partials/Components/TextDescription.vue';
import ImageDetail from './Partials/Components/ImageDetail.vue';
import BackButton from '@/Components/BackButton.vue';
import axios from 'axios';

const pageData = usePage().props.menu;

let quantity = 1;

function addToCart() {
    axios.post(route('cart.add'), {
        'productId' : pageData.id,
        'quantity' : quantity,
        'storeId' : pageData.merchant_profile_id
    }).then(response => {
        alert(response.data.message);
    }).catch(error => {
        console.error('There was an error adding the product to cart:', error.message);
    });
}
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
                <BackButton />
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
                                                <InputQuantity v-model="quantity" :data="pageData.qty" />
                                                <AddCartButton @click="addToCart"/>
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