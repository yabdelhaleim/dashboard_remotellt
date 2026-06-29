<template>
  <section class="max-w-7xl mx-auto mt-8 mb-16 px-4 sm:px-6 lg:px-8 relative">
    
    <!-- Hero Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center min-h-[560px] py-10">
      
      <!-- Right/Left Side: Text & Actions -->
      <div class="lg:col-span-7 space-y-7 animate-slide-right" :class="locale === 'ar' ? 'text-right' : 'text-left'">
        
        <!-- Premium Badge -->
        <div class="inline-flex items-center gap-2.5 px-4 py-2 bg-dark-card border border-dark-border rounded-full select-none">
          <span class="flex h-2 w-2 rounded-full bg-vibrant-purple animate-pulse shrink-0"></span>
          <span class="font-mono text-[11px] font-semibold text-slate-300 tracking-widest uppercase">
            {{ t('hero_badge') }}
          </span>
        </div>

        <!-- Headline — منصة ريموتلي السحابية -->
        <h1 class="hero-headline text-[2.25rem] sm:text-[2.75rem] lg:text-[3.25rem] text-white tracking-normal font-extrabold leading-[1.3]" :class="locale === 'ar' ? 'text-right' : 'text-left'">
          <template v-if="locale === 'ar'">
            منصة
            <span class="relative inline-block">
              <span class="bg-gradient-to-l from-vibrant-cyan via-vibrant-purple to-primary-200 bg-clip-text text-transparent drop-shadow-[0_0_15px_rgba(168,85,247,0.3)] font-black">
                ريـمـوتـلـي
              </span>
            </span>
            <br />
            <span class="text-slate-200 font-extrabold text-[1.75rem] sm:text-[2.25rem] lg:text-[2.5rem]">للأنظمة السحابية وتطبيقات الجوال</span>
          </template>
          <template v-else>
            <span class="relative inline-block">
              <span class="bg-gradient-to-l from-vibrant-cyan via-vibrant-purple to-primary-200 bg-clip-text text-transparent drop-shadow-[0_0_15px_rgba(168,85,247,0.3)] font-black">
                Remotelly
              </span>
            </span>
            Platform
            <br />
            <span class="text-slate-200 font-extrabold text-[1.75rem] sm:text-[2.25rem] lg:text-[2.5rem]">For Cloud Systems & Mobile Apps</span>
          </template>
        </h1>

        <!-- Subheading -->
        <p class="font-body font-normal text-slate-300 text-base sm:text-lg leading-ar-relaxed max-w-2xl" :class="locale === 'ar' ? 'text-right' : 'text-left'">
          {{ t('hero_desc') }}
        </p>

        <!-- Benefit Checklist -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
          <div
            v-for="feat in features"
            :key="feat.label"
            class="flex items-center gap-3.5 bg-dark-card/60 border border-dark-border/70 p-4 rounded-2xl hover:border-vibrant-purple/30 transition-all duration-300"
            :class="locale === 'ar' ? 'text-right' : 'text-left'"
          >
            <span
              :class="`w-9 h-9 rounded-xl ${feat.bg} flex items-center justify-center ${feat.color} text-base shrink-0`"
            >{{ feat.icon }}</span>
            <div>
              <span class="font-display font-bold text-sm text-white block leading-snug">{{ feat.label }}</span>
              <span class="font-body font-normal text-xs text-dark-muted block mt-0.5 leading-snug">{{ feat.sub }}</span>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 pt-2" :class="locale === 'ar' ? 'justify-end' : 'justify-start'">
          <button
            @click="$emit('open-wizard')"
            class="bg-gradient-to-l from-primary-400 to-vibrant-purple text-white font-display font-bold py-3.5 px-8 rounded-2xl transition-all duration-300 shadow-neon-purple hover:-translate-y-0.5 active:translate-y-0 cursor-pointer text-sm text-center hover:shadow-[0_0_35px_rgba(168,85,247,0.45)]"
          >
            ✨ {{ t('book_now') }}
          </button>
          
          <a
            href="#products"
            class="bg-dark-card hover:bg-dark-hover text-dark-text border border-dark-border font-display font-semibold py-3.5 px-7 rounded-2xl transition-all duration-300 text-center text-sm hover:-translate-y-0.5 active:translate-y-0"
          >
            {{ t('explore_systems') }}
          </a>
        </div>

      </div>

      <!-- Left Side: Custom Animated Cloud & App Architecture -->
      <div class="lg:col-span-5 animate-slide-left relative flex items-center justify-center w-full min-h-[440px] md:min-h-[500px]">
        <!-- Aura Glows matching logo colors -->
        <div class="absolute w-60 h-60 bg-primary-400 rounded-full blur-[120px] opacity-20 pointer-events-none top-1/4 right-1/4 animate-pulse duration-4000"></div>
        <div class="absolute w-60 h-60 bg-vibrant-pink rounded-full blur-[120px] opacity-15 pointer-events-none bottom-1/4 left-1/4 animate-pulse duration-3000"></div>

        <!-- SVG Network Connections -->
        <svg class="absolute inset-0 w-full h-full pointer-events-none z-0" viewBox="0 0 400 400" fill="none">
          <!-- Hub to Dashboard -->
          <path d="M 200 200 Q 260 130 300 120" stroke="url(#line-grad-1)" stroke-width="2" stroke-dasharray="6,6" class="animate-dash" />
          <!-- Hub to Mobile -->
          <path d="M 200 200 Q 120 230 90 280" stroke="url(#line-grad-2)" stroke-width="2" stroke-dasharray="6,6" class="animate-dash" />
          <!-- Hub to DB -->
          <path d="M 200 200 Q 270 270 310 270" stroke="url(#line-grad-3)" stroke-width="2" stroke-dasharray="6,6" class="animate-dash" />
          
          <defs>
            <linearGradient id="line-grad-1" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" stop-color="#C06C47" />
              <stop offset="100%" stop-color="#D49B4B" />
            </linearGradient>
            <linearGradient id="line-grad-2" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" stop-color="#C06C47" />
              <stop offset="100%" stop-color="#4E6B53" />
            </linearGradient>
            <linearGradient id="line-grad-3" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" stop-color="#D49B4B" />
              <stop offset="100%" stop-color="#4E6B53" />
            </linearGradient>
          </defs>
        </svg>

        <!-- 1. Central SaaS Cloud Hub (Slow Pulse) -->
        <div class="absolute z-20 w-32 h-32 rounded-full bg-[#141311]/90 backdrop-blur-md border-2 border-primary-400/40 flex flex-col items-center justify-center shadow-neon-purple animate-pulse duration-[3000ms]">
          <span class="text-3xl select-none filter drop-shadow-[0_0_8px_rgba(192,108,71,0.5)]">☁️</span>
          <span class="text-[9px] font-mono text-primary-400 font-bold uppercase tracking-wider mt-1.5">Remotelly SaaS</span>
          <span class="text-[8px] text-dark-muted font-bold">Cloud Core</span>
        </div>

        <!-- 2. Orbiting Node: Web Dashboard (Floats) -->
        <div class="absolute z-10 top-6 right-2 bg-[#141311]/95 backdrop-blur-md border border-dark-border p-4 rounded-2xl w-48 shadow-card select-none animate-float" style="animation-duration: 5s">
          <div class="flex items-center justify-between border-b border-dark-border/40 pb-2 mb-2">
            <div class="flex items-center gap-1">
              <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
              <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
              <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
            </div>
            <span class="font-mono text-[8px] text-dark-muted">Web Admin</span>
          </div>
          <div class="space-y-1.5 text-right">
            <div class="h-2.5 bg-dark-hover rounded w-3/4 mr-auto"></div>
            <div class="flex items-center justify-between pt-1">
              <div class="w-16 h-4 bg-primary-400/10 border border-primary-400/20 rounded flex items-center justify-center">
                <span class="text-[8px] font-mono font-bold text-primary-400">92,450 ج</span>
              </div>
              <div class="w-12 h-2 bg-dark-hover rounded"></div>
            </div>
          </div>
        </div>

        <!-- 3. Orbiting Node: Mobile App (Floats out of sync) -->
        <div class="absolute z-10 bottom-4 left-2 bg-[#141311]/95 backdrop-blur-md border border-dark-border p-3.5 rounded-[22px] w-28 h-44 shadow-card select-none animate-float" style="animation-duration: 6s">
          <!-- Mobile Screen Frame -->
          <div class="w-full h-full rounded-2xl border border-dark-border bg-dark-bg/60 p-2 flex flex-col justify-between">
            <div class="flex items-center justify-between border-b border-dark-border/40 pb-1 mb-1">
              <span class="text-[6px] font-mono text-dark-muted">12:00</span>
              <span class="text-[6px] text-dark-muted">🔋</span>
            </div>
            <!-- Notification Badge -->
            <div class="bg-primary-400/20 border border-primary-400/30 p-1.5 rounded-lg text-right space-y-1">
              <span class="text-[7px] text-primary-400 font-bold block leading-none">تفعيل الكاشير</span>
              <span class="text-[6px] text-dark-text block leading-none">جاهز للعمل 📦</span>
            </div>
            <div class="h-10 bg-dark-card border border-dark-border rounded-lg flex items-center justify-center">
              <span class="text-[12px]">📱</span>
            </div>
          </div>
        </div>

        <!-- 4. Orbiting Node: Database Cylinder (Floats) -->
        <div class="absolute z-10 bottom-6 right-6 bg-[#141311]/95 backdrop-blur-md border border-dark-border p-3 rounded-2xl w-24 h-24 flex flex-col items-center justify-center shadow-card select-none animate-float" style="animation-duration: 4.5s">
          <span class="text-xl">💾</span>
          <span class="text-[9px] font-bold text-white mt-1">الربط الآمن</span>
          <div class="flex gap-0.5 mt-1.5">
            <span class="w-1.5 h-1.5 rounded-full bg-vibrant-teal animate-ping"></span>
            <span class="text-[7px] text-vibrant-teal font-mono">Syncing</span>
          </div>
        </div>
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

const features = computed(() => [
  {
    icon: '⚡',
    label: t('feat_1_title'),
    sub: t('feat_1_sub'),
    bg: 'bg-vibrant-purple/10',
    color: 'text-vibrant-purple',
  },
  {
    icon: '🛡️',
    label: t('feat_2_title'),
    sub: t('feat_2_sub'),
    bg: 'bg-vibrant-cyan/10',
    color: 'text-vibrant-cyan',
  },
  {
    icon: '🤝',
    label: t('feat_3_title'),
    sub: t('feat_3_sub'),
    bg: 'bg-vibrant-teal/10',
    color: 'text-vibrant-teal',
  },
  {
    icon: '🛠️',
    label: t('feat_4_title'),
    sub: t('feat_4_sub'),
    bg: 'bg-vibrant-pink/10',
    color: 'text-vibrant-pink',
  },
])
</script>
