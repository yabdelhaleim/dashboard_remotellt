<template>
  <section
    ref="sectionRef"
    :class="['relative py-20 sm:py-28 px-4 sm:px-6 lg:px-8 overflow-hidden', isVisible ? 'is-visible' : '']"
    aria-labelledby="services-heading"
  >
    <!-- ============ Background ambiance ============ -->
    <div class="ambient-grid" aria-hidden="true"></div>
    <div class="ambient-blob ambient-blob-1" aria-hidden="true"></div>
    <div class="ambient-blob ambient-blob-2" aria-hidden="true"></div>
    <div class="ambient-blob ambient-blob-3" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto relative z-10">
      <!-- ============ Section header ============ -->
      <div class="text-center mb-14 sm:mb-16 reveal-item reveal-header">
        <span
          class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full
                 bg-vibrant-purple/10 border border-vibrant-purple/30
                 text-vibrant-purple text-xs font-mono font-semibold
                 tracking-[0.2em] uppercase backdrop-blur-sm"
        >
          <span class="w-1.5 h-1.5 rounded-full bg-vibrant-purple animate-pulse"></span>
          {{ t('services_badge') }}
        </span>

        <h2
          id="services-heading"
          class="mt-5 font-display font-black text-3xl sm:text-4xl lg:text-5xl
                 leading-tight text-white hero-headline"
        >
          {{ t('services_title') }}
        </h2>

        <p class="mt-4 text-dark-muted text-base sm:text-lg max-w-3xl mx-auto leading-ar-normal">
          {{ t('services_desc') }}
        </p>
      </div>

      <!-- ============ Masonry grid ============ -->
      <div class="masonry-grid">
        <!-- Tourism -->
        <article
          class="svc-card svc-tourism reveal-item"
          @mousemove="handleMouseMove($event, 'svc', 0)"
          @mouseleave="handleMouseLeave('svc', 0)"
          :style="tiltStates[0]"
        >
          <div class="svc-halo" aria-hidden="true"></div>
          <div class="svc-bdr-shine" aria-hidden="true"></div>

          <div class="svc-icon-wrap">
            <svg class="svc-icon svc-icon-anim-tourism" viewBox="0 0 64 64" fill="none">
              <defs>
                <linearGradient id="sm-blue" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#00C6FF" />
                  <stop offset="100%" stop-color="#1E90FF" />
                </linearGradient>
              </defs>
              <circle cx="32" cy="32" r="30" fill="rgba(0,198,255,0.10)" />
              <circle cx="32" cy="32" r="30" stroke="rgba(0,198,255,0.25)" stroke-width="1" />
              <!-- dashed flight path -->
              <ellipse class="tour-path" cx="32" cy="32" rx="22" ry="14" fill="none"
                       stroke="url(#sm-blue)" stroke-width="1.2" stroke-dasharray="3 4" opacity="0.65" />
              <!-- airplane that follows path -->
              <g class="tour-plane">
                <path d="M -8 0 L 0 -2 L 4 0 L 8 0 L 4 2 L 0 2 Z" fill="url(#sm-blue)" />
                <path d="M 0 -8 L 2 0 L -2 0 Z" fill="url(#sm-blue)" />
              </g>
              <!-- pin -->
              <circle cx="48" cy="22" r="2.5" fill="#FF3B6B" />
              <circle cx="48" cy="22" r="5" fill="none" stroke="#FF3B6B" stroke-width="1" opacity="0.6" />
            </svg>
          </div>

          <h3 class="svc-title">{{ t('service_tourism_title') }}</h3>
          <p class="svc-desc">{{ t('service_tourism_desc') }}</p>
          <div class="svc-tags">
            <span class="svc-tag">Booking</span>
            <span class="svc-tag">CRM</span>
            <span class="svc-tag">{{ locale === 'ar' ? 'تذاكر' : 'Tickets' }}</span>
          </div>
        </article>

        <!-- Accounting -->
        <article
          class="svc-card svc-accounting reveal-item"
          @mousemove="handleMouseMove($event, 'svc', 1)"
          @mouseleave="handleMouseLeave('svc', 1)"
          :style="tiltStates[1]"
        >
          <div class="svc-halo" aria-hidden="true"></div>
          <div class="svc-bdr-shine" aria-hidden="true"></div>

          <div class="svc-icon-wrap">
            <svg class="svc-icon" viewBox="0 0 64 64" fill="none">
              <defs><linearGradient id="acc-blue" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#00C6FF" /><stop offset="100%" stop-color="#1E90FF" />
              </linearGradient></defs>
              <circle cx="32" cy="32" r="30" fill="rgba(0,198,255,0.10)" />
              <circle cx="32" cy="32" r="30" stroke="rgba(0,198,255,0.25)" stroke-width="1" />

              <!-- chart -->
              <g transform="translate(16, 14)">
                <line x1="0" y1="32" x2="32" y2="32" stroke="#243B55" stroke-width="1.5" />
                <line x1="0" y1="0"  x2="0"  y2="32" stroke="#243B55" stroke-width="1.5" />
                <rect class="bar bar-1" x="3"  y="22" width="6" height="10" rx="1" fill="url(#acc-blue)" />
                <rect class="bar bar-2" x="11" y="16" width="6" height="16" rx="1" fill="url(#acc-blue)" />
                <rect class="bar bar-3" x="19" y="10" width="6" height="22" rx="1" fill="url(#acc-blue)" />
                <rect class="bar bar-4" x="27" y="4"  width="6" height="28" rx="1" fill="url(#acc-blue)" />
              </g>

              <!-- coin -->
              <g class="acc-coin" transform="translate(48, 16)">
                <circle r="6" fill="#FFB400" />
                <circle r="6" fill="none" stroke="#fff" stroke-width="0.8" />
                <text x="0" y="2" text-anchor="middle" font-family="sans-serif" font-size="6" font-weight="900" fill="#fff">$</text>
              </g>
            </svg>
          </div>

          <h3 class="svc-title">{{ t('service_accounting_title') }}</h3>
          <p class="svc-desc">{{ t('service_accounting_desc') }}</p>
          <div class="svc-tags">
            <span class="svc-tag">{{ locale === 'ar' ? 'فواتير' : 'Invoices' }}</span>
            <span class="svc-tag">{{ locale === 'ar' ? 'ميزانيات' : 'Budgets' }}</span>
            <span class="svc-tag">{{ locale === 'ar' ? 'ضرائب' : 'Tax' }}</span>
          </div>
        </article>

        <!-- Education -->
        <article
          class="svc-card svc-education reveal-item"
          @mousemove="handleMouseMove($event, 'svc', 2)"
          @mouseleave="handleMouseLeave('svc', 2)"
          :style="tiltStates[2]"
        >
          <div class="svc-halo" aria-hidden="true"></div>
          <div class="svc-bdr-shine" aria-hidden="true"></div>

          <div class="svc-icon-wrap">
            <svg class="svc-icon" viewBox="0 0 64 64" fill="none">
              <defs><linearGradient id="edu-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#00C6FF" /><stop offset="100%" stop-color="#1E90FF" />
              </linearGradient></defs>
              <circle cx="32" cy="32" r="30" fill="rgba(0,198,255,0.10)" />
              <circle cx="32" cy="32" r="30" stroke="rgba(0,198,255,0.25)" stroke-width="1" />

              <!-- open book -->
              <g transform="translate(14, 18)">
                <!-- left page -->
                <path class="book-left" d="M 0 0 L 16 -3 L 16 24 L 0 26 Z" fill="rgba(0,198,255,0.18)" stroke="url(#edu-grad)" stroke-width="1.2" />
                <!-- right page -->
                <path class="book-right" d="M 20 -3 L 36 0 L 36 26 L 20 24 Z" fill="rgba(0,198,255,0.18)" stroke="url(#edu-grad)" stroke-width="1.2" />
                <!-- spine -->
                <line x1="18" y1="-1.5" x2="18" y2="25" stroke="url(#edu-grad)" stroke-width="1.5" />

                <!-- text lines -->
                <line x1="3" y1="6" x2="13" y2="5" stroke="#00C6FF" stroke-width="1" opacity="0.6" />
                <line x1="3" y1="10" x2="13" y2="9" stroke="#00C6FF" stroke-width="1" opacity="0.6" />
                <line x1="3" y1="14" x2="13" y2="13" stroke="#00C6FF" stroke-width="1" opacity="0.6" />
                <line x1="23" y1="5" x2="33" y2="6" stroke="#00C6FF" stroke-width="1" opacity="0.6" />
                <line x1="23" y1="9" x2="33" y2="10" stroke="#00C6FF" stroke-width="1" opacity="0.6" />
                <line x1="23" y1="13" x2="33" y2="14" stroke="#00C6FF" stroke-width="1" opacity="0.6" />

                <!-- floating cap -->
                <g class="edu-cap" transform="translate(28, -8)">
                  <rect x="-7" y="2" width="14" height="3" rx="1" fill="#00C6FF" />
                  <polygon points="-9,2 9,2 0,-3" fill="#1E90FF" />
                  <line x1="6" y1="-2" x2="9" y2="3" stroke="#FFB400" stroke-width="1.2" />
                  <circle cx="9" cy="3" r="1.2" fill="#FFB400" />
                </g>
              </g>
            </svg>
          </div>

          <h3 class="svc-title">{{ t('service_education_title') }}</h3>
          <p class="svc-desc">{{ t('service_education_desc') }}</p>
          <div class="svc-tags">
            <span class="svc-tag">LMS</span>
            <span class="svc-tag">Video</span>
            <span class="svc-tag">{{ locale === 'ar' ? 'شهادات' : 'Certificates' }}</span>
          </div>
        </article>

        <!-- Website -->
        <article
          class="svc-card svc-website reveal-item"
          @mousemove="handleMouseMove($event, 'svc', 3)"
          @mouseleave="handleMouseLeave('svc', 3)"
          :style="tiltStates[3]"
        >
          <div class="svc-halo" aria-hidden="true"></div>
          <div class="svc-bdr-shine" aria-hidden="true"></div>

          <div class="svc-icon-wrap">
            <svg class="svc-icon" viewBox="0 0 64 64" fill="none">
              <defs><linearGradient id="web-grad-svc" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#00C6FF" /><stop offset="100%" stop-color="#1E90FF" />
              </linearGradient></defs>
              <circle cx="32" cy="32" r="30" fill="rgba(0,198,255,0.10)" />
              <circle cx="32" cy="32" r="30" stroke="rgba(0,198,255,0.25)" stroke-width="1" />

              <!-- browser -->
              <g transform="translate(12, 16)">
                <rect x="0" y="0" width="40" height="32" rx="3" fill="rgba(0, 198, 255, 0.10)" stroke="url(#web-grad-svc)" stroke-width="1.4" />
                <rect x="0" y="0" width="40" height="8" rx="3" fill="#11151F" />
                <circle cx="4" cy="4" r="1.2" fill="#FF5F57" />
                <circle cx="8" cy="4" r="1.2" fill="#FEBC2E" />
                <circle cx="12" cy="4" r="1.2" fill="#28C840" />

                <!-- globe spinning -->
                <g class="globe-spin" transform="translate(20, 22)">
                  <circle r="8" fill="none" stroke="url(#web-grad-svc)" stroke-width="1.5" />
                  <ellipse cx="0" cy="0" rx="3" ry="8" fill="none" stroke="url(#web-grad-svc)" stroke-width="1" />
                  <line x1="-8" y1="0" x2="8" y2="0" stroke="url(#web-grad-svc)" stroke-width="1" />
                </g>
              </g>
            </svg>
          </div>

          <h3 class="svc-title">{{ t('service_website_title') }}</h3>
          <p class="svc-desc">{{ t('service_website_desc') }}</p>
          <div class="svc-tags">
            <span class="svc-tag">SEO</span>
            <span class="svc-tag">Fast</span>
            <span class="svc-tag">{{ locale === 'ar' ? 'متجاوب' : 'Responsive' }}</span>
          </div>
        </article>

        <!-- E-commerce -->
        <article
          class="svc-card svc-ecommerce reveal-item"
          @mousemove="handleMouseMove($event, 'svc', 4)"
          @mouseleave="handleMouseLeave('svc', 4)"
          :style="tiltStates[4]"
        >
          <div class="svc-halo" aria-hidden="true"></div>
          <div class="svc-bdr-shine" aria-hidden="true"></div>

          <div class="svc-icon-wrap">
            <svg class="svc-icon" viewBox="0 0 64 64" fill="none">
              <defs><linearGradient id="ec-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#00C6FF" /><stop offset="100%" stop-color="#1E90FF" />
              </linearGradient></defs>
              <circle cx="32" cy="32" r="30" fill="rgba(0,198,255,0.10)" />
              <circle cx="32" cy="32" r="30" stroke="rgba(0,198,255,0.25)" stroke-width="1" />

              <!-- cart -->
              <g class="cart-bounce" transform="translate(16, 18)">
                <path d="M 2 4 L 6 4 L 8 18 L 26 18 L 28 8 L 10 8" fill="none" stroke="url(#ec-grad)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <!-- products in cart -->
                <circle class="cart-item-1" cx="14" cy="14" r="2" fill="#00C6FF" />
                <circle class="cart-item-2" cx="20" cy="14" r="2" fill="#1E90FF" />
                <circle class="cart-item-3" cx="24" cy="14" r="2" fill="#FFB400" />
                <!-- wheels -->
                <circle cx="12" cy="24" r="2.5" fill="none" stroke="url(#ec-grad)" stroke-width="1.5" />
                <circle cx="24" cy="24" r="2.5" fill="none" stroke="url(#ec-grad)" stroke-width="1.5" />
                <!-- little bag floating above -->
                <g class="cart-sparkle" transform="translate(28, -4)">
                  <path d="M 0 -4 L 1 -1 L 4 0 L 1 1 L 0 4 L -1 1 L -4 0 L -1 -1 Z" fill="#FF3B6B" />
                </g>
              </g>
            </svg>
          </div>

          <h3 class="svc-title">{{ t('service_ecommerce_title') }}</h3>
          <p class="svc-desc">{{ t('service_ecommerce_desc') }}</p>
          <div class="svc-tags">
            <span class="svc-tag">Fawry</span>
            <span class="svc-tag">Visa</span>
            <span class="svc-tag">PayPal</span>
          </div>
        </article>

        <!-- ============ BIG Custom Idea card (highlighted) ============ -->
        <article
          class="svc-card svc-card-highlight svc-custom reveal-item"
          @mousemove="handleMouseMove($event, 'svc', 5)"
          @mouseleave="handleMouseLeave('svc', 5)"
          :style="tiltStates[5]"
        >
          <div class="svc-halo svc-halo-custom" aria-hidden="true"></div>
          <div class="svc-bdr-shine svc-bdr-shine-custom" aria-hidden="true"></div>

          <!-- Sparkle particles -->
          <span class="hc-spark hc-spark-1" aria-hidden="true"></span>
          <span class="hc-spark hc-spark-2" aria-hidden="true"></span>
          <span class="hc-spark hc-spark-3" aria-hidden="true"></span>
          <span class="hc-spark hc-spark-4" aria-hidden="true"></span>

          <!-- Big glowing icon -->
          <div class="svc-icon-wrap svc-icon-wrap-big">
            <svg class="svc-icon" viewBox="0 0 80 80" fill="none">
              <defs>
                <linearGradient id="bulb-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#FF3B6B" />
                  <stop offset="50%" stop-color="#A855F7" />
                  <stop offset="100%" stop-color="#1E90FF" />
                </linearGradient>
                <radialGradient id="bulb-glow" cx="50%" cy="50%" r="50%">
                  <stop offset="0%" stop-color="#A855F7" stop-opacity="0.7" />
                  <stop offset="100%" stop-color="#A855F7" stop-opacity="0" />
                </radialGradient>
              </defs>

              <!-- Glow halo behind bulb -->
              <circle class="bulb-halo" cx="40" cy="32" r="28" fill="url(#bulb-glow)" />

              <!-- Bulb glass -->
              <path class="bulb-body" d="M 40 14 C 26 14 18 24 18 36 C 18 44 22 48 26 52 L 26 58 L 54 58 L 54 52 C 58 48 62 44 62 36 C 62 24 54 14 40 14 Z"
                    fill="url(#bulb-grad)" opacity="0.95" />
              <path d="M 40 14 C 26 14 18 24 18 36 C 18 44 22 48 26 52 L 26 58 L 54 58 L 54 52 C 58 48 62 44 62 36 C 62 24 54 14 40 14 Z"
                    fill="none" stroke="#fff" stroke-width="1" stroke-opacity="0.5" />

              <!-- Filament -->
              <path class="bulb-filament" d="M 30 36 Q 35 42 40 36 Q 45 42 50 36" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round" />

              <!-- Base -->
              <rect x="28" y="58" width="24" height="6" rx="1" fill="#243B55" />
              <rect x="30" y="64" width="20" height="4" rx="1" fill="#243B55" />
              <path d="M 32 68 L 48 68 L 46 72 L 34 72 Z" fill="#1B202E" />

              <!-- Sparkle stars -->
              <g class="bulb-star bulb-star-1" transform="translate(20, 18)">
                <path d="M 0 -4 L 1 -1 L 4 0 L 1 1 L 0 4 L -1 1 L -4 0 L -1 -1 Z" fill="#FFB400" />
              </g>
              <g class="bulb-star bulb-star-2" transform="translate(64, 20)">
                <path d="M 0 -3 L 0.8 -0.8 L 3 0 L 0.8 0.8 L 0 3 L -0.8 0.8 L -3 0 L -0.8 -0.8 Z" fill="#00C6FF" />
              </g>
              <g class="bulb-star bulb-star-3" transform="translate(66, 50)">
                <path d="M 0 -3 L 0.7 -0.7 L 3 0 L 0.7 0.7 L 0 3 L -0.7 0.7 L -3 0 L -0.7 -0.7 Z" fill="#fff" />
              </g>
            </svg>

            <!-- "spark" badge popping top-right -->
            <span class="hc-rocket" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none">
                <path d="M 12 2 L 16 8 L 22 12 L 16 16 L 12 22 L 8 16 L 2 12 L 8 8 Z" fill="url(#bulb-grad)" />
              </svg>
            </span>
          </div>

          <h3 class="svc-title svc-title-big">{{ t('service_custom_title') }}</h3>
          <p class="svc-desc svc-desc-big">{{ t('service_custom_desc') }}</p>

          <!-- Team strength strip -->
          <div class="svc-team-strip">
            <div class="svc-team-icon">
              <svg viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="8" r="3" stroke="#00C6FF" stroke-width="1.5" />
                <path d="M 4 20 Q 4 14 12 14 Q 20 14 20 20" stroke="#00C6FF" stroke-width="1.5" fill="none" stroke-linecap="round" />
                <circle cx="6" cy="10" r="2" stroke="#A855F7" stroke-width="1.2" fill="none" />
                <path d="M 2 20 Q 2 16 6 15" stroke="#A855F7" stroke-width="1.2" fill="none" />
                <circle cx="18" cy="10" r="2" stroke="#00C6FF" stroke-width="1.2" fill="none" />
                <path d="M 22 20 Q 22 16 18 15" stroke="#00C6FF" stroke-width="1.2" fill="none" />
              </svg>
            </div>
            <span class="svc-team-label">{{ t('service_team_label') }}</span>
          </div>
        </article>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, reactive, onMounted, onUnmounted, nextTick } from 'vue'
