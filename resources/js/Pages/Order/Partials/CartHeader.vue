<script setup lang="ts">
import CartLogo from '@/Components/CartLogo.vue';
</script>

<template>
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Welcome!
    </h2>
    <div class="relative">
        <CartLogo />
        <span class="absolute -top-1 -left-1 bg-red-600 text-white text-xs font-semibold rounded-full h-4 w-4 flex items-center justify-center">
            0
        </span>
    </div>
</template>