<template>
  <div
    :style="{ aspectRatio: size === 'large' ? '1000 / 650' : '512 / 128' }"
    :class="[
      'logo-container select-none relative flex items-center justify-center transition-transform duration-500 ease-out will-change-transform',
      size === 'large'
        ? 'logo-container-large w-[260px] sm:w-[340px] md:w-[420px] lg:w-[480px] xl:w-[540px] 2xl:w-[600px]'
        : 'logo-container-small w-[160px] sm:w-[200px]'
    ]"
  >
    <!-- Ambient pulsing glow behind the icon (large variant only) -->
    <div
      v-if="size === 'large'"
      class="ambient-glow"
      aria-hidden="true"
    ></div>

    <!-- ============================================================ -->
    <!-- Large variant: vertical stacked layout (used in hero/landing) -->
    <!-- ============================================================ -->
    <svg
      v-if="size === 'large'"
      class="logo-svg w-full h-full relative z-10"
      viewBox="0 0 1000 650"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
      preserveAspectRatio="xMidYMid meet"
      role="img"
      :aria-label="locale === 'ar' ? 'شعار ريموتلي' : 'Remotelly logo'"
    >
      <defs>
        <!-- Sky blue gradient with slow color cycle (premium feel) -->
        <linearGradient id="logo-grad-lg" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stop-color="#00C6FF">
            <animate
              attributeName="stop-color"
              values="#00C6FF;#1E90FF;#00C6FF"
              dur="8s"
              repeatCount="indefinite"
            />
          </stop>
          <stop offset="100%" stop-color="#1E90FF">
            <animate
              attributeName="stop-color"
              values="#1E90FF;#00C6FF;#1E90FF"
              dur="8s"
              repeatCount="indefinite"
            />
          </stop>
        </linearGradient>

        <!-- Shine gradient (transparent band that sweeps across the wordmark on hover) -->
        <linearGradient id="shine-grad-lg" x1="0%" y1="0%" x2="100%" y2="0%">
          <stop offset="0%"   stop-color="#ffffff" stop-opacity="0" />
          <stop offset="42%"  stop-color="#ffffff" stop-opacity="0" />
          <stop offset="50%"  stop-color="#ffffff" stop-opacity="0.65" />
          <stop offset="58%"  stop-color="#ffffff" stop-opacity="0" />
          <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
        </linearGradient>

        <!-- Reusable wordmark symbol so we can use it for both visible fill and shine clip -->
        <symbol id="wordmark-lg" overflow="visible">
          <g transform="translate(92.5, 420)" fill="#243B55">
            <!-- R (with blue diagonal leg accent) -->
            <g>
              <path
                d="M 35 40 L 48 40 L 75 100 L 58 100 Z"
                fill="url(#logo-grad-lg)"
                stroke="url(#logo-grad-lg)"
                stroke-width="4"
                stroke-linejoin="round"
              />
              <path
                d="M 0 0 L 45 0 C 65 0 75 10 75 25 C 75 40 65 50 45 50 L 45 100 L 30 100 Q 20 100 20 90 L 20 20 Q 20 5 0 0 Z M 45 15 L 45 35 C 55 35 60 30 60 25 C 60 20 55 15 45 15 Z"
                fill="#243B55"
                stroke="#243B55"
                stroke-width="4.5"
                stroke-linejoin="round"
              />
            </g>
            <!-- E -->
            <path
              d="M 95 0 L 165 0 L 165 15 L 115 15 L 115 42 L 150 42 L 150 58 L 115 58 L 115 85 L 165 85 L 165 100 L 125 100 Q 115 100 115 90 L 115 20 Q 115 5 95 0 Z"
              fill="#243B55"
              stroke="#243B55"
              stroke-width="4.5"
              stroke-linejoin="round"
            />
            <!-- M -->
            <path
              d="M 185 0 L 203 0 L 227.5 55 L 252 0 L 270 0 L 270 100 L 255 100 L 255 25 L 227.5 75 L 200 25 L 200 100 L 185 100 Z"
              fill="#243B55"
              stroke="#243B55"
              stroke-width="4.5"
              stroke-linejoin="round"
            />
            <!-- O -->
            <path
              d="M 315 0 L 340 0 C 355 0 365 15 365 35 L 365 65 C 365 85 355 100 340 100 L 315 100 C 300 100 290 85 290 65 L 290 35 C 290 15 300 0 315 0 Z M 315 15 C 308 15 305 22 305 35 L 305 65 C 305 78 308 85 315 85 L 340 85 C 347 85 350 78 350 65 L 350 35 C 350 22 347 15 340 15 Z"
              fill="#243B55"
              fill-rule="evenodd"
              stroke="#243B55"
              stroke-width="4.5"
              stroke-linejoin="round"
            />
            <!-- T -->
            <path
              d="M 385 0 L 460 0 L 460 15 L 430 15 L 430 100 L 415 100 L 415 15 L 385 15 Z"
              fill="#243B55"
              stroke="#243B55"
              stroke-width="4.5"
              stroke-linejoin="round"
            />
            <!-- E -->
            <path
              d="M 480 0 L 550 0 L 550 15 L 500 15 L 500 42 L 535 42 L 535 58 L 500 58 L 500 85 L 550 85 L 550 100 L 510 100 Q 500 100 500 90 L 500 20 Q 500 5 480 0 Z"
              fill="#243B55"
              stroke="#243B55"
              stroke-width="4.5"
              stroke-linejoin="round"
            />
            <!-- L -->
            <path
              d="M 570 0 L 585 0 L 585 85 L 635 85 L 635 100 L 570 100 Z"
              fill="#243B55"
              stroke="#243B55"
              stroke-width="4.5"
              stroke-linejoin="round"
            />
            <!-- L -->
            <path
              d="M 655 0 L 670 0 L 670 85 L 720 85 L 720 100 L 655 100 Z"
              fill="#243B55"
              stroke="#243B55"
              stroke-width="4.5"
              stroke-linejoin="round"
            />
            <!-- Y (with blue diagonal accent) -->
            <g transform="translate(740, 0)">
              <path
                d="M 75 0 L 60 0 L 37.5 35 L 52.5 35 Z"
                fill="url(#logo-grad-lg)"
                stroke="url(#logo-grad-lg)"
                stroke-width="4"
                stroke-linejoin="round"
              />
              <path
                d="M 0 0 L 15 0 L 30 35 L 30 100 L 45 100 L 45 35 Z"
                fill="#243B55"
                stroke="#243B55"
                stroke-width="4.5"
                stroke-linejoin="round"
              />
            </g>
          </g>
        </symbol>

        <!-- Clip path: wordmark shape (used to constrain the shine sweep) -->
        <clipPath id="wordmark-clip-lg">
          <use href="#wordmark-lg" />
        </clipPath>
      </defs>

      <!-- ============ Icon: R symbol with WiFi waves ============ -->
      <g class="icon-block entrance-icon" transform="translate(300, 50) scale(2.8)">
        <!-- Blue diagonal leg -->
        <path
          class="icon-shape"
          d="M 35 40 L 48 40 L 75 100 L 58 100 Z"
          fill="url(#logo-grad-lg)"
          stroke="url(#logo-grad-lg)"
          stroke-width="4"
          stroke-linejoin="round"
        />
        <!-- Dark navy stem and loop -->
        <path
          class="icon-shape"
          d="M 0 0 L 45 0 C 65 0 75 10 75 25 C 75 40 65 50 45 50 L 45 100 L 30 100 Q 20 100 20 90 L 20 20 Q 20 5 0 0 Z M 45 15 L 45 35 C 55 35 60 30 60 25 C 60 20 55 15 45 15 Z"
          fill="#243B55"
          stroke="#243B55"
          stroke-width="4.5"
          stroke-linejoin="round"
        />

        <!-- WiFi waves (3 layered pulsing animations) -->
        <g class="wifi-block">
          <circle class="wifi-wave wifi-wave-1" cx="95" cy="18" r="7" fill="url(#logo-grad-lg)" />
          <path
            class="wifi-wave wifi-wave-2"
            d="M 92 -8 A 26 26 0 0 1 121 21"
            fill="none"
            stroke="url(#logo-grad-lg)"
            stroke-width="7"
            stroke-linecap="round"
          />
          <path
            class="wifi-wave wifi-wave-3"
            d="M 90 -30 A 48 48 0 0 1 143 23"
            fill="none"
            stroke="url(#logo-grad-lg)"
            stroke-width="7"
            stroke-linecap="round"
          />
        </g>
      </g>

      <!-- ============ Wordmark: REMOTELLY ============ -->
      <g class="wordmark-block entrance-wordmark">
        <use href="#wordmark-lg" />
      </g>

      <!-- 'lly' accent underline (reveals on hover) -->
      <rect
        class="lly-underline"
        x="663"
        y="530"
        width="0"
        height="7"
        rx="3.5"
        fill="url(#logo-grad-lg)"
        aria-hidden="true"
      />

      <!-- Shine sweep overlay (clipped to wordmark) -->
      <g class="shine-layer" clip-path="url(#wordmark-clip-lg)" aria-hidden="true">
        <rect
          class="shine-sweep"
          x="-200"
          y="380"
          width="180"
          height="180"
          fill="url(#shine-grad-lg)"
        />
      </g>

      <!-- ============ Divider dots & lines ============ -->
      <g class="divider-block entrance-divider" transform="translate(0, 560)">
        <line x1="250" y1="0" x2="440" y2="0" stroke="url(#logo-grad-lg)" stroke-width="2" stroke-linecap="round" />
        <circle cx="475" cy="0" r="3" fill="url(#logo-grad-lg)" />
        <circle cx="500" cy="0" r="4" fill="url(#logo-grad-lg)" />
        <circle cx="515" cy="0" r="3" fill="url(#logo-grad-lg)" />
        <line x1="550" y1="0" x2="740" y2="0" stroke="url(#logo-grad-lg)" stroke-width="2" stroke-linecap="round" />
      </g>

      <!-- ============ Tagline ============ -->
      <text
        class="tagline entrance-tagline"
        x="500"
        y="615"
        :font-family="locale === 'ar' ? 'Cairo, sans-serif' : 'Outfit, sans-serif'"
        :font-size="locale === 'ar' ? '21' : '15'"
        font-weight="900"
        fill="#9AA4B2"
        :letter-spacing="locale === 'ar' ? '0.02em' : '0.45em'"
        text-anchor="middle"
      >
        {{ locale === 'ar' ? 'منصة الأنظمة السحابية وتطبيقات الجوال' : 'CLOUD SYSTEMS & MOBILE APPS PLATFORM' }}
      </text>
    </svg>

    <!-- ============================================================ -->
    <!-- Small variant: horizontal layout (used in navbar / footer)   -->
    <!-- ============================================================ -->
    <svg
      v-else
      class="logo-svg w-full h-full relative z-10"
      viewBox="0 0 512 128"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
      preserveAspectRatio="xMidYMid meet"
      role="img"
      :aria-label="locale === 'ar' ? 'شعار ريموتلي' : 'Remotelly logo'"
    >
      <defs>
        <linearGradient id="logo-grad-sm" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stop-color="#00C6FF">
            <animate
              attributeName="stop-color"
              values="#00C6FF;#1E90FF;#00C6FF"
              dur="8s"
              repeatCount="indefinite"
            />
          </stop>
          <stop offset="100%" stop-color="#1E90FF">
            <animate
              attributeName="stop-color"
              values="#1E90FF;#00C6FF;#1E90FF"
              dur="8s"
              repeatCount="indefinite"
            />
          </stop>
        </linearGradient>

        <linearGradient id="shine-grad-sm" x1="0%" y1="0%" x2="100%" y2="0%">
          <stop offset="0%"   stop-color="#ffffff" stop-opacity="0" />
          <stop offset="42%"  stop-color="#ffffff" stop-opacity="0" />
          <stop offset="50%"  stop-color="#ffffff" stop-opacity="0.55" />
          <stop offset="58%"  stop-color="#ffffff" stop-opacity="0" />
          <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
        </linearGradient>

        <symbol id="wordmark-sm" overflow="visible">
          <g transform="translate(170, 41.5) scale(0.45)" fill="#243B55">
            <g>
              <path d="M 35 40 L 48 40 L 75 100 L 58 100 Z" fill="url(#logo-grad-sm)" stroke="url(#logo-grad-sm)" stroke-width="4" stroke-linejoin="round" />
              <path d="M 0 0 L 45 0 C 65 0 75 10 75 25 C 75 40 65 50 45 50 L 45 100 L 30 100 Q 20 100 20 90 L 20 20 Q 20 5 0 0 Z M 45 15 L 45 35 C 55 35 60 30 60 25 C 60 20 55 15 45 15 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
            </g>
            <path d="M 95 0 L 165 0 L 165 15 L 115 15 L 115 42 L 150 42 L 150 58 L 115 58 L 115 85 L 165 85 L 165 100 L 125 100 Q 115 100 115 90 L 115 20 Q 115 5 95 0 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
            <path d="M 185 0 L 203 0 L 227.5 55 L 252 0 L 270 0 L 270 100 L 255 100 L 255 25 L 227.5 75 L 200 25 L 200 100 L 185 100 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
            <path d="M 315 0 L 340 0 C 355 0 365 15 365 35 L 365 65 C 365 85 355 100 340 100 L 315 100 C 300 100 290 85 290 65 L 290 35 C 290 15 300 0 315 0 Z M 315 15 C 308 15 305 22 305 35 L 305 65 C 305 78 308 85 315 85 L 340 85 C 347 85 350 78 350 65 L 350 35 C 350 22 347 15 340 15 Z" fill="#243B55" fill-rule="evenodd" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
            <path d="M 385 0 L 460 0 L 460 15 L 430 15 L 430 100 L 415 100 L 415 15 L 385 15 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
            <path d="M 480 0 L 550 0 L 550 15 L 500 15 L 500 42 L 535 42 L 535 58 L 500 58 L 500 85 L 550 85 L 550 100 L 510 100 Q 500 100 500 90 L 500 20 Q 500 5 480 0 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
            <path d="M 570 0 L 585 0 L 585 85 L 635 85 L 635 100 L 570 100 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
            <path d="M 655 0 L 670 0 L 670 85 L 720 85 L 720 100 L 655 100 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
            <g transform="translate(740, 0)">
              <path d="M 75 0 L 60 0 L 37.5 35 L 52.5 35 Z" fill="url(#logo-grad-sm)" stroke="url(#logo-grad-sm)" stroke-width="4" stroke-linejoin="round" />
              <path d="M 0 0 L 15 0 L 30 35 L 30 100 L 45 100 L 45 35 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
            </g>
          </g>
        </symbol>

        <clipPath id="wordmark-clip-sm">
          <use href="#wordmark-sm" />
        </clipPath>
      </defs>

      <!-- Icon: R symbol with waves -->
      <g class="icon-block entrance-icon" transform="translate(15, 14) scale(1.1)">
        <path d="M 35 40 L 48 40 L 75 100 L 58 100 Z" fill="url(#logo-grad-sm)" stroke="url(#logo-grad-sm)" stroke-width="3" stroke-linejoin="round" />
        <path d="M 0 0 L 45 0 C 65 0 75 10 75 25 C 75 40 65 50 45 50 L 45 100 L 30 100 Q 20 100 20 90 L 20 20 Q 20 5 0 0 Z M 45 15 L 45 35 C 55 35 60 30 60 25 C 60 20 55 15 45 15 Z" fill="#243B55" stroke="#243B55" stroke-width="3" stroke-linejoin="round" />

        <g class="wifi-block">
          <circle class="wifi-wave wifi-wave-1" cx="95" cy="18" r="7" fill="url(#logo-grad-sm)" />
          <path class="wifi-wave wifi-wave-2" d="M 92 -8 A 26 26 0 0 1 121 21" fill="none" stroke="url(#logo-grad-sm)" stroke-width="7" stroke-linecap="round" />
          <path class="wifi-wave wifi-wave-3" d="M 90 -30 A 48 48 0 0 1 143 23" fill="none" stroke="url(#logo-grad-sm)" stroke-width="7" stroke-linecap="round" />
        </g>
      </g>

      <!-- Wordmark -->
      <g class="wordmark-block entrance-wordmark">
        <use href="#wordmark-sm" />
      </g>

      <!-- Shine sweep (clipped to wordmark) -->
      <g class="shine-layer" clip-path="url(#wordmark-clip-sm)" aria-hidden="true">
        <rect
          class="shine-sweep"
          x="-150"
          y="20"
          width="120"
          height="120"
          fill="url(#shine-grad-sm)"
        />
      </g>
    </svg>
  </div>
