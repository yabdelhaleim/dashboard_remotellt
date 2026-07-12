<template>
  <div
    :style="{ aspectRatio: size === 'large' ? '1000 / 650' : '512 / 128' }"
    :class="[
      'logo-container select-none relative flex items-center justify-center transition-transform duration-500 ease-out will-change-transform',
      size === 'large'
        ? 'logo-container-large w-[260px] sm:w-[340px] md:w-[420px] lg:w-[480px] xl:w-[540px] 2xl:w-[600px]'
        : 'logo-container-small w-[160px] sm:w-[200px]'
    ]"
    :dir="locale === 'ar' ? 'rtl' : 'ltr'"
  >
    <!-- Ambient pulsing glow behind the icon (large variant only) -->
    <div
      v-if="size === 'large'"
      class="ambient-glow"
      aria-hidden="true"
    ></div>

    <!-- ============================================================ -->
    <!-- Large variant: stacked layout (hero / landing)               -->
    <!-- ============================================================ -->
    <svg
      v-if="size === 'large'"
      class="logo-svg w-full h-full relative z-10"
      viewBox="0 0 1000 650"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
      preserveAspectRatio="xMidYMid meet"
      role="img"
      :aria-label="locale === 'ar' ? 'شعار ريموتلي' : 'Remotely — Your Software Solutions Partner'"
    >
      <defs>
        <!-- Brand blue gradient with slow color cycle (premium feel) -->
        <linearGradient id="lg-blue" x1="0%" y1="0%" x2="100%" y2="100%">
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
        <linearGradient id="lg-shine" x1="0%" y1="0%" x2="100%" y2="0%">
          <stop offset="0%"   stop-color="#ffffff" stop-opacity="0" />
          <stop offset="42%"  stop-color="#ffffff" stop-opacity="0" />
          <stop offset="50%"  stop-color="#ffffff" stop-opacity="0.65" />
          <stop offset="58%"  stop-color="#ffffff" stop-opacity="0" />
          <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
        </linearGradient>

        <!-- Reusable "Remotely" wordmark (used for visible fill and shine clip) -->
        <symbol id="lg-remotely" overflow="visible">
          <text
            x="0"
            y="0"
            text-anchor="middle"
            font-family="'Outfit', 'IBM Plex Sans', system-ui, sans-serif"
            font-size="140"
            font-weight="800"
            letter-spacing="-2"
            fill="#FFFFFF"
          >Remotely</text>
        </symbol>

        <clipPath id="lg-clip">
          <use href="#lg-remotely" />
        </clipPath>
      </defs>

      <!-- ============ Icon: R with > _ terminal ============ -->
      <g class="icon-block entrance-icon" transform="translate(360, 50)">
        <!-- Outer rounded square (the R's stem and top) -->
        <rect
          x="0"
          y="0"
          width="280"
          height="280"
          rx="42"
          fill="none"
          stroke="#FFFFFF"
          stroke-width="14"
          stroke-linejoin="round"
        />

        <!-- Diagonal R leg (parallelogram extending past the bottom-right corner) -->
        <path
          d="M 158 168 L 188 168 L 286 280 L 254 280 Z"
          fill="#FFFFFF"
        />

        <!-- Terminal prompt (blue, inside the bowl area) -->
        <g class="terminal-group">
          <!-- The ">" chevron and the "_" underscore together -->
          <text
            x="58"
            y="158"
            font-family="'IBM Plex Mono', 'JetBrains Mono', monospace"
            font-size="118"
            font-weight="900"
            fill="url(#lg-blue)"
          >&gt;_</text>

          <!-- Subtle blinking caret under the underscore (terminal-life feel) -->
          <rect
            class="terminal-caret"
            x="156"
            y="138"
            width="6"
            height="22"
            fill="url(#lg-blue)"
            rx="1"
          />
        </g>
      </g>

      <!-- ============ Wordmark: "Remotely" ============ -->
      <g class="wordmark-block entrance-wordmark" transform="translate(500, 430)">
        <use href="#lg-remotely" />

        <!-- Shine sweep overlay (clipped to wordmark) -->
        <g class="shine-layer" clip-path="url(#lg-clip)" aria-hidden="true">
          <rect
            class="shine-sweep shine-sweep-lg"
            x="-100"
            y="-130"
            width="120"
            height="200"
            fill="url(#lg-shine)"
          />
        </g>
      </g>

      <!-- ============ TEAM subtitle (with wide letter-spacing) ============ -->
      <g class="team-block entrance-team" transform="translate(500, 510)">
        <text
          x="0"
          y="0"
          text-anchor="middle"
          font-family="'Outfit', sans-serif"
          font-size="58"
          font-weight="600"
          fill="url(#lg-blue)"
          letter-spacing="32"
        >T E A M</text>
      </g>

      <!-- ============ Divider line (under TEAM) ============ -->
      <line
        class="divider-block entrance-divider"
        x1="380" y1="565" x2="620" y2="565"
        stroke="url(#lg-blue)"
        stroke-width="2"
        stroke-linecap="round"
        opacity="0.55"
      />

      <!-- ============ Tagline ============ -->
      <text
        class="tagline entrance-tagline"
        x="500"
        y="608"
        text-anchor="middle"
        font-family="'IBM Plex Mono', 'Cairo', monospace"
        font-size="20"
        font-weight="500"
        fill="#9AA4B2"
        letter-spacing="3"
      >— {{ brandTagline }} —</text>
    </svg>

    <!-- ============================================================ -->
    <!-- Small variant: horizontal inline (navbar / footer)            -->
    <!-- ============================================================ -->
    <svg
      v-else
      class="logo-svg w-full h-full relative z-10"
      viewBox="0 0 512 128"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
      preserveAspectRatio="xMidYMid meet"
      role="img"
      :aria-label="locale === 'ar' ? 'شعار ريموتلي' : 'Remotely logo'"
    >
      <defs>
        <linearGradient id="sm-blue" x1="0%" y1="0%" x2="100%" y2="100%">
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

        <linearGradient id="sm-shine" x1="0%" y1="0%" x2="100%" y2="0%">
          <stop offset="0%"   stop-color="#ffffff" stop-opacity="0" />
          <stop offset="42%"  stop-color="#ffffff" stop-opacity="0" />
          <stop offset="50%"  stop-color="#ffffff" stop-opacity="0.55" />
          <stop offset="58%"  stop-color="#ffffff" stop-opacity="0" />
          <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
        </linearGradient>

        <symbol id="sm-remotely" overflow="visible">
          <text
            x="0"
            y="0"
            text-anchor="middle"
            font-family="'Outfit', 'IBM Plex Sans', sans-serif"
            font-size="58"
            font-weight="800"
            letter-spacing="-1"
            fill="#FFFFFF"
          >Remotely</text>
        </symbol>

        <clipPath id="sm-clip">
          <use href="#sm-remotely" />
        </clipPath>
      </defs>

      <!-- Icon: compact R with terminal prompt -->
      <g class="icon-block entrance-icon" transform="translate(40, 22)">
        <rect
          x="0"
          y="0"
          width="84"
          height="84"
          rx="14"
          fill="none"
          stroke="#FFFFFF"
          stroke-width="5"
          stroke-linejoin="round"
        />
        <path
          d="M 48 48 L 58 48 L 90 84 L 80 84 Z"
          fill="#FFFFFF"
        />
        <text
          x="14"
          y="50"
          font-family="'IBM Plex Mono', monospace"
          font-size="34"
          font-weight="900"
          fill="url(#sm-blue)"
        >&gt;_</text>
        <rect
          class="terminal-caret"
          x="46"
          y="44"
          width="3"
          height="9"
          fill="url(#sm-blue)"
          rx="0.5"
        />
      </g>

      <!-- Wordmark -->
      <g class="wordmark-block entrance-wordmark" transform="translate(290, 84)">
        <use href="#sm-remotely" />
        <g class="shine-layer" clip-path="url(#sm-clip)" aria-hidden="true">
          <rect
            class="shine-sweep shine-sweep-sm"
            x="-50"
            y="-50"
            width="50"
            height="80"
            fill="url(#sm-shine)"
          />
        </g>
      </g>
    </svg>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { locale } from '../../utils/locale'
import { translations } from '../../utils/translations'

defineProps({
  size: {
    type: String,
    default: 'small', // 'small' (navbar/footer) or 'large' (hero)
    validator: (val) => ['small', 'large'].includes(val),
  },
})

// Tagline shown below TEAM ("Team Online" / Arabic equivalent).
// Falls back to English string if the AR/EN translation hasn't been added yet.
const brandTagline = computed(
  () => translations[locale.value]?.brand_tagline || 'Team Online'
)
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
  from { opacity: 0; transform: translateY(12px); }
  to   { opacity: 1; transform: translateY(0); }
}

