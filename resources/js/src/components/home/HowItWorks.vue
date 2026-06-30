<template>
  <section id="how-it-works" class="bg-dark-bg/40 border-y border-dark-border py-24 scroll-mt-24" :class="locale === 'ar' ? 'text-right' : 'text-left'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Title -->
      <div class="mb-14" :class="locale === 'ar' ? 'text-center md:text-right' : 'text-center md:text-left'">
        <span class="font-mono text-[11px] font-semibold text-vibrant-cyan uppercase tracking-widest bg-dark-card px-4 py-2 rounded-full border border-dark-border">
          {{ t('how_badge') }}
        </span>
        <h2 class="section-headline text-2xl sm:text-3xl text-white mt-4">
          {{ t('how_title') }}
        </h2>
      </div>

      <!-- Steps Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <div
          v-for="(step, i) in steps"
          :key="i"
          class="relative bg-dark-card rounded-3xl p-7 sm:p-8 border border-dark-border shadow-card flex flex-col gap-4 hover:border-vibrant-purple/40 hover:shadow-neon-purple transition-all duration-300 group overflow-hidden"
        >
          <!-- Step Number Watermark -->
          <div 
            class="absolute top-5 font-mono text-7xl font-black text-primary-400/5 select-none group-hover:text-vibrant-purple/8 transition-colors leading-none"
            :class="locale === 'ar' ? 'left-5' : 'right-5'"
          >
            0{{ i + 1 }}
          </div>

          <div class="relative z-10">
            <div class="font-mono text-xs font-bold text-vibrant-purple mb-3 tracking-widest">
              STEP 0{{ i + 1 }}
            </div>
            <h3 class="font-display font-bold text-lg text-white mb-2 group-hover:text-vibrant-purple transition-colors leading-normal">
              {{ step.title }}
            </h3>
            <p class="font-body font-normal text-slate-300 text-sm leading-relaxed">
              {{ step.description }}
            </p>
          </div>

        </div>

      </div>

      <!-- CTA Under Steps -->
      <div class="mt-12 text-center">
        <button
          @click="$emit('open-wizard')"
          class="font-display font-bold text-sm bg-gradient-to-l from-primary-400 to-vibrant-pink text-white py-3.5 px-8 rounded-2xl shadow-neon-cyan hover:-translate-y-0.5 hover:scale-[1.02] hover:shadow-[0_0_25px_rgba(0,198,255,0.45)] transition-all duration-300 cursor-pointer"
        >
          {{ t('book_now') }}
        </button>
      </div>

    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'
import { locale } from '../../utils/locale'
import { translations } from '../../utils/translations'

defineEmits(['open-wizard'])

function t(key) {
  return translations[locale.value][key] || key
}

const steps = computed(() => [
  {
    title: t('step_1_title'),
    description: t('step_1_desc'),
  },
  {
    title: t('step_2_title'),
    description: t('step_2_desc'),
  },
  {
    title: t('step_3_title'),
    description: t('step_3_desc'),
  },
  {
    title: t('step_4_title'),
    description: t('step_4_desc'),
  },
])
</script>