import { locale } from '../../utils/locale'
import { translations } from '../../utils/translations'

function t(key) {
  return translations[locale.value][key] || key
}

// ============ Scroll reveal ============
const sectionRef = ref(null)
const isVisible = ref(false)
let observer = null

onMounted(async () => {
  await nextTick()
  if (typeof IntersectionObserver === 'undefined') {
    isVisible.value = true
    return
  }
  observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          isVisible.value = true
          observer.disconnect()
        }
      })
    },
    { threshold: 0.1 },
  )
  if (sectionRef.value) observer.observe(sectionRef.value)
})

onUnmounted(() => {
  if (observer) observer.disconnect()
})

// ============ 3D mouse-tilt per card ============
const tiltStates = reactive([
  { transform: '', transition: 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)' },
  { transform: '', transition: 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)' },
  { transform: '', transition: 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)' },
  { transform: '', transition: 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)' },
  { transform: '', transition: 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)' },
  { transform: '', transition: 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)' },
])

function handleMouseMove(e, _group, idx) {
  const target = e.currentTarget
  const rect = target.getBoundingClientRect()
  const x = e.clientX - rect.left
  const y = e.clientY - rect.top
  const cx = rect.width / 2
  const cy = rect.height / 2
  const rx = ((y - cy) / cy) * -5
  const ry = ((x - cx) / cx) * 5
  tiltStates[idx].transform = `perspective(900px) rotateX(${rx}deg) rotateY(${ry}deg)`
}

