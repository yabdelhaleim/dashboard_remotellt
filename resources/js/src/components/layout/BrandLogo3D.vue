<template>
  <div 
    :class="[
      'relative select-none flex items-center justify-center logo-entrance transition-all duration-300',
      size === 'large' ? 'w-[320px] sm:w-[400px] h-[210px] sm:h-[260px]' : 'w-[190px] h-[50px]'
    ]"
  >
    <!-- Subtle Ambient Back-Light behind the logo (opacity 0.18, blur 12px) -->
    <div 
      v-if="size === 'large'"
      class="absolute w-36 h-36 rounded-full bg-[#00C6FF]/18 blur-[12px] pointer-events-none -translate-x-12 -translate-y-20 z-0"
    ></div>

    <!-- Crisp Inline SVG Logo - Large (Vertical Stacked Layout) -->
    <svg 
      v-if="size === 'large'"
      class="w-full h-full relative z-10" 
      viewBox="0 0 1000 650" 
      fill="none" 
      xmlns="http://www.w3.org/2000/svg"
    >
      <defs>
        <!-- Sky Blue Gradient matching logo exactly -->
        <linearGradient id="logo-blue-grad" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stop-color="#00C6FF" />
          <stop offset="100%" stop-color="#1E90FF" />
        </linearGradient>
      </defs>

      <!-- Icon (R Symbol with Waves) - Scaled up by 27% (2.2 -> 2.8) and centered horizontally -->
      <g transform="translate(300, 50) scale(2.8)">
        <!-- Blue diagonal leg -->
        <path d="M 35 40 L 48 40 L 75 100 L 58 100 Z" fill="url(#logo-blue-grad)" stroke="url(#logo-blue-grad)" stroke-width="4" stroke-linejoin="round" />
        <!-- Dark Navy stem and loop -->
        <path d="M 0 0 L 45 0 C 65 0 75 10 75 25 C 75 40 65 50 45 50 L 45 100 L 30 100 Q 20 100 20 90 L 20 20 Q 20 5 0 0 Z M 45 15 L 45 35 C 55 35 60 30 60 25 C 60 20 55 15 45 15 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        
        <!-- Waves (Cyan/Blue) with a pulsing class -->
        <g class="wifi-waves-pulse">
          <circle cx="95" cy="18" r="7" fill="url(#logo-blue-grad)" />
          <path d="M 92 -8 A 26 26 0 0 1 121 21" fill="none" stroke="url(#logo-blue-grad)" stroke-width="7" stroke-linecap="round" />
          <path d="M 90 -30 A 48 48 0 0 1 143 23" fill="none" stroke="url(#logo-blue-grad)" stroke-width="7" stroke-linecap="round" />
        </g>
      </g>

      <!-- Wordmark REMOTELLY (Bolder and stronger visually) -->
      <g transform="translate(92.5, 420)">
        <!-- R -->
        <g transform="translate(0, 0)">
          <path d="M 35 40 L 48 40 L 75 100 L 58 100 Z" fill="url(#logo-blue-grad)" stroke="url(#logo-blue-grad)" stroke-width="4" stroke-linejoin="round" />
          <path d="M 0 0 L 45 0 C 65 0 75 10 75 25 C 75 40 65 50 45 50 L 45 100 L 30 100 Q 20 100 20 90 L 20 20 Q 20 5 0 0 Z M 45 15 L 45 35 C 55 35 60 30 60 25 C 60 20 55 15 45 15 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        </g>
        <!-- E -->
        <path d="M 95 0 L 165 0 L 165 15 L 115 15 L 115 42 L 150 42 L 150 58 L 115 58 L 115 85 L 165 85 L 165 100 L 125 100 Q 115 100 115 90 L 115 20 Q 115 5 95 0 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- M -->
        <path d="M 185 0 L 203 0 L 227.5 55 L 252 0 L 270 0 L 270 100 L 255 100 L 255 25 L 227.5 75 L 200 25 L 200 100 L 185 100 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- O -->
        <path d="M 315 0 L 340 0 C 355 0 365 15 365 35 L 365 65 C 365 85 355 100 340 100 L 315 100 C 300 100 290 85 290 65 L 290 35 C 290 15 300 0 315 0 Z M 315 15 C 308 15 305 22 305 35 L 305 65 C 305 78 308 85 315 85 L 340 85 C 347 85 350 78 350 65 L 350 35 C 350 22 347 15 340 15 Z" fill="#243B55" fill-rule="evenodd" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- T -->
        <path d="M 385 0 L 460 0 L 460 15 L 430 15 L 430 100 L 415 100 L 415 15 L 385 15 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- E -->
        <path d="M 480 0 L 550 0 L 550 15 L 500 15 L 500 42 L 535 42 L 535 58 L 500 58 L 500 85 L 550 85 L 550 100 L 510 100 Q 500 100 500 90 L 500 20 Q 500 5 480 0 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- L -->
        <path d="M 570 0 L 585 0 L 585 85 L 635 85 L 635 100 L 570 100 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- L -->
        <path d="M 655 0 L 670 0 L 670 85 L 720 85 L 720 100 L 655 100 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- Y -->
        <g transform="translate(740, 0)">
          <path d="M 75 0 L 60 0 L 37.5 35 L 52.5 35 Z" fill="url(#logo-blue-grad)" stroke="url(#logo-blue-grad)" stroke-width="4" stroke-linejoin="round" />
          <path d="M 0 0 L 15 0 L 30 35 L 30 100 L 45 100 L 45 35 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        </g>
      </g>
      
      <!-- Divider -->
      <g transform="translate(0, 560)">
        <line x1="250" y1="0" x2="440" y2="0" stroke="url(#logo-blue-grad)" stroke-width="2" />
        <circle cx="475" cy="0" r="3" fill="url(#logo-blue-grad)" />
        <circle cx="500" cy="0" r="4" fill="url(#logo-blue-grad)" />
        <circle cx="515" cy="0" r="3" fill="url(#logo-blue-grad)" />
        <line x1="550" y1="0" x2="740" y2="0" stroke="url(#logo-blue-grad)" stroke-width="2" />
      </g>

      <!-- Subtext (Cairo / Outfit modern tagline, logically integrated directly below REMOTELLY) -->
      <text 
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

    <!-- Crisp Inline SVG Logo - Small (Horizontal Layout for Navbar) -->
    <svg 
      v-else
      class="w-full h-full relative z-10" 
      viewBox="0 0 512 128" 
      fill="none" 
      xmlns="http://www.w3.org/2000/svg"
    >
      <defs>
        <linearGradient id="logo-blue-grad-sm" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stop-color="#00C6FF" />
          <stop offset="100%" stop-color="#1E90FF" />
        </linearGradient>
      </defs>

      <!-- Icon (R Symbol with Waves) on the left -->
      <g transform="translate(15, 14) scale(1.1)">
        <!-- Blue diagonal leg -->
        <path d="M 35 40 L 48 40 L 75 100 L 58 100 Z" fill="url(#logo-blue-grad-sm)" stroke="url(#logo-blue-grad-sm)" stroke-width="3" stroke-linejoin="round" />
        <!-- Dark Navy stem and loop -->
        <path d="M 0 0 L 45 0 C 65 0 75 10 75 25 C 75 40 65 50 45 50 L 45 100 L 30 100 Q 20 100 20 90 L 20 20 Q 20 5 0 0 Z M 45 15 L 45 35 C 55 35 60 30 60 25 C 60 20 55 15 45 15 Z" fill="#243B55" stroke="#243B55" stroke-width="3" stroke-linejoin="round" />
        
        <!-- Waves (Cyan/Blue) with a pulsing class -->
        <g class="wifi-waves-pulse">
          <circle cx="95" cy="18" r="7" fill="url(#logo-blue-grad-sm)" />
          <path d="M 92 -8 A 26 26 0 0 1 121 21" fill="none" stroke="url(#logo-blue-grad-sm)" stroke-width="7" stroke-linecap="round" />
          <path d="M 90 -30 A 48 48 0 0 1 143 23" fill="none" stroke="url(#logo-blue-grad-sm)" stroke-width="7" stroke-linecap="round" />
        </g>
      </g>

      <!-- Wordmark REMOTELLY on the right (Bolder and stronger visually) -->
      <g transform="translate(170, 41.5) scale(0.45)">
        <!-- R -->
        <g transform="translate(0, 0)">
          <path d="M 35 40 L 48 40 L 75 100 L 58 100 Z" fill="url(#logo-blue-grad-sm)" stroke="url(#logo-blue-grad-sm)" stroke-width="4" stroke-linejoin="round" />
          <path d="M 0 0 L 45 0 C 65 0 75 10 75 25 C 75 40 65 50 45 50 L 45 100 L 30 100 Q 20 100 20 90 L 20 20 Q 20 5 0 0 Z M 45 15 L 45 35 C 55 35 60 30 60 25 C 60 20 55 15 45 15 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        </g>
        <!-- E -->
        <path d="M 95 0 L 165 0 L 165 15 L 115 15 L 115 42 L 150 42 L 150 58 L 115 58 L 115 85 L 165 85 L 165 100 L 125 100 Q 115 100 115 90 L 115 20 Q 115 5 95 0 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- M -->
        <path d="M 185 0 L 203 0 L 227.5 55 L 252 0 L 270 0 L 270 100 L 255 100 L 255 25 L 227.5 75 L 200 25 L 200 100 L 185 100 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- O -->
        <path d="M 315 0 L 340 0 C 355 0 365 15 365 35 L 365 65 C 365 85 355 100 340 100 L 315 100 C 300 100 290 85 290 65 L 290 35 C 290 15 300 0 315 0 Z M 315 15 C 308 15 305 22 305 35 L 305 65 C 305 78 308 85 315 85 L 340 85 C 347 85 350 78 350 65 L 350 35 C 350 22 347 15 340 15 Z" fill="#243B55" fill-rule="evenodd" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- T -->
        <path d="M 385 0 L 460 0 L 460 15 L 430 15 L 430 100 L 415 100 L 415 15 L 385 15 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- E -->
        <path d="M 480 0 L 550 0 L 550 15 L 500 15 L 500 42 L 535 42 L 535 58 L 500 58 L 500 85 L 550 85 L 550 100 L 510 100 Q 500 100 500 90 L 500 20 Q 500 5 480 0 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- L -->
        <path d="M 570 0 L 585 0 L 585 85 L 635 85 L 635 100 L 570 100 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- L -->
        <path d="M 655 0 L 670 0 L 670 85 L 720 85 L 720 100 L 655 100 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        <!-- Y -->
        <g transform="translate(740, 0)">
          <path d="M 75 0 L 60 0 L 37.5 35 L 52.5 35 Z" fill="url(#logo-blue-grad-sm)" stroke="url(#logo-blue-grad-sm)" stroke-width="4" stroke-linejoin="round" />
          <path d="M 0 0 L 15 0 L 30 35 L 30 100 L 45 100 L 45 35 Z" fill="#243B55" stroke="#243B55" stroke-width="4.5" stroke-linejoin="round" />
        </g>
      </g>
    </svg>
  </div>
</template>

<script setup>
import { locale } from '../../utils/locale'

defineProps({
  size: {
    type: String,
    default: 'small' // 'small' or 'large'
  }
})
</script>

<style scoped>
/* entrance animation: fade-in + scale from 0.95 to 1 in 0.6 seconds */
@keyframes logoEntrance {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.logo-entrance {
  animation: logoEntrance 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

/* wifi wave pulsing: slow, subtle opacity changes on waves only */
@keyframes wavePulse {
  0%, 100% {
    opacity: 0.8;
  }
  50% {
    opacity: 1.0;
  }
}

.wifi-waves-pulse {
  animation: wavePulse 3.5s ease-in-out infinite;
}
</style>
