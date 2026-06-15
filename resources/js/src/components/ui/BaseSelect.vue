<template>
  <label class="block text-right">
    <span v-if="label" class="block text-sm font-medium text-charcoal-700 mb-1.5">{{ label }}</span>
    <select
      v-bind="$attrs"
      :value="modelValue"
      @change="$emit('update:modelValue', $event.target.value)"
      class="w-full px-4 py-3 rounded-xl border border-warm-border bg-white text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-primary-400 transition-all duration-300 text-sm"
    >
      <option v-for="opt in options" :key="opt.value" :value="opt.value">
        {{ opt.label }}
      </option>
    </select>
  </label>
</template>

<script setup>
defineProps({
  modelValue: { type: [String, Number], default: '' },
  label: { type: String, default: '' },
  options: { type: Array, default: () => [] }
})

defineEmits(['update:modelValue'])
</script>