function handleMouseLeave(_group, idx) {
  tiltStates[idx].transform = 'perspective(900px) rotateX(0deg) rotateY(0deg)'
}
</script>

<style scoped>
/* =================================================================
   Ambient background
   ================================================================= */
.ambient-grid {
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(168, 85, 247, 0.05) 1px, transparent 1px),
    linear-gradient(90deg, rgba(168, 85, 247, 0.05) 1px, transparent 1px);
  background-size: 50px 50px;
  mask-image: radial-gradient(ellipse 80% 60% at 50% 40%, #000 30%, transparent 80%);
  -webkit-mask-image: radial-gradient(ellipse 80% 60% at 50% 40%, #000 30%, transparent 80%);
  pointer-events: none;
  z-index: 0;
}

.ambient-blob {
  position: absolute;
  border-radius: 9999px;
  filter: blur(90px);
  pointer-events: none;
  z-index: 0;
}
.ambient-blob-1 {
  top: 5%;   left: -8%;  width: 22rem; height: 22rem;
  background: radial-gradient(circle, rgba(0, 198, 255, 0.30) 0%, transparent 70%);
  animation: drift1 16s ease-in-out infinite;
}
.ambient-blob-2 {
  bottom: -10%; right: -8%; width: 24rem; height: 24rem;
  background: radial-gradient(circle, rgba(168, 85, 247, 0.25) 0%, transparent 70%);
  animation: drift2 20s ease-in-out infinite 1.5s;
}
.ambient-blob-3 {
  top: 30%; right: 25%; width: 16rem; height: 16rem;
  background: radial-gradient(circle, rgba(255, 59, 107, 0.15) 0%, transparent 70%);
  animation: drift3 18s ease-in-out infinite 3s;
}
@keyframes drift1 { 0%,100%{transform:translate(0,0) scale(1)} 50%{transform:translate(40px,-30px) scale(1.1)} }
@keyframes drift2 { 0%,100%{transform:translate(0,0) scale(1)} 50%{transform:translate(-30px,-40px) scale(1.08)} }
@keyframes drift3 { 0%,100%{transform:translate(0,0) scale(1);opacity:.7} 50%{transform:translate(20px,20px) scale(1.15);opacity:1} }

/* =================================================================
   MASONRY LAYOUT (CSS columns, like stone wall)
   ================================================================= */
.masonry-grid {
  column-count: 3;
  column-gap: 1.5rem;
}
@media (max-width: 1023px) { .masonry-grid { column-count: 2; } }
@media (max-width: 639px)  { .masonry-grid { column-count: 1; } }

.svc-card {
  position: relative;
  display: block;
  break-inside: avoid;
  margin-bottom: 1.5rem;
  padding: 1.5rem 1.5rem 1.4rem;
  background: linear-gradient(160deg, rgba(20, 25, 38, 0.92) 0%, rgba(10, 14, 26, 0.92) 100%);
  border: 1px solid rgba(30, 37, 54, 0.85);
  border-radius: 1.25rem;
  backdrop-filter: blur(10px);
  overflow: hidden;
  isolation: isolate;
  transform-style: preserve-3d;
  will-change: transform;
  box-shadow: 0 6px 24px rgba(0, 198, 255, 0.05), inset 0 1px 0 rgba(255, 255, 255, 0.04);
  transition: border-color 0.45s ease, box-shadow 0.5s ease;
}

.svc-card:hover {
  border-color: rgba(0, 198, 255, 0.5);
  box-shadow:
    0 18px 50px rgba(0, 198, 255, 0.20),
    0 4px 14px rgba(30, 144, 255, 0.10),
    inset 0 1px 0 rgba(255, 255, 255, 0.10);
}

.svc-halo {
  position: absolute; inset: 0; pointer-events: none; z-index: -1;
  border-radius: 1.25rem;
  opacity: 0.5;
  transition: opacity 0.5s ease;
  background: radial-gradient(circle at 30% 0%, rgba(0, 198, 255, 0.25), transparent 55%);
}
.svc-card:hover .svc-halo { opacity: 0.85; }

.svc-bdr-shine {
  position: absolute; inset: 0; pointer-events: none;
  border-radius: 1.25rem;
  padding: 1px;
  background: linear-gradient(120deg, transparent 30%, rgba(255, 255, 255, 0.18) 50%, transparent 70%);
  -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
          mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
  -webkit-mask-composite: xor;
          mask-composite: exclude;
  opacity: 0;
  transition: opacity 0.5s ease;
}
.svc-card:hover .svc-bdr-shine { opacity: 1; }

/* =================================================================
   Icon block
   ================================================================= */
.svc-icon-wrap {
  width: 100%;
  display: flex;
  justify-content: center;
  margin-bottom: 1.1rem;
  position: relative;
}
.svc-icon {
  width: 92px;
  height: 92px;
  filter: drop-shadow(0 6px 12px rgba(0, 198, 255, 0.18));
  transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}
.svc-card:hover .svc-icon { transform: scale(1.08) rotate(-3deg); }

/* =================================================================
   Content
   ================================================================= */
.svc-title {
  font-family: 'Cairo', sans-serif;
  font-weight: 800;
  font-size: 1.25rem;
  line-height: 1.3;
  color: #F5F7FA;
  margin-bottom: 0.55rem;
}
.svc-desc {
  color: #9AA4B2;
  font-size: 0.92rem;
  line-height: 1.7;
  margin-bottom: 1rem;
}
.svc-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.4rem;
}
.svc-tag {
  display: inline-flex;
  align-items: center;
  padding: 0.3rem 0.7rem;
  font-family: 'IBM Plex Mono', monospace;
  font-size: 0.7rem;
  color: #C2D1E5;
  background: rgba(0, 198, 255, 0.08);
  border: 1px solid rgba(0, 198, 255, 0.18);
  border-radius: 9999px;
  transition: all 0.3s ease;
}
.svc-card:hover .svc-tag {
  background: rgba(0, 198, 255, 0.18);
  border-color: rgba(0, 198, 255, 0.4);
  color: #00C6FF;
}

