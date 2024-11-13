<script setup>
import { watch } from 'vue';
import { ref } from 'vue';

const listType = ref(['home', 'office', 'other']);

const emit = defineEmits(['update:initialSelectedType']);

const props = defineProps({
    initialSelectedType: {
        type: String,
        default: '',
    },
});

const selectedType = ref(props.initialSelectedType);

function updateSelectedId() {
    emit('update:initialSelectedType', selectedType.value);
}

watch(() => props.initialSelectedType, (newVal) => {
    selectedType.value = newVal; 
});

</script>

<template>
    <div class="flex gap-10 mt-1">
        <div class="inline-flex items-center" v-for="type in listType">
            <label class="relative flex items-center cursor-pointer" :for="type">
                <input 
                    type="radio" 
                    class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-gray-300 checked:border-gray-400 transition-all" 
                    :id="type"
                    :value="type"
                    v-model="selectedType"
                    @change="updateSelectedId"
                >
            </label>
            <label class="ml-2 text-slate-600 cursor-pointer text-sm" :for="type">{{ type }}</label>
        </div>
    </div>
</template>