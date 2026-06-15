<template>
  <div class="min-h-screen bg-warm-50 text-charcoal-900 font-body flex flex-col justify-between">
    <!-- Navbar -->
    <TheNavbar />

    <!-- Main Content -->
    <main class="flex-grow max-w-4xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-12 flex items-center justify-center">
      <div class="bg-white rounded-2xl shadow-xl border border-warm-border p-6 sm:p-10 w-full overflow-hidden relative">
        <!-- Background decorative blobs -->
        <div class="absolute -top-24 -left-24 w-48 h-48 bg-primary-100 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-primary-200 rounded-full blur-3xl opacity-40 pointer-events-none"></div>

        <!-- Success State -->
        <div v-if="submitted" class="text-center py-12 px-4 flex flex-col items-center justify-center animate-fade-in">
          <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center border border-green-200 text-green-500 text-3xl mb-6 shadow-sm scale-up">
            ✓
          </div>
          <h2 class="text-2xl font-bold text-charcoal-800 mb-3">تم إرسال طلبك بنجاح!</h2>
          <p class="text-charcoal-600 max-w-md mx-auto mb-8 leading-relaxed text-sm">
            شكرًا لتواصلك معنا. سنقوم بمراجعة طلبك والتواصل معك عبر الهاتف أو الواتساب في أقرب وقت ممكن لمناقشة التفاصيل وتفعيل النظام.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center w-full max-w-xs">
            <router-link to="/" class="bg-charcoal-800 hover:bg-charcoal-900 text-primary-200 font-display font-bold py-3.5 px-6 rounded-xl transition-all duration-300 shadow-md text-center text-sm">
              العودة للرئيسية
            </router-link>
          </div>
        </div>

        <!-- Form State -->
        <div v-else class="relative z-10">
          <div class="text-right mb-8 border-b border-warm-border pb-6">
            <h2 class="text-2xl font-black text-charcoal-900 mb-2">طلب استشارة وتفعيل النظام</h2>
            <p class="text-charcoal-500 text-sm">يرجى ملء النموذج التالي، وسيتواصل معك أحد مستشارينا الفنيين خلال 24 ساعة.</p>
          </div>

          <!-- LeadForm Component -->
          <LeadForm @success="submitted = true" />
        </div>

      </div>
    </main>

    <!-- Footer -->
    <TheFooter />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import TheNavbar from '../../components/layout/TheNavbar.vue'
import TheFooter from '../../components/layout/TheFooter.vue'
import LeadForm from '../../components/contact/LeadForm.vue'

const submitted = ref(false)
</script>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes scaleUp {
  from { transform: scale(0.9); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}

.animate-fade-in {
  animation: fadeIn 0.4s ease-out forwards;
}

.scale-up {
  animation: scaleUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
}
</style>