@keyframes teamSpread {
  0%   { opacity: 0; letter-spacing: 8px; }
  100% { opacity: 1; letter-spacing: 32px; }
}

@keyframes dividerExpand {
  from { opacity: 0; transform: scaleX(0); }
  to   { opacity: 0.55; transform: scaleX(1); }
}

@keyframes taglineFade {
  from { opacity: 0; letter-spacing: 0; }
  to   { opacity: 1; letter-spacing: 3px; }
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

.entrance-team {
  transform-box: fill-box;
  transform-origin: center;
  animation: teamSpread 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.65s backwards;
}

.entrance-divider {
  transform-box: fill-box;
  transform-origin: center;
  animation: dividerExpand 0.55s cubic-bezier(0.16, 1, 0.3, 1) 0.95s backwards;
}

.entrance-tagline {
  animation: taglineFade 0.5s ease-out 1.15s backwards;
}

/* ===================================================================
   CONTINUOUS — Terminal cursor blink (the small rect after >_)
   =================================================================== */
@keyframes caretBlink {
  0%, 49%   { opacity: 1; }
  50%, 100% { opacity: 0; }
}
.terminal-caret {
  animation: caretBlink 1.05s steps(1, end) infinite 1.5s;
}

/* ===================================================================
   AMBIENT BACKLIGHT (large variant only) — slow breathing glow
   behind the R icon
   =================================================================== */
@keyframes glowBreathe {
  0%, 100% { opacity: 0.22; transform: scale(1); }
  50%      { opacity: 0.45; transform: scale(1.12); }
}
.ambient-glow {
  position: absolute;
  width: 12rem;
  height: 12rem;
  border-radius: 9999px;
  background: radial-gradient(circle, rgba(0, 198, 255, 0.55) 0%, rgba(0, 198, 255, 0) 70%);
  filter: blur(22px);
  pointer-events: none;
  top: 5%;
  left: 38%;
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
  opacity: 0.65;
  animation-duration: 2.8s;
}

/* Shine sweep on hover over the wordmark */
.shine-layer {
  opacity: 0;
  transition: opacity 0.25s ease-out;
}
.logo-container:hover .shine-layer {
  opacity: 1;
}

@keyframes shineSweepLg {
  0%   { transform: translateX(-220px); }
  100% { transform: translateX(720px); }
}
@keyframes shineSweepSm {
  0%   { transform: translateX(-90px); }
  100% { transform: translateX(360px); }
}
.shine-sweep {
  opacity: 0;
}
.logo-container:hover .shine-sweep {
  opacity: 1;
}
.logo-container-large:hover .shine-sweep {
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
  .entrance-team,
  .entrance-divider,
  .entrance-tagline,
  .terminal-caret,
  .ambient-glow,
  .shine-layer,
  .shine-sweep {
    animation: none !important;
    transition: none !important;
    opacity: 1 !important;
    transform: none !important;
  }
  .entrance-divider {
    opacity: 0.55 !important;
  }
}
</style>
