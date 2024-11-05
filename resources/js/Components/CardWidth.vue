<script setup>
const props = defineProps({
    data: Array
});
</script>
<template>
    <div class="m-4" v-for="res in data">
        <div class="card bg-white shadow-lg rounded-md p-6 max-lg mx-auto">
            <div class="flex items-center gap-4">
                <img :src="`${res.gambar}`" alt="Card Image" class="w-24 h-24 rounded-md object-cover">
                <div>
                    <h3 class="text-lg font-semibold">{{ res.nama }}</h3>
                    <p class="text-sm text-gray-500">Rp. {{ res.price }} | Stock: {{ res.qty }}</p>
                    <p class="text-gray-600">
                        {{ res.deskripsi }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>