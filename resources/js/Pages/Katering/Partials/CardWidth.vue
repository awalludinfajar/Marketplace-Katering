<script setup>
import EditButton from '@/Components/EditButton.vue';
import RemoveButton from '@/Components/RemoveButton.vue';
import axios from 'axios';

const props = defineProps({
    data: Object
});

function deleteItem(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        axios.delete(route('menu.delete', id)).then(response => {
            alert(response.data.message);
            location.reload();
        }).catch(error => {
            alert(error.data.message);
        });
    }
}

function editItem(id) {
    window.location.href = route('menu.form', id);
}

</script>
<template>
    <div class="m-4" v-for="res in data.data">
        <div class="card bg-white shadow-lg rounded-md p-6 max-lg mx-auto flex items-center">
            <div class="flex items-center gap-4 flex-grow">
                <img :src="`${res.gambar}`" alt="Card Image" class="w-24 h-24 rounded-md object-cover">
                <div>
                    <h3 class="text-lg font-semibold">{{ res.nama }}</h3>
                    <p class="text-sm text-gray-500">Rp. {{ res.price }} | Stock: {{ res.qty }}</p>
                    <p class="text-gray-600">
                        {{ res.deskripsi }}
                    </p>
                </div>
            </div>
            <EditButton @click="editItem(res.id)" />
            <RemoveButton @click="deleteItem(res.id)" />
        </div>
    </div>
</template>