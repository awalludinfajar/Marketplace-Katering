<script setup>
import { ref } from 'vue';

const model = defineProps({
    modelValue: {
        type: String,
        require: true
    },
});

const emit = defineEmits(['update:modelValue']);

// const image = ref(null);
const imageUrl = ref(null);

function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        emit('update:modelValue', file);

        // image.value = file;
        imageUrl.value = URL.createObjectURL(file);
    }
}
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