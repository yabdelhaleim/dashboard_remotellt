<template>
  <form @submit.prevent="onSubmit" class="space-y-5 text-right">
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
      <BaseInput 
        name="name" 
        label="الاسم الكامل *" 
        v-model="form.name" 
        placeholder="مثال: أحمد محمد"
        required 
      />

      <BaseInput 
        name="phone" 
        type="tel" 
        label="رقم الهاتف *" 
        v-model="form.phone" 
        placeholder="مثال: 01012345678"
        required 
        dir="ltr"
        class="text-left"
      />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
      <BaseInput 
        name="address" 
        label="العنوان / المدينة *" 
        v-model="form.address" 
        placeholder="مثال: القاهرة، مدينة نصر"
        required 
      />

      <BaseInput 
        name="whatsapp" 
        type="tel" 
        label="رقم الواتساب (إذا كان مختلفاً)" 
        v-model="form.whatsapp" 
        placeholder="مثال: 01012345678"
        dir="ltr"
        class="text-left"
      />
    </div>

    <BaseInput 
      name="business" 
      label="نوع النشاط التجاري *" 
      v-model="form.business" 
      placeholder="مثال: محل ملابس، مطعم، سوبرماركت، مصنع..." 
      required 
    />

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
      <BaseSelect 
        name="product" 
        label="البرنامج المطلوب *" 
        :options="productOptions" 
        v-model="form.product" 
        required
      />

      <!-- Package Selection (show only if product has packages) -->
      <BaseSelect 
        v-if="hasPackages"
        name="package" 
        label="الباقة المفضلة" 
        :options="packageOptions" 
        v-model="form.package" 
      />
      <div v-else class="flex flex-col justify-end">
        <div class="text-xs text-charcoal-400 bg-warm-100 p-4 rounded-xl border border-warm-border h-12 flex items-center justify-center font-body">
          لا توجد باقات محددة لهذا النظام (سيتم تفصيل تسعيرة خاصة)
        </div>
      </div>
    </div>

    <label class="block text-right">
      <span class="text-sm font-medium text-charcoal-700">ملاحظات أو متطلبات خاصة</span>
      <textarea 
        v-model="form.notes" 
        placeholder="مثال: أريد ربط النظام مع قارئ باركود وطابعة فواتير..."
        class="mt-1.5 block w-full rounded-xl border border-warm-border p-3 bg-warm-50/50 text-charcoal-900 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent transition-all duration-300 text-sm font-body" 
        rows="4"
      ></textarea>
    </label>

    <div class="pt-4 flex justify-end">
      <BaseButton type="submit" variant="primary" class="w-full sm:w-auto px-8 py-4">
        <span>إرسال طلب التفعيل</span>
        <span>←</span>
      </BaseButton>
    </div>

  </form>
</template>

<script setup>
import { reactive, computed, onMounted, watch } from 'vue'
import { useRoute } from 'vue-router'
import BaseInput from '../ui/BaseInput.vue'
import BaseSelect from '../ui/BaseSelect.vue'
import BaseButton from '../ui/BaseButton.vue'
import { useRequestsStore } from '../../stores/useRequestsStore'
import { useProductsStore } from '../../stores/useProductsStore'
import { useNotification } from '../../composables/useNotification'

const emit = defineEmits(['success'])

const route = useRoute()
const products = useProductsStore()
const requests = useRequestsStore()
const notifier = useNotification()

const form = reactive({ 
  name: '', 
  address: '', 
  phone: '', 
  whatsapp: '', 
  business: '', 
  product: '', 
  package: '', 
  notes: '' 
})

const productOptions = computed(() => {
  return products.products.map(p => ({ value: p.slug, label: p.name }))
})

const currentProductObj = computed(() => {
  return products.products.find(x => x.slug === form.product)
})

const hasPackages = computed(() => {
  return currentProductObj.value && currentProductObj.value.packages && currentProductObj.value.packages.length > 0
})

const packageOptions = computed(() => {
  const p = currentProductObj.value
  return p && p.packages 
    ? p.packages.map(pk => ({ value: pk.id, label: `${pk.name} (${pk.price} ج/شهر)` })) 
    : []
})

// Initialize from route parameters
onMounted(() => {
  if (products.products.length > 0) {
    form.product = products.products[0].slug
  }

  const queryProduct = route.query.product
  const queryPackage = route.query.package

  if (queryProduct && products.products.some(p => p.slug === queryProduct)) {
    form.product = queryProduct
    
    // Check if package is valid
    const prod = products.products.find(p => p.slug === queryProduct)
    if (prod && prod.packages && prod.packages.length > 0) {
      if (queryPackage && prod.packages.some(pk => pk.id === queryPackage)) {
        form.package = queryPackage
      } else {
        form.package = prod.packages[0].id
      }
    }
  }
})

// Keep product and package in sync
watch(() => form.product, (newVal) => {
  const p = products.products.find(x => x.slug === newVal)
  if (p && p.packages && p.packages.length > 0) {
    if (!p.packages.some(pk => pk.id === form.package)) {
      form.package = p.packages[0].id
    }
  } else {
    form.package = ''
  }
})

function onSubmit() {
  if (!form.name.trim() || !form.phone.trim() || !form.address.trim() || !form.business.trim()) {
    return
  }

  const selectedProductObj = products.products.find(p => p.slug === form.product)
  const selectedPackageObj = selectedProductObj?.packages?.find(pkg => pkg.id === form.package)

  const lead = {
    name: form.name.trim(),
    address: form.address.trim(),
    phone: form.phone.trim(),
    whatsapp: form.whatsapp.trim() || form.phone.trim(),
    business: form.business.trim(),
    product: selectedProductObj ? selectedProductObj.name : form.product,
    package: selectedPackageObj ? selectedPackageObj.name : (form.package || 'طلب سعر مخصص'),
    notes: form.notes.trim()
  }

  // Save request to Pinia (localStorage)
  requests.addRequest(lead)

  // Send notifications (Telegram / EmailJS / Whatsapp)
  notifier.notifyAll(lead)

  // Emit success event to parent view
  emit('success')
  
  // Reset form
  Object.keys(form).forEach(k => {
    form[k] = k === 'product' && products.products.length > 0 ? products.products[0].slug : ''
  })
}
</script>
