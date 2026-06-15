<template>
  <Transition name="modal">
    <div 
      v-if="isOpen" 
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/90 backdrop-blur-md"
      dir="rtl"
    >
      <div 
        class="bg-dark-card border border-dark-border rounded-[32px] w-full max-w-2xl shadow-premium relative overflow-hidden text-right font-body text-dark-text max-h-[92vh] flex flex-col transition-premium"
        @click.stop
      >
        <!-- Top glowing neon line -->
        <div class="h-1.5 w-full bg-gradient-to-r from-primary-400 via-vibrant-purple to-vibrant-cyan"></div>
        
        <!-- Close button -->
        <button 
          @click="close" 
          class="absolute top-5 left-5 text-dark-muted hover:text-white bg-dark-bg/80 border border-dark-border w-9 h-9 rounded-full flex items-center justify-center cursor-pointer transition-all duration-300 z-10 text-sm hover:border-vibrant-purple/40"
        >
          ✕
        </button>

        <!-- Stepper Indicator -->
        <div class="px-6 pt-10 pb-6 border-b border-dark-border bg-dark-card/50 shrink-0">
          <div class="flex items-center justify-between max-w-md mx-auto text-xs font-bold relative">
            <!-- Background track -->
            <div class="absolute inset-0 top-1/2 -translate-y-1/2 h-[3px] bg-dark-border -z-10 rounded-full"></div>
            <!-- Glowing active progress bar -->
            <div 
              class="absolute inset-0 top-1/2 -translate-y-1/2 h-[3px] bg-gradient-to-r from-primary-400 to-vibrant-purple -z-10 transition-all duration-500 rounded-full shadow-neon-purple"
              :style="{ width: progressPercent + '%' }"
            ></div>

            <!-- Steps -->
            <div 
              v-for="stepNum in 4" 
              :key="stepNum"
              class="flex flex-col items-center gap-2"
            >
              <div 
                :class="[
                  'w-9 h-9 rounded-full flex items-center justify-center font-mono font-bold transition-premium border-2',
                  step === stepNum 
                    ? 'bg-gradient-to-r from-primary-400 to-vibrant-purple text-white border-transparent shadow-neon-purple scale-110'
                    : step > stepNum
                    ? 'bg-primary-400 text-white border-transparent'
                    : 'bg-dark-bg text-dark-muted border-dark-border'
                ]"
              >
                {{ stepNum }}
              </div>
              <span 
                :class="[
                  'text-[10px] font-display font-medium hidden sm:inline transition-colors',
                  step === stepNum ? 'text-white' : 'text-dark-muted'
                ]"
              >
                {{ getStepTitle(stepNum) }}
              </span>
            </div>
          </div>
        </div>

        <!-- Scrollable Modal Body -->
        <div class="p-6 sm:p-10 overflow-y-auto flex-grow space-y-6">
          <!-- Step 1: Client/Business Info -->
          <div v-if="step === 1" class="space-y-5 animate-fade-in">
            <div class="text-right mb-6">
              <h3 class="text-xl font-display font-black text-white">بيانات الاتصال والنشاط</h3>
              <p class="text-xs text-dark-muted mt-1">يرجى كتابة معلوماتك لنستطيع التنسيق والاتصال بك مباشرة</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div>
                <label class="block text-xs font-bold text-slate-300 mb-2">الاسم الكامل *</label>
                <input 
                  type="text" 
                  v-model="form.clientName" 
                  placeholder="مثال: أحمد محمد"
                  class="w-full px-4 py-3.5 rounded-2xl border border-dark-border bg-dark-bg text-dark-text text-sm focus:outline-none focus:border-vibrant-purple focus:ring-2 focus:ring-vibrant-purple/10 transition-premium"
                  required
                />
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-300 mb-2">رقم الهاتف *</label>
                <input 
                  type="tel" 
                  v-model="form.clientPhone" 
                  placeholder="مثال: 01012345678"
                  class="w-full px-4 py-3.5 rounded-2xl border border-dark-border bg-dark-bg text-dark-text text-sm focus:outline-none focus:border-vibrant-purple focus:ring-2 focus:ring-vibrant-purple/10 transition-premium text-left font-mono"
                  dir="ltr"
                  required
                />
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div>
                <label class="block text-xs font-bold text-slate-300 mb-2">رقم الواتساب (لتلقي تفاصيل الموعد) *</label>
                <input 
                  type="tel" 
                  v-model="form.clientWhatsapp" 
                  placeholder="مثال: 01012345678"
                  class="w-full px-4 py-3.5 rounded-2xl border border-dark-border bg-dark-bg text-dark-text text-sm focus:outline-none focus:border-vibrant-purple focus:ring-2 focus:ring-vibrant-purple/10 transition-premium text-left font-mono"
                  dir="ltr"
                  required
                />
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-300 mb-2">المدينة / المحافظة *</label>
                <input 
                  type="text" 
                  v-model="form.address" 
                  placeholder="مثال: القاهرة، مصر الجديدة"
                  class="w-full px-4 py-3.5 rounded-2xl border border-dark-border bg-dark-bg text-dark-text text-sm focus:outline-none focus:border-vibrant-purple focus:ring-2 focus:ring-vibrant-purple/10 transition-premium"
                  required
                />
              </div>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-300 mb-2">نوع النشاط التجاري *</label>
              <input 
                type="text" 
                v-model="form.businessType" 
                placeholder="مثال: سوبرماركت، مطعم، شركة شحن، صيدلية..."
                class="w-full px-4 py-3.5 rounded-2xl border border-dark-border bg-dark-bg text-dark-text text-sm focus:outline-none focus:border-vibrant-purple focus:ring-2 focus:ring-vibrant-purple/10 transition-premium"
                required
              />
            </div>
          </div>

          <!-- Step 2: Choose Systems -->
          <div v-if="step === 2" class="space-y-5 animate-fade-in">
            <div class="text-right mb-6">
              <h3 class="text-xl font-display font-black text-white">اختيار البرامج والحلول</h3>
              <p class="text-xs text-dark-muted mt-1">اختر نظاماً أو أكثر من الأنظمة المتاحة، أو أخبرنا بفكرة برنامجك الخاص</p>
            </div>

            <!-- Dynamic grid of products -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-60 overflow-y-auto pr-1">
              <div 
                v-for="p in products" 
                :key="p.id"
                @click="toggleProductSelection(p.name)"
                :class="[
                  'border rounded-2xl p-4 flex items-center justify-between cursor-pointer transition-premium',
                  form.selectedProducts.includes(p.name)
                    ? 'bg-primary-400/10 border-vibrant-purple shadow-neon-purple/10'
                    : 'bg-dark-bg/60 border-dark-border hover:border-dark-hover'
                ]"
              >
                <div class="flex items-center gap-3">
                  <span class="text-2xl select-none bg-dark-card p-1.5 rounded-xl border border-dark-border/40">{{ p.icon || '⚙' }}</span>
                  <div class="text-right">
                    <span class="text-xs font-bold block text-white">{{ p.name }}</span>
                    <span class="text-[9px] text-dark-muted block line-clamp-1 mt-0.5">{{ p.description }}</span>
                  </div>
                </div>
                <!-- Custom Checkbox -->
                <div 
                  :class="[
                    'w-5 h-5 rounded-lg border flex items-center justify-center transition-all',
                    form.selectedProducts.includes(p.name)
                      ? 'bg-gradient-to-tr from-primary-400 to-vibrant-purple border-transparent text-white shadow-neon-purple/20'
                      : 'border-dark-border bg-dark-bg'
                  ]"
                >
                  <span v-if="form.selectedProducts.includes(p.name)" class="text-[9px] font-bold">✓</span>
                </div>
              </div>
            </div>

            <!-- Custom Idea Option -->
            <div class="border-t border-dark-border/60 pt-4 mt-2">
              <label class="flex items-center gap-3 cursor-pointer select-none">
                <input 
                  type="checkbox" 
                  v-model="hasCustomIdea" 
                  class="w-4 h-4 text-vibrant-purple border-dark-border bg-dark-bg rounded focus:ring-vibrant-purple/20"
                />
                <span class="text-xs font-bold text-white">أريد تنفيذ فكرة برنامج مخصصة وجديدة بالكامل</span>
              </label>

              <!-- Description input for custom idea -->
              <div v-if="hasCustomIdea" class="mt-4 animate-fade-in">
                <label class="block text-[10px] font-bold text-slate-300 mb-2">اشرح فكرة برنامجك والخصائص المطلوبة *</label>
                <textarea 
                  v-model="form.customProgramIdea"
                  rows="3"
                  placeholder="مثال: أريد تطبيق توصيل للعملاء يربط الكباتن مع لوحة تحكم سحابية لمتابعة حركة السيارات..."
                  class="w-full px-4 py-3.5 rounded-2xl border border-dark-border bg-dark-bg text-dark-text text-xs focus:outline-none focus:border-vibrant-purple focus:ring-2 focus:ring-vibrant-purple/10 transition-premium leading-relaxed"
                  required
                ></textarea>
              </div>
            </div>
          </div>

          <!-- Step 3: Choose Date & Time Slot -->
          <div v-if="step === 3" class="space-y-6 animate-fade-in">
            <div class="text-right mb-6">
              <h3 class="text-xl font-display font-black text-white">موعد المقابلة الاستشارية</h3>
              <p class="text-xs text-dark-muted mt-1">اختر اليوم والساعة الأنسب لك لعقد المقابلة أونلاين عبر برنامج مكالمات الفيديو</p>
            </div>

            <!-- Dates Selector -->
            <div class="space-y-2.5">
              <span class="block text-xs font-bold text-slate-300">1. اختر التاريخ المفضل:</span>
              <div class="flex gap-2.5 overflow-x-auto pb-2.5 scrollbar-thin">
                <button 
                  v-for="d in availableDates" 
                  :key="d"
                  type="button"
                  @click="selectDate(d)"
                  :class="[
                    'px-4 py-3.5 rounded-2xl border text-center transition-premium min-w-[100px] shrink-0 cursor-pointer',
                    form.meetingDate === d
                      ? 'bg-gradient-to-tr from-primary-400 to-vibrant-purple text-white border-transparent shadow-neon-purple scale-[1.03]'
                      : 'bg-dark-bg/60 border-dark-border hover:border-dark-hover text-dark-muted'
                  ]"
                >
                  <span class="text-[9px] block font-bold tracking-wider">{{ getDayName(d) }}</span>
                  <span class="text-xs font-mono font-bold block mt-1">{{ formatDateString(d) }}</span>
                </button>
              </div>
            </div>

            <!-- Time Slots Selector -->
            <div v-if="form.meetingDate" class="space-y-2.5 pt-2 border-t border-dark-border/40">
              <span class="block text-xs font-bold text-slate-300">2. اختر الفترة الزمنية الشاغرة:</span>
              <div v-if="availableSlots.length > 0" class="grid grid-cols-3 gap-3">
                <button 
                  v-for="time in availableSlots" 
                  :key="time"
                  type="button"
                  @click="form.meetingTimeSlot = time"
                  :class="[
                    'py-3 rounded-2xl border text-center transition-premium font-mono text-xs cursor-pointer',
                    form.meetingTimeSlot === time
                      ? 'bg-vibrant-cyan text-slate-950 font-bold border-transparent shadow-neon-cyan scale-[1.02]'
                      : 'bg-dark-bg/60 border-dark-border hover:border-dark-hover text-dark-text'
                  ]"
                >
                  {{ time }}
                </button>
              </div>
              <div v-else class="bg-dark-bg/50 border border-dark-border p-5 rounded-2xl text-center text-xs text-dark-muted italic">
                عذراً، لا توجد فترات حجز شاغرة في هذا التاريخ. يرجى اختيار يوم آخر.
              </div>
            </div>
          </div>

          <!-- Step 4: Booking Success -->
          <div v-if="step === 4" class="text-center py-8 space-y-6 animate-fade-in flex flex-col items-center">
            <div class="w-20 h-20 bg-green-950/40 border border-green-900 text-green-400 rounded-full flex items-center justify-center text-3xl shadow-lg scale-up mb-2">
              ✓
            </div>
            <h3 class="text-2xl font-display font-black text-white">تم تأكيد موعدك بنجاح!</h3>
            
            <div class="bg-dark-bg border border-dark-border p-6 rounded-3xl max-w-md w-full text-right text-xs space-y-3.5 relative">
              <div class="absolute -right-3 -top-3 w-8 h-8 bg-vibrant-purple rounded-full blur-md opacity-25"></div>
              
              <div>
                <span class="text-dark-muted block">العميل الكريم:</span>
                <span class="text-white font-bold text-sm">{{ form.clientName }}</span>
              </div>
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <span class="text-dark-muted block font-display">يوم المقابلة:</span>
                  <span class="text-vibrant-cyan font-bold font-mono text-xs">{{ getDayName(form.meetingDate) }} ({{ form.meetingDate }})</span>
                </div>
                <div>
                  <span class="text-dark-muted block font-display">الساعة:</span>
                  <span class="text-vibrant-cyan font-bold font-mono text-xs">{{ form.meetingTimeSlot }}</span>
                </div>
              </div>
              <div>
                <span class="text-dark-muted block">الطلب:</span>
                <span class="text-white font-bold leading-relaxed">
                  {{ displaySelectedProducts }}
                </span>
              </div>
            </div>
            
            <p class="text-xs text-dark-muted max-w-sm leading-relaxed">
              شكرًا لثقتك في فريق Remotelly. سنقوم بإرسال رابط الاجتماع أونلاين وتفاصيل الجلسة عبر الواتساب على الرقم <b class="text-white font-mono text-xs">{{ form.clientWhatsapp }}</b> خلال ساعات قليلة.
            </p>
          </div>
        </div>

        <!-- Error Message -->
          <div v-if="submitError" class="mx-6 mb-4 bg-red-950/50 border border-red-900/60 text-red-400 text-xs font-body px-4 py-3 rounded-2xl text-right">
            ⚠️ {{ submitError }}
          </div>

        <!-- Footer Actions -->
        <div class="px-6 py-5 border-t border-dark-border bg-dark-card/50 flex items-center justify-between shrink-0">
          <!-- Back button -->
          <button 
            v-if="step > 1 && step < 4" 
            @click="prevStep"
            class="bg-dark-bg hover:bg-dark-hover text-dark-text border border-dark-border px-6 py-3 rounded-2xl text-xs font-bold transition-premium cursor-pointer"
          >
            ← السابق
          </button>
          <div v-else></div>

          <!-- Action button -->
          <button 
            v-if="step < 3"
            @click="nextStep"
            class="bg-gradient-to-r from-primary-400 to-vibrant-purple text-white text-xs font-bold py-3.5 px-8 rounded-2xl transition-premium shadow-neon-purple/20 hover:shadow-neon-purple hover:-translate-y-0.5 cursor-pointer"
          >
            التالي ←
          </button>
          
          <button 
            v-else-if="step === 3"
            @click="confirmBooking"
            :disabled="!isStep3Valid || submitting"
            class="bg-gradient-to-r from-primary-400 to-vibrant-purple disabled:opacity-50 disabled:cursor-not-allowed text-white text-xs font-bold py-3.5 px-8 rounded-2xl transition-premium shadow-neon-purple/20 hover:shadow-neon-purple hover:-translate-y-0.5 cursor-pointer flex items-center gap-2"
          >
            <span v-if="submitting" class="animate-spin">⏳</span>
            <span>{{ submitting ? 'جاري التأكيد...' : 'تأكيد وإرسال الطلب 🎉' }}</span>
          </button>

          <button 
            v-else-if="step === 4"
            @click="close"
            class="bg-dark-hover hover:bg-dark-border text-dark-text border border-dark-border px-8 py-3 rounded-2xl text-xs font-bold transition-premium cursor-pointer"
          >
            إغلاق النافذة
          </button>
        </div>

      </div>
    </div>
  </Transition>
