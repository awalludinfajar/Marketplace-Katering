<script setup lang="ts">
import CartLogo from '@/Components/CartLogo.vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted, onUnmounted, ref } from 'vue';

const cartCount = ref(0);

async function fetchCartCount() {
  try {
    const response = await axios.get(route('cart.get'));
    cartCount.value = response.data.length;
  } catch (error) {
    console.error('Failed to fetch cart count:', error);
  }
}

onMounted(() => {
  fetchCartCount();
  const interval = setInterval(fetchCartCount, 1000);
  onUnmounted(() => clearInterval(interval));
});
</script>

<template>
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Welcome!
    </h2>
    <div class="relative">
        <Link :href="route('cart.page')" class="inline-block">
            <CartLogo />
        </Link>
        <span class="absolute -top-1 -left-1 bg-red-600 text-white text-xs font-semibold rounded-full h-4 w-4 flex items-center justify-center">
            {{ cartCount }}
        </span>
    </div>
</template>