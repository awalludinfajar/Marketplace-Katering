<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import CardCart from './Components/CardCart.vue';
import CardFooter from './Components/CardFooter.vue';
import { ref } from 'vue';

interface Product {
    productId: number;
    productName: string;
    price: number;
    quantity: number;
    quantityAll: number;
    gambar: string;
}

interface Merchant {
    merchantId: number;
    merchantName: string;
    products: Product[];
}

const pageData = usePage().props.cardData as Merchant[];

const totalPrice = ref(0);
</script>

<template>
    <Head title="Cart" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Cart
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <CardCart 
                        :data="pageData"
                        v-model:totalValue="totalPrice"
                    />
                    <CardFooter :data="totalPrice"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>