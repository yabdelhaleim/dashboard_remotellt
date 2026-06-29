import { ref, watchEffect } from 'vue'

export const locale = ref(localStorage.getItem('remotelly_locale') || 'ar')

export function toggleLocale() {
  locale.value = locale.value === 'ar' ? 'en' : 'ar'
  localStorage.setItem('remotelly_locale', locale.value)
}

// Watch and apply html direction and class automatically
watchEffect(() => {
  if (typeof document !== 'undefined') {
    const isAr = locale.value === 'ar'
    document.documentElement.dir = isAr ? 'rtl' : 'ltr'
    document.documentElement.lang = locale.value
    
    // Toggle font class helper
    if (isAr) {
      document.body.classList.remove('font-en')
      document.body.classList.add('font-ar')
    } else {
      document.body.classList.remove('font-ar')
      document.body.classList.add('font-en')
    }
  }
})
