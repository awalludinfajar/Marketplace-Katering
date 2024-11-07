<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import CardWidth from '@/Pages/Katering/Partials/CardWidth.vue';
import { ref } from 'vue'
import Paging from './Partials/Paging.vue';

const listMenu = usePage().props.menu.data;
const dataList = ref(listMenu);

</script>

<template>
    <Head title="Menu Makanan" />
    
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Makanan
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8" >
                    <section>
                        <div class="flex items-center m-4 justify-end">
                            <Link :href="route('menu.form', 0)">
                                <PrimaryButton>Create Menu</PrimaryButton>
                            </Link>
                        </div>
                        <CardWidth :data="dataList"/>
                        <Paging />
                    </section>
                </div>
            </div>  
        </div>
    </AuthenticatedLayout>
</template>