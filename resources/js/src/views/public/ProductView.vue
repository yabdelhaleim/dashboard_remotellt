<template>
  <div class="min-h-screen bg-slate-950 text-white font-body flex flex-col justify-between overflow-x-hidden relative">
    
    <!-- Floating background glow spots -->
    <div class="absolute top-[20%] left-[-10%] w-[500px] h-[500px] bg-primary-400 rounded-full blur-[180px] opacity-10 pointer-events-none"></div>
    <div class="absolute bottom-[20%] right-[-10%] w-[600px] h-[600px] bg-vibrant-purple rounded-full blur-[200px] opacity-15 pointer-events-none"></div>

    <!-- Navbar -->
    <TheNavbar @open-wizard="isWizardOpen = true" />

    <!-- Product Detail Content -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-12 text-right relative z-10">
      
      <!-- Back Link -->
      <div class="mb-6">
        <router-link to="/" class="inline-flex items-center gap-1.5 text-xs text-dark-muted hover:text-vibrant-purple transition-colors duration-300">
          <span>→</span>
          <span>العودة للرئيسية</span>
        </router-link>
      </div>

      <!-- Header Banner (Premium Purple Gradient) -->
      <div class="bg-gradient-to-br from-primary-600 via-primary-800 to-slate-950 text-white rounded-3xl p-8 sm:p-12 border border-dark-border shadow-xl mb-12 relative overflow-hidden">
        <!-- Background decorative blur inside banner -->
        <div class="absolute -left-16 -top-16 w-56 h-56 bg-vibrant-purple rounded-full blur-3xl opacity-30"></div>
        <div class="absolute -right-16 -bottom-16 w-56 h-56 bg-vibrant-cyan rounded-full blur-3xl opacity-20"></div>
        
        <div class="relative z-10 max-w-3xl">
          <span class="inline-block px-3 py-1 bg-white/10 text-slate-300 rounded-full text-[10px] font-mono font-bold tracking-widest uppercase mb-4 border border-white/5">
            نظام سحابي ذكي
          </span>
          <h1 class="font-display font-extrabold text-3xl sm:text-4xl mb-4 select-none">
            {{ product.name }}
          </h1>
          <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-body">
            {{ product.description }}
          </p>
        </div>
      </div>

      <!-- Packages Section -->
      <section v-if="product.packages && product.packages.length > 0" class="mb-12">
        <div class="text-right mb-8">
          <span class="text-xs font-mono font-bold text-vibrant-purple uppercase tracking-wider bg-dark-card px-3 py-1.5 rounded-full border border-dark-border">
            خطط التسعير والاشتراك
          </span>
          <h2 class="font-display font-black text-xl sm:text-2xl text-white mt-3">الباقات والأسعار المتاحة للنظام</h2>
          <p class="text-dark-muted text-xs mt-1">اختر الباقة المناسبة لحجم أعمالك لمناقشتها وتفعيلها في جلسة الاستشارة</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
          <PackageCard 
            v-for="pkg in product.packages" 
            :key="pkg.id" 
            :pkg="pkg"
            @select="handleSelectPackage"
          />
        </div>
      </section>

      <!-- Empty Packages State (Custom system quote request) -->
      <section v-else class="bg-dark-card rounded-3xl border border-dark-border p-8 text-center max-w-xl mx-auto shadow-sm relative overflow-hidden">
        <div class="absolute -left-10 -top-10 w-24 h-24 bg-vibrant-purple rounded-full blur-2xl opacity-10"></div>
        
        <div class="w-14 h-14 bg-primary-400/10 border border-primary-400/30 rounded-full flex items-center justify-center text-vibrant-purple text-2xl mx-auto mb-4">
          💡
        </div>
        <h3 class="font-body font-bold text-base text-white mb-2">طلب تسعيرة فنية مخصصة</h3>
        <p class="text-dark-muted text-xs mb-6 leading-relaxed">
          هذا النظام يتم تفصيله وتهيئته خصيصاً ليناسب طبيعة وحجم نشاطك التجاري بدقة. يرجى حجز موعد جلسة استشارية أونلاين مجانية لمناقشة أفكار النظام والحصول على عرض سعر فني.
        </p>
        <button 
          @click="isWizardOpen = true"
          class="bg-gradient-to-r from-primary-400 to-vibrant-purple text-white font-body font-bold py-3.5 px-8 rounded-2xl transition-all duration-300 shadow-neon-purple/20 hover:shadow-neon-purple inline-flex items-center gap-2 text-xs cursor-pointer hover:-translate-y-0.5 active:translate-y-0"
        >
          <span>احجز استشارة وجدولة المقابلة</span>
          <span>←</span>
        </button>
      </section>

    </main>

    <!-- Footer -->
    <TheFooter />

    <!-- Intake Wizard Modal -->
    <IntakeWizardModal :isOpen="isWizardOpen" @close="isWizardOpen = false" />
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useProductsStore } from '../../stores/useProductsStore'
import TheNavbar from '../../components/layout/TheNavbar.vue'
import TheFooter from '../../components/layout/TheFooter.vue'
import PackageCard from '../../components/product/PackageCard.vue'
import IntakeWizardModal from '../../components/home/IntakeWizardModal.vue'

const route = useRoute()
const router = useRouter()
const productsStore = useProductsStore()

const isWizardOpen = ref(false)

const product = computed(() => {
  return productsStore.findBySlug(route.params.slug) || { name: 'غير معروف', description: '', packages: [] }
})

// Auto-redirect helper if external link is configured
function checkRedirect() {
  if (product.value && product.value.externalUrl) {
    const url = product.value.externalUrl.trim()
    if (url.startsWith('http://') || url.startsWith('https://')) {
      window.location.replace(url)
    } else {
      router.replace(url)
    }
  }
}

onMounted(() => {
  checkRedirect()
})

watch(product, () => {
  checkRedirect()
})

function handleSelectPackage(pkg) {
  // Instead of static contact page, open the intake wizard with prefilled details
  isWizardOpen.value = true
}
</script>
