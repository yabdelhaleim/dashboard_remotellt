<template>
  <div 
    class="bg-dark-card border border-dark-border hover:border-vibrant-purple/40 rounded-3xl p-6 sm:p-8 flex flex-col justify-between transition-all duration-300 relative overflow-hidden group hover:shadow-neon-purple hover:border-t-2 hover:border-t-vibrant-purple text-right min-h-[250px]"
  >
    <!-- Background decorative blur inside card -->
    <div class="absolute -left-10 -top-10 w-24 h-24 bg-vibrant-purple rounded-full blur-2xl opacity-5 group-hover:opacity-10 transition-opacity duration-300"></div>

    <div>
      <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
          <span class="text-3xl bg-dark-bg p-2 rounded-xl border border-dark-border select-none">
            {{ product.icon || '⚙️' }}
          </span>
          <h3 class="font-display font-bold text-lg text-white group-hover:text-vibrant-purple transition-colors duration-300 leading-ar-normal">
            {{ product.name }}
          </h3>
        </div>
        <span v-if="index !== undefined" class="font-mono text-sm font-bold text-dark-border group-hover:text-vibrant-purple/40 transition-colors duration-300">
          0{{ index + 1 }}
        </span>
      </div>

      <p class="font-body text-slate-300 font-normal text-sm leading-ar-relaxed mb-6 line-clamp-3">
        {{ product.description }}
      </p>
    </div>

    <!-- Footer -->
    <div class="border-t border-dark-border/40 pt-5 flex items-center justify-between mt-auto">
      <div>
        <span class="font-body font-normal text-[11px] text-dark-muted block">الاشتراك السحابي</span>
        <span class="font-mono font-bold text-vibrant-cyan text-sm sm:text-base">
          {{ startingPrice }}
        </span>
      </div>

      <!-- Conditional Action Link -->
      <!-- Case A: External Redirection URL exists -->
      <a 
        v-if="product.externalUrl"
        :href="product.externalUrl"
        class="inline-flex items-center gap-1.5 font-display font-bold text-sm text-vibrant-blue hover:text-blue-400 transition-colors duration-300"
      >
        <span>فتح صفحة الباقات 🔗</span>
        <span class="group-hover:translate-x-[-3px] transition-transform duration-300 font-bold">←</span>
      </a>

      <!-- Case B: Internal packages display -->
      <router-link 
        v-else
        :to="'/product/' + product.slug" 
        class="inline-flex items-center gap-1.5 font-display font-bold text-sm text-vibrant-purple hover:text-purple-400 transition-colors duration-300"
      >
        <span>اعرض المميزات</span>
        <span class="group-hover:translate-x-[-3px] transition-transform duration-300 font-bold">←</span>
      </router-link>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  product: { type: Object, required: true },
  index: { type: Number, default: 0 }
})

const startingPrice = computed(() => {
  if (props.product.externalUrl) {
    return 'زيارة رابط الباقات'
  }
  if (!props.product.packages || props.product.packages.length === 0) {
    return 'طلب تسعيرة خاصة'
  }
  const minPrice = Math.min(...props.product.packages.map(p => p.price))
  return `${minPrice} ج / شهرياً`
})
</script>
