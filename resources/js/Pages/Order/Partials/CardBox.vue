<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    data: Object
})

function setIdr(crcy) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(crcy);
}
</script>

<template>
    <div v-for="res in data.data" class="card bg-white shadow-md rounded-md p-4 flex flex-col">
        <img :src="`${res.gambar}`" alt="Card Image" class="w-25 h-25 rounded-md object-cover card-image mb-4" />
        <div>
            <h3 class="text-lg font-bold mb-1"><Link :href="route('menu.detail', res.id)">{{ res.nama }}</Link></h3>
            <h4 class="text-sm text-gray-500 mb-2">{{ setIdr(res.price) }} | Stock: {{ res.qty }}</h4>
        </div>
    </div>
</template>

<style scoped>
.card-image {
    width: 240px;
    height: 240px;
    object-fit: cover;
    border-radius: 8px;
}
</style>