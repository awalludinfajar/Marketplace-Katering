<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
    modelValue: {
        type: [Number,String],
        required: true,
    },
    url: {
        type: String,
        required: true
    },
});

const emit = defineEmits(['update:modelValue']);

const options = ref([]);
const selectedId = ref(props.modelValue);

async function fetchOption() {
    try {
        const response = await axios.get(props.url);
        options.value = response.data;
    } catch (error) {
        console.log("Error fetching Options: "+error);
        
    }
}

function updateSelectedId() {
    emit('update:modelValue', selectedId.value);
}

watch(() => props.modelValue, (newVal) => {
    selectedId.value = newVal;
});

onMounted(() => {
    fetchOption();
});
</script>
<template>
    <select
        v-model="selectedId"
        @change="updateSelectedId"
        typeof="select"
        class="mt-1 block w-full rounded-md border-gray-300">
        <option value="0"></option>
        <option v-for="option in options" :key="option.id" :value="option.id">
            {{ option.nama }}
        </option>
    </select>
</template>