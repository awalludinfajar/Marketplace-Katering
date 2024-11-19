<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import { computed, ref, watch } from 'vue';
import CartRemove from './CartRemove.vue';

const props = defineProps({
    data: {
        type: Array,
        required: true
    },
    totalValue: {
        type: Number,
        default: 0 
    },
    qtyVal: {
        type: Number,
        default: 0
    }
});

const emit = defineEmits(['update:totalValue']);

function setIdr(crcy) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(crcy);
}

const selectedProducts = ref(new Set());

function toggleAll() {
  const allSelected = props.data.every(res => 
    res.products.every(product => selectedProducts.value.has(product))
  );

  props.data.forEach(res => {
    res.products.forEach(product => {
      if (allSelected) {
        selectedProducts.value.delete(product);
      } else {
        selectedProducts.value.add(product);
      }
    });
  });
}

function toggleMerchant(products) {
  const allSelected = products.every(product => selectedProducts.value.has(product));
  products.forEach(product => {
    if (allSelected) {
      selectedProducts.value.delete(product);
    } else {
      selectedProducts.value.add(product);
    }
  });
}

function toggleProduct(product) {
  if (selectedProducts.value.has(product)) {
    selectedProducts.value.delete(product);
  } else {
    selectedProducts.value.add(product);
  }
}

const total = computed(() => {
  let totalPrice = 0;

  selectedProducts.value.forEach((product) => {
    totalPrice += product.price * product.quantity;
  });

  return {
    price: totalPrice,
  };
});

watch(total, (newTotal) => {
    emit('update:totalValue', newTotal.price);
  },
  { immediate: true }
);
</script>

<template>
    <div class="flex items-center gap-2">
        <Checkbox 
            :checked="props.data.every(res => res.products.every(product => selectedProducts.has(product)))"
            @change="toggleAll"
        />
        <h3 class="text-lg font-semibold">Select all</h3>
    </div>
    <div class="m-4" v-for="res in props.data">
        <div class="flex items-center gap-2">
            <Checkbox
                :checked="res.products.every(product => selectedProducts.has(product))"
                @change="toggleMerchant(res.products)"
            />
            <h3 class="text-lg font-semibold">{{ res.merchantName }}</h3>
        </div>
        <div class="m-4" v-for="product in res.products">
            <div class="card bg-white shadow-md rounded-md p-6 max-lg mx-auto flex items-center">
                <div class="flex items-center gap-4 flex-grow">
                    <Checkbox
                        :checked="selectedProducts.has(product)"
                        @change="toggleProduct(product)"
                    />
                    <img :src="`${product.gambar}`" alt="Card Image" class="w-24 h-24 rounded-md object-cover">
                    <div class="flex-grow">
                        <h3 class="text-lg font-semibold">{{ product.productName }}</h3>
                        <p class="text-sm text-gray-500">{{ setIdr(product.price) }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-end">
                    <p class="text-gray-400 mr-4">
                        Qty: {{ product.quantity }}
                    </p>
                    <CartRemove :data="product.productId" />
                </div>
            </div>
        </div>
    </div>
</template>