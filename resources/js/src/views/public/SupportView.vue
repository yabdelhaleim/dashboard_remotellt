<template>
  <div class="min-h-screen bg-dark-bg text-dark-text flex flex-col justify-between overflow-x-hidden relative">
    
    <!-- Floating background glow spots -->
    <div class="absolute top-[15%] left-[-10%] w-[500px] h-[500px] bg-primary-400/10 rounded-full blur-[180px] pointer-events-none"></div>
    <div class="absolute bottom-[20%] right-[-10%] w-[600px] h-[600px] bg-vibrant-purple/10 rounded-full blur-[200px] pointer-events-none"></div>

    <!-- Navbar -->
    <TheNavbar />

    <!-- Main Content -->
    <main class="flex-grow max-w-4xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-12 relative z-10 text-right">
      
      <!-- Back Link -->
      <div class="mb-8">
        <router-link to="/" class="inline-flex items-center gap-1.5 text-xs text-dark-muted hover:text-vibrant-purple transition-colors duration-300">
          <span>→</span>
          <span>العودة للرئيسية</span>
        </router-link>
      </div>

      <!-- Header Section -->
      <div class="text-center mb-10">
        <span class="px-3 py-1.5 bg-vibrant-purple/10 text-vibrant-purple border border-vibrant-purple/20 rounded-full text-xs font-mono font-bold tracking-wider uppercase">
          مركز المساعدة والدعم
        </span>
        <h1 class="font-display font-extrabold text-3xl sm:text-4xl text-white mt-4 mb-3">الدعم الفني وطلبات التعديل</h1>
        <p class="text-dark-muted text-sm max-w-xl mx-auto leading-relaxed">
          نسعد بخدمتكم. يمكنك فتح تذكرة جديدة للإبلاغ عن مشكلة أو لطلب تعديلات ومميزات جديدة، أو تتبع حالة تذكرتك الحالية بكل سهولة.
        </p>
      </div>

      <!-- Tabs Navigation -->
      <div class="flex border-b border-dark-border mb-8 max-w-md mx-auto p-1 bg-dark-card/60 rounded-xl border">
        <button 
          @click="activeTab = 'open'"
          class="flex-1 py-3 text-center rounded-lg font-display font-bold text-sm transition-all duration-300 cursor-pointer"
          :class="activeTab === 'open' ? 'bg-gradient-to-l from-primary-400 to-vibrant-purple text-white shadow-neon-purple/15' : 'text-dark-muted hover:text-white'"
        >
          📝 فتح تذكرة جديدة
        </button>
        <button 
          @click="activeTab = 'track'"
          class="flex-1 py-3 text-center rounded-lg font-display font-bold text-sm transition-all duration-300 cursor-pointer"
          :class="activeTab === 'track' ? 'bg-gradient-to-l from-primary-400 to-vibrant-purple text-white shadow-neon-purple/15' : 'text-dark-muted hover:text-white'"
        >
          🔍 تتبع حالة تذكرة
        </button>
      </div>

      <!-- Tab Content Area -->
      <div class="bg-dark-card/60 backdrop-blur-xl border border-dark-border rounded-3xl p-6 sm:p-10 shadow-premium relative overflow-hidden">
        
        <!-- Tab 1: Create Ticket -->
        <div v-if="activeTab === 'open'">
          <div v-if="ticketCreated" class="text-center py-8 animate-fade-in flex flex-col items-center">
            <div class="w-16 h-16 bg-vibrant-teal/10 border border-vibrant-teal/30 rounded-full flex items-center justify-center text-vibrant-teal text-3xl mb-6 shadow-neon-cyan/10">
              ✓
            </div>
            <h2 class="font-display font-extrabold text-2xl text-white mb-3">تم فتح التذكرة بنجاح!</h2>
            <p class="text-dark-muted text-sm max-w-md mb-6 leading-relaxed">
              تم تسجيل طلبك بنجاح في نظامنا. يرجى الاحتفاظ برقم التذكرة التالي لتتبع حالتها ورؤية ردود الدعم الفني لاحقاً:
            </p>
            
            <!-- Ticket Number Box -->
            <div class="bg-slate-900 border border-dark-border rounded-2xl py-4 px-8 mb-6 flex items-center justify-center gap-4 group">
              <span class="font-mono text-2xl font-black text-white tracking-widest">{{ createdTicketNumber }}</span>
              <button 
                @click="copyTicketNumber" 
                class="text-vibrant-purple hover:text-vibrant-pink p-2 hover:bg-dark-hover rounded-lg transition-colors cursor-pointer"
                title="نسخ رقم التذكرة"
              >
                <span v-if="copied">✅ تم النسخ</span>
                <span v-else>📋 نسخ</span>
              </button>
            </div>

            <p class="text-xs text-dark-muted mb-8">
              سنقوم بمراجعة طلبك والتواصل معك عبر الهاتف المسجل ({{ form.client_phone }}) في أقرب وقت.
            </p>
            
            <div class="flex gap-4">
              <button 
                @click="resetOpenTab" 
                class="bg-dark-hover hover:bg-dark-border text-slate-200 font-bold text-xs py-3 px-6 rounded-xl border border-dark-border transition-all cursor-pointer"
              >
                تذكرة جديدة أخرى
              </button>
              <button 
                @click="goToTrackTab" 
                class="bg-gradient-to-l from-primary-400 to-vibrant-purple hover:opacity-90 text-white font-bold text-xs py-3 px-6 rounded-xl transition-all cursor-pointer"
              >
                تتبع حالة التذكرة الآن
              </button>
            </div>
          </div>

          <!-- Open Ticket Form -->
          <form v-else @submit.prevent="handleSubmitTicket" class="space-y-6">
            <div v-if="submitError" class="bg-red-500/10 border border-red-500/20 text-red-400 text-xs p-4 rounded-xl leading-relaxed">
              ⚠️ {{ submitError }}
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <!-- Full Name -->
              <div>
                <label class="block text-xs font-bold text-slate-300 mb-2">الاسم بالكامل <span class="text-vibrant-pink">*</span></label>
                <input 
                  v-model="form.client_name" 
                  type="text" 
                  required
                  placeholder="مثال: أحمد محمد علي"
                  class="w-full bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-4 py-3 text-xs text-white placeholder-dark-muted focus:outline-none transition-colors"
                />
              </div>

              <!-- Phone -->
              <div>
                <label class="block text-xs font-bold text-slate-300 mb-2">رقم الهاتف للتواصل <span class="text-vibrant-pink">*</span></label>
                <input 
                  v-model="form.client_phone" 
                  type="tel" 
                  required
                  placeholder="مثال: 01012345678"
                  class="w-full bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-4 py-3 text-xs text-white placeholder-dark-muted focus:outline-none transition-colors text-left"
                  dir="ltr"
                />
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <!-- WhatsApp -->
              <div>
                <label class="block text-xs font-bold text-slate-300 mb-2">رقم الواتساب (اختياري)</label>
                <input 
                  v-model="form.client_whatsapp" 
                  type="tel" 
                  placeholder="مثال: 01012345678"
                  class="w-full bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-4 py-3 text-xs text-white placeholder-dark-muted focus:outline-none transition-colors text-left"
                  dir="ltr"
                />
              </div>

              <!-- System/Product -->
              <div>
                <label class="block text-xs font-bold text-slate-300 mb-2">البرنامج أو النظام <span class="text-vibrant-pink">*</span></label>
                <select 
                  v-model="form.system_name"
                  required
                  class="w-full bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-4 py-3 text-xs text-slate-200 focus:outline-none transition-colors cursor-pointer"
                >
                  <option value="" disabled>اختر البرنامج المعني</option>
                  <option 
                    v-for="prod in products" 
                    :key="prod.id" 
                    :value="prod.name"
                  >
                    {{ prod.name }}
                  </option>
                  <option value="أخرى / طلب تعديل مخصص">أخرى / طلب تعديل مخصص</option>
                </select>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <!-- Ticket Type -->
              <div>
                <label class="block text-xs font-bold text-slate-300 mb-2">نوع الطلب <span class="text-vibrant-pink">*</span></label>
                <select 
                  v-model="form.type"
                  required
                  class="w-full bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-4 py-3 text-xs text-slate-200 focus:outline-none transition-colors cursor-pointer"
                >
                  <option value="support">🛠️ دعم فني (حل مشكلة أو عطل في النظام)</option>
                  <option value="modification">✨ طلب تعديل (إضافة ميزة أو موديول جديد)</option>
                </select>
              </div>

              <!-- Priority -->
              <div>
                <label class="block text-xs font-bold text-slate-300 mb-2">درجة الأهمية <span class="text-vibrant-pink">*</span></label>
                <select 
                  v-model="form.priority"
                  required
                  class="w-full bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-4 py-3 text-xs text-slate-200 focus:outline-none transition-colors cursor-pointer"
                >
                  <option value="low">منخفضة (استفسار عادي)</option>
                  <option value="medium">متوسطة (أعمال اعتيادية غير معطلة للعمل)</option>
                  <option value="high">عالية (تأثير جزئي على عمل النظام)</option>
                  <option value="urgent">عاجلة جداً (توقف كلي للنظام أو الكاشير)</option>
                </select>
              </div>
            </div>

            <!-- Title -->
            <div>
              <label class="block text-xs font-bold text-slate-300 mb-2">عنوان المشكلة أو الطلب <span class="text-vibrant-pink">*</span></label>
              <input 
                v-model="form.title" 
                type="text" 
                required
                placeholder="مثال: تعذر طباعة الباركود / طلب إضافة لوجو الفاتورة"
                class="w-full bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-4 py-3 text-xs text-white placeholder-dark-muted focus:outline-none transition-colors"
              />
            </div>

            <!-- Description -->
            <div>
              <label class="block text-xs font-bold text-slate-300 mb-2">تفاصيل ووصف المشكلة <span class="text-vibrant-pink">*</span></label>
              <textarea 
                v-model="form.description" 
                required
                rows="5"
                placeholder="يرجى كتابة تفاصيل المشكلة بدقة والخطوات التي تؤدي لظهورها، أو الميزة التي ترغب في إضافتها وتفاصيلها الفنية..."
                class="w-full bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-4 py-3 text-xs text-white placeholder-dark-muted focus:outline-none transition-colors resize-none leading-relaxed"
              ></textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-left">
              <button 
                type="submit"
                :disabled="submitting"
                class="bg-gradient-to-l from-primary-400 to-vibrant-purple text-white font-display font-bold text-xs py-3.5 px-8 rounded-xl transition-all duration-300 hover:shadow-neon-purple/30 cursor-pointer disabled:opacity-50 flex items-center justify-center gap-2 inline-flex"
              >
                <span v-if="submitting" class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                <span>إرسال التذكرة الفنية</span>
              </button>
            </div>

          </form>
        </div>

        <!-- Tab 2: Track Ticket -->
        <div v-else class="space-y-8">
          
          <!-- Search Form -->
          <form @submit.prevent="handleTrackTicket" class="bg-dark-bg/40 border border-dark-border p-6 rounded-2xl space-y-4">
            <h3 class="text-xs font-bold text-slate-300">أدخل بيانات التذكرة للبحث والتتبع:</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <input 
                  v-model="trackForm.ticket_number" 
                  type="text" 
                  required
                  placeholder="رقم التذكرة (مثال: RMT-1001)"
                  class="w-full bg-dark-bg/80 border border-dark-border focus:border-vibrant-purple rounded-xl px-4 py-3 text-xs text-white placeholder-dark-muted focus:outline-none transition-colors text-center font-mono tracking-widest uppercase"
                />
              </div>
              <div>
                <input 
                  v-model="trackForm.client_phone" 
                  type="tel" 
                  required
                  placeholder="رقم الهاتف المسجل بالتذكرة"
                  class="w-full bg-dark-bg/80 border border-dark-border focus:border-vibrant-purple rounded-xl px-4 py-3 text-xs text-white placeholder-dark-muted focus:outline-none transition-colors text-center font-mono"
                  dir="ltr"
                />
              </div>
            </div>

            <div v-if="trackError" class="text-red-400 text-xs py-1">
              ⚠️ {{ trackError }}
            </div>

            <div class="text-left pt-2">
              <button 
                type="submit"
                :disabled="tracking"
                class="bg-gradient-to-l from-primary-400 to-vibrant-purple text-white font-display font-bold text-xs py-3 px-6 rounded-xl transition-all cursor-pointer disabled:opacity-50 flex items-center gap-2 inline-flex"
              >
                <span v-if="tracking" class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                <span>بحث وتتبع التذكرة</span>
              </button>
            </div>
          </form>

          <!-- Search Result Details -->
          <div v-if="ticket" class="space-y-6 animate-fade-in">
            
            <div class="border-b border-dark-border pb-4 flex flex-wrap gap-4 items-center justify-between">
              <div>
                <span class="text-xs text-dark-muted font-mono block">رقم التذكرة</span>
                <span class="font-mono text-xl font-black text-white">{{ ticket.ticket_number }}</span>
              </div>

              <!-- Status Badges -->
              <div class="flex gap-2">
                <span 
                  class="px-3 py-1 rounded-full text-[10px] font-bold"
                  :class="statusColors[ticket.status]"
                >
                  {{ statusLabels[ticket.status] }}
                </span>
                
                <span 
                  class="px-3 py-1 rounded-full text-[10px] font-bold"
                  :class="priorityColors[ticket.priority]"
                >
                  أهمية: {{ priorityLabels[ticket.priority] }}
                </span>

                <span class="bg-dark-hover border border-dark-border px-3 py-1 rounded-full text-[10px] font-bold text-slate-300">
                  {{ ticket.type === 'support' ? '🛠️ دعم فني' : '✨ طلب تعديل' }}
                </span>
              </div>
            </div>

            <!-- Details Block -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-dark-bg/20 p-4 rounded-xl text-xs text-slate-300 border border-dark-border/40">
              <div>
                <span class="text-dark-muted block mb-1">العميل</span>
                <span class="font-bold text-white">{{ ticket.client_name }}</span>
              </div>
              <div>
                <span class="text-dark-muted block mb-1">النظام/البرنامج المعني</span>
                <span class="font-bold text-white">{{ ticket.system_name }}</span>
              </div>
              <div>
                <span class="text-dark-muted block mb-1">تاريخ الإنشاء</span>
                <span class="font-bold text-white font-mono">{{ formatDate(ticket.created_at) }}</span>
              </div>
            </div>

            <!-- Ticket Content -->
            <div class="bg-dark-bg/60 border border-dark-border p-6 rounded-2xl">
              <h4 class="font-display font-extrabold text-sm text-white mb-2">{{ ticket.title }}</h4>
              <p class="text-xs text-slate-300 leading-relaxed whitespace-pre-line">{{ ticket.description }}</p>
            </div>

            <!-- Support Reply Section -->
            <div v-if="ticket.admin_reply" class="bg-gradient-to-br from-primary-900/40 via-dark-card to-dark-card border border-vibrant-purple/20 p-6 rounded-2xl relative">
              <div class="absolute top-4 left-4 text-xs font-mono text-vibrant-purple font-semibold bg-vibrant-purple/10 px-2 py-0.5 rounded-md">
                رد الدعم الفني
              </div>
              <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 rounded-full bg-vibrant-purple flex items-center justify-center text-sm">
                  🏢
                </div>
                <div>
                  <h5 class="text-xs font-bold text-white">إدارة Remotelly</h5>
                  <span class="text-[10px] text-dark-muted font-mono">{{ formatDate(ticket.admin_reply_at || ticket.updated_at) }}</span>
                </div>
              </div>
              <p class="text-xs text-slate-200 leading-relaxed whitespace-pre-line">{{ ticket.admin_reply }}</p>
            </div>

            <!-- No Reply Yet -->
            <div v-else class="bg-dark-bg/30 border border-dashed border-dark-border p-6 rounded-2xl text-center text-xs text-dark-muted leading-relaxed">
              💡 لا يوجد رد إداري مسجل على هذه التذكرة حتى الآن. تذكرتك قيد المراجعة والدراسة الفنية من قِبل مهندسينا، وسنعاود الرد عليك هنا قريباً جداً.
            </div>

            <!-- Action: WhatsApp Contact Follow-up -->
            <div class="text-left pt-2">
              <a 
                :href="generateWhatsAppLink()"
                target="_blank"
                class="bg-green-600 hover:bg-green-700 text-white font-bold text-xs py-3 px-6 rounded-xl transition-all inline-flex items-center gap-2 cursor-pointer"
              >
                <span>💬 متابعة التذكرة عبر الواتساب مباشرة</span>
              </a>
            </div>

          </div>
        </div>

      </div>

    </main>

    <!-- Footer -->
    <TheFooter />
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { locale } from '../../utils/locale'
import TheNavbar from '../../components/layout/TheNavbar.vue'
import TheFooter from '../../components/layout/TheFooter.vue'
import { useTicketsStore } from '../../stores/useTicketsStore'
import { useProductsStore } from '../../stores/useProductsStore'