</template>

<script setup>
import { locale } from '../../utils/locale'

defineProps({
  size: {
    type: String,
    default: 'small', // 'small' (navbar/footer) or 'large' (hero)
    validator: (val) => ['small', 'large'].includes(val),
  },
})
</script>

<style scoped>
/* ===================================================================
   ENTRANCE ANIMATIONS — sequenced reveal
   =================================================================== */
@keyframes containerFadeIn {
  from { opacity: 0; }
  to   { opacity: 1; }
}

@keyframes iconPop {
  0%   { opacity: 0; transform: scale(0.55); }
  60%  { opacity: 1; transform: scale(1.08); }
  100% { opacity: 1; transform: scale(1); }
}

@keyframes blockRise {
  from { opacity: 0; transform: translateY(10px); }
  to   { opacity: 1; transform: translateY(0); }
}

@keyframes dividerExpand {
  from { opacity: 0; transform: scaleX(0); }
  to   { opacity: 1; transform: scaleX(1); }
}

@keyframes taglineFade {
  from { opacity: 0; letter-spacing: 0; }
  to   { opacity: 1; letter-spacing: inherit; }
}

.logo-container {
  animation: containerFadeIn 0.45s ease-out backwards;
}

.entrance-icon {
  transform-box: fill-box;
  transform-origin: center;
  animation: iconPop 0.75s cubic-bezier(0.34, 1.56, 0.64, 1) 0.15s backwards;
}

