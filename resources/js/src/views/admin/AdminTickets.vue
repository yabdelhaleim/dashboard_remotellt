<template>
  <div class="space-y-6 text-right text-dark-text font-body">
    
    <!-- Title Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-dark-border pb-5 gap-4">
      <div>
        <h2 class="font-display font-black text-2xl text-white">إدارة وتتبع تذاكر الدعم الفني</h2>
        <p class="text-dark-muted text-xs mt-1">تلقي وإدارة طلبات العملاء وحل المشاكل التقنية وتلبية طلبات التعديلات البرمجية</p>
      </div>
    </div>

    <!-- Ticket Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <!-- Total Tickets -->
      <div class="bg-dark-card border border-dark-border p-5 rounded-2xl relative overflow-hidden">
        <span class="text-[10px] font-mono font-bold text-dark-muted tracking-wider uppercase">إجمالي التذاكر</span>
        <div class="text-2xl font-black text-white mt-1">{{ totalTickets }}</div>
        <div class="absolute bottom-2 left-4 text-3xl opacity-15">🎫</div>
      </div>
      
      <!-- Open Tickets -->
      <div class="bg-dark-card border border-dark-border p-5 rounded-2xl relative overflow-hidden">
        <span class="text-[10px] font-mono font-bold text-vibrant-purple tracking-wider uppercase">تذاكر مفتوحة (جديدة)</span>
        <div class="text-2xl font-black text-vibrant-purple mt-1">{{ openTickets }}</div>
        <div class="absolute bottom-2 left-4 text-3xl opacity-15">🆕</div>
      </div>
      
      <!-- In Progress Tickets -->
      <div class="bg-dark-card border border-dark-border p-5 rounded-2xl relative overflow-hidden">
        <span class="text-[10px] font-mono font-bold text-vibrant-blue tracking-wider uppercase">قيد المعالجة</span>
        <div class="text-2xl font-black text-vibrant-blue mt-1">{{ inProgressTickets }}</div>
        <div class="absolute bottom-2 left-4 text-3xl opacity-15">⏳</div>
      </div>

      <!-- Resolved Tickets -->
      <div class="bg-dark-card border border-dark-border p-5 rounded-2xl relative overflow-hidden">
        <span class="text-[10px] font-mono font-bold text-vibrant-teal tracking-wider uppercase">تم الحل</span>
        <div class="text-2xl font-black text-vibrant-teal mt-1">{{ resolvedTickets }}</div>
        <div class="absolute bottom-2 left-4 text-3xl opacity-15">✅</div>
      </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-dark-card/60 backdrop-blur-xl border border-dark-border rounded-2xl p-5 flex flex-wrap gap-4 items-center justify-between">
      
      <div class="flex flex-wrap gap-3 items-center">
        <!-- Search Input -->
        <input 
          v-model="filters.search"
          @input="debounceSearch"
          type="text"
          placeholder="ابحث بالرقم، الاسم أو الهاتف..."
          class="bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-4 py-2 text-xs text-white placeholder-dark-muted focus:outline-none transition-colors w-60"
        />

        <!-- Status Filter -->
        <select 
          v-model="filters.status"
          @change="loadTickets"
          class="bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-3 py-2 text-xs text-slate-200 focus:outline-none transition-colors cursor-pointer"
        >
          <option value="all">كل الحالات</option>
          <option value="open">مفتوحة</option>
          <option value="in_progress">قيد المعالجة</option>
          <option value="resolved">تم الحل</option>
          <option value="closed">مغلقة</option>
        </select>

        <!-- Priority Filter -->
        <select 
          v-model="filters.priority"
          @change="loadTickets"
          class="bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-3 py-2 text-xs text-slate-200 focus:outline-none transition-colors cursor-pointer"
        >
          <option value="all">كل الأولويات</option>
          <option value="low">منخفضة</option>
          <option value="medium">متوسطة</option>
          <option value="high">عالية</option>
          <option value="urgent">عاجلة جداً</option>
        </select>

        <!-- Type Filter -->
        <select 
          v-model="filters.type"
          @change="loadTickets"
          class="bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-3 py-2 text-xs text-slate-200 focus:outline-none transition-colors cursor-pointer"
        >
          <option value="all">كل الأنواع</option>
          <option value="support">🛠️ دعم فني</option>
          <option value="modification">✨ طلب تعديل</option>
        </select>
      </div>

      <button 
        @click="resetFilters"
        class="bg-dark-hover hover:bg-dark-border text-dark-text border border-dark-border text-xs px-4 py-2 rounded-xl transition-all cursor-pointer"
      >
        🔄 إعادة تعيين
      </button>
    </div>

    <!-- Table Container -->
    <div class="bg-dark-card rounded-2xl border border-dark-border shadow-sm overflow-hidden">
      
      <!-- Loading State -->
      <div v-if="ticketsStore.loading" class="text-center py-20">
        <div class="w-10 h-10 border-4 border-vibrant-purple/30 border-t-vibrant-purple rounded-full animate-spin mx-auto mb-4"></div>
        <p class="text-dark-muted text-xs">جاري تحميل تذاكر الدعم الفني...</p>
      </div>

      <!-- Table Content -->
      <div v-else-if="tickets.length > 0" class="overflow-x-auto">
        <table class="w-full text-right text-xs border-collapse">
          <thead>
            <tr class="bg-dark-hover/60 text-dark-muted font-bold border-b border-dark-border">
              <th class="p-4 w-24">رقم التذكرة</th>
              <th class="p-4">اسم العميل</th>
              <th class="p-4">النظام المعني</th>
              <th class="p-4 text-center">النوع</th>
              <th class="p-4 text-center">الأولوية</th>
              <th class="p-4 text-center">الحالة</th>
              <th class="p-4">تاريخ الإنشاء</th>
              <th class="p-4 text-center">إجراءات</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-dark-border/40">
            <tr 
              v-for="t in tickets" 
              :key="t.id" 
              class="hover:bg-dark-hover/30 transition-colors duration-150"
            >
              <!-- Ticket Number -->
              <td class="p-4 font-mono font-bold text-white tracking-widest text-sm">
                {{ t.ticket_number }}
              </td>

              <!-- Client Info -->
              <td class="p-4">
                <span class="font-bold text-white block">{{ t.client_name }}</span>
                <span class="text-[10px] text-dark-muted block mt-0.5" dir="ltr">{{ t.client_phone }}</span>
              </td>

              <!-- System Name -->
              <td class="p-4 font-medium text-slate-300">
                {{ t.system_name }}
              </td>

              <!-- Type -->
              <td class="p-4 text-center">
                <span class="text-[10px] font-bold text-slate-300">
                  {{ t.type === 'support' ? '🛠️ دعم فني' : '✨ تعديل' }}
                </span>
              </td>

              <!-- Priority -->
              <td class="p-4 text-center">
                <span 
                  :class="[
                    'inline-flex items-center px-2 py-0.5 rounded text-[9px] font-bold border',
                    priorityBadgeColors[t.priority]
                  ]"
                >
                  {{ priorityLabels[t.priority] }}
                </span>
              </td>

              <!-- Status Badge -->
              <td class="p-4 text-center">
                <span 
                  :class="[
                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-bold border',
                    statusBadgeColors[t.status]
                  ]"
                >
                  {{ statusLabels[t.status] }}
                </span>
              </td>

              <!-- Date -->
              <td class="p-4 text-[10px] font-mono text-dark-muted">
                {{ formatDate(t.created_at) }}
              </td>

              <!-- Actions -->
              <td class="p-4">
                <div class="flex items-center justify-center gap-1.5">
                  <!-- View Details & Reply -->
                  <button 
                    @click="openDetailsModal(t)" 
                    class="bg-primary-900/40 hover:bg-primary-800/40 text-vibrant-purple p-1.5 rounded-lg border border-primary-600/30 transition-all cursor-pointer"
                    title="عرض التفاصيل والرد"
                  >
                    👁️
                  </button>

                  <!-- WhatsApp quick link -->
                  <button 
                    @click="openWhatsapp(t)" 
                    class="bg-green-950/40 hover:bg-green-900/40 text-green-400 p-1.5 rounded-lg border border-green-900/30 transition-all cursor-pointer"
                    title="مراسلة العميل واتساب"
                  >
                    💬
                  </button>

                  <!-- Delete -->
                  <button 
                    @click="handleDelete(t.id)" 
                    class="bg-red-950/40 hover:bg-red-900/40 text-red-400 p-1.5 rounded-lg border border-red-900/30 transition-all cursor-pointer"
                    title="حذف التذكرة"
                  >
                    🗑
                  </button>
                </div>
              </td>

            </tr>
          </tbody>
        </table>
      </div>

      <!-- Empty State -->
      <div v-else class="text-center py-20 px-4">
        <div class="w-16 h-16 bg-dark-hover rounded-full flex items-center justify-center text-dark-muted text-xl mx-auto mb-4 border border-dark-border">
          🎫
        </div>
        <h3 class="font-bold text-sm text-white mb-1">لا توجد تذاكر دعم فني</h3>
        <p class="text-dark-muted text-xs">لا تتوفر أي تذاكر مطابقة لمعايير التصفية الحالية.</p>
      </div>

    </div>

    <!-- Details and Reply Modal -->
    <div v-if="selectedTicket" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm animate-fade-in text-right">
      <div class="bg-dark-card border border-dark-border w-full max-w-2xl rounded-3xl overflow-hidden shadow-premium flex flex-col max-h-[90vh]">
        
        <!-- Modal Header -->
        <div class="p-6 border-b border-dark-border flex items-center justify-between">
          <button @click="closeModal" class="text-dark-muted hover:text-white text-xl cursor-pointer">✕</button>
          <div class="flex items-center gap-3">
            <span class="font-mono text-lg font-black text-white">{{ selectedTicket.ticket_number }}</span>
            <span class="px-2 py-0.5 bg-dark-hover text-dark-muted border border-dark-border rounded text-[10px]">
              {{ selectedTicket.type === 'support' ? '🛠️ دعم فني' : '✨ طلب تعديل' }}
            </span>
          </div>
        </div>

        <!-- Modal Body (Scrollable) -->
        <div class="p-6 overflow-y-auto space-y-6 flex-grow">
          
          <!-- Client Card -->
          <div class="bg-dark-bg/50 border border-dark-border/60 p-4 rounded-2xl flex flex-wrap items-center justify-between gap-4">
            <div>
              <span class="text-[10px] text-dark-muted block">اسم العميل</span>
              <span class="text-xs font-bold text-white">{{ selectedTicket.client_name }}</span>
            </div>
            <div>
              <span class="text-[10px] text-dark-muted block">رقم الهاتف للتواصل</span>
              <a :href="'tel:' + selectedTicket.client_phone" class="text-xs font-mono font-bold text-vibrant-cyan hover:underline" dir="ltr">
                {{ selectedTicket.client_phone }}
              </a>
            </div>
            <div class="flex gap-2">
              <a 
                :href="'tel:' + selectedTicket.client_phone" 
                class="bg-dark-hover hover:bg-dark-border border border-dark-border text-white p-2 rounded-xl transition-all"
                title="اتصال تلفوني"
              >
                📞
              </a>
              <button 
                @click="openWhatsapp(selectedTicket)" 
                class="bg-green-950/60 hover:bg-green-900/60 border border-green-900/40 text-green-400 p-2 rounded-xl transition-all"
                title="مراسلة واتساب"
              >
                💬 واتساب
              </button>
            </div>
          </div>

          <!-- Ticket Subject -->
          <div class="space-y-2">
            <div class="text-[10px] text-dark-muted font-bold">الموضوع والوصف:</div>
            <div class="bg-dark-bg/30 border border-dark-border p-4 rounded-2xl">
              <h4 class="font-display font-bold text-sm text-white mb-2">{{ selectedTicket.title }}</h4>
              <p class="text-xs text-slate-300 leading-relaxed whitespace-pre-line">{{ selectedTicket.description }}</p>
              <div class="text-[10px] text-dark-muted font-mono mt-4 text-left">
                البرنامج المعني: {{ selectedTicket.system_name }} | تاريخ الفتح: {{ formatDate(selectedTicket.created_at) }}
              </div>
            </div>
          </div>

          <!-- Configuration & Reply Area -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Update Status -->
            <div>
              <label class="block text-xs font-bold text-slate-300 mb-2">تحديث حالة التذكرة:</label>
              <select 
                v-model="modalForm.status" 
                @change="handleUpdateStatus"
                class="w-full bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-3 py-2.5 text-xs text-slate-200 focus:outline-none transition-colors cursor-pointer"
              >
                <option value="open">مفتوحة 🆕</option>
                <option value="in_progress">قيد المعالجة ⏳</option>
                <option value="resolved">تم الحل ✅</option>
                <option value="closed">مغلقة 🔒</option>
              </select>
            </div>

            <!-- Update Priority -->
            <div>
              <label class="block text-xs font-bold text-slate-300 mb-2">تحديث درجة الأهمية:</label>
              <select 
                v-model="modalForm.priority" 
                @change="handleUpdatePriority"
                class="w-full bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-3 py-2.5 text-xs text-slate-200 focus:outline-none transition-colors cursor-pointer"
              >
                <option value="low">منخفضة</option>
                <option value="medium">متوسطة</option>
                <option value="high">عالية</option>
                <option value="urgent">عاجلة جداً 🔥</option>
              </select>
            </div>
          </div>

          <!-- Reply Section -->
          <div class="space-y-2 border-t border-dark-border pt-4">
            <label class="block text-xs font-bold text-slate-300">رد الدعم الفني / الإدارة:</label>
            <textarea 
              v-model="modalForm.admin_reply"
              rows="4"
              placeholder="اكتب رد الدعم الفني هنا. بمجرد الضغط على زر حفظ الرد، سيتحول النظام تلقائياً لحالة 'تم الحل' ويظهر الرد للعميل على الفور..."
              class="w-full bg-dark-bg/60 border border-dark-border focus:border-vibrant-purple rounded-xl px-4 py-3 text-xs text-white placeholder-dark-muted focus:outline-none transition-colors resize-none leading-relaxed"
            ></textarea>
            
            <div v-if="selectedTicket.admin_reply_at" class="text-[10px] text-dark-muted font-mono">
              آخر رد تم تسجيله في: {{ formatDate(selectedTicket.admin_reply_at) }}
            </div>
          </div>

        </div>

        <!-- Modal Footer -->
        <div class="p-6 border-t border-dark-border bg-dark-bg/40 flex items-center justify-between">
          <button 
            @click="handleSaveReply"
            :disabled="replying"
            class="bg-gradient-to-l from-primary-400 to-vibrant-purple text-white font-display font-bold text-xs py-3 px-6 rounded-xl transition-all cursor-pointer disabled:opacity-50 flex items-center gap-2"
          >
            <span v-if="replying" class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
            <span>حفظ وإرسال الرد للعميل</span>
          </button>
          
          <button 
            @click="closeModal"
            class="bg-dark-hover hover:bg-dark-border text-dark-text border border-dark-border text-xs px-5 py-3 rounded-xl transition-all cursor-pointer"
          >
            إغلاق
          </button>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useTicketsStore } from '../../stores/useTicketsStore'

