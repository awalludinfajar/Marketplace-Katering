<script setup lang="ts">
import EditButton from '@/Components/EditButton.vue';
import RemoveButton from '@/Components/RemoveButton.vue';
import axios from 'axios';

const props = defineProps({
    data: Object
});

function deleteItem(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        axios.delete(route('address.delete', id)).then(response => {
            alert(response.data.message);
            location.reload();
        }).catch(error => {
            alert(error.data.message);
        });
    }
}

function editItem(id) {
    window.location.href = route('address.input', id);
}

</script>

<template>
    <div class="m-4" v-for="res in data.data">
        <div class="card bg-white shadow-lg rounded-md p-6 max-lg mx-auto flex items-center">
            <div class="flex items-center gap-4 flex-grow">
                <div>
                    <h3 class="text-lg font-semibold">
                        <span v-if="res.primary === true" class="w-4 h-4 text-white text-xs font-bold">✔</span>
                        {{ res.type_address }} 
                    </h3>
                    <p class="text-gray-600">{{ res.address }}</p>
                    <p class="text-sm text-gray-500">{{ res.province }} | {{ res.city }} | Kode Pos: {{ res.post_code }}</p>
                </div>
            </div>
            <EditButton @click="editItem(res.id)" />
            <RemoveButton @click="deleteItem(res.id)" />
        </div>
    </div>
</template>