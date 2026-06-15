<template>
  <nav class="bg-dark-bg/85 backdrop-blur-xl border-b border-dark-border text-white sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-[72px]">
        
        <!-- Logo -->
        <router-link to="/" class="flex items-center gap-2 group shrink-0">
          <span class="font-display font-black text-[1.6rem] tracking-wide text-white select-none leading-none">
            REMOTE<span class="text-vibrant-purple group-hover:text-vibrant-pink transition-colors duration-300 drop-shadow-[0_0_10px_rgba(168,85,247,0.5)]">LLY</span>
          </span>
        </router-link>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-7">
          <router-link
            to="/"
            class="font-display font-semibold text-sm text-slate-200 hover:text-vibrant-purple transition-all duration-300 relative after:absolute after:bottom-[-2px] after:right-0 after:w-0 after:h-[2px] after:bg-vibrant-purple after:rounded-full hover:after:w-full after:transition-all after:duration-300"
          >
            الرئيسية
          </router-link>
          <a
            href="/#products"
            class="font-display font-semibold text-sm text-slate-200 hover:text-vibrant-purple transition-all duration-300 relative after:absolute after:bottom-[-2px] after:right-0 after:w-0 after:h-[2px] after:bg-vibrant-purple after:rounded-full hover:after:w-full after:transition-all after:duration-300"
          >
            الأنظمة والحلول
          </a>
          <a
            href="/#how-it-works"
            class="font-display font-semibold text-sm text-slate-200 hover:text-vibrant-purple transition-all duration-300 relative after:absolute after:bottom-[-2px] after:right-0 after:w-0 after:h-[2px] after:bg-vibrant-purple after:rounded-full hover:after:w-full after:transition-all after:duration-300"
          >
            كيف نعمل؟
          </a>
          <router-link
            to="/support"
            class="font-display font-semibold text-sm text-slate-200 hover:text-vibrant-purple transition-all duration-300 relative after:absolute after:bottom-[-2px] after:right-0 after:w-0 after:h-[2px] after:bg-vibrant-purple after:rounded-full hover:after:w-full after:transition-all after:duration-300"
          >
            الدعم الفني
          </router-link>
          <router-link
            to="/admin"
            class="font-display font-semibold text-sm text-vibrant-cyan hover:text-cyan-300 transition-all duration-300"
          >
            لوحة التحكم 💻
          </router-link>
        </div>

        <!-- Desktop CTA -->
        <div class="hidden md:block">
          <button
            @click="$emit('open-wizard')"
            class="bg-gradient-to-l from-primary-400 to-vibrant-purple hover:opacity-90 text-white font-display font-bold text-sm py-2.5 px-6 rounded-xl shadow-neon-purple/20 transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0 cursor-pointer"
          >
            احجز استشارة مجانية
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
          <router-link to="/" @click="isOpen = false" class="block px-4 py-3 rounded-xl font-display font-semibold text-sm text-slate-300 hover:bg-dark-hover hover:text-white transition-all">الرئيسية</router-link>
          <a href="/#products" @click="isOpen = false" class="block px-4 py-3 rounded-xl font-display font-semibold text-sm text-slate-300 hover:bg-dark-hover hover:text-white transition-all">الأنظمة والحلول</a>
          <a href="/#how-it-works" @click="isOpen = false" class="block px-4 py-3 rounded-xl font-display font-semibold text-sm text-slate-300 hover:bg-dark-hover hover:text-white transition-all">كيف نعمل؟</a>
          <router-link to="/support" @click="isOpen = false" class="block px-4 py-3 rounded-xl font-display font-semibold text-sm text-slate-300 hover:bg-dark-hover hover:text-white transition-all">الدعم الفني</router-link>
          <router-link to="/admin" @click="isOpen = false" class="block px-4 py-3 rounded-xl font-display font-semibold text-sm text-vibrant-cyan hover:bg-dark-hover transition-all">لوحة التحكم 💻</router-link>
          <div class="pt-3 px-0">
            <button
              @click="triggerMobileWizard"
              class="block w-full text-center bg-gradient-to-l from-primary-400 to-vibrant-purple text-white font-display font-bold text-sm py-3.5 rounded-xl transition-all cursor-pointer shadow-neon-purple/20"
            >
              احجز استشارة مجانية
            </button>
          </div>
        </div>
      </div>
    </Transition>
  </nav>
</template>

<script setup>
import { ref } from 'vue'

const emit = defineEmits(['open-wizard'])
const isOpen = ref(false)

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
