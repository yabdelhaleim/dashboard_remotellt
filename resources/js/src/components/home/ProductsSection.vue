<template>
  <section id="products" class="max-w-7xl mx-auto my-24 px-4 sm:px-6 lg:px-8 text-right scroll-mt-24">
    
    <!-- Section Header -->
    <div class="mb-14">
      <span class="font-mono text-[11px] font-semibold text-vibrant-purple uppercase tracking-widest bg-dark-card px-4 py-2 rounded-full border border-dark-border">
        حلولنا البرمجية المبتكرة
      </span>
      <h2 class="section-headline text-2xl sm:text-3xl text-white mt-4 mb-3">
        اكتشف أنظمتنا السحابية المتكاملة
      </h2>
      <p class="font-body font-normal text-slate-300 text-base leading-ar-relaxed max-w-xl">
        أنظمة متكاملة مصممة بأحدث التقنيات لتسهيل إدارة نشاطك التجاري، أتمتة مبيعاتك، وزيادة كفاءتك التشغيلية.
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
import { useProductsStore } from '../../stores/useProductsStore'
import ProductCard from '../product/ProductCard.vue'

const productsStore = useProductsStore()
const products = computed(() => productsStore.products)
</script>
