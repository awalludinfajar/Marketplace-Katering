<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import CardAddress from './Partials/CardAddress.vue';

const pageData = usePage().props.address;

</script>

<template>
    <Head title="User Address"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Addresses
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8" >
                    <section>
                        <div class="flex items-center m-4 justify-end">
                            <Link :href="route('address.input', 0)">
                                <PrimaryButton>New Address</PrimaryButton>
                            </Link>
                        </div>
                        <CardAddress :data="pageData" />
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>