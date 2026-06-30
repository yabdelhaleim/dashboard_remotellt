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
      return 'bg-[#1A2332] text-[#00C6FF] border border-[#1E90FF]/30'
    case 'contacted':
    case 'info':
      return 'bg-[#11151F] text-slate-300 border border-[#1E2536]'
    case 'closed':
    case 'success':
      return 'bg-[#11221F] text-emerald-400 border border-emerald-500/20'
    default:
      return 'bg-[#1A2332] text-[#00C6FF] border border-[#1E90FF]/30'
  }
})
</script>
