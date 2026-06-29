<template>
  <div 
    class="bg-dark-card border border-dark-border hover:border-vibrant-purple/40 rounded-3xl p-6 sm:p-8 flex flex-col justify-between transition-all duration-300 relative overflow-hidden group hover:shadow-neon-purple hover:border-t-2 hover:border-t-vibrant-purple min-h-[250px]"
    :class="locale === 'ar' ? 'text-right' : 'text-left'"
  >
    <!-- Background decorative blur inside card -->
    <div class="absolute -left-10 -top-10 w-24 h-24 bg-vibrant-purple rounded-full blur-2xl opacity-5 group-hover:opacity-10 transition-opacity duration-300"></div>

    <div>
      <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
          <span class="text-3xl bg-dark-bg p-2 rounded-xl border border-dark-border select-none">
            {{ product.icon || '⚙️' }}
          </span>
          <h3 class="font-display font-bold text-lg text-white group-hover:text-vibrant-purple transition-colors duration-300 leading-normal">
            {{ product.name }}
          </h3>
        </div>
        <span v-if="index !== undefined" class="font-mono text-sm font-bold text-dark-border group-hover:text-vibrant-purple/40 transition-colors duration-300">
          0{{ index + 1 }}
        </span>
      </div>

      <p class="font-body text-slate-300 font-normal text-sm leading-relaxed mb-6 line-clamp-3">
        {{ product.description }}
      </p>
    </div>

    <!-- Footer -->
    <div class="border-t border-dark-border/40 pt-5 flex items-center justify-between mt-auto">
      <div>
        <span class="font-body font-normal text-[11px] text-dark-muted block">{{ t('cloud_subscription') }}</span>
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
        <span>{{ t('open_packages') }}</span>
        <span class="transition-transform duration-300 font-bold" :class="locale === 'ar' ? 'group-hover:translate-x-[-3px]' : 'group-hover:translate-x-[3px]'">{{ locale === 'ar' ? '←' : '→' }}</span>
      </a>

      <!-- Case B: Internal packages display -->
      <router-link 
        v-else
        :to="'/product/' + product.slug" 
        class="inline-flex items-center gap-1.5 font-display font-bold text-sm text-vibrant-purple hover:text-purple-400 transition-colors duration-300"
      >
        <span>{{ t('show_features') }}</span>
        <span class="transition-transform duration-300 font-bold" :class="locale === 'ar' ? 'group-hover:translate-x-[-3px]' : 'group-hover:translate-x-[3px]'">{{ locale === 'ar' ? '←' : '→' }}</span>
      </router-link>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { locale } from '../../utils/locale'
import { translations } from '../../utils/translations'

const props = defineProps({
  product: { type: Object, required: true },
  index: { type: Number, default: 0 }
})

function t(key) {
  return translations[locale.value][key] || key
}

const startingPrice = computed(() => {
  if (props.product.externalUrl) {
    return t('visit_packages')
  }
  if (!props.product.packages || props.product.packages.length === 0) {
    return t('custom_pricing')
  }
  const minPrice = Math.min(...props.product.packages.map(p => p.price))
  return locale.value === 'ar' ? `${minPrice} ج / شهرياً` : `${minPrice} EGP / mo`
})
</script>