.entrance-wordmark {
  transform-box: fill-box;
  transform-origin: center;
  animation: blockRise 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.45s backwards;
}

.entrance-divider {
  transform-box: fill-box;
  transform-origin: center;
  animation: dividerExpand 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0.85s backwards;
}

.entrance-tagline {
  animation: taglineFade 0.5s ease-out 1.05s backwards;
}

/* ===================================================================
   CONTINUOUS — Layered WiFi wave pulses (3 staggered animations)
   =================================================================== */
.wifi-wave {
  transform-box: fill-box;
  transform-origin: center;
}

@keyframes wifiPulseInner {
  0%, 100% { opacity: 0.85; transform: scale(1); }
  50%      { opacity: 1;    transform: scale(1.12); }
}
.wifi-wave-1 {
  animation: wifiPulseInner 2.6s ease-in-out infinite;
}

@keyframes wifiPulseMid {
  0%, 100% { opacity: 0.7; transform: scale(0.95); }
  50%      { opacity: 1;   transform: scale(1.06); }
}
.wifi-wave-2 {
  animation: wifiPulseMid 3.4s ease-in-out infinite 0.3s;
}

@keyframes wifiPulseOuter {
  0%, 100% { opacity: 0.55; transform: scale(0.93); }
  50%      { opacity: 0.9;  transform: scale(1.04); }
}
.wifi-wave-3 {
  animation: wifiPulseOuter 4.2s ease-in-out infinite 0.6s;
}

