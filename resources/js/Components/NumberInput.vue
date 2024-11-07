<script setup>
import { onMounted, ref, watch } from 'vue';

const model = defineModel({
    type: Number,
    required: true,
});

const input = ref(model.value);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

watch(() => model.value, (newVal) => {
    input.value = newVal ? newVal : 0;
})
</script>
<template>
    <input
        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        v-model="model"
        type="number"
        ref="input"
    />
</template>