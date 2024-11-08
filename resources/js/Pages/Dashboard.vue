<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import CartLogo from '@/Components/CartLogo.vue';
import CustomerPages from './Order/CustomerPages.vue';
import CartHeader from './Order/Partials/CartHeader.vue';

const roles = ref([]);

onMounted(async () => {
  const response = await axios.get('/user/roles');
  roles.value = response.data.roles;
});

function hasRole(role) {
  return roles.value.includes(role);
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between" v-if="hasRole('customer')">
                <CartHeader />
            </div>
            <div class="flex items-center justify-between" v-if="hasRole('merchant')">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Welcome!
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8" v-if="hasRole('merchant')">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        You're logged in!
                    </div>
                </div>
            </div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8" v-if="hasRole('customer')">
                <CustomerPages></CustomerPages>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