/* ===================================================================
   AMBIENT BACKLIGHT (large variant only) — slow breathing
   =================================================================== */
@keyframes glowBreathe {
  0%, 100% { opacity: 0.22; transform: scale(1); }
  50%      { opacity: 0.42; transform: scale(1.12); }
}
.ambient-glow {
  position: absolute;
  width: 12rem;
  height: 12rem;
  border-radius: 9999px;
  background: radial-gradient(circle, rgba(0, 198, 255, 0.5) 0%, rgba(0, 198, 255, 0) 70%);
  filter: blur(20px);
  pointer-events: none;
  top: -8%;
  left: 35%;
  z-index: 0;
  animation: glowBreathe 5s ease-in-out infinite 0.8s;
}

/* ===================================================================
   HOVER INTERACTIONS
   =================================================================== */
.logo-container:hover {
  transform: scale(1.025);
}

.logo-container:hover .ambient-glow {
  opacity: 0.55;
  animation-duration: 2.8s;
}

/* Reveal the "lly" accent underline on hover (large variant only) */
.lly-underline {
  transition: width 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0.05s;
}
.logo-container:hover .lly-underline {
  width: 244;
}

/* Shine sweep on hover */
.shine-layer {
  opacity: 0;
  transition: opacity 0.25s ease-out;
}
.logo-container:hover .shine-layer {
  opacity: 1;
}

@keyframes shineSweepLg {
  0%   { transform: translateX(-220px); }
  100% { transform: translateX(1080px); }
}
@keyframes shineSweepSm {
  0%   { transform: translateX(-160px); }
  100% { transform: translateX(540px);  }
}
.shine-sweep {
  opacity: 0;
}
.logo-container:hover .shine-sweep {
  opacity: 1;
  animation: shineSweepLg 1.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
.logo-container-small:hover .shine-sweep {
  animation: shineSweepSm 1.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

/* ===================================================================
   ACCESSIBILITY — respect users who prefer reduced motion
   =================================================================== */
@media (prefers-reduced-motion: reduce) {
  .logo-container,
  .entrance-icon,
  .entrance-wordmark,
  .entrance-divider,
  .entrance-tagline,
  .wifi-wave,
  .ambient-glow,
  .shine-layer,
  .shine-sweep {
    animation: none !important;
    transition: none !important;
    opacity: 1 !important;
    transform: none !important;
  }
  .lly-underline {
    width: 244 !important;
  }
}
</style>
