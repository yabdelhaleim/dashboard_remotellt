<template>
  <section
    class="split-hero relative overflow-hidden my-12 sm:my-16 px-4 sm:px-6 lg:px-8"
    :dir="locale === 'ar' ? 'rtl' : 'ltr'"
  >
    <!-- Background image + dark overlay (covers the entire hero section) -->
    <div class="hero-bg absolute inset-0 -z-10" aria-hidden="true"></div>
    <div class="hero-bg-overlay absolute inset-0 -z-10" aria-hidden="true"></div>

    <!-- Hero grid: artwork on one side, content on the other -->
    <div class="hero max-w-7xl mx-auto relative grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-14 items-center pt-6 sm:pt-10">

      <!-- LEFT: Artwork (the original uploaded image, untouched) -->
      <div class="hero-image order-1">
        <img
          :src="heroImage"
          alt="Remotly Team — Your Software Solutions Partner"
          class="hero-art w-full h-auto object-contain select-none"
          draggable="false"
        />
      </div>

      <!-- RIGHT: Arabic content -->
      <div class="hero-content order-2 space-y-5 sm:space-y-6" :class="locale === 'ar' ? 'text-right' : 'text-left'">

        <!-- Premium Badge -->
        <div class="inline-flex items-center gap-2.5 px-4 py-1.5 bg-[#11151F] border border-primary-400/30 rounded-full select-none shadow-sm w-fit">
          <span class="flex h-2 w-2 rounded-full bg-[#00C6FF] animate-pulse shrink-0"></span>
          <span class="font-mono font-bold text-[11px] text-slate-200 tracking-widest uppercase">
            {{ t('hero_badge') }}
          </span>
        </div>

        <!-- Headline -->
        <h1 class="font-display font-black leading-[1.18] text-white text-[2rem] sm:text-[2.6rem] lg:text-[3rem]">
          {{ t('hero_title_pre') }}
          <span class="block sm:inline bg-gradient-to-l from-primary-400 via-[#00C6FF] to-[#1E90FF] bg-clip-text text-transparent">
            {{ t('hero_title_accent') }}
          </span>
        </h1>

        <!-- Cyan Subtitle -->
        <p class="font-display font-bold text-xl sm:text-2xl text-primary-400">
          {{ t('hero_subtitle') }}
        </p>

        <!-- Description -->
        <p class="font-body font-normal text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl">
          {{ t('hero_desc') }}
        </p>

        <!-- Services 5-column grid -->
        <div class="space-y-2.5">
          <p class="font-mono text-[10px] tracking-widest uppercase text-dark-muted/80 font-bold flex items-center gap-2" :class="locale === 'ar' ? 'flex-row-reverse' : ''">
            <span class="block w-6 h-px bg-primary-400/50"></span>
            <span>{{ t('hero_services') }}</span>
            <span class="block w-6 h-px bg-primary-400/50"></span>
          </p>
          <div class="grid grid-cols-5 gap-2 sm:gap-3">
            <div
              v-for="(svc, i) in services"
              :key="svc.label"
              :style="{ animationDelay: (0.3 + i * 0.08) + 's' }"
              class="service-card group flex flex-col items-center justify-center gap-1.5 py-3.5 px-2 bg-dark-card/60 border border-dark-border/70 hover:border-primary-400/60 hover:bg-dark-card/85 backdrop-blur rounded-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_0_25px_rgba(0,198,255,0.18)]"
            >
              <span class="text-primary-400 text-xl sm:text-2xl transition-transform duration-300 group-hover:scale-110" v-html="svc.icon"></span>
              <span class="text-[10px] sm:text-[11px] font-display font-bold text-white text-center leading-tight">{{ svc.label }}</span>
            </div>
          </div>
        </div>

        <!-- 4 Features row -->
        <div class="space-y-2.5">
          <p class="font-mono text-[10px] tracking-widest uppercase text-dark-muted/80 font-bold flex items-center gap-2" :class="locale === 'ar' ? 'flex-row-reverse' : ''">
            <span class="block w-6 h-px bg-primary-400/50"></span>
            <span>{{ t('hero_features') }}</span>
            <span class="block w-6 h-px bg-primary-400/50"></span>
          </p>
          <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-3">
            <div
              v-for="(f, i) in features"
              :key="f.title"
              :style="{ animationDelay: (0.6 + i * 0.08) + 's' }"
              class="feature-pill flex items-center gap-2.5 py-2.5 px-3 bg-dark-card/40 border border-dark-border/60 hover:border-primary-400/40 rounded-xl backdrop-blur transition-all duration-300 hover:-translate-y-0.5"
            >
              <span class="w-7 h-7 shrink-0 rounded-lg bg-primary-400/10 border border-primary-400/20 flex items-center justify-center text-primary-400" v-html="f.icon"></span>
              <div class="min-w-0">
                <span class="block font-display font-bold text-[11px] sm:text-xs text-white leading-tight truncate">{{ f.title }}</span>
                <span class="block font-body font-normal text-[9px] sm:text-[10px] text-dark-muted leading-tight truncate">{{ f.sub }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- CTA -->
        <div class="flex items-center gap-4 pt-2" :class="locale === 'ar' ? 'flex-row' : 'flex-row-reverse'">
          <span class="font-display font-bold text-sm sm:text-base text-white">{{ t('hero_cta_title') }}</span>
          <button
            @click="$emit('open-wizard')"
            class="cta-btn group inline-flex items-center gap-2.5 bg-gradient-to-l from-primary-400 to-[#00C6FF] text-white font-display font-bold py-3 px-6 rounded-full transition-all duration-300 shadow-[0_8px_30px_rgba(0,198,255,0.35)] hover:-translate-y-0.5 hover:shadow-[0_12px_40px_rgba(0,198,255,0.55)] active:translate-y-0 cursor-pointer text-sm shrink-0"
          >
            <span>{{ t('hero_cta_btn') }}</span>
            <span class="cta-arrow inline-flex items-center justify-center w-6 h-6 rounded-full bg-white/20 transition-transform duration-300 group-hover:translate-x-0.5 rtl:group-hover:-translate-x-0.5">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5">
                <path d="M22 2 11 13" /><path d="M22 2l-7 20-4-9-9-4Z" />
              </svg>
            </span>
          </button>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'
import { locale } from '../../utils/locale'
import { translations } from '../../utils/translations'
import heroImage from '../../assets/hero-remotly.png'

defineEmits(['open-wizard'])

function t(key) {
  return translations[locale.value][key] || key
}

// 5 services
const services = computed(() => [
  {
    label: t('hero_svc_1'),
    icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>`,
  },
  {
    label: t('hero_svc_2'),
    icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>`,
  },
  {
    label: t('hero_svc_3'),
    icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/></svg>`,
  },
  {
    label: t('hero_svc_4'),
    icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"/></svg>`,
  },
  {
    label: t('hero_svc_5'),
    icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>`,
  },
])

// 4 features
const features = computed(() => [
  {
    title: t('hero_f1_title'),
    sub: t('hero_f1_sub'),
    icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-3.5 h-3.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>`,
  },
  {
    title: t('hero_f2_title'),
    sub: t('hero_f2_sub'),
    icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-3.5 h-3.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>`,
  },
  {
    title: t('hero_f3_title'),
    sub: t('hero_f3_sub'),
    icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-3.5 h-3.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>`,
  },
  {
    title: t('hero_f4_title'),
    sub: t('hero_f4_sub'),
    icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-3.5 h-3.5"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>`,
  },
])
</script>

<style scoped>
/* ============ Hero background image + dark overlay ============ */
.hero-bg {
  background-image: url('/hero-bg.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  transform: scale(1.04);
  transform-origin: center;
  will-change: transform;
}

.hero-bg-overlay {
  background: rgba(5, 10, 25, 0.75);
  background-image:
    linear-gradient(180deg, rgba(5, 10, 25, 0.55) 0%, rgba(5, 10, 25, 0.85) 100%),
    radial-gradient(circle at 30% 30%, rgba(0, 198, 255, 0.08) 0%, transparent 60%);
  background-blend-mode: normal;
  z-index: -9;
}

@media (max-width: 768px) {
  .hero-bg-overlay {
    background: rgba(5, 10, 25, 0.85);
  }
}

/* ============ Hero artwork image ============ */
.hero-art {
  display: block;
  width: 100%;
  height: auto;
  object-fit: contain;
  filter: drop-shadow(0 20px 40px rgba(0, 198, 255, 0.18));
  /* Original aspect ratio: 1536×1024 = 1.5:1 — preserve via object-fit */
}

@media (max-width: 992px) {
  .hero-image { order: 1; }
  .hero-content { order: 2; text-align: center; }
}

/* ============ Service cards entrance ============ */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(10px); }
  to   { opacity: 1; transform: translateY(0); }
}
.service-card {
  animation: fadeUp 0.5s ease-out backwards;
}
.feature-pill {
  animation: fadeUp 0.5s ease-out backwards;
}

/* ============ CTA arrow subtle pulse ============ */
@keyframes ctaPulse {
  0%, 100% { box-shadow: 0 0 0 0 rgba(0, 198, 255, 0.45); }
  50%      { box-shadow: 0 0 0 8px rgba(0, 198, 255, 0); }
}
.cta-btn { animation: ctaPulse 2.5s ease-in-out infinite; }

/* ============ Accessibility ============ */
@media (prefers-reduced-motion: reduce) {
  .service-card,
  .feature-pill,
  .cta-btn {
    animation: none !important;
  }
}
</style>