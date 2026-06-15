<template>
  <span
    :class="[
      'inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold font-mono tracking-wider',
      colorClasses
    ]"
  >
    <slot />
  </span>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  type: { type: String, default: 'primary' }
})

const colorClasses = computed(() => {
  switch (props.type) {
    case 'new':
    case 'warning':
      return 'bg-yellow-100 text-yellow-800 border border-yellow-200'
    case 'contacted':
    case 'info':
      return 'bg-blue-100 text-blue-800 border border-blue-200'
    case 'closed':
    case 'success':
      return 'bg-green-100 text-green-800 border border-green-200'
    default:
      return 'bg-primary-50 text-primary-800 border border-primary-100'
  }
})
</script>
