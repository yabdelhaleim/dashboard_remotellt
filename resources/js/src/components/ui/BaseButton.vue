<template>
  <button
    v-bind="$attrs"
    :class="[
      'font-medium py-3 px-6 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center gap-2 hover:-translate-y-0.5 cursor-pointer text-sm active:scale-[0.98]',
      variantClasses
    ]"
  >
    <slot />
  </button>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  variant: { type: String, default: 'primary' }
})

const variantClasses = computed(() => {
  if (props.variant === 'primary') {
    return 'bg-gradient-to-l from-primary-400 to-vibrant-pink text-white hover:shadow-[0_0_25px_rgba(0,198,255,0.35)] hover:scale-[1.02]'
  } else if (props.variant === 'secondary' || props.variant === 'outline') {
    return 'bg-transparent hover:bg-primary-400/10 text-dark-text border border-primary-400/30 hover:border-primary-400/60'
  } else if (props.variant === 'charcoal') {
    return 'bg-charcoal-900 hover:bg-dark-hover text-dark-text border border-dark-border'
  } else {
    return 'bg-transparent hover:bg-primary-400/10 text-dark-text border border-primary-400/30 hover:border-primary-400/60'
  }
})
</script>