/* =================================================================
   Per-card icon continuous animations
   ================================================================= */

/* TOURISM: airplane orbits the dashed path */
.tour-path {
  transform-box: fill-box;
  transform-origin: center;
  animation: pathRotate 8s linear infinite;
}
@keyframes pathRotate { to { transform: rotate(360deg); } }
.tour-plane {
  animation: planeFly 8s linear infinite;
  transform-box: fill-box;
  transform-origin: center;
}
@keyframes planeFly {
  from { transform: rotate(0deg) translate(22px, 0) rotate(0deg); }
  to   { transform: rotate(360deg) translate(22px, 0) rotate(-360deg); }
}

/* ACCOUNTING: bars grow + coin spins */
.bar { transform-box: fill-box; transform-origin: bottom center; animation: barGro 3.5s ease-in-out infinite; }
.bar-1 { animation-delay: 0s; }
.bar-2 { animation-delay: 0.2s; }
.bar-3 { animation-delay: 0.4s; }
.bar-4 { animation-delay: 0.6s; }
@keyframes barGro {
  0%, 100% { transform: scaleY(1); }
  50%      { transform: scaleY(1.18); }
}
.acc-coin { transform-box: fill-box; transform-origin: center; animation: coinSpin 4s linear infinite; }
@keyframes coinSpin {
  0%   { transform: rotateY(0deg); }
  100% { transform: rotateY(360deg); }
}

