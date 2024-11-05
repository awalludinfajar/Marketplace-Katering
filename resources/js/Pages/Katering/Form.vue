<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputImage from '@/Components/InputImage.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextAreaInput.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import SelectOption from '@/Components/SelectOption.vue';
import NumberInput from '@/Components/NumberInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const menu = usePage().props.menu;

const form = useForm({
    gambar: null,
    nama: '',
    category_id: 0,
    deskripsi: '',
    harga: 0,
    qty: 0
});
</script>
<template>
    <Head title="Buat Menu Makanan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Tambah Menu Makanan
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8" >
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Menu create
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Create a Menu of your Merchant information.
                            </p>
                        </header>
                        <form action="" method="post" class="mt-6 space-y-6"
                            @submit.prevent="form.post(route('menu.store'))"    
                        >
                            <div>
                                <InputLabel for="gambar" value="Gambar" />
                                <InputImage 
                                    id="gambar"
                                    v-model="form.gambar"
                                />
                                <InputError class="mt-2" :message="form.errors.gambar"/>
                            </div>
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
                                <InputError class="mt-2" :message="form.errors.nama"/>
                            </div>
                            <div>
                                <InputLabel for="category_id" value="Category"/>
                                <SelectOption 
                                    id="category_id"
                                    :url="route('category.json')"
                                    v-model="form.category_id"
                                />
                                <InputError class="mt-2" :message="form.errors.category_id"/>
                            </div>
                            <div>
                                <InputLabel for="deskripsi" value="Deskripsi" />
                                <TextArea
                                    id="deskripsi"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.deskripsi"
                                    required
                                    autofocus
                                    autocomplete="deskripsi"
                                />
                                <InputError class="mt-2" :message="form.errors.deskripsi"/>
                            </div>
                            <div>
                                <InputLabel for="harga" value="Harga" />
                                <NumberInput 
                                    id="harga"
                                    class="mt-1 block w-full"
                                    v-model="form.harga"
                                    required
                                    autofocus
                                    autocomplete="harga"
                                />
                                <InputError class="mt-2" :message="form.errors.harga"/>
                            </div>
                            <div>
                                <InputLabel for="qty" value="Quantity" />
                                <NumberInput
                                    id="qty"
                                    class="mt-1 block w-full"
                                    v-model="form.qty"
                                    required
                                    autofocus
                                    autocomplete="qty"
                                />
                                <InputError class="mt-2" :message="form.errors.qty" />
                            </div>
                            <div class="flex items-center gap-4">
                                <PrimaryButton>Save</PrimaryButton>

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                </Transition>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>