const ticketsStore = useTicketsStore()

// State Filters
const filters = ref({
  status: 'all',
  priority: 'all',
  type: 'all',
  search: ''
})

// Tickets list computed
const tickets = computed(() => ticketsStore.tickets)

// Statistics computed
const totalTickets = computed(() => ticketsStore.tickets.length)
const openTickets = computed(() => ticketsStore.tickets.filter(t => t.status === 'open').length)
const inProgressTickets = computed(() => ticketsStore.tickets.filter(t => t.status === 'in_progress').length)
const resolvedTickets = computed(() => ticketsStore.tickets.filter(t => t.status === 'resolved').length)

// Search Debounce
let searchTimeout = null
function debounceSearch() {
  clearTimeout(searchTimeout)
  searchTimeout = setTimeout(() => {
    loadTickets()
  }, 300)
}

// Fetch tickets from API
function loadTickets() {
  ticketsStore.fetchTickets(filters.value)
}

// Reset filters to defaults
function resetFilters() {
  filters.value = {
    status: 'all',
    priority: 'all',
    type: 'all',
    search: ''
  }
  loadTickets()
}

onMounted(() => {
  loadTickets()
})

// Modal Logic
const selectedTicket = ref(null)
const replying = ref(false)
const modalForm = ref({
  status: 'open',
  priority: 'medium',
  admin_reply: ''
})

