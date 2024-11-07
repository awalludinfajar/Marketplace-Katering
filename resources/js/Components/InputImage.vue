<script setup>
import { ref, watch } from 'vue';

const modelImage = defineProps({
    modelValue: {
        type: [Object,String],
        default: null
    },
});

const emit = defineEmits(['update:modelValue']);

const imageUrl = ref(modelImage.modelValue);
const fileInputRef = ref(null);

function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        preImageInput();

        emit('update:modelValue', file);
        imageUrl.value = URL.createObjectURL(file);
    }
}

function preImageInput() {
    if (fileInputRef.value) {
        fileInputRef.value.value = '';
    }
}

watch(() => modelImage.modelValue, (newVal) => {
    imageUrl.value = newVal ?  URL.createObjectURL(newVal) : null;
});

</script>
<template>
    <div>
        <div v-if="imageUrl" class="mt-4 mb-4">
            <img :src="imageUrl" alt="Image Preview" width="200" />
        </div>
        <input 
            type="file" 
            @change="previewImage"
            class="border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            ref="input"
        />
    </div>
</template>