/* EDUCATION: book opens + cap bobs */
.book-left  { transform-box: fill-box; transform-origin: right center; animation: bookLeft  4s ease-in-out infinite; }
.book-right { transform-box: fill-box; transform-origin: left center;  animation: bookRight 4s ease-in-out infinite; }
@keyframes bookLeft  { 0%,100%{transform:rotateY(0)} 50%{transform:rotateY(-15deg)} }
@keyframes bookRight { 0%,100%{transform:rotateY(0)} 50%{transform:rotateY(15deg)} }
.edu-cap {
  transform-box: fill-box; transform-origin: center;
  animation: capBob 3s ease-in-out infinite;
}
@keyframes capBob {
  0%, 100% { transform: translate(28px, -8px) rotate(-5deg); }
  50%      { transform: translate(28px, -12px) rotate(5deg); }
}

/* WEBSITE: globe spins */
.globe-spin {
  transform-box: fill-box;
  transform-origin: center;
  animation: globeSpin 6s linear infinite;
}
@keyframes globeSpin { to { transform: rotate(360deg); } }

/* E-COMMERCE: cart bounces + items pop */
.cart-bounce { transform-box: fill-box; transform-origin: center; animation: cartBounce 2.5s ease-in-out infinite; }
@keyframes cartBounce {
  0%, 100% { transform: translate(16px, 18px) translateY(0); }
  50%      { transform: translate(16px, 18px) translateY(-3px); }
}
.cart-item-1, .cart-item-2, .cart-item-3 {
  transform-box: fill-box; transform-origin: center;
  animation: itemPop 1.6s ease-in-out infinite;
}
.cart-item-1 { animation-delay: 0.0s; }
.cart-item-2 { animation-delay: 0.2s; }
.cart-item-3 { animation-delay: 0.4s; }
@keyframes itemPop {
  0%, 100% { transform: translateY(0); }
  50%      { transform: translateY(-1.5px); }
}
.cart-sparkle { transform-box: fill-box; transform-origin: center; animation: sparkleSpin 2s linear infinite; }
@keyframes sparkleSpin { to { transform: translate(28px, -4px) rotate(360deg); } }