</template>

<script setup>
import { ref, reactive, computed, watch } from 'vue'
import { useBookingsStore } from '../../stores/useBookingsStore'
import { useRequestsStore } from '../../stores/useRequestsStore'
import { useProductsStore } from '../../stores/useProductsStore'

const props = defineProps({
  isOpen: { type: Boolean, default: false }
})

const emit = defineEmits(['close'])

const bookingsStore = useBookingsStore()
const requestsStore = useRequestsStore()
const productsStore = useProductsStore()

const products        = computed(() => productsStore.products)
const availableDates  = ref([])
const availableSlots  = ref([])

const step           = ref(1)
const hasCustomIdea  = ref(false)
const submitting     = ref(false)
const submitError    = ref('')

const form = reactive({
  clientName: '',
  clientPhone: '',
  clientWhatsapp: '',
  address: '',
  businessType: '',
  selectedProducts: [],
  customProgramIdea: '',
  meetingDate: '',
  meetingTimeSlot: '',
  notes: ''
})

// Load dates when wizard opens
watch(() => props.isOpen, async (val) => {
  if (val) {
    availableDates.value = await bookingsStore.fetchAvailableDates()
    if (!productsStore.products.length) await productsStore.fetchProducts()
  }
})

// Load slots when date changes
watch(() => form.meetingDate, async (date) => {
  form.meetingTimeSlot = ''
  availableSlots.value = date ? await bookingsStore.fetchAvailableSlots(date) : []
})

