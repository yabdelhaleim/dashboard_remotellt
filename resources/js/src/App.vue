<template>
  <div id="app" dir="rtl">
    <router-view />
  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { useProductsStore } from './stores/useProductsStore'

const productsStore = useProductsStore()

// تحميل المنتجات من الـ API عند أول تشغيل
onMounted(() => {
  productsStore.fetchProducts()
})
</script>

<style>
</style>
