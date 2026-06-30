<template>
  <div 
    :class="[
      'bg-dark-card rounded-3xl p-6 sm:p-8 flex flex-col justify-between border transition-all duration-300 relative text-right hover:shadow-lg',
      highlighted 
        ? 'border-2 border-vibrant-purple shadow-neon-cyan scale-102 z-10' 
        : 'border-dark-border'
    ]"
  >
    <!-- Featured Badge -->
    <div 
      v-if="highlighted" 
      class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-gradient-to-r from-primary-400 to-vibrant-pink text-white text-[9px] font-bold px-3 py-1 rounded-full uppercase tracking-wider font-mono shadow-sm"
    >
      الأكثر طلباً ★
    </div>

    <div>
      <div class="mb-4">
        <h3 class="font-display font-black text-xl text-white mb-1">
          {{ pkg.name }}
        </h3>
        <span class="font-mono text-[10px] font-bold text-dark-muted uppercase tracking-widest block mb-3">
          باقة {{ pkg.name }} الذكية
        </span>
      </div>

      <!-- Pricing -->
      <div class="mb-6 flex items-baseline gap-1 border-b border-dark-border/40 pb-6">
        <span class="font-mono font-black text-3xl text-vibrant-cyan">
          {{ pkg.price }}
        </span>
        <span class="text-xs text-dark-muted font-body">ج / شهرياً</span>
      </div>

      <!-- Feature List Component -->
      <FeatureList :features="pkg.features" class="mb-8 text-dark-text/90" />
    </div>

    <!-- Select Action Button -->
    <button 
      @click="$emit('select', pkg)"
      :class="[
        'w-full font-body font-bold py-3.5 px-6 rounded-2xl transition-all duration-300 flex items-center justify-center gap-2 hover:-translate-y-0.5 active:translate-y-0 cursor-pointer text-xs',
        highlighted 
          ? 'bg-gradient-to-r from-primary-400 to-vibrant-pink text-white shadow-neon-cyan/20' 
          : 'bg-dark-bg hover:bg-dark-hover text-dark-text border border-dark-border'
      ]"
    >
      <span>اشترك الآن</span>
      <span>←</span>
    </button>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import FeatureList from './FeatureList.vue'

const props = defineProps({
  pkg: { type: Object, required: true }
})

defineEmits(['select'])

const highlighted = computed(() => !!props.pkg.highlighted)
</script>
