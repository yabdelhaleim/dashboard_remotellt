<template>
  <section
    ref="sectionRef"
    :class="[
      'relative py-20 sm:py-28 px-4 sm:px-6 lg:px-8 overflow-hidden',
      isVisible ? 'is-visible' : '',
    ]"
    aria-labelledby="spec-heading"
  >
    <!-- ============ Background ambiance ============ -->
    <div class="ambient-grid" aria-hidden="true"></div>
    <div class="ambient-blob ambient-blob-1" aria-hidden="true"></div>
    <div class="ambient-blob ambient-blob-2" aria-hidden="true"></div>
    <div class="ambient-blob ambient-blob-3" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto relative z-10">
      <!-- ============ Section header ============ -->
      <div class="text-center mb-16 sm:mb-20 reveal-item reveal-header">
        <span
          class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full
                 bg-vibrant-cyan/10 border border-vibrant-cyan/25
                 text-vibrant-cyan text-xs font-mono font-semibold
                 tracking-[0.2em] uppercase backdrop-blur-sm"
        >
          <span class="w-1.5 h-1.5 rounded-full bg-vibrant-cyan animate-pulse"></span>
          {{ t('spec_badge') }}
        </span>

        <h2
          id="spec-heading"
          class="mt-5 font-display font-black text-3xl sm:text-4xl lg:text-5xl
                 leading-tight text-white hero-headline"
        >
          {{ t('spec_title') }}
        </h2>

        <p class="mt-4 text-dark-muted text-base sm:text-lg max-w-3xl mx-auto leading-ar-normal">
          {{ t('spec_desc') }}
        </p>
      </div>

      <!-- ============ Specializations grid ============ -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-7 lg:gap-9">

        <!-- =============== WEB APPLICATIONS CARD =============== -->
        <article
          class="spec-card spec-card-web reveal-item reveal-card-1"
          @mousemove="handleMouseMove($event, 'web')"
          @mouseleave="handleMouseLeave('web')"
          :style="tiltWeb"
        >
          <div class="spec-halo spec-halo-web" aria-hidden="true"></div>
          <div class="spec-border-shine spec-border-shine-web" aria-hidden="true"></div>

          <!-- 3D illustration stage -->
          <div
            class="spec-stage"
            :style="stageWeb"
          >
            <!-- floating sparkle particles around the device -->
            <span class="float-spark spark-1" aria-hidden="true"></span>
            <span class="float-spark spark-2" aria-hidden="true"></span>
            <span class="float-spark spark-3" aria-hidden="true"></span>

            <!-- the 3D-tilted browser window -->
            <svg
              class="browser-svg"
              viewBox="0 0 360 240"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
              role="img"
              aria-label="Web dashboard mockup"
            >
              <defs>
                <linearGradient id="web-blue" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#00C6FF" />
                  <stop offset="100%" stop-color="#1E90FF" />
                </linearGradient>
                <linearGradient id="web-glass" x1="0%" y1="0%" x2="0%" y2="100%">
                  <stop offset="0%" stop-color="#1a2233" />
                  <stop offset="100%" stop-color="#0e1420" />
                </linearGradient>
                <linearGradient id="web-bar" x1="0%" y1="100%" x2="0%" y2="0%">
                  <stop offset="0%" stop-color="#1E90FF" />
                  <stop offset="100%" stop-color="#00C6FF" />
                </linearGradient>
                <linearGradient id="web-shine" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#ffffff" stop-opacity="0" />
                  <stop offset="50%" stop-color="#ffffff" stop-opacity="0.06" />
                  <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
                </linearGradient>
                <filter id="web-shadow" x="-20%" y="-20%" width="140%" height="140%">
                  <feGaussianBlur stdDeviation="6" />
                </filter>
              </defs>

              <!-- BIG ambient under-shadow -->
              <ellipse class="browser-shadow" cx="180" cy="220" rx="150" ry="14" fill="#000" opacity="0.55" filter="url(#web-shadow)" />

              <!-- ============ Browser window ============ -->
              <g class="browser-window" transform="translate(20, 14)">

                <!-- Outer chrome with tilt-ready shape -->
                <rect x="0" y="0" width="320" height="200" rx="14" fill="url(#web-glass)" stroke="#243B55" stroke-width="1" />

                <!-- Top chrome bar -->
                <path d="M 0 0 L 320 0 L 320 36 L 0 36 Z" fill="#11151F" />
                <rect x="0" y="0" width="320" height="14" rx="14" fill="#11151F" />
                <!-- Right-only bottom corners to flatten under-bar -->
                <rect x="0" y="14" width="320" height="22" fill="#11151F" />

                <!-- Traffic lights -->
                <circle cx="16" cy="18" r="4.5" fill="#FF5F57" />
                <circle cx="30" cy="18" r="4.5" fill="#FEBC2E" />
                <circle cx="44" cy="18" r="4.5" fill="#28C840" />

                <!-- Tabs -->
                <g transform="translate(64, 9)">
                  <rect class="tab tab-active" x="0" y="0" width="78" height="22" rx="6" fill="#1B202E" />
                  <circle cx="10" cy="11" r="3" fill="url(#web-blue)" />
                  <rect x="18" y="8" width="48" height="6" rx="3" fill="#F5F7FA" opacity="0.85" />
                  <rect class="tab tab-inactive" x="82" y="0" width="62" height="22" rx="6" fill="#0F1525" />
                  <rect x="92" y="9" width="42" height="4" rx="2" fill="#9AA4B2" opacity="0.4" />
                </g>

                <!-- URL bar -->
                <g transform="translate(64, 26)">
                  <rect x="0" y="0" width="190" height="3" rx="1.5" fill="#0A0E1A" />
                  <circle cx="6" cy="1.5" r="1.2" fill="#28C840" />
                  <text x="14" y="2.4" font-family="IBM Plex Mono, monospace" font-size="2" fill="#9AA4B2">
                    https://app.remotelly.com/dashboard
                  </text>
                </g>

                <!-- Browser top-bottom separator -->
                <line x1="0" y1="36" x2="320" y2="36" stroke="#1E2536" stroke-width="1" />

                <!-- ============ Inner dashboard ============ -->
                <g transform="translate(0, 36)">

                  <!-- Sidebar -->
                  <rect x="0" y="0" width="60" height="164" fill="#0F1525" />
                  <rect x="0" y="0" width="60" height="164" fill="#0F1525" />
                  <!-- Logo mark -->
                  <rect x="14" y="10" width="14" height="14" rx="3" fill="url(#web-blue)" />
                  <path d="M 18 14 L 22 14 L 28 24 L 24 24 Z" fill="#fff" opacity="0.95" />
                  <!-- Menu items -->
                  <rect x="8"  y="36" width="44" height="10" rx="3" fill="#1E90FF" opacity="0.18" />
                  <rect x="8"  y="36" width="2"  height="10" fill="url(#web-blue)" />
                  <circle cx="14" cy="41" r="2" fill="url(#web-blue)" />
                  <rect x="20" y="39" width="26" height="4" rx="2" fill="#F5F7FA" opacity="0.9" />

                  <circle cx="14" cy="55" r="2" fill="#9AA4B2" opacity="0.6" />
                  <rect x="20" y="53" width="20" height="4" rx="2" fill="#9AA4B2" opacity="0.45" />

                  <circle cx="14" cy="69" r="2" fill="#9AA4B2" opacity="0.6" />
                  <rect x="20" y="67" width="24" height="4" rx="2" fill="#9AA4B2" opacity="0.45" />

                  <circle cx="14" cy="83" r="2" fill="#9AA4B2" opacity="0.6" />
                  <rect x="20" y="81" width="22" height="4" rx="2" fill="#9AA4B2" opacity="0.45" />

                  <circle cx="14" cy="97" r="2" fill="#9AA4B2" opacity="0.6" />
                  <rect x="20" y="95" width="26" height="4" rx="2" fill="#9AA4B2" opacity="0.45" />

                  <circle cx="14" cy="111" r="2" fill="#9AA4B2" opacity="0.6" />
                  <rect x="20" y="109" width="20" height="4" rx="2" fill="#9AA4B2" opacity="0.45" />

                  <!-- Bottom-avatar block -->
                  <circle cx="20" cy="146" r="6" fill="url(#web-blue)" />
                  <rect x="30" y="143" width="20" height="3" rx="1.5" fill="#F5F7FA" opacity="0.7" />
                  <rect x="30" y="148" width="14" height="3" rx="1.5" fill="#9AA4B2" opacity="0.4" />

                  <!-- Main content area -->
                  <!-- Topbar -->
                  <rect x="60" y="0" width="260" height="22" fill="#0A0E1A" />
                  <text x="72" y="14" font-family="Cairo, sans-serif" font-size="6" font-weight="800" fill="#F5F7FA">Dashboard</text>
                  <circle cx="305" cy="11" r="5" fill="#1B202E" />
                  <circle cx="305" cy="11" r="2.5" fill="url(#web-blue)" />
                  <rect x="270" y="6" width="22" height="10" rx="5" fill="#1B202E" />
                  <rect x="274" y="9" width="14" height="4" rx="2" fill="#F5F7FA" opacity="0.7" />

                  <!-- 3 stat cards -->
                  <g transform="translate(72, 32)">
                    <!-- Card 1 -->
                    <rect x="0" y="0" width="76" height="34" rx="4" fill="#11151F" stroke="#1E2536" />
                    <rect x="6"  y="6"  width="22" height="3"  rx="1.5" fill="#9AA4B2" opacity="0.55" />
                    <text x="6" y="22" font-family="Cairo, sans-serif" font-size="9" font-weight="900" fill="#F5F7FA">12,450</text>
                    <rect x="6" y="27" width="14" height="3" rx="1.5" fill="#28C840" opacity="0.85" />
                    <polygon points="6,29 8,26 10,28 12,25" fill="#28C840" />

                    <!-- Card 2 -->
                    <rect x="84" y="0" width="76" height="34" rx="4" fill="#11151F" stroke="#1E2536" />
                    <rect x="90"  y="6"  width="22" height="3"  rx="1.5" fill="#9AA4B2" opacity="0.55" />
                    <text x="90" y="22" font-family="Cairo, sans-serif" font-size="9" font-weight="900" fill="#F5F7FA">+24%</text>
                    <rect x="90" y="27" width="14" height="3" rx="1.5" fill="#28C840" opacity="0.85" />
                    <polygon points="90,29 92,26 94,28 96,25" fill="#28C840" />

                    <!-- Card 3 -->
                    <rect x="168" y="0" width="76" height="34" rx="4" fill="#11151F" stroke="#1E2536" />
                    <rect x="174" y="6"  width="22" height="3"  rx="1.5" fill="#9AA4B2" opacity="0.55" />
                    <text x="174" y="22" font-family="Cairo, sans-serif" font-size="9" font-weight="900" fill="#F5F7FA">8,392</text>
                    <rect x="174" y="27" width="14" height="3" rx="1.5" fill="#00C6FF" opacity="0.95" />
                    <polygon points="174,29 176,26 178,28 180,25" fill="#00C6FF" />
                  </g>

                  <!-- Bar chart -->
                  <g transform="translate(72, 78)">
                    <rect x="0" y="0" width="244" height="78" rx="4" fill="#11151F" stroke="#1E2536" />
                    <text x="8" y="10" font-family="Cairo, sans-serif" font-size="5.5" font-weight="700" fill="#F5F7FA">آخر 7 أيام</text>
                    <text x="232" y="10" text-anchor="end" font-family="Cairo, sans-serif" font-size="4.5" fill="#9AA4B2">Revenue ↑</text>

                    <!-- bars -->
                    <rect class="bar bar-1" x="14"  y="68" width="20" height="0" rx="2" fill="url(#web-bar)" />
                    <rect class="bar bar-2" x="46"  y="68" width="20" height="0" rx="2" fill="url(#web-bar)" />
                    <rect class="bar bar-3" x="78"  y="68" width="20" height="0" rx="2" fill="url(#web-bar)" />
                    <rect class="bar bar-4" x="110" y="68" width="20" height="0" rx="2" fill="url(#web-bar)" />
                    <rect class="bar bar-5" x="142" y="68" width="20" height="0" rx="2" fill="url(#web-bar)" />
                    <rect class="bar bar-6" x="174" y="68" width="20" height="0" rx="2" fill="url(#web-bar)" />
                    <rect class="bar bar-7" x="206" y="68" width="20" height="0" rx="2" fill="url(#web-bar)" />

                    <!-- baseline -->
                    <line x1="10" y1="68" x2="234" y2="68" stroke="#1E2536" stroke-width="0.5" />

                    <!-- Day labels -->
                    <g fill="#9AA4B2" font-family="IBM Plex Mono, monospace" font-size="3.5" text-anchor="middle">
                      <text x="24"  y="76">س</text>
                      <text x="56"  y="76">ج</text>
                      <text x="88"  y="76">خ</text>
                      <text x="120" y="76">ر</text>
                      <text x="152" y="76">ث</text>
                      <text x="184" y="76">ا</text>
                      <text x="216" y="76">ح</text>
                    </g>

                    <!-- top trend line -->
                    <path class="trend-line" d="M 24 50 L 56 42 L 88 46 L 120 36 L 152 32 L 184 24 L 216 18"
                          fill="none" stroke="#00C6FF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" opacity="0.85"/>
                    <circle class="trend-dot trend-dot-1" cx="24"  cy="50" r="1.6" fill="#00C6FF" />
                    <circle class="trend-dot trend-dot-2" cx="56"  cy="42" r="1.6" fill="#00C6FF" />
                    <circle class="trend-dot trend-dot-3" cx="88"  cy="46" r="1.6" fill="#00C6FF" />
                    <circle class="trend-dot trend-dot-4" cx="120" cy="36" r="1.6" fill="#00C6FF" />
                    <circle class="trend-dot trend-dot-5" cx="152" cy="32" r="1.6" fill="#00C6FF" />
                    <circle class="trend-dot trend-dot-6" cx="184" cy="24" r="1.6" fill="#00C6FF" />
                    <circle class="trend-dot trend-dot-7" cx="216" cy="18" r="2.4" fill="#00C6FF" />
                  </g>
                </g>

                <!-- Glass shine overlay -->
                <rect x="0" y="0" width="320" height="200" rx="14" fill="url(#web-shine)" pointer-events="none" />
              </g>

              <!-- floating cursor -->
              <g class="browser-cursor" transform="translate(220, 170)">
                <path d="M 0 0 L 0 12 L 3.5 9 L 6 14 L 8 13 L 5.5 8 L 9.5 7.5 Z" fill="#F5F7FA" stroke="#00C6FF" stroke-width="1" />
              </g>

              <!-- notification toast popping out -->
              <g class="web-toast" transform="translate(36, 6)">
                <rect x="0" y="0" width="92" height="20" rx="10" fill="#11151F" stroke="#28C840" stroke-width="1" />
                <circle cx="10" cy="10" r="4" fill="#28C840" />
                <path d="M 8 10 L 9.4 11.4 L 12.4 8.4" fill="none" stroke="#0a0e1a" stroke-width="1.2" stroke-linecap="round" />
                <rect x="20" y="6"  width="50" height="3" rx="1.5" fill="#F5F7FA" />
                <rect x="20" y="12" width="34" height="3" rx="1.5" fill="#9AA4B2" opacity="0.6" />
              </g>
            </svg>
          </div>

          <!-- Card content -->
          <div class="spec-content">
            <div class="spec-icon-row">
              <span class="spec-emoji spec-emoji-web" aria-hidden="true">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="2" y1="12" x2="22" y2="12"></line>
                  <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                </svg>
              </span>
              <span class="spec-track">{{ locale === 'ar' ? 'تخصص رقم 1' : 'Track 01' }}</span>
            </div>

            <h3 class="spec-title">{{ t('spec_web_title') }}</h3>
            <p class="spec-desc">{{ t('spec_web_desc') }}</p>
          </div>
        </article>

        <!-- =============== MOBILE APPLICATIONS CARD =============== -->
        <article
          class="spec-card spec-card-mobile reveal-item reveal-card-2"
          @mousemove="handleMouseMove($event, 'mobile')"
          @mouseleave="handleMouseLeave('mobile')"
          :style="tiltMobile"
        >
          <div class="spec-halo spec-halo-mobile" aria-hidden="true"></div>
          <div class="spec-border-shine spec-border-shine-mobile" aria-hidden="true"></div>

          <div class="spec-stage" :style="stageMobile">
            <span class="float-spark spark-1 spark-mobile" aria-hidden="true"></span>
            <span class="float-spark spark-2 spark-mobile" aria-hidden="true"></span>
            <span class="float-spark spark-3 spark-mobile" aria-hidden="true"></span>

            <!-- 3D-tilted iPhone -->
            <svg
              class="phone-svg"
              viewBox="0 0 360 240"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
              role="img"
              aria-label="Mobile application mockup"
            >
              <defs>
                <linearGradient id="phone-frame" x1="0%" y1="0%" x2="0%" y2="100%">
                  <stop offset="0%" stop-color="#1a2030" />
                  <stop offset="50%" stop-color="#0a0e1a" />
                  <stop offset="100%" stop-color="#101622" />
                </linearGradient>
                <linearGradient id="phone-screen" x1="0%" y1="0%" x2="0%" y2="100%">
                  <stop offset="0%" stop-color="#1E2536" />
                  <stop offset="100%" stop-color="#0F1525" />
                </linearGradient>
                <linearGradient id="mob-blue" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#00C6FF" />
                  <stop offset="100%" stop-color="#1E90FF" />
                </linearGradient>
                <radialGradient id="notif-red" cx="50%" cy="50%" r="50%">
                  <stop offset="0%" stop-color="#FF3B6B" />
                  <stop offset="100%" stop-color="#E11D48" />
                </radialGradient>
                <linearGradient id="phone-shine" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#ffffff" stop-opacity="0.10" />
                  <stop offset="40%" stop-color="#ffffff" stop-opacity="0" />
                  <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
                </linearGradient>
                <filter id="phone-shadow" x="-20%" y="-20%" width="140%" height="140%">
                  <feGaussianBlur stdDeviation="8" />
                </filter>
              </defs>

              <!-- Big under shadow -->
              <ellipse cx="180" cy="225" rx="80" ry="8" fill="#000" opacity="0.55" filter="url(#phone-shadow)" />

              <!-- ============ iPhone frame + screen ============ -->
              <g class="phone-body" transform="translate(125, 12)">
                <!-- Outer bezel (slight shadow side) -->
                <rect x="-2" y="-2" width="116" height="212" rx="26" fill="#000" opacity="0.6" />
                <!-- Frame -->
                <rect x="0" y="0" width="112" height="208" rx="24" fill="url(#phone-frame)" stroke="#000" stroke-width="0.5" />
                <!-- Screen inset -->
                <rect x="4" y="4" width="104" height="200" rx="20" fill="url(#phone-screen)" />

                <!-- Side buttons -->
                <rect x="-1" y="30" width="1.5" height="14" rx="1" fill="#000" />
                <rect x="-1" y="50" width="1.5" height="20" rx="1" fill="#000" />
                <rect x="-1" y="76" width="1.5" height="20" rx="1" fill="#000" />
                <rect x="111.5" y="56" width="1.5" height="28" rx="1" fill="#000" />

                <!-- Dynamic Island -->
                <rect x="38" y="9" width="36" height="9" rx="4.5" fill="#000" />
                <circle cx="68" cy="13.5" r="1.4" fill="#1a2030" />

                <!-- ============ iOS UI ============ -->
                <!-- Status bar (right-aligned for AR / realistic look) -->
                <text x="98" y="26" text-anchor="end" font-family="Cairo, sans-serif" font-size="7" font-weight="700" fill="#F5F7FA">9:41</text>
                <!-- Signal bars -->
                <g transform="translate(14, 22)">
                  <rect x="0"  y="3" width="1.5" height="3" rx="0.5" fill="#F5F7FA" />
                  <rect x="2.5" y="2" width="1.5" height="4" rx="0.5" fill="#F5F7FA" />
                  <rect x="5"  y="1" width="1.5" height="5" rx="0.5" fill="#F5F7FA" />
                  <rect x="7.5" y="0" width="1.5" height="6" rx="0.5" fill="#F5F7FA" />
                </g>
                <!-- Wifi -->
                <g transform="translate(26, 22)">
                  <path d="M 0 4 A 5 5 0 0 1 10 4" fill="none" stroke="#F5F7FA" stroke-width="1.2" stroke-linecap="round" />
                  <path d="M 1.5 5.5 A 3 3 0 0 1 8.5 5.5" fill="none" stroke="#F5F7FA" stroke-width="1.2" stroke-linecap="round" />
                  <circle cx="5" cy="6.6" r="0.9" fill="#F5F7FA" />
                </g>
                <!-- Battery -->
                <g transform="translate(80, 22)">
                  <rect x="0" y="0" width="14" height="6" rx="1.2" fill="none" stroke="#F5F7FA" stroke-width="0.8" />
                  <rect x="14.5" y="2" width="1" height="2" rx="0.4" fill="#F5F7FA" />
                  <rect class="battery-fill" x="1" y="1" width="0" height="4" rx="0.6" fill="#28C840" />
                </g>

                <!-- Big greeting header -->
                <text x="56" y="48" text-anchor="middle" font-family="Cairo, sans-serif" font-size="9" font-weight="900" fill="#F5F7FA">
                  {{ locale === 'ar' ? 'صباح الخير 👋' : 'Good morning 👋' }}
                </text>
                <text x="56" y="58" text-anchor="middle" font-family="Cairo, sans-serif" font-size="5.5" fill="#9AA4B2">
                  {{ locale === 'ar' ? 'إليك ملخص اليوم' : 'Here is your summary' }}
                </text>

                <!-- Animated notification card -->
                <g class="notif-card-1">
                  <rect x="10" y="68" width="92" height="22" rx="6" fill="#1B202E" stroke="#00C6FF" stroke-width="0.6" />
                  <!-- app icon -->
                  <rect x="13" y="71" width="16" height="16" rx="3.5" fill="url(#mob-blue)" />
                  <path d="M 18 75 L 22 75 L 26 84 L 23 84 Z" fill="white" opacity="0.95" />
                  <!-- text -->
                  <rect x="33" y="73" width="48" height="3" rx="1.5" fill="#F5F7FA" />
                  <rect x="33" y="80" width="62" height="2.5" rx="1.2" fill="#9AA4B2" opacity="0.7" />
                  <rect x="33" y="85" width="40" height="2.5" rx="1.2" fill="#9AA4B2" opacity="0.5" />
                  <text x="94" y="75" text-anchor="end" font-family="IBM Plex Mono, monospace" font-size="3.5" fill="#9AA4B2">الآن</text>
                </g>

                <!-- 2nd notification (smaller, older) -->
                <g class="notif-card-2">
                  <rect x="10" y="94" width="92" height="18" rx="6" fill="#11151F" stroke="#1E2536" stroke-width="0.5" />
                  <rect x="13" y="96" width="14" height="14" rx="3" fill="#1B202E" />
                  <circle cx="20" cy="103" r="3" fill="url(#mob-blue)" />
                  <rect x="31" y="98" width="42" height="3" rx="1.5" fill="#F5F7FA" opacity="0.85" />
                  <rect x="31" y="104" width="56" height="2.5" rx="1.2" fill="#9AA4B2" opacity="0.55" />
                  <text x="94" y="103" text-anchor="end" font-family="IBM Plex Mono, monospace" font-size="3" fill="#9AA4B2">5د</text>
                </g>

                <!-- Quick action row -->
                <g transform="translate(14, 118)">
                  <rect x="0"  y="0" width="20" height="20" rx="5" fill="url(#mob-blue)" />
                  <path d="M 7 6 L 7 14 L 13 10 Z" fill="white" />
                  <text x="10" y="14" text-anchor="middle" font-family="Cairo, sans-serif" font-size="3" font-weight="700" fill="white">تشغيل</text>

                  <rect x="26" y="0" width="20" height="20" rx="5" fill="rgba(0,198,255,0.15)" stroke="#00C6FF" stroke-width="0.5" />
                  <path d="M 33 5 L 39 10 L 33 15" fill="none" stroke="#00C6FF" stroke-width="1.4" stroke-linecap="round" />
                  <text x="36" y="14" text-anchor="middle" font-family="Cairo, sans-serif" font-size="3" font-weight="700" fill="#00C6FF">بيع</text>

                  <rect x="52" y="0" width="20" height="20" rx="5" fill="#1B202E" />
                  <path d="M 58 10 L 66 10" stroke="#9AA4B2" stroke-width="1.5" stroke-linecap="round" />
                  <text x="62" y="14" text-anchor="middle" font-family="Cairo, sans-serif" font-size="3" fill="#9AA4B2">تقرير</text>
                </g>

                <!-- Stats row -->
                <g transform="translate(10, 146)">
                  <rect x="0"  y="0" width="44" height="22" rx="5" fill="#11151F" stroke="#1E2536" stroke-width="0.5" />
                  <text x="6" y="8" font-family="Cairo, sans-serif" font-size="3.5" fill="#9AA4B2">المبيعات</text>
                  <text x="6" y="17" font-family="Cairo, sans-serif" font-size="6.5" font-weight="900" fill="#F5F7FA">24,580</text>
                  <circle cx="38" cy="8" r="2" fill="#28C840" />
                  <path d="M 36 9 L 38 11 L 40.5 7.5" stroke="#11151F" stroke-width="0.8" stroke-linecap="round" fill="none" />

                  <rect x="48" y="0" width="44" height="22" rx="5" fill="#11151F" stroke="#1E2536" stroke-width="0.5" />
                  <text x="54" y="8" font-family="Cairo, sans-serif" font-size="3.5" fill="#9AA4B2">الطلبات</text>
                  <text x="54" y="17" font-family="Cairo, sans-serif" font-size="6.5" font-weight="900" fill="url(#mob-blue)">128</text>
                  <circle cx="86" cy="8" r="2" fill="#00C6FF" />
                  <path d="M 84 9 L 86 11 L 88.5 7.5" stroke="#11151F" stroke-width="0.8" stroke-linecap="round" fill="none" />
                </g>

                <!-- Tab bar -->
                <rect x="4" y="178" width="104" height="26" rx="0" fill="#0a0e1a" />
                <rect x="4" y="178" width="104" height="1" fill="#1E2536" />
                <g transform="translate(0, 184)">
                  <!-- home active -->
                  <g transform="translate(20, 0)">
                    <rect x="-9" y="-1" width="18" height="2" rx="1" fill="url(#mob-blue)" />
                    <path d="M -5 4 L 0 0 L 5 4 L 5 10 L -5 10 Z" fill="url(#mob-blue)" />
                  </g>
                  <!-- search -->
                  <g transform="translate(48, 0)">
                    <circle cx="0" cy="5" r="3.2" fill="none" stroke="#9AA4B2" stroke-width="1.2" />
                    <line x1="2.2" y1="7.2" x2="4.5" y2="9.5" stroke="#9AA4B2" stroke-width="1.2" stroke-linecap="round" />
                  </g>
                  <!-- bell -->
                  <g transform="translate(76, 0)">
                    <path d="M -3 2 C -3 0 -1.5 -1 0 -1 C 1.5 -1 3 0 3 2 L 4 7 L -4 7 Z" fill="#9AA4B2" />
                    <circle cx="0" cy="9" r="1" fill="#9AA4B2" />
                    <circle class="bell-dot" cx="3" cy="0" r="1.6" fill="url(#notif-red)" />
                  </g>
                  <!-- profile -->
                  <g transform="translate(96, 0)">
                    <circle cx="0" cy="3" r="2.5" fill="#9AA4B2" />
                    <path d="M -4 10 C -3 7 3 7 4 10 Z" fill="#9AA4B2" />
                  </g>
                </g>

                <!-- Home indicator -->
                <rect x="42" y="200" width="28" height="2" rx="1" fill="#9AA4B2" opacity="0.7" />

                <!-- Glass shine (top-left) -->
                <path d="M 4 4 L 50 4 L 4 60 Z" fill="url(#phone-shine)" pointer-events="none" />
              </g>

              <!-- floating touch ripple near phone -->
              <g class="touch-ripple" transform="translate(80, 130)">
                <circle r="0" fill="none" stroke="#00C6FF" stroke-width="1.5" opacity="0" />
              </g>
              <g class="touch-ripple touch-ripple-2" transform="translate(228, 156)">
                <circle r="0" fill="none" stroke="#00C6FF" stroke-width="1.5" opacity="0" />
              </g>

              <!-- Pulse rings off phone -->
              <g class="phone-pulse-ring pulse-ring-1" transform="translate(180, 116)">
                <circle cx="0" cy="0" r="60" fill="none" stroke="#00C6FF" stroke-width="0.8" opacity="0" />
              </g>
              <g class="phone-pulse-ring pulse-ring-2" transform="translate(180, 116)">
                <circle cx="0" cy="0" r="60" fill="none" stroke="#00C6FF" stroke-width="0.8" opacity="0" />
              </g>
            </svg>
          </div>

          <div class="spec-content">
            <div class="spec-icon-row">
              <span class="spec-emoji spec-emoji-mobile" aria-hidden="true">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                  <line x1="12" y1="18" x2="12.01" y2="18"></line>
                </svg>
              </span>
              <span class="spec-track">{{ locale === 'ar' ? 'تخصص رقم 2' : 'Track 02' }}</span>
            </div>

            <h3 class="spec-title">{{ t('spec_mobile_title') }}</h3>
            <p class="spec-desc">{{ t('spec_mobile_desc') }}</p>
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