function openDetailsModal(t) {
  selectedTicket.value = t
  modalForm.value = {
    status: t.status,
    priority: t.priority,
    admin_reply: t.admin_reply || ''
  }
}

function closeModal() {
  selectedTicket.value = null
}

// Update status inline
async function handleUpdateStatus() {
  if (!selectedTicket.value) return
  try {
    const updated = await ticketsStore.updateTicketStatus(selectedTicket.value.id, modalForm.value.status)
    selectedTicket.value.status = updated.status
  } catch (err) {
    alert('فشل تحديث الحالة')
  }
}

// Update priority inline
async function handleUpdatePriority() {
  if (!selectedTicket.value) return
  try {
    const updated = await ticketsStore.updateTicketPriority(selectedTicket.value.id, modalForm.value.priority)
    selectedTicket.value.priority = updated.priority
  } catch (err) {
    alert('فشل تحديث الأهمية')
  }
}

// Save reply and resolve ticket
async function handleSaveReply() {
  if (!selectedTicket.value) return
  replying.value = true
  try {
    // Reply will set status to resolved by default if status is not explicitly closed or something else.
    // Let's pass the status in modalForm.status so that we keep status consistent.
    const updated = await ticketsStore.replyToTicket(
      selectedTicket.value.id, 
      modalForm.value.admin_reply, 
      modalForm.value.status === 'open' ? 'resolved' : modalForm.value.status
    )
    
    selectedTicket.value = updated
    modalForm.value.status = updated.status
    
    // Refresh parent list
    loadTickets()
    closeModal()
  } catch (err) {
    alert('فشل إرسال الرد: ' + err.message)
  } finally {
    replying.value = false
  }
}

