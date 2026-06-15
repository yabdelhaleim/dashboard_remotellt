<template>
  <ul class="space-y-3 text-sm text-charcoal-700">
    <li 
      v-for="feat in features" 
      :key="feat" 
      class="flex items-start gap-2.5 leading-relaxed"
    >
      <span class="text-primary-400 font-bold shrink-0 text-base select-none">
        ✓
      </span>
      <span>{{ feat }}</span>
    </li>
  </ul>
</template>

<script setup>
defineProps({
  features: { type: Array, default: () => [] }
})
</script>
