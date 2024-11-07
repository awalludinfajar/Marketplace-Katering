<script setup>
import { onMounted, ref, watch } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const textarea = ref(model.value);

onMounted(() => {
    if (textarea.value.hasAttribute('autofocus')) {
        textarea.value.focus();
    }
});

defineExpose({ focus: () => textarea.value.focus() });

watch(() => model.value, (newVal) => {
    textarea.value = newVal ? newVal : '';
})
</script>

<template>
    <textarea 
        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        v-model="model"
        ref="textarea"></textarea>
</template>
