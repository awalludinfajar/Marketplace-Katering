<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    modelValue: {
        type: Number,
        default: 1
    },
    data: {
        type: Number,
        default: 0
    }
});

const emit = defineEmits(['update:modelValue']);
const quantity = ref(props.modelValue);

watch(() => props.modelValue, (newVal) => {
    quantity.value = newVal;
});

function decrement() {
    if (quantity.value > 1) {
        quantity.value--;
        emit('update:modelValue', quantity.value);
    }
}

function increment() {
    if (quantity.value < props.data) {        
        quantity.value++;
        emit('update:modelValue', quantity.value);
    }
}

function updateQuantity(value) {
    const numericValue = Number(value) || 1;
    quantity.value = numericValue;
    emit('update:modelValue', quantity.value);
}

</script>

<template>
    <div class="flex sm:items-center sm:justify-center w-full">
        <button
            @click="decrement"
            class="group py-4 px-6 border border-gray-400 rounded-l-full bg-white transition-all duration-300 hover:bg-gray-50 hover:shadow-sm hover:shadow-gray-300">
            <svg class="stroke-gray-900 group-hover:stroke-black" width="22" height="22"
                viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.5 11H5.5" stroke="" stroke-width="1.6" stroke-linecap="round" />
                <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round" />
                <path d="M16.5 11H5.5" stroke="" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round" />
            </svg>
        </button>
        <input
            type="text"
            v-model="quantity"
            class="font-semibold text-gray-900 cursor-pointer text-lg py-[13px] px-6 w-full sm:max-w-[118px] outline-0 border-y border-gray-400 bg-transparent placeholder:text-gray-900 text-center hover:bg-gray-50"
            placeholder="1"
            disabled
            @input="updateQuantity($event.target.value)"
        >
        <button
            @click="increment"
            class="group py-4 px-6 border border-gray-400 rounded-r-full bg-white transition-all duration-300 hover:bg-gray-50 hover:shadow-sm hover:shadow-gray-300">
            <svg class="stroke-gray-900 group-hover:stroke-black" width="22" height="22"
                viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 5.5V16.5M16.5 11H5.5" stroke="#9CA3AF" stroke-width="1.6" stroke-linecap="round" />
                <path d="M11 5.5V16.5M16.5 11H5.5" stroke="black" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round" />
                <path d="M11 5.5V16.5M16.5 11H5.5" stroke="black" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round" />
            </svg>
        </button>
    </div>
</template>