<template>
  <nav class="bg-dark-bg/85 backdrop-blur-xl border-b border-dark-border text-white sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-[72px]">
        
        <!-- Logo -->
        <router-link to="/" class="flex items-center gap-2 group shrink-0">
          <div class="bg-[#FAF8F5] px-4 py-2 rounded-xl flex items-center justify-center border border-dark-border/20 shadow-sm transition-all duration-300 group-hover:border-primary-400/40">
            <img :src="'/logo.png'" alt="Remotelly" class="h-6 w-auto object-contain" />
          </div>
        </router-link>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-7">
          <router-link
            to="/"
            class="font-display font-semibold text-sm text-slate-200 hover:text-vibrant-purple transition-all duration-300 relative after:absolute after:bottom-[-2px] after:right-0 after:w-0 after:h-[2px] after:bg-vibrant-purple after:rounded-full hover:after:w-full after:transition-all after:duration-300"
          >
            {{ t('home') }}
          </router-link>
          <a
            href="/#products"
            class="font-display font-semibold text-sm text-slate-200 hover:text-vibrant-purple transition-all duration-300 relative after:absolute after:bottom-[-2px] after:right-0 after:w-0 after:h-[2px] after:bg-vibrant-purple after:rounded-full hover:after:w-full after:transition-all after:duration-300"
          >
            {{ t('solutions') }}
          </a>
          <a
            href="/#how-it-works"
            class="font-display font-semibold text-sm text-slate-200 hover:text-vibrant-purple transition-all duration-300 relative after:absolute after:bottom-[-2px] after:right-0 after:w-0 after:h-[2px] after:bg-vibrant-purple after:rounded-full hover:after:w-full after:transition-all after:duration-300"
          >
            {{ t('how_works') }}
          </a>
          <router-link
            to="/support"
            class="font-display font-semibold text-sm text-slate-200 hover:text-vibrant-purple transition-all duration-300 relative after:absolute after:bottom-[-2px] after:right-0 after:w-0 after:h-[2px] after:bg-vibrant-purple after:rounded-full hover:after:w-full after:transition-all after:duration-300"
          >
            {{ t('support') }}
          </router-link>
          <router-link
            to="/admin"
            class="font-display font-semibold text-sm text-vibrant-cyan hover:text-cyan-300 transition-all duration-300"
          >
            {{ t('admin') }}
          </router-link>
        </div>

        <!-- Desktop CTA & Language Switcher -->
        <div class="hidden md:flex items-center gap-4">
          <button
            @click="toggleLocale"
            class="bg-dark-card hover:bg-dark-hover text-dark-text border border-dark-border/60 hover:border-primary-400/40 font-display font-semibold text-xs py-2 px-3 rounded-xl transition-all duration-300 cursor-pointer flex items-center gap-1.5"
          >
            <span>🌐</span>
            <span>{{ locale === 'ar' ? 'English' : 'العربية' }}</span>
          </button>
          
          <button
            @click="$emit('open-wizard')"
            class="bg-gradient-to-l from-primary-400 to-vibrant-purple hover:opacity-90 text-white font-display font-bold text-sm py-2.5 px-6 rounded-xl shadow-neon-purple/20 transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0 cursor-pointer"
          >
            {{ t('book_consultation') }}
          </button>
        </div>

        <!-- Mobile Hamburger -->
        <div class="md:hidden">
          <button
            @click="isOpen = !isOpen"
            class="p-2 rounded-xl text-slate-300 hover:text-white hover:bg-dark-hover focus:outline-none transition-colors duration-300 cursor-pointer"
          >
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path v-if="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>

      </div>
    </div>

    <!-- Mobile Drawer -->
    <Transition name="slide-down">
      <div v-if="isOpen" class="md:hidden border-t border-dark-border bg-dark-bg/95 backdrop-blur-xl">
        <div class="px-4 pt-3 pb-5 space-y-1 text-right">
          <router-link to="/" @click="isOpen = false" class="block px-4 py-3 rounded-xl font-display font-semibold text-sm text-slate-300 hover:bg-dark-hover hover:text-white transition-all">{{ t('home') }}</router-link>
          <a href="/#products" @click="isOpen = false" class="block px-4 py-3 rounded-xl font-display font-semibold text-sm text-slate-300 hover:bg-dark-hover hover:text-white transition-all">{{ t('solutions') }}</a>
          <a href="/#how-it-works" @click="isOpen = false" class="block px-4 py-3 rounded-xl font-display font-semibold text-sm text-slate-300 hover:bg-dark-hover hover:text-white transition-all">{{ t('how_works') }}</a>
          <router-link to="/support" @click="isOpen = false" class="block px-4 py-3 rounded-xl font-display font-semibold text-sm text-slate-300 hover:bg-dark-hover hover:text-white transition-all">{{ t('support') }}</router-link>
          <router-link to="/admin" @click="isOpen = false" class="block px-4 py-3 rounded-xl font-display font-semibold text-sm text-vibrant-cyan hover:bg-dark-hover transition-all">{{ t('admin') }}</router-link>
          
          <!-- Mobile Language Selector -->
          <button
            @click="toggleLocale"
            class="w-full text-right px-4 py-3 rounded-xl font-display font-semibold text-sm text-slate-300 hover:bg-dark-hover hover:text-white transition-all flex items-center justify-between cursor-pointer"
          >
            <span>اللغة / Language</span>
            <span class="text-xs bg-dark-bg px-2.5 py-1 rounded-lg border border-dark-border text-primary-400 font-bold">
              {{ locale === 'ar' ? 'English' : 'العربية' }}
            </span>
          </button>

          <div class="pt-3 px-0">
            <button
              @click="triggerMobileWizard"
              class="block w-full text-center bg-gradient-to-l from-primary-400 to-vibrant-purple text-white font-display font-bold text-sm py-3.5 rounded-xl transition-all cursor-pointer shadow-neon-purple/20"
            >
              {{ t('book_consultation') }}
            </button>
          </div>
        </div>
      </div>
    </Transition>
  </nav>
</template>

<script setup>
import { ref } from 'vue'
import { locale, toggleLocale } from '../../utils/locale'
import { translations } from '../../utils/translations'

const emit = defineEmits(['open-wizard'])
const isOpen = ref(false)

function t(key) {
  return translations[locale.value][key] || key
}

function triggerMobileWizard() {
  isOpen.value = false
  setTimeout(() => emit('open-wizard'), 150)
}
</script>

<style scoped>
.slide-down-enter-active,
.slide-down-leave-active {
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  overflow: hidden;
}
.slide-down-enter-from,
.slide-down-leave-to {
  max-height: 0;
  opacity: 0;
}
.slide-down-enter-to,
.slide-down-leave-from {
  max-height: 400px;
  opacity: 1;
}
</style>