/* =================================================================
   HIGHLIGHTED custom card
   ================================================================= */
.svc-card-highlight {
  background: linear-gradient(160deg, rgba(35, 22, 60, 0.92) 0%, rgba(15, 13, 30, 0.92) 100%);
  border: 1px solid rgba(168, 85, 247, 0.4);
  box-shadow:
    0 8px 30px rgba(168, 85, 247, 0.18),
    inset 0 1px 0 rgba(255, 255, 255, 0.06);
}
.svc-card-highlight:hover {
  border-color: rgba(168, 85, 247, 0.7);
  box-shadow:
    0 22px 60px rgba(168, 85, 247, 0.30),
    0 8px 20px rgba(0, 198, 255, 0.18),
    inset 0 1px 0 rgba(255, 255, 255, 0.14);
}
.svc-halo-custom {
  background: radial-gradient(circle at 30% 0%, rgba(255, 59, 107, 0.30), transparent 55%);
}
.svc-bdr-shine-custom {
  background: linear-gradient(120deg, transparent 30%, rgba(168, 85, 247, 0.5) 50%, rgba(255, 59, 107, 0.5) 70%, transparent);
}

/* Big icon is larger */
.svc-icon-wrap-big { margin-bottom: 1.4rem; }
.svc-icon-wrap-big .svc-icon { width: 110px; height: 110px; }

