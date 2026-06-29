<template>
  <div class="min-h-screen bg-dark-bg text-dark-text flex flex-col justify-between overflow-x-hidden relative">
    
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
      <div class="bg-gradient-to-br from-primary-600 via-primary-800 to-dark-bg text-white rounded-3xl p-8 sm:p-12 border border-dark-border shadow-xl mb-12 relative overflow-hidden">
        <!-- Background decorative blur inside banner -->
        <div class="absolute -left-16 -top-16 w-56 h-56 bg-vibrant-purple rounded-full blur-3xl opacity-30"></div>
        <div class="absolute -right-16 -bottom-16 w-56 h-56 bg-vibrant-cyan rounded-full blur-3xl opacity-20"></div>
        
        <div class="relative z-10 max-w-3xl">
          <span class="inline-block px-3 py-1 bg-white/10 text-slate-300 rounded-full text-[10px] font-mono font-bold tracking-widest uppercase mb-4 border border-white/5">
            نظام سحابي ذكي
          </span>
          <h1 class="font-display font-extrabold text-3xl sm:text-4xl text-white mb-4 leading-normal">{{ product.name }}</h1>
          <p class="font-body text-slate-200 text-sm sm:text-base leading-relaxed font-normal">{{ product.description }}</p>
        </div>
      </div>

      <!-- Packages Grid -->
      <div v-if="product.packages && product.packages.length > 0">
        <h2 class="font-display font-bold text-xl sm:text-2xl text-white mb-6">باقات الاشتراك المتاحة</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <PackageCard 
            v-for="pkg in product.packages"
            :key="pkg.id"
            :pkg="pkg"
            :product="product"
            @open-wizard="isWizardOpen = true"
          />
        </div>
      </div>
      <div v-else class="bg-dark-card border border-dark-border rounded-3xl p-10 text-center shadow-card">
        <span class="text-3xl block mb-4">💬</span>
        <h3 class="font-display font-bold text-lg text-white mb-2">طلب تسعيرة وتفاصيل مخصصة</h3>
        <p class="font-body font-normal text-slate-400 text-sm max-w-md mx-auto mb-6 leading-relaxed">
          هذا النظام يتطلب إعدادات خاصة ونشاطاً تشغيلياً دقيقاً ليتناسب مع حجم نشاطك التجاري. اضغط بالأسفل لحجز استشارتك المجانية لبناء خطتك.
        </p>
        <button 
          @click="isWizardOpen = true"
          class="bg-gradient-to-l from-primary-400 to-vibrant-purple text-white font-display font-bold text-sm py-3 px-8 rounded-xl transition-all cursor-pointer shadow-neon-purple"
        >
          احجز موعد الاستشارة الآن
        </button>
      </div>

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
import { locale } from '../../utils/locale'
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