const ticketsStore = useTicketsStore()
const productsStore = useProductsStore()

const activeTab = ref('open') // open | track

// List products for selection
const products = computed(() => productsStore.products)

// Open Ticket Form Data
const form = ref({
  client_name: '',
  client_phone: '',
  client_whatsapp: '',
  system_name: '',
  type: 'support',
  priority: 'medium',
  title: '',
  description: '',
})

const submitting = ref(false)
const submitError = ref(null)
const ticketCreated = ref(false)
const createdTicketNumber = ref('')
const copied = ref(false)

// Track Ticket Form Data
const trackForm = ref({
  ticket_number: '',
  client_phone: '',
})
const tracking = ref(false)
const trackError = ref(null)
const ticket = computed(() => ticketsStore.currentTicket)

// Copy ticket number helper
async function copyTicketNumber() {
  try {
    await navigator.clipboard.writeText(createdTicketNumber.value)
    copied.value = true
    setTimeout(() => copied.value = false, 2000)
  } catch (err) {
    console.error('Failed to copy text: ', err)
  }
}

// Reset open tab state
function resetOpenTab() {
  form.value = {
    client_name: '',
    client_phone: '',
    client_whatsapp: '',
    system_name: '',
    type: 'support',
    priority: 'medium',
    title: '',
    description: '',
  }
  ticketCreated.value = false
  createdTicketNumber.value = ''
  submitError.value = null
}

