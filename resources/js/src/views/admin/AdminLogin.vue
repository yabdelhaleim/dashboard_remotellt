<template>
  <div class="min-h-screen flex items-center justify-center bg-warm-50 px-4 sm:px-6 lg:px-8 text-right font-body">
    <div class="bg-white rounded-2xl shadow-xl border border-warm-border p-8 w-full max-w-sm relative overflow-hidden">
      <!-- Background decorative blur -->
      <div class="absolute -top-20 -left-20 w-40 h-40 bg-primary-100 rounded-full blur-2xl opacity-60 pointer-events-none"></div>

      <!-- Header/Logo -->
      <div class="text-center mb-8 relative z-10">
        <span class="font-display font-black text-3xl tracking-wider text-charcoal-800 select-none">
          REMOTE<span class="text-primary-400">lly</span>
        </span>
        <h2 class="text-xs text-charcoal-400 font-mono tracking-widest uppercase mt-2">
          Admin Dashboard Portal
        </h2>
      </div>

      <!-- Form -->
      <form @submit.prevent="submit" class="space-y-5 relative z-10">
        <div>
          <label for="admin-password" class="block text-sm font-medium text-charcoal-700 mb-1.5">كلمة المرور</label>
          <input 
            id="admin-password"
            v-model="password" 
            type="password" 
            placeholder="••••••••"
            class="w-full px-4 py-3 rounded-xl border border-warm-border bg-warm-50/50 text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent transition-all duration-300 text-sm text-left font-mono" 
            dir="ltr"
            required
          />
        </div>

        <button 
          type="submit" 
          class="w-full bg-charcoal-800 hover:bg-charcoal-900 text-primary-200 font-display font-bold py-3.5 px-6 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center gap-2 hover:-translate-y-0.5 active:translate-y-0 text-sm cursor-pointer"
        >
          <span>تسجيل الدخول</span>
          <span>←</span>
        </button>
      </form>

      <!-- Error State -->
      <div v-if="error" class="mt-4 text-center text-xs font-bold text-red-600 bg-red-50 py-2 rounded-lg border border-red-100 font-body animate-pulse">
        ⚠️ كلمة مرور خاطئة، يرجى المحاولة مرة أخرى
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../../stores/useAuthStore'

const password = ref('')
const error = ref(false)
const router = useRouter()
const auth = useAuthStore()

async function submit() {
  error.value = false
  const ok = auth.login(password.value)
  if (ok) {
    router.push('/admin/requests')
  } else {
    error.value = true
  }
}
</script>
