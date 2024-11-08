<script setup>
import { router, usePage } from '@inertiajs/vue3';
import CardBox from './Partials/CardBox.vue';
import { ref, watch } from 'vue';
import Paging from '@/Components/Paging.vue';
import SelectOption from '@/Components/SelectOption.vue';

const pageData = usePage().props;
const dataList = ref(pageData.menu.data);
const selectedId = ref(pageData.selectedCategory || 0);

watch(selectedId, (Ids) => {
    router.get(route('dashboard'), {selectedId: Ids}, {
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
    <section>
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-4">
                <div class="p-3 w-1/3">
                    <SelectOption
                        :modelValue="selectedId"
                        :url="route('category.json')"
                        @update:modelValue="val => selectedId = val"
                    />
                </div>
                <div class="card-container flex flex-wrap gap-6 m-3">
                    <CardBox :data="dataList" />
                </div>
            </div>
            <Paging 
                class="p-3"
                :path="'dashboard'"
            />
        </div>
    </section>
</template>