/* Bulb animations */
.bulb-halo {
  transform-box: fill-box; transform-origin: center;
  animation: bulbHaloPulse 3s ease-in-out infinite;
}
@keyframes bulbHaloPulse {
  0%, 100% { opacity: 0.5; transform: scale(0.95); }
  50%      { opacity: 1;   transform: scale(1.1); }
}
.bulb-filament {
  animation: filamentGlow 1.5s ease-in-out infinite;
}
@keyframes filamentGlow {
  0%, 100% { opacity: 0.7; }
  50%      { opacity: 1; }
}
.bulb-star {
  transform-box: fill-box; transform-origin: center;
  animation: starTwinkle 2s ease-in-out infinite;
}
.bulb-star-1 { animation-delay: 0.0s; }
.bulb-star-2 { animation-delay: 0.6s; }
.bulb-star-3 { animation-delay: 1.2s; }
@keyframes starTwinkle {
  0%, 100% { opacity: 0.4; transform: scale(0.8); }
  50%      { opacity: 1;   transform: scale(1.2); }
}

/* Rocket badge orbiting */
.hc-rocket {
  position: absolute;
  top: -4px; right: -4px;
  width: 32px; height: 32px;
  filter: drop-shadow(0 0 10px rgba(255, 59, 107, 0.6));
  animation: rocketOrbit 6s linear infinite;
}
.hc-rocket svg { width: 100%; height: 100%; }
@keyframes rocketOrbit {
  from { transform: rotate(0deg) translateX(0); }
  to   { transform: rotate(360deg) translateX(0); }
}

