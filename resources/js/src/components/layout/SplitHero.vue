<template>
  <section class="max-w-7xl mx-auto my-20 sm:my-28 px-4 sm:px-6 lg:px-8 relative">
    
    <!-- Hero Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center min-h-[580px] py-10">
      
      <!-- Right/Left Side: Text & Actions -->
      <div class="lg:col-span-7 space-y-6 animate-slide-right" :class="locale === 'ar' ? 'text-right' : 'text-left'">
        
        <!-- Premium Badge (Aligned with text block, bold font, larger padding & readable text, width fits content) -->
        <div class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-[#11151F] border border-primary-400/25 rounded-full select-none shadow-sm w-fit">
          <span class="flex h-2.5 w-2.5 rounded-full bg-[#00C6FF] animate-pulse shrink-0"></span>
          <span class="font-display font-bold text-sm text-slate-200">
            {{ t('hero_badge') }}
          </span>
        </div>

        <!-- Headline — امتلك نظامك السحابي الذكي وأدر أعمالك بكفاءة -->
        <h1 class="hero-headline text-[2.25rem] sm:text-[2.75rem] lg:text-[3.25rem] text-white tracking-normal font-black leading-[1.25] mb-4" :class="locale === 'ar' ? 'text-right' : 'text-left'">
          <template v-if="locale === 'ar'">
            <span class="bg-gradient-to-r from-primary-400 to-[#00C6FF] bg-clip-text text-transparent">{{ t('hero_title_brand') }}</span>
            <span class="bg-gradient-to-r from-[#00C6FF] to-primary-400 bg-clip-text text-transparent mx-2">{{ t('hero_title_1') }}</span>
            <span class="text-slate-200 block sm:inline">{{ t('hero_title_2') }}</span>
          </template>
          <template v-else>
            <span class="bg-gradient-to-r from-primary-400 to-[#00C6FF] bg-clip-text text-transparent">Own Your Smart</span>
            <span class="bg-gradient-to-r from-[#00C6FF] to-primary-400 bg-clip-text text-transparent mx-2">Cloud System</span>
            <span class="text-slate-200 block sm:inline">and Manage Business Efficiently</span>
          </template>
        </h1>

        <!-- Subheading -->
        <p class="font-body font-normal text-slate-300 text-base sm:text-lg leading-ar-relaxed max-w-2xl" :class="locale === 'ar' ? 'text-right' : 'text-left'">
          {{ t('hero_desc') }}
        </p>

        <!-- Benefit Checklist (Sleek Glassmorphic Cards with Micro-interactions) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div
            v-for="feat in features"
            :key="feat.label"
            class="flex items-center gap-3.5 bg-dark-card/65 backdrop-blur-md border border-dark-border/60 hover:border-primary-400/40 p-4.5 rounded-2xl hover:shadow-[0_0_25px_rgba(30,144,255,0.06)] hover:-translate-y-0.5 transition-all duration-300 group cursor-pointer"
            :class="locale === 'ar' ? 'text-right' : 'text-left'"
          >
            <span
              :class="`w-9 h-9 rounded-xl ${feat.bg} flex items-center justify-center ${feat.color} shrink-0 group-hover:scale-105 transition-transform duration-300`"
              v-html="feat.icon"
            ></span>
            <div>
              <span class="font-display font-bold text-sm text-white block leading-snug group-hover:text-primary-400 transition-colors duration-300">{{ feat.label }}</span>
              <span class="font-body font-normal text-xs text-dark-muted block mt-0.5 leading-snug">{{ feat.sub }}</span>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 pt-4" :class="locale === 'ar' ? 'justify-end' : 'justify-start'">
          <button
            @click="$emit('open-wizard')"
            class="bg-gradient-to-l from-primary-400 to-vibrant-pink text-white font-display font-bold py-3.5 px-8 rounded-2xl transition-all duration-300 shadow-neon-purple hover:-translate-y-0.5 hover:scale-[1.02] active:translate-y-0 cursor-pointer text-sm text-center hover:shadow-[0_0_35px_rgba(0,198,255,0.45)]"
          >
            ✨ {{ t('book_now') }}
          </button>
          
          <a
            href="#products"
            class="bg-transparent hover:bg-primary-400/10 text-dark-text border border-primary-400/30 hover:border-primary-400/60 font-display font-semibold py-3.5 px-7 rounded-2xl transition-all duration-300 text-center text-sm hover:-translate-y-0.5 active:translate-y-0"
          >
            {{ t('explore_systems') }}
          </a>
        </div>

      </div>

      <!-- Left Side: Custom Animated Cloud & App Architecture -->
      <div class="lg:col-span-5 animate-slide-left relative flex items-center justify-center w-full min-h-[460px]">
        <!-- Subtle Grid Pattern Background with Radial Fade -->
        <div class="absolute inset-0 grid-pattern opacity-[0.14] [mask-image:radial-gradient(circle_at_center,black_40%,transparent_75%)] pointer-events-none z-0"></div>

        <!-- Aura Glows matching sky-blue / cyan brand colors -->
        <div class="absolute w-72 h-72 bg-[#00C6FF]/10 rounded-full blur-[120px] pointer-events-none top-1/4 right-1/4 animate-pulse duration-4000 z-0"></div>
        <div class="absolute w-72 h-72 bg-[#1E90FF]/8 rounded-full blur-[120px] pointer-events-none bottom-1/4 left-1/4 animate-pulse duration-3000 z-0"></div>

        <!-- Cohesive Floating Composition Container -->
        <div class="relative w-full h-[400px] flex items-center justify-center animate-float-slow z-10">
          
          <!-- SVG Network Connections (Sky Blue Gradients) -->
          <svg class="absolute inset-0 w-full h-full pointer-events-none z-0" viewBox="0 0 400 400" fill="none">
            <!-- Hub to Dashboard -->
            <path d="M 200 200 Q 260 130 300 120" stroke="url(#line-grad-1)" stroke-width="2" stroke-dasharray="6,6" class="animate-dash" />
            <!-- Hub to Mobile -->
            <path d="M 200 200 Q 120 230 90 280" stroke="url(#line-grad-2)" stroke-width="2" stroke-dasharray="6,6" class="animate-dash" />
            <!-- Hub to DB -->
            <path d="M 200 200 Q 270 270 310 270" stroke="url(#line-grad-3)" stroke-width="2" stroke-dasharray="6,6" class="animate-dash" />
            
            <defs>
              <linearGradient id="line-grad-1" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#1E90FF" />
                <stop offset="100%" stop-color="#00C6FF" />
              </linearGradient>
              <linearGradient id="line-grad-2" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#1E90FF" />
                <stop offset="100%" stop-color="#2563EB" />
              </linearGradient>
              <linearGradient id="line-grad-3" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#00C6FF" />
                <stop offset="100%" stop-color="#60A5FA" />
              </linearGradient>
            </defs>
          </svg>

          <!-- 1. Central SaaS Cloud Hub (Slow Pulse) -->
          <div class="absolute z-20 w-32 h-32 rounded-full bg-dark-card/90 backdrop-blur-md border-2 border-primary-400/40 flex flex-col items-center justify-center shadow-neon-cyan animate-pulse duration-[3000ms]">
            <span class="text-3xl select-none filter drop-shadow-[0_0_8px_rgba(0,198,255,0.5)]"><svg class="w-10 h-10 text-primary-400 filter drop-shadow-[0_0_8px_rgba(0,198,255,0.4)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
            </svg></span>
            <span class="text-[9px] font-mono text-primary-400 font-bold uppercase tracking-wider mt-1.5">Remotelly SaaS</span>
            <span class="text-[8px] text-dark-muted font-bold">Cloud Core</span>
          </div>

          <!-- 2. Orbiting Node: Web Dashboard -->
          <div class="absolute z-10 top-6 right-2 glass-card p-4 rounded-2xl w-48 shadow-card select-none">
            <div class="flex items-center justify-between border-b border-dark-border/40 pb-2 mb-2">
              <div class="flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-dark-border"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-dark-border"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-dark-border"></span>
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

          <!-- 3. Orbiting Node: Mobile App -->
          <div class="absolute z-10 bottom-4 left-2 glass-card p-3.5 rounded-[22px] w-28 h-44 shadow-card select-none">
            <!-- Mobile Screen Frame -->
            <div class="w-full h-full rounded-2xl border border-dark-border bg-dark-bg/60 p-2 flex flex-col justify-between">
              <div class="flex items-center justify-between border-b border-dark-border/40 pb-1 mb-1">
                <span class="text-[6px] font-mono text-dark-muted">12:00</span>
                <span class="text-[6px] text-dark-muted">100%</span>
              </div>
              <!-- Notification Badge -->
              <div class="bg-primary-400/20 border border-primary-400/30 p-1.5 rounded-lg text-right space-y-1">
                <span class="text-[7px] text-primary-400 font-bold block leading-none">تفعيل الكاشير</span>
                <span class="text-[6px] text-dark-text block leading-none flex items-center justify-end gap-0.5">
                  <span>جاهز للعمل</span>
                  <span class="w-1 h-1 rounded-full bg-emerald-400"></span>
                </span>
              </div>
              <div class="h-10 bg-dark-card border border-dark-border rounded-lg flex flex-col justify-center px-1.5 gap-1">
                <div class="h-1 bg-primary-400/30 rounded w-full"></div>
                <div class="h-1 bg-primary-400/20 rounded w-5/6"></div>
                <div class="h-1 bg-primary-400/10 rounded w-2/3"></div>
              </div>
            </div>
          </div>

          <!-- 4. Orbiting Node: Database Cylinder -->
          <div class="absolute z-10 bottom-6 right-6 glass-card p-3 rounded-2xl w-24 h-24 flex flex-col items-center justify-center shadow-card select-none">
            <span class="text-xl"><svg class="w-6 h-6 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <ellipse cx="12" cy="5" rx="9" ry="3" fill="none" />
              <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5" />
              <path d="M3 12c0 1.66 4 3 9 3s9-1.34 9-3" />
            </svg></span>
            <span class="text-[9px] font-bold text-white mt-1">الربط الآمن</span>
            <div class="flex gap-0.5 mt-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-primary-600 animate-ping"></span>
              <span class="text-[7px] text-primary-600 font-mono">Syncing</span>
            </div>
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
import BrandLogo3D from './BrandLogo3D.vue'

defineEmits(['open-wizard'])

function t(key) {
  return translations[locale.value][key] || key
}

const features = computed(() => [
  {
    icon: `<svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>`,
    label: t('feat_1_title'),
    sub: t('feat_1_sub'),
    bg: 'bg-primary-400/10',
    color: 'text-primary-400',
  },
  {
    icon: `<svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>`,
    label: t('feat_2_title'),
    sub: t('feat_2_sub'),
    bg: 'bg-[#00C6FF]/10',
    color: 'text-[#00C6FF]',
  },
  {
    icon: `<svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>`,
    label: t('feat_3_title'),
    sub: t('feat_3_sub'),
    bg: 'bg-primary-400/10',
    color: 'text-primary-400',
  },
  {
    icon: `<svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"/></svg>`,
    label: t('feat_4_title'),
    sub: t('feat_4_sub'),
    bg: 'bg-[#00C6FF]/10',
    color: 'text-[#00C6FF]',
  },
])
</script>

<style scoped>
@keyframes floatSlow {
  0%, 100% {
    transform: translateY(0px) rotate(0deg);
  }
  50% {
    transform: translateY(-15px) rotate(0.8deg);
  }
}
.animate-float-slow {
  animation: floatSlow 7s ease-in-out infinite;
}
.grid-pattern {
  background-size: 24px 24px;
  background-image: 
    linear-gradient(to right, rgba(30, 198, 255, 0.08) 1px, transparent 1px),
    linear-gradient(to bottom, rgba(30, 198, 255, 0.08) 1px, transparent 1px);
}
</style>
