<script setup lang="ts">
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    data: {
        type: Number,
        default: 0
    },
});

function setIdr(crcy) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(crcy);
}

</script>

<template>
    <hr class="text-gray-600 mt-4 mb-4">
    <div class="flex justify-end p-6">
        <div class="flex gap-4 items-center">
            <h6 class="text-2xl font-semibold">Total :</h6>
            <h6 class="text-2xl font-semibold">{{ setIdr(props.data) }}</h6>
        </div>
    </div>
    <div class="flex justify-end p-4">
        <PrimaryButton>Checkout</PrimaryButton>
    </div>
</template>