function goToTrackTab() {
  trackForm.value.ticket_number = createdTicketNumber.value
  trackForm.value.client_phone = form.value.client_phone
  activeTab.value = 'track'
  resetOpenTab()
  handleTrackTicket()
}

// Handle open ticket submission
async function handleSubmitTicket() {
  submitting.value = true
  submitError.value = null
  try {
    const data = await ticketsStore.createTicket(form.value)
    createdTicketNumber.value = data.ticket_number
    ticketCreated.value = true
  } catch (err) {
    submitError.value = err.message || 'حدث خطأ أثناء إرسال التذكرة. يرجى المحاولة مرة أخرى.'
  } finally {
    submitting.value = false
  }
}

// Handle track ticket search
async function handleTrackTicket() {
  tracking.value = true
  trackError.value = null
  try {
    await ticketsStore.trackTicket(trackForm.value.ticket_number, trackForm.value.client_phone)
  } catch (err) {
    trackError.value = err.message || 'التذكرة غير موجودة أو رقم الهاتف غير صحيح.'
  } finally {
    tracking.value = false
  }
}

// Date formatter
function formatDate(dateStr) {
  if (!dateStr) return ''
  const date = new Date(dateStr)
  return date.toLocaleString('ar-EG', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}

// Generate WhatsApp link for ticket follow-up
function generateWhatsAppLink() {
  if (!ticket.value) return ''
  const phone = import.meta.env.VITE_WHATSAPP_NUMBER || '201000000000'
  const text = encodeURIComponent(
    `مرحبا دعم Remotelly، أود الاستفسار عن حالة التذكرة الخاصة بي ذات الرقم: ${ticket.value.ticket_number} والمسجلة باسم: ${ticket.value.client_name}.`
  )
  return `https://wa.me/${phone}?text=${text}`
}

// Arabic labels
const statusLabels = {
  open: 'مفتوحة 🆕',
  in_progress: 'قيد المعالجة ⏳',
  resolved: 'تم الحل ✅',
  closed: 'مغلقة 🔒'
}

const statusColors = {
  open: 'bg-vibrant-purple/10 text-vibrant-purple border border-vibrant-purple/20',
  in_progress: 'bg-vibrant-blue/10 text-vibrant-blue border border-vibrant-blue/20 animate-pulse',
  resolved: 'bg-vibrant-teal/10 text-vibrant-teal border border-vibrant-teal/20',
  closed: 'bg-slate-800 text-slate-400 border border-slate-700'
}

const priorityLabels = {
  low: 'منخفضة',
  medium: 'متوسطة',
  high: 'عالية',
  urgent: 'عاجلة جداً 🔥'
}

const priorityColors = {
  low: 'bg-slate-900 text-slate-300 border border-dark-border',
  medium: 'bg-vibrant-blue/5 text-vibrant-blue border border-vibrant-blue/15',
  high: 'bg-vibrant-pink/5 text-vibrant-pink border border-vibrant-pink/15',
  urgent: 'bg-red-500/10 text-red-400 border border-red-500/20'
}
</script>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(8px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
  animation: fadeIn 0.35s ease-out forwards;
}
</style>