// ============ IntersectionObserver for scroll reveal ============
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
    { threshold: 0.15 },
  )
  if (sectionRef.value) observer.observe(sectionRef.value)
})

onUnmounted(() => {
  if (observer) observer.disconnect()
})

// ============ 3D mouse-tilt parallax ============
const tiltWeb = reactive({ transform: '', transition: 'transform 0.6s cubic-bezier(0.16, 1, 0.3, 1)' })
const tiltMobile = reactive({ transform: '', transition: 'transform 0.6s cubic-bezier(0.16, 1, 0.3, 1)' })
const stageWeb = reactive({ transform: 'translateZ(0)', transition: 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)' })
const stageMobile = reactive({ transform: 'translateZ(0)', transition: 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)' })

function handleMouseMove(e, card) {
  const target = e.currentTarget
  const rect = target.getBoundingClientRect()
  const x = e.clientX - rect.left
  const y = e.clientY - rect.top
  const cx = rect.width / 2
  const cy = rect.height / 2
  // -8 to +8 deg range
  const rx = ((y - cy) / cy) * -6
  const ry = ((x - cx) / cx) * 6

  const tilt = `perspective(900px) rotateX(${rx}deg) rotateY(${ry}deg) translateZ(0)`
  if (card === 'web') {
    tiltWeb.transform = tilt
    stageWeb.transform = `translateX(${(x - cx) * 0.04}px) translateY(${(y - cy) * 0.04}px) translateZ(40px)`
  } else {
    tiltMobile.transform = tilt
    stageMobile.transform = `translateX(${(x - cx) * 0.04}px) translateY(${(y - cy) * 0.04}px) translateZ(40px)`
  }
}

function handleMouseLeave(card) {
  if (card === 'web') {
    tiltWeb.transform = 'perspective(900px) rotateX(0deg) rotateY(0deg) translateZ(0)'
    stageWeb.transform = 'translateZ(0)'
  } else {
    tiltMobile.transform = 'perspective(900px) rotateX(0deg) rotateY(0deg) translateZ(0)'
    stageMobile.transform = 'translateZ(0)'
  }
}
</script>

<style scoped>
/* =================================================================
   Ambient background grid + glows
   ================================================================= */
.ambient-grid {
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(0, 198, 255, 0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(0, 198, 255, 0.04) 1px, transparent 1px);
  background-size: 60px 60px;
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
  top: 5%;
  left: -8%;
  width: 22rem;
  height: 22rem;
  background: radial-gradient(circle, rgba(0, 198, 255, 0.30) 0%, rgba(0, 198, 255, 0) 70%);
  animation: blobDrift1 16s ease-in-out infinite;
}
.ambient-blob-2 {
  bottom: -10%;
  right: -5%;
  width: 24rem;
  height: 24rem;
  background: radial-gradient(circle, rgba(30, 144, 255, 0.22) 0%, rgba(30, 144, 255, 0) 70%);
  animation: blobDrift2 20s ease-in-out infinite 1.5s;
}
.ambient-blob-3 {
  top: 30%;
  right: 20%;
  width: 14rem;
  height: 14rem;
  background: radial-gradient(circle, rgba(167, 139, 250, 0.15) 0%, transparent 70%);
  animation: blobDrift3 18s ease-in-out infinite 3s;
}
@keyframes blobDrift1 {
  0%, 100% { transform: translate(0, 0) scale(1); }
  50%      { transform: translate(40px, -30px) scale(1.1); }
}
@keyframes blobDrift2 {
  0%, 100% { transform: translate(0, 0) scale(1); }
  50%      { transform: translate(-30px, -40px) scale(1.08); }
}
@keyframes blobDrift3 {
  0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.7; }
  50%      { transform: translate(20px, 20px) scale(1.15); opacity: 1; }
}

/* =================================================================
   Card shell with 3D perspective
   ================================================================= */
.spec-card {
  position: relative;
  background: linear-gradient(160deg, rgba(20, 25, 38, 0.9) 0%, rgba(10, 14, 26, 0.9) 100%);
  border: 1px solid rgba(30, 37, 54, 0.9);
  border-radius: 1.75rem;
  padding: 1.75rem;
  overflow: hidden;
  backdrop-filter: blur(10px);
  transition: border-color 0.5s ease, box-shadow 0.5s ease;
  isolation: isolate;
  transform-style: preserve-3d;
  will-change: transform;
}

.spec-card-web    { box-shadow: 0 6px 36px rgba(0, 198, 255, 0.06), inset 0 1px 0 rgba(255, 255, 255, 0.04); }
.spec-card-mobile { box-shadow: 0 6px 36px rgba(30, 144, 255, 0.06), inset 0 1px 0 rgba(255, 255, 255, 0.04); }

.spec-card:hover {
  border-color: rgba(0, 198, 255, 0.55);
  box-shadow:
    0 20px 70px rgba(0, 198, 255, 0.25),
    0 4px 14px rgba(30, 144, 255, 0.15),
    inset 0 1px 0 rgba(255, 255, 255, 0.10);
}

/* Inner halo (intensifies on hover) */
.spec-halo {
  position: absolute;
  inset: 0;
  border-radius: 1.75rem;
  pointer-events: none;
  z-index: -1;
  opacity: 0.45;
  transition: opacity 0.5s ease;
}
.spec-halo-web    { background: radial-gradient(circle at 30% 0%, rgba(0, 198, 255, 0.35), transparent 55%); }
.spec-halo-mobile { background: radial-gradient(circle at 70% 0%, rgba(30, 144, 255, 0.30), transparent 55%); }
.spec-card:hover .spec-halo { opacity: 0.85; }

/* Sweeping highlight on top border */
.spec-border-shine {
  position: absolute;
  inset: 0;
  border-radius: 1.75rem;
  padding: 1px;
  background: linear-gradient(120deg, transparent 30%, rgba(255, 255, 255, 0.18) 50%, transparent 70%);
  -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
  mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
  -webkit-mask-composite: xor;
          mask-composite: exclude;
  pointer-events: none;
  opacity: 0;
  transition: opacity 0.5s ease;
}
.spec-card:hover .spec-border-shine { opacity: 1; }

/* =================================================================
   3D illustration stage with perspective
   ================================================================= */
.spec-stage {
  width: 100%;
  max-width: 420px;
  height: 240px;
  margin: 0 auto 1.5rem;
  position: relative;
  perspective: 1000px;
  perspective-origin: 50% 50%;
}

/* Floating spark decorations */
.float-spark {
  position: absolute;
  border-radius: 9999px;
  background: radial-gradient(circle, #00C6FF, transparent 60%);
  pointer-events: none;
  z-index: 0;
}
.spark-1 { top: 8%;  left: -2%; width: 18px; height: 18px; animation: sparkFloat1 5s ease-in-out infinite; }
.spark-2 { top: 60%; right: 4%; width: 12px; height: 12px; animation: sparkFloat2 6s ease-in-out infinite 0.4s; }
.spark-3 { top: 30%; right: -4%; width: 14px; height: 14px; animation: sparkFloat3 7s ease-in-out infinite 1s; }
.spark-mobile.spark-1 { top: 12%; left: 6%;  }
.spark-mobile.spark-2 { top: 50%; right: 8%; }
.spark-mobile.spark-3 { top: 75%; left: 12%; }

@keyframes sparkFloat1 { 0%,100%{transform:translateY(0) scale(1);opacity:.6} 50%{transform:translateY(-10px) scale(1.3);opacity:1} }
@keyframes sparkFloat2 { 0%,100%{transform:translateY(0) scale(1);opacity:.5} 50%{transform:translateY(-7px) scale(1.2);opacity:1} }
@keyframes sparkFloat3 { 0%,100%{transform:translateY(0) scale(1);opacity:.7} 50%{transform:translateY(-12px) scale(1.4);opacity:1} }

.browser-svg, .phone-svg {
  width: 100%;
  height: 100%;
  filter: drop-shadow(0 25px 35px rgba(0, 0, 0, 0.5));
  transform-style: preserve-3d;
}

/* =================================================================
   WEB SVG animations
   ================================================================= */
.browser-shadow {
  animation: shadowBreathe 6s ease-in-out infinite;
  transform-origin: center;
  transform-box: fill-box;
}
@keyframes shadowBreathe {
  0%, 100% { transform: scaleX(1); opacity: 0.55; }
  50%      { transform: scaleX(1.04); opacity: 0.4; }
}

.tab {
  transform-box: fill-box;
  transform-origin: center;
  transition: opacity 0.3s ease;
}
.tab-inactive { opacity: 0.7; }

.bar {
  transform-origin: bottom center;
  transform-box: fill-box;
  animation: barGrow 5s cubic-bezier(0.34, 1.56, 0.64, 1) infinite;
}
.bar-1 { animation-delay: 0.0s; --h: 38; }
.bar-2 { animation-delay: 0.2s; --h: 26; }
.bar-3 { animation-delay: 0.4s; --h: 44; }
.bar-4 { animation-delay: 0.6s; --h: 32; }
.bar-5 { animation-delay: 0.8s; --h: 48; }
.bar-6 { animation-delay: 1.0s; --h: 36; }
.bar-7 { animation-delay: 1.2s; --h: 54; }

@keyframes barGrow {
  0%       { height: 0; }
  25%      { height: var(--h); }
  75%      { height: var(--h); }
  100%     { height: 0; }
}

.trend-line {
  stroke-dasharray: 280;
  stroke-dashoffset: 280;
  animation: trendDraw 4s cubic-bezier(0.16, 1, 0.3, 1) 0.5s infinite;
}
@keyframes trendDraw {
  0%   { stroke-dashoffset: 280; opacity: 0; }
  20%  { opacity: 0.9; }
  50%  { stroke-dashoffset: 0; opacity: 0.9; }
  90%  { opacity: 0.9; }
  100% { stroke-dashoffset: 0; opacity: 0; }
}

.trend-dot {
  opacity: 0;
  animation: dotPop 4s ease-out 0.5s infinite;
}
.trend-dot-1 { animation-delay: 0.6s; }
.trend-dot-2 { animation-delay: 0.9s; }
.trend-dot-3 { animation-delay: 1.2s; }
.trend-dot-4 { animation-delay: 1.5s; }
.trend-dot-5 { animation-delay: 1.8s; }
.trend-dot-6 { animation-delay: 2.1s; }
.trend-dot-7 { animation-delay: 2.4s; }

@keyframes dotPop {
  0%        { opacity: 0; transform: scale(0); }
  10%       { opacity: 1; transform: scale(1.5); }
  20%, 80%  { opacity: 1; transform: scale(1); }
  100%      { opacity: 0; transform: scale(1); }
}

.browser-cursor {
  animation: cursorGlide 6s cubic-bezier(0.16, 1, 0.3, 1) infinite;
}
@keyframes cursorGlide {
  0%, 100% { transform: translate(220px, 170px); }
  20%      { transform: translate(180px, 130px); }
  35%      { transform: translate(200px, 150px); }
  55%      { transform: translate(150px, 110px); }
  75%      { transform: translate(190px, 140px); }
}

.web-toast {
  transform-box: fill-box;
  transform-origin: center;
  animation: toastPop 5s cubic-bezier(0.34, 1.56, 0.64, 1) 2s infinite;
}
@keyframes toastPop {
  0%, 8%, 100%    { transform: translateY(-30px) scale(0.85); opacity: 0; }
  15%             { transform: translateY(0)     scale(1);    opacity: 1; }
  60%             { transform: translateY(0)     scale(1);    opacity: 1; }
  85%             { transform: translateY(-10px) scale(0.95); opacity: 0; }
}

/* =================================================================
   PHONE SVG animations
   ================================================================= */
.phone-pulse-ring circle {
  transform-box: fill-box;
  transform-origin: center;
  animation: pulseRing 3.5s ease-out infinite;
}
.pulse-ring-1 circle { animation-delay: 0s; }
.pulse-ring-2 circle { animation-delay: 1.7s; }

@keyframes pulseRing {
  0%        { opacity: 0.65; transform: scale(0.6); }
  100%      { opacity: 0;    transform: scale(1.6); }
}

.battery-fill {
  animation: batteryCharge 4s ease-in-out infinite;
}
@keyframes batteryCharge {
  0%       { width: 0; }
  35%      { width: 12; }
  85%      { width: 12; }
  100%     { width: 0; }
}

.bell-dot {
  transform-box: fill-box;
  transform-origin: center;
  animation: bellPulse 1.6s ease-in-out infinite;
}
@keyframes bellPulse {
  0%, 100% { transform: scale(1); }
  50%      { transform: scale(1.4); }
}

.notif-card-1 {
  transform-box: fill-box;
  transform-origin: left center;
  animation: notifSlide 5s cubic-bezier(0.16, 1, 0.3, 1) infinite;
}
@keyframes notifSlide {
  0%, 4%      { transform: translateY(-12px); opacity: 0; }
  12%, 70%    { transform: translateY(0); opacity: 1; }
  85%, 100%   { transform: translateY(-12px); opacity: 0; }
}
.notif-card-2 {
  transform-box: fill-box;
  transform-origin: left center;
  animation: notifSlide 5s cubic-bezier(0.16, 1, 0.3, 1) infinite 0.6s;
}

.touch-ripple circle {
  transform-box: fill-box;
  transform-origin: center;
  animation: touchRipple 2.6s ease-out infinite;
}
.touch-ripple-2 circle { animation-delay: 1s; }

@keyframes touchRipple {
  0%       { opacity: 0.7; r: 0; }
  100%     { opacity: 0;   r: 22; }
}

.phone-body {
  transform-box: fill-box;
  transform-origin: center;
  animation: phoneFloat 5s ease-in-out infinite;
}
@keyframes phoneFloat {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  50%      { transform: translateY(-4px) rotate(-0.6deg); }
}

/* =================================================================
   Card text content
   ================================================================= */
.spec-content { text-align: start; }

.spec-icon-row {
  display: flex;
  align-items: center;
  gap: 0.6rem;
  margin-bottom: 0.85rem;
}
.spec-emoji {
  width: 2.4rem;
  height: 2.4rem;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  color: #00C6FF;
  border-radius: 0.75rem;
  transition: transform 0.4s ease;
  border: 1px solid rgba(0, 198, 255, 0.3);
  box-shadow: 0 0 14px rgba(0, 198, 255, 0.12);
}
.spec-emoji-web    { background: rgba(0, 198, 255, 0.10); }
.spec-emoji-mobile { background: rgba(30, 144, 255, 0.10); }

.spec-card:hover .spec-emoji { transform: scale(1.10) rotate(-6deg); }

.spec-track {
  font-family: 'IBM Plex Mono', monospace;
  font-size: 0.7rem;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: #00C6FF;
  font-weight: 600;
}

.spec-title {
  font-family: 'Cairo', sans-serif;
  font-weight: 800;
  font-size: 1.55rem;
  line-height: 1.25;
  color: #F5F7FA;
  margin-bottom: 0.7rem;
}

.spec-desc {
  color: #9AA4B2;
  font-size: 0.95rem;
  line-height: 1.75;
  margin-bottom: 1.2rem;
}

.spec-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}
.spec-tag {
  display: inline-flex;
  align-items: center;
  gap: 0.35rem;
  padding: 0.35rem 0.75rem;
  font-family: 'IBM Plex Mono', monospace;
  font-size: 0.72rem;
  font-weight: 500;
  color: #E1E7F0;
  background: rgba(0, 198, 255, 0.08);
  border: 1px solid rgba(0, 198, 255, 0.18);
  border-radius: 9999px;
  transition: all 0.3s ease;
}
.spec-card:hover .spec-tag {
  background: rgba(0, 198, 255, 0.18);
  border-color: rgba(0, 198, 255, 0.45);
  color: #00C6FF;
}

/* =================================================================
   Scroll-triggered entrance
   ================================================================= */
.reveal-item {
  opacity: 0;
  transform: translateY(40px);
  transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1),
              transform 0.9s cubic-bezier(0.16, 1, 0.3, 1);
}
.is-visible .reveal-header { opacity: 1; transform: translateY(0); transition-delay: 0.05s; }
.is-visible .reveal-card-1 { opacity: 1; transform: translateY(0); transition-delay: 0.25s; }
.is-visible .reveal-card-2 { opacity: 1; transform: translateY(0); transition-delay: 0.45s; }

/* =================================================================
   Accessibility — prefers-reduced-motion
   ================================================================= */
@media (prefers-reduced-motion: reduce) {
  .reveal-item {
    opacity: 1;
    transform: none;
    transition: none;
  }
  .ambient-blob,
  .browser-shadow,
  .bar, .trend-line, .trend-dot,
  .browser-cursor, .web-toast,
  .phone-pulse-ring circle, .battery-fill, .bell-dot,
  .notif-card-1, .notif-card-2,
  .touch-ripple circle,
  .phone-body,
  .float-spark {
    animation: none !important;
  }
  .spec-card,
  .spec-emoji, .spec-tag,
  .spec-border-shine {
    transition: none !important;
  }
  .spec-card { transform: none !important; }
}
</style>
