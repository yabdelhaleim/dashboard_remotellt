<template>
  <label class="block text-right">
    <span v-if="label" class="block text-sm font-medium text-charcoal-700 mb-1.5">{{ label }}</span>
    <input
      v-bind="$attrs"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      class="w-full px-4 py-3 rounded-xl border border-warm-border bg-warm-50/50 text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent transition-all duration-300 text-sm"
    />
  </label>
</template>

<script setup>
defineProps({
  modelValue: { type: [String, Number], default: '' },
  label: { type: String, default: '' }
})

defineEmits(['update:modelValue'])
</script>
