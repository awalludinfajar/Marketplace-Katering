<script setup lang="ts">
import BackButton from '@/Components/BackButton.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import NumberInput from '@/Components/NumberInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import RadioButtonType from './Partials/RadioButtonType.vue';

const addresses = usePage().props.addresses;

const form = useForm({
    typeAddress: addresses === null ? '' : addresses.type_address,
    address:  addresses === null ? '' : addresses.address,
    province:  addresses === null ? '' : addresses.province,
    city:  addresses === null ? '' : addresses.city,
    postCode:  addresses === null ? 0 : parseInt(addresses.post_code),
    mainAddress:  addresses === null ? false : addresses.primary
});

onMounted(() => {
    const fetchValue = form.mainAddress;
    form.mainAddress = fetchValue;
});

</script>

<template>
    <Head title="Input Address"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Addresses
                </h2>
            </div>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <BackButton />
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8" >
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Add address
                            </h2>
                        </header>

                        <form action="" method="post" class="mt-6 space-y-6"
                            @submit.prevent="addresses === null ? form.post(route('address.store')) : form.post(route('address.update', addresses.id))">
                            <div>
                                <InputLabel for="typeAddress" value="Type Address"/>
                                <RadioButtonType 
                                    id="typeAddress"
                                    v-model:initialSelectedType="form.typeAddress"
                                />
                                <InputError class="mt-2" :message="form.errors.typeAddress"/>
                            </div>
                            <div>
                                <InputLabel for="address" value="Alamat Lengkap"/>
                                <TextAreaInput
                                    id="address"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.address"
                                    required
                                    autofocus
                                    autocomplete="Alamat Lengkap"
                                />
                                <InputError class="mt-2" :message="form.errors.address"/>
                            </div>
                            <div>
                                <InputLabel for="province" value="Provinsi"/>
                                <TextInput
                                    id="province"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.province"
                                    required
                                    autofocus
                                    autocomplete="Provinsi"
                                />
                                <InputError class="mt-2" :message="form.errors.province"/>
                            </div>
                            <div>
                                <InputLabel for="city" value="Kota"/>
                                <TextInput
                                    id="city"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.city"
                                    required
                                    autofocus
                                    autocomplete="Kota"
                                />
                                <InputError class="mt-2" :message="form.errors.city"/>
                            </div>
                            <div>
                                <InputLabel for="postCode" value="Kode Pos"/>
                                <NumberInput
                                    id="postCode"
                                    class="mt-1 block w-full"
                                    v-model="form.postCode"
                                    required
                                    autofocus
                                    autocomplete="Kode Pos"
                                />
                                <InputError class="mt-2" :message="form.errors.postCode"/>
                            </div>
                            <div class="flex justify-start">
                                <Checkbox
                                    v-model:checked="form.mainAddress"
                                    id="mainAddress"
                                />
                                <InputLabel for="main" value="Alamat Utama" class="ml-4"/>
                                <InputError class="ml-6" :message="form.errors.mainAddress"/>
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