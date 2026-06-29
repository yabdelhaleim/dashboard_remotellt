<template>
  <section class="bg-dark-bg py-24 text-center text-white relative overflow-hidden border-t border-dark-border">
    <!-- Decorative Glows -->
    <div class="absolute -left-40 -top-40 w-96 h-96 bg-vibrant-purple rounded-full blur-[130px] opacity-10 pointer-events-none"></div>
    <div class="absolute -right-40 -bottom-40 w-96 h-96 bg-vibrant-cyan rounded-full blur-[130px] opacity-10 pointer-events-none"></div>
    
    <div class="max-w-3xl mx-auto px-4 relative z-10 space-y-7">
      
      <div class="inline-flex items-center gap-2 px-4 py-2 bg-dark-card border border-dark-border rounded-full">
        <span class="w-2 h-2 rounded-full bg-vibrant-cyan animate-pulse"></span>
        <span class="font-mono text-[11px] font-semibold text-vibrant-cyan tracking-widest uppercase">{{ t('cta_badge') }}</span>
      </div>

      <h2 class="section-headline text-3xl sm:text-[2.2rem] text-white">
        {{ t('cta_title') }}
      </h2>
      
      <p class="font-body font-normal text-dark-muted text-base leading-relaxed max-w-xl mx-auto">
        {{ t('cta_desc') }}
      </p>
      
      <div class="flex flex-col sm:flex-row gap-4 justify-center pt-2">
        <button
          @click="$emit('open-wizard')"
          class="bg-gradient-to-l from-primary-400 to-vibrant-purple text-white font-display font-bold py-4 px-10 rounded-2xl transition-all duration-300 shadow-neon-purple hover:shadow-[0_0_40px_rgba(168,85,247,0.5)] hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2.5 text-sm sm:text-base cursor-pointer"
        >
          <span>✨</span>
          <span>{{ t('book_now') }}</span>
        </button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { locale } from '../../utils/locale'
import { translations } from '../../utils/translations'

defineEmits(['open-wizard'])

function t(key) {
  return translations[locale.value][key] || key
}
</script>