const progressPercent = computed(() => ((step.value - 1) / 3) * 100)

const displaySelectedProducts = computed(() => {
  let list = [...form.selectedProducts]
  if (hasCustomIdea.value && form.customProgramIdea) {
    list.push('فكرة مخصصة: ' + form.customProgramIdea.substring(0, 30) + '...')
  }
  return list.length > 0 ? list.join(' • ') : 'تخصيص كامل'
})

const isStep3Valid = computed(() => form.meetingDate && form.meetingTimeSlot)

function getStepTitle(num) {
  return ['', 'بيانات النشاط', 'اختيار البرامج', 'موعد المقابلة', 'نجاح التأكيد'][num] || ''
}

function getDayName(dateStr) {
  if (!dateStr) return ''
  return new Date(dateStr + 'T12:00:00').toLocaleDateString('ar-EG', { weekday: 'long' })
}

function formatDateString(dateStr) {
  if (!dateStr) return ''
  const parts = dateStr.split('-')
  return `${parts[2]} / ${parts[1]}`
}

function toggleProductSelection(name) {
  const idx = form.selectedProducts.indexOf(name)
  idx > -1 ? form.selectedProducts.splice(idx, 1) : form.selectedProducts.push(name)
}

function selectDate(date) { form.meetingDate = date }

