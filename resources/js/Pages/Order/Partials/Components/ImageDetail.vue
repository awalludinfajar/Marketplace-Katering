<script setup>

const props = defineProps({
    data: Object
});

</script>

<template>
    <div class="img">
        <div class="img-box h-full max-lg:mx-auto ">
            <img :src="data.gambar" :alt="data.nama" class="max-lg:mx-auto lg:ml-auto h-full object-cover">
        </div>
    </div>
</template>