<script setup>

const props = defineProps({
    data: Object
});

</script>

<template>
    <h2 class="font-manrope font-bold text-3xl leading-10 text-gray-900 mb-2 capitalize">
        {{ data.nama }}
    </h2>
    <div class="flex flex-col sm:flex-row sm:items-center mb-6">
        <h6 class="font-manrope font-semibold text-2xl leading-9 text-gray-900 pr-5 mr-5">
            Rp. {{ data.price }}
        </h6>
    </div>
    <p class="text-gray-500 text-base font-normal mb-5">
        {{ data.deskripsi }} <a href="#" class="text-gray-600">More....</a>
    </p>
    <ul class="grid gap-y-4 mb-16">
        <li class="flex items-center gap-3">
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="26" height="26" rx="13" fill="gray" />
                <path
                    d="M7.66669 12.629L10.4289 15.3913C10.8734 15.8357 11.0956 16.0579 11.3718 16.0579C11.6479 16.0579 11.8701 15.8357 12.3146 15.3913L18.334 9.37183"
                    stroke="white" stroke-width="1.6" stroke-linecap="round" />
            </svg>
            <span class="font-normal text-base text-gray-900 ">{{ data.category_menu.nama }}</span>
        </li>
    </ul>
</template>