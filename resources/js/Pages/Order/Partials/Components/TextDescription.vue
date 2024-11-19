<script setup>
import { computed, ref } from 'vue';


const props = defineProps({
    data: Object
});

const formattedPrice = computed(() => {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(props.data.price);
});

const showFullDescription = ref(false);

const truncatedDescription = computed(() => {
    return props.data.deskripsi.length > 100
        ? props.data.deskripsi.slice(0, 100) + "..."
        : props.data.deskripsi;
});

const toggleFullDescription = () => {
    showFullDescription.value = !showFullDescription.value;
};

</script>

<template>
    <h2 class="font-manrope font-bold text-3xl leading-10 text-gray-900 mb-2 capitalize">
        {{ data.nama }}
    </h2>
    <div class="flex flex-col sm:flex-row sm:items-center mb-6">
        <h6 class="font-manrope font-semibold text-2xl leading-9 text-gray-900 pr-5 mr-5">
            {{ formattedPrice }}
        </h6>
    </div>
    <p class="text-gray-500 text-base font-normal mb-5">
        {{ truncatedDescription }} 
        <template v-if="data.deskripsi.length > 100">
            <a href="#" @click.prevent="toggleFullDescription" class="text-gray-600">Read More</a>
        </template>
    </p>

    <div v-if="showFullDescription" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg max-w-lg mx-auto">
            <h3 class="font-manrope font-semibold text-xl text-gray-900 mb-4">Full Description</h3>
            <p class="text-gray-700 mb-4">{{ data.deskripsi }}</p>
            <button @click="toggleFullDescription" class="text-blue-500 hover:underline">Close</button>
        </div>
    </div>

    <ul class="grid gap-y-4 mb-16">
        <li class="flex items-center gap-3">
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="26" height="26" rx="13" fill="gray" />
                <path d="M8 13H18M13 8L18 13L13 18"
                    stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            <span class="font-normal text-base text-gray-900 ">Type: {{ data.category_menu.nama }}</span>
        </li>
        <li class="flex items-center gap-3">
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="26" height="26" rx="13" fill="gray" />
                <path d="M8 13H18M13 8L18 13L13 18"
                    stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            <span class="font-normal text-base text-gray-900 ">Jumlah tersedia: {{ data.qty }}pcs</span>
        </li>
    </ul>
</template>