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
    return 'bg-primary-400 hover:bg-primary-600 text-white font-mono'
  } else if (props.variant === 'charcoal') {
    return 'bg-charcoal-800 hover:bg-charcoal-900 text-primary-200'
  } else {
    return 'bg-white hover:bg-warm-100 text-charcoal-800 border border-warm-border'
  }
})
</script>
