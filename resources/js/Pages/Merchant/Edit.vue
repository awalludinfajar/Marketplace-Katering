<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextAreaInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const merchant = usePage().props.merchant;

const form = useForm({
    nama: merchant.nama,
    alamat: merchant.alamat,
    kota: merchant.kota,
    no_telpon: merchant.no_telpon,
    decription: merchant.decription,
});
</script>

<template>
    <Head title="Merchant" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Merchant
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8" >
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Merchant Information
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Update your Merchant account's profile information.
                            </p>
                        </header>
                        <form 
                            @submit.prevent="form.patch(route('merchant.update'))"
                            class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="nama" value="Nama" />

                                <TextInput
                                    id="nama"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.nama"
                                    required
                                    autofocus
                                    autocomplete="nama"
                                />

                                <InputError class="mt-2" :message="form.errors.nama" />
                            </div>
                            <div>
                                <InputLabel for="alamat" value="Alamat" />

                                <TextArea
                                    id="alamat"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.alamat"
                                    required
                                    autofocus
                                    autocomplete="alamat"
                                />

                                <InputError class="mt-2" :message="form.errors.alamat" />
                            </div>
                            <div>
                                <InputLabel for="kota" value="Kota" />

                                <TextInput
                                    id="kota"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.kota"
                                    required
                                    autofocus
                                    autocomplete="kota"
                                />

                                <InputError class="mt-2" :message="form.errors.kota" />
                            </div>
                            <div>
                                <InputLabel for="no_telpon" value="No.Telepon" />

                                <TextInput
                                    id="no_telpon"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.no_telpon"
                                    required
                                    autofocus
                                    autocomplete="no_telpon"
                                />

                                <InputError class="mt-2" :message="form.errors.no_telpon" />
                            </div>
                            <div>
                                <InputLabel for="decription" value="Deskripsi" />

                                <TextArea
                                    id="decription"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.decription"
                                    required
                                    autofocus
                                    autocomplete="decription"
                                />

                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p
                                        v-if="form.recentlySuccessful"
                                        class="text-sm text-gray-600"
                                    >
                                        Saved.
                                    </p>
                                </Transition>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>