<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextAreaInput from '@/Components/TextAreaInput.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    user_type: '',
    merchant_name: '',
    alamat_merchant: '',
    kota_merchant: '',
    telp_merchant: '',
    description: ''
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-4">
                <InputLabel for="user_type" value="User Type" />
                <select
                    v-model="form.user_type"
                    typeof="select"
                    id="user_type"
                    class="mt-1 block w-full rounded-md border-gray-300"
                    required>
                    <option value="customer">customer</option>
                    <option value="merchant">merchant</option>
                </select>
            </div>

            <div v-if="form.user_type === 'merchant'">
                <div class="mt-4">
                    <InputLabel for="merchant_name" value="Nama Merchant" />
                    <TextInput
                        id="merchant_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.merchant_name"
                        required
                        autofocus
                        autocomplete="merchant_name"
                    />
    
                    <InputError class="mt-2" :message="form.errors.merchant_name" />
                </div>
    
                <div class="mt-4">
                    <InputLabel for="alamat_merchant" value="Alamat Merchant" />
                    <TextAreaInput
                        id="alamat_merchant"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.alamat_merchant"
                        required
                        autofocus
                        autocomplete="alamat_merchant"
                    />
    
                    <InputError class="mt-2" :message="form.errors.alamat_merchant" />
                </div>
    
                <div class="mt-4">
                    <InputLabel for="kota_merchant" value="Kota Merchant" />
                    <TextInput
                        id="kota_merchant"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.kota_merchant"
                        required
                        autofocus
                        autocomplete="kota_merchant"
                    />
    
                    <InputError class="mt-2" :message="form.errors.kota_merchant" />
                </div>
    
                <div class="mt-4">
                    <InputLabel for="telp_merchant" value="No.Telp Merchant" />
                    <TextInput
                        id="telp_merchant"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.telp_merchant"
                        required
                        autofocus
                        autocomplete="telp_merchant"
                    />
    
                    <InputError class="mt-2" :message="form.errors.telp_merchant" />
                </div>
    
                <div class="mt-4">
                    <InputLabel for="description" value="Description" />
                    <TextAreaInput
                        id="description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.description"
                        required
                        autofocus
                        autocomplete="description"
                    />
    
                    <InputError class="mt-2" :message="form.errors.description" />
                </div>
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