// Delete ticket
async function handleDelete(id) {
  if (confirm('هل أنت متأكد من حذف هذه التذكرة نهائياً؟ لا يمكن التراجع عن هذا الإجراء.')) {
    try {
      await ticketsStore.deleteTicket(id)
      if (selectedTicket.value && selectedTicket.value.id == id) {
        closeModal()
      }
    } catch (err) {
      alert('فشل حذف التذكرة')
    }
  }
}

// Date formatter
function formatDate(dateStr) {
  if (!dateStr) return ''
  try {
    const date = new Date(dateStr)
    return date.toLocaleString('ar-EG', {
      year: 'numeric',
      month: 'numeric',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    })
  } catch (e) {
    return dateStr
  }
}

// WhatsApp redirect
function openWhatsapp(t) {
  const cleanPhone = t.client_phone.replace(/[^0-9+]/g, '')
  let finalPhone = cleanPhone
  if (cleanPhone.startsWith('01')) {
    finalPhone = '2' + cleanPhone
  }
  const msg = encodeURIComponent(
    `مرحباً أ. ${t.client_name}، تواصلنا معك من دعم Remotelly بخصوص تذكرتك رقم ${t.ticket_number} لمشكلة "${t.title}" على نظام "${t.system_name}".`
  )
  window.open(`https://wa.me/${finalPhone}?text=${msg}`, '_blank')
}

