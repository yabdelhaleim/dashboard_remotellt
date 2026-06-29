<template>
  <section id="products" class="max-w-7xl mx-auto my-24 px-4 sm:px-6 lg:px-8 scroll-mt-24" :class="locale === 'ar' ? 'text-right' : 'text-left'">
    
    <!-- Section Header -->
    <div class="mb-14">
      <span class="font-mono text-[11px] font-semibold text-vibrant-purple uppercase tracking-widest bg-dark-card px-4 py-2 rounded-full border border-dark-border">
        {{ t('products_badge') }}
      </span>
      <h2 class="section-headline text-2xl sm:text-3xl text-white mt-4 mb-3">
        {{ t('products_title') }}
      </h2>
      <p class="font-body font-normal text-slate-300 text-base leading-relaxed max-w-xl" :class="locale === 'ar' ? 'mr-0 ml-auto' : 'ml-0 mr-auto'">
        {{ t('products_desc') }}
      </p>
    </div>

    <!-- Grid of Products -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <ProductCard
        v-for="(prod, i) in products"
        :key="prod.id"
        :product="prod"
        :index="i"
      />
    </div>

  </section>
</template>

<script setup>
import { computed } from 'vue'
import { locale } from '../../utils/locale'
import { translations } from '../../utils/translations'
import { useProductsStore } from '../../stores/useProductsStore'
import ProductCard from '../product/ProductCard.vue'

const productsStore = useProductsStore()
const products = computed(() => productsStore.products)

function t(key) {
  return translations[locale.value][key] || key
}
</script>
