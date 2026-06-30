<template>
  <footer class="bg-dark-bg text-white border-t border-dark-border py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="flex flex-col md:flex-row justify-between items-center gap-8">
        
        <!-- Brand -->
        <div class="text-center md:text-right space-y-3">
          <router-link to="/" class="inline-block mx-auto md:mx-0">
            <BrandLogo3D />
          </router-link>
          <p class="font-body font-normal text-dark-muted text-sm mt-2 leading-ar-normal">
            {{ t('footer_desc') }}
          </p>
        </div>

        <!-- Links -->
        <div class="flex flex-wrap justify-center gap-7">
          <router-link to="/" class="font-display font-semibold text-sm text-slate-400 hover:text-vibrant-purple transition-all duration-300">{{ t('home') }}</router-link>
          <a href="/#products" class="font-display font-semibold text-sm text-slate-400 hover:text-vibrant-purple transition-all duration-300">{{ t('solutions') }}</a>
          <a href="/#how-it-works" class="font-display font-semibold text-sm text-slate-400 hover:text-vibrant-purple transition-all duration-300">{{ t('how_works') }}</a>
          <router-link to="/admin" class="font-display font-semibold text-sm text-vibrant-cyan hover:text-cyan-300 transition-all duration-300">{{ t('admin') }}</router-link>
        </div>

      </div>

      <!-- Divider -->
      <div class="border-t border-dark-border/40 my-8"></div>

      <!-- Copyright -->
      <div class="text-center">
        <span class="font-body font-normal text-dark-muted text-sm">
          {{ t('copyright').replace('{year}', new Date().getFullYear().toString()) }}
        </span>
      </div>

    </div>
  </footer>
</template>

<script setup>
import { locale } from '../../utils/locale'
import { translations } from '../../utils/translations'
import BrandLogo3D from './BrandLogo3D.vue'

function t(key) {
  return translations[locale.value][key] || key
}
</script>