/* Flying sparkles in card */
.hc-spark {
  position: absolute;
  width: 6px; height: 6px;
  border-radius: 9999px;
  background: radial-gradient(circle, #fff, transparent 70%);
  pointer-events: none;
}
.hc-spark-1 { top: 20%;  left: 8%;  animation: sparkFly 5s ease-in-out infinite; }
.hc-spark-2 { top: 70%;  left: 90%; animation: sparkFly 6s ease-in-out infinite 0.7s; }
.hc-spark-3 { top: 12%;  right: 14%; animation: sparkFly 4.5s ease-in-out infinite 1.4s; }
.hc-spark-4 { top: 80%;  right: 30%; animation: sparkFly 5.5s ease-in-out infinite 2s; }
@keyframes sparkFly {
  0%, 100% { transform: translateY(0) scale(1); opacity: 0.7; }
  50%      { transform: translateY(-12px) scale(1.3); opacity: 1; }
}

/* Big card title */
.svc-title-big {
  font-size: 1.5rem;
  background: linear-gradient(135deg, #F5F7FA 30%, #A855F7 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.svc-desc-big {
  font-size: 0.97rem;
  color: #C2D1E5;
}

/* Team strip inside the custom card */
.svc-team-strip {
  margin-top: 1rem;
  padding: 0.85rem 1rem;
  background: rgba(168, 85, 247, 0.08);
  border: 1px solid rgba(168, 85, 247, 0.25);
  border-radius: 0.85rem;
  display: flex;
  align-items: center;
  gap: 0.7rem;
}
.svc-team-icon {
  width: 32px;
  height: 32px;
  display: grid;
  place-items: center;
  flex-shrink: 0;
  background: rgba(0, 198, 255, 0.1);
  border-radius: 0.5rem;
}
.svc-team-icon svg { width: 22px; height: 22px; }
.svc-team-label {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 0.78rem;
  font-weight: 500;
  color: #E1E7F0;
  line-height: 1.4;
}

/* =================================================================
   Scroll-triggered entrance
   ================================================================= */
.reveal-item {
  opacity: 0;
  transform: translateY(36px);
  transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
              transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}
.is-visible .reveal-header { opacity: 1; transform: translateY(0); transition-delay: 0.05s; }
.is-visible .svc-tourism     { opacity: 1; transform: translateY(0); transition-delay: 0.20s; }
.is-visible .svc-accounting  { opacity: 1; transform: translateY(0); transition-delay: 0.30s; }
.is-visible .svc-education   { opacity: 1; transform: translateY(0); transition-delay: 0.40s; }
.is-visible .svc-website     { opacity: 1; transform: translateY(0); transition-delay: 0.50s; }
.is-visible .svc-ecommerce   { opacity: 1; transform: translateY(0); transition-delay: 0.60s; }
.is-visible .svc-custom      { opacity: 1; transform: translateY(0); transition-delay: 0.70s; }

/* =================================================================
   Accessibility
   ================================================================= */
@media (prefers-reduced-motion: reduce) {
  .reveal-item { opacity: 1; transform: none; transition: none; }
  .ambient-blob,
  .tour-path, .tour-plane, .bar, .acc-coin,
  .book-left, .book-right, .edu-cap, .globe-spin,
  .cart-bounce, .cart-item-1, .cart-item-2, .cart-item-3, .cart-sparkle,
  .bulb-halo, .bulb-filament, .bulb-star, .hc-rocket, .hc-spark {
    animation: none !important;
  }
  .svc-card, .svc-icon, .svc-tag, .svc-bdr-shine, .svc-halo {
    transition: none !important;
  }
  .svc-card { transform: none !important; }
}
</style>
