<script setup lang="ts">
import RemoveButton from '@/Components/RemoveButton.vue';
import axios from 'axios';

const props = defineProps({
    data: {
        type: Number,
        default: 0
    }
});

function deleteCartItem(id) {
    if (confirm('Are you sure to delete this item on your cart ?')) {
        axios.delete(route('cart.remove', id)).then(response => {
            alert(response.data.message);
            location.reload();
        }).catch(error => {
            alert(error.data);
        });
    }
}

</script>

<template>
    <RemoveButton class="mt-2" @click="deleteCartItem(props.data)" />
</template>