// English labels to Arabic
const statusLabels = {
  open: 'مفتوحة 🆕',
  in_progress: 'قيد المعالجة ⏳',
  resolved: 'تم الحل ✅',
  closed: 'مغلقة 🔒'
}

const statusBadgeColors = {
  open: 'bg-vibrant-purple/10 text-vibrant-purple border border-vibrant-purple/20',
  in_progress: 'bg-vibrant-blue/10 text-vibrant-blue border border-vibrant-blue/20',
  resolved: 'bg-vibrant-teal/10 text-vibrant-teal border border-vibrant-teal/20',
  closed: 'bg-slate-800 text-slate-400 border border-slate-700'
}

const priorityLabels = {
  low: 'منخفضة',
  medium: 'متوسطة',
  high: 'عالية',
  urgent: 'عاجلة جداً 🔥'
}

const priorityBadgeColors = {
  low: 'bg-slate-800 text-slate-400 border border-slate-700',
  medium: 'bg-vibrant-blue/15 text-vibrant-blue border border-vibrant-blue/30',
  high: 'bg-vibrant-pink/15 text-vibrant-pink border border-vibrant-pink/30',
  urgent: 'bg-red-500/15 text-red-400 border border-red-500/30'
}
</script>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}
.animate-fade-in {
  animation: fadeIn 0.2s ease-out forwards;
}
</style>
