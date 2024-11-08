<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import CardWidth from '@/Pages/Katering/Partials/CardWidth.vue';
import { ref, watch } from 'vue'
import Paging from '@/Components/Paging.vue';
import SelectOption from '@/Components/SelectOption.vue';

const pageData = usePage().props;
const dataList = ref(pageData.menu.data);
const refSelectedId = ref(pageData.refSelectedId || 0);

watch(refSelectedId, (isId) => {
    router.get(route('menu.list'), { refSelectedId: isId }, {
        preserveState: true,
        preserveScroll: true,
        only: ['menu'],
        replace: true,
        onSuccess: (page) => {
            dataList.value = page.props.menu.data;
        }
    });
});

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
                        <div class="flex items-center m-4 justify-between">
                            <div class="w-1/3">
                                <SelectOption
                                    :modelValue="refSelectedId"
                                    :url="route('category.json')"
                                    @update:modelValue="val => refSelectedId = val"
                                />
                            </div>
                            <Link :href="route('menu.form', 0)">
                                <PrimaryButton>Create Menu</PrimaryButton>
                            </Link>
                        </div>
                        <CardWidth :data="dataList"/>
                        <Paging 
                            :path="'menu.list'"
                        />
                    </section>
                </div>
            </div>  
        </div>
    </AuthenticatedLayout>
</template>