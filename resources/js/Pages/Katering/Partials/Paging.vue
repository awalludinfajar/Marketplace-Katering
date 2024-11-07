<script setup>
import { usePage } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

const pagination = usePage().props.menu;

if (pagination.links[0].label === "&laquo; Previous") {
    pagination.links[0].label = "Previous"
}

if (pagination.links[pagination.links.length-1].label === "Next &raquo;") {
    pagination.links[pagination.links.length-1].label = "Next"
}

function goToPage(url) {
    if (!url) return;
    const pageNumber = new URL(url, window.location.origin).searchParams.get('page');
    if (pageNumber) {
        Inertia.get(route('menu.list', { page: pageNumber }));
    }
}

</script>
<template>
    <div class="m-4 flex justify-left space-x-2">
        <button 
            v-for="page in pagination.links" 
            :key="page.label"
            :class="['px-4 py-2 rounded-md', page.active ? 'bg-gray-800 text-white' : 'bg-gray-300']"
            @click="goToPage(page.url)"
        >
            {{ page.label }}
        </button>
    </div>
</template>