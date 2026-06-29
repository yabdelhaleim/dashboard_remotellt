<template>
  <footer class="bg-dark-bg text-white border-t border-dark-border py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="flex flex-col md:flex-row justify-between items-center gap-8">
        
        <!-- Brand -->
        <div class="text-center md:text-right">
          <img :src="'/logo.png'" alt="Remotelly Logo" class="logo-img h-9 w-auto mx-auto md:mx-0 object-contain" />
          <p class="font-body font-normal text-dark-muted text-sm mt-2 leading-ar-normal">
            شريكك التقني الموثوق لبناء وتفعيل الأنظمة السحابية
          </p>
        </div>

        <!-- Links -->
        <div class="flex flex-wrap justify-center gap-7">
          <router-link to="/" class="font-display font-semibold text-sm text-slate-400 hover:text-vibrant-purple transition-all duration-300">الرئيسية</router-link>
          <a href="/#products" class="font-display font-semibold text-sm text-slate-400 hover:text-vibrant-purple transition-all duration-300">الأنظمة والبرامج</a>
          <a href="/#how-it-works" class="font-display font-semibold text-sm text-slate-400 hover:text-vibrant-purple transition-all duration-300">كيف نعمل؟</a>
          <router-link to="/admin" class="font-display font-semibold text-sm text-vibrant-cyan hover:text-cyan-300 transition-all duration-300">لوحة الإدارة 💻</router-link>
        </div>

      </div>

      <!-- Divider -->
      <div class="border-t border-dark-border/40 my-8"></div>

      <!-- Copyright -->
      <div class="text-center">
        <span class="font-body font-normal text-dark-muted text-sm">
          جميع الحقوق محفوظة © {{ new Date().getFullYear() }} REMOTELLY — تصميم وتطوير أنظمة سحابية احترافية
        </span>
      </div>

    </div>
  </footer>
</template>

<script setup>
</script>