function isStep1Valid() {
  return form.clientName.trim() && form.clientPhone.trim() && form.clientWhatsapp.trim() && form.address.trim() && form.businessType.trim()
}

function isStep2Valid() {
  return form.selectedProducts.length > 0 || (hasCustomIdea.value && form.customProgramIdea.trim())
}

function nextStep() {
  submitError.value = ''
  if (step.value === 1 && !isStep1Valid()) {
    submitError.value = 'يرجى ملء جميع الحقول المطلوبة (*) أولاً.'
    return
  }
  if (step.value === 2 && !isStep2Valid()) {
    submitError.value = 'يرجى اختيار نظام واحد على الأقل، أو توضيح فكرة برنامجك الخاص.'
    return
  }
  step.value++
}

function prevStep() {
  if (step.value > 1) step.value--
  submitError.value = ''
}

async function confirmBooking() {
  if (!isStep3Valid.value) return
  submitting.value  = true
  submitError.value = ''

  try {
    await bookingsStore.addBooking({
      clientName:        form.clientName,
      clientPhone:       form.clientPhone,
      clientWhatsapp:    form.clientWhatsapp,
      businessType:      form.businessType,
      selectedProducts:  [...form.selectedProducts],
      customProgramIdea: hasCustomIdea.value ? form.customProgramIdea : '',
      meetingDate:       form.meetingDate,
      meetingTimeSlot:   form.meetingTimeSlot,
      notes:             `حجز استشارة أونلاين. العنوان: ${form.address}`,
    })

    await requestsStore.addRequest({
      name:     form.clientName,
      phone:    form.clientPhone,
      whatsapp: form.clientWhatsapp,
      address:  form.address,
      business: form.businessType,
      product:  form.selectedProducts.length > 0 ? form.selectedProducts.join(', ') : 'تطوير فكرة مخصصة',
      package:  `استشارة أونلاين (${form.meetingDate} - ${form.meetingTimeSlot})`,
      notes:    hasCustomIdea.value ? `تفاصيل الفكرة: ${form.customProgramIdea}` : 'حجز جلسة استشارة أونلاين.',
    })

    step.value = 4
  } catch (e) {
    submitError.value = e.message || 'حدث خطأ، يرجى المحاولة مجدداً.'
  } finally {
    submitting.value = false
  }
}

function close() {
  emit('close')
  setTimeout(() => {
    step.value        = 1
    hasCustomIdea.value = false
    submitError.value = ''
    availableSlots.value = []
    Object.keys(form).forEach(k => {
      form[k] = k === 'selectedProducts' ? [] : ''
    })
  }, 400)
}
</script>

<style scoped>
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

.modal-enter-active .bg-dark-card {
  animation: modalSlideUp 0.45s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.modal-leave-active .bg-dark-card {
  animation: modalSlideDown 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes modalSlideUp {
  from { transform: translateY(50px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

@keyframes modalSlideDown {
  from { transform: translateY(0); opacity: 1; }
  to { transform: translateY(40px); opacity: 0; }
}

.animate-fade-in {
  animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(12px); }
  to { opacity: 1; transform: translateY(0); }
}

.scale-up {
  animation: scaleUp 0.35s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
}

@keyframes scaleUp {
  from { transform: scale(0.8); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}

.scrollbar-thin::-webkit-scrollbar {
  height: 5px;
}
.scrollbar-thin::-webkit-scrollbar-track {
  background: #0F111A;
}
.scrollbar-thin::-webkit-scrollbar-thumb {
  background: #1D2132;
  border-radius: 10px;
}
</style>
