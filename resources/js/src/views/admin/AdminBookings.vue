<template>
  <div class="space-y-6 text-right">
    
    <!-- Title Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-dark-border pb-5 gap-4">
      <div>
        <h2 class="font-display font-black text-2xl text-white">إدارة اجتماعات الاستشارة</h2>
        <p class="text-dark-muted text-xs mt-1">جدولة وتأكيد اجتماعات الفيديو مع العملاء لمناقشة تفعيل الأنظمة وتطوير الأفكار المخصصة</p>
      </div>

      <!-- Filters & Stats -->
      <div class="flex items-center gap-3">
        <span class="text-xs font-bold text-dark-muted">تصفية حسب:</span>
        <select 
          v-model="statusFilter" 
          class="px-4 py-2.5 rounded-xl border border-dark-border bg-dark-card text-dark-text text-xs font-medium focus:outline-none focus:ring-2 focus:ring-primary-400 transition-all cursor-pointer"
        >
          <option value="all">كل المواعيد ({{ totalCount }})</option>
          <option value="new">جديد بانتظار التأكيد ({{ newCount }})</option>
          <option value="confirmed">تم التأكيد ({{ confirmedCount }})</option>
          <option value="completed">اجتماعات منتهية</option>
          <option value="cancelled">ملغاة</option>
        </select>
      </div>
    </div>

    <!-- Quick Stats Cards (Dark & Cheerful Glow) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <div class="bg-dark-card border border-dark-border rounded-2xl p-5 flex items-center justify-between shadow-sm relative overflow-hidden group hover:border-vibrant-pink/40 transition-all duration-300">
        <div class="absolute -right-6 -bottom-6 w-20 h-20 bg-vibrant-pink rounded-full blur-2xl opacity-5"></div>
        <div>
          <span class="text-[10px] text-dark-muted font-bold block uppercase tracking-wider mb-1">الطلبات الجديدة</span>
          <span class="text-2xl font-mono font-bold text-vibrant-pink">{{ newCount }}</span>
        </div>
        <div class="w-10 h-10 bg-vibrant-pink/10 rounded-xl flex items-center justify-center text-vibrant-pink text-lg shadow-neon-purple/5">
          🔔
        </div>
      </div>

      <div class="bg-dark-card border border-dark-border rounded-2xl p-5 flex items-center justify-between shadow-sm relative overflow-hidden group hover:border-vibrant-blue/40 transition-all duration-300">
        <div class="absolute -right-6 -bottom-6 w-20 h-20 bg-vibrant-blue rounded-full blur-2xl opacity-5"></div>
        <div>
          <span class="text-[10px] text-dark-muted font-bold block uppercase tracking-wider mb-1">الاجتماعات المؤكدة</span>
          <span class="text-2xl font-mono font-bold text-vibrant-blue">{{ confirmedCount }}</span>
        </div>
        <div class="w-10 h-10 bg-vibrant-blue/10 rounded-xl flex items-center justify-center text-vibrant-blue text-lg">
          📅
        </div>
      </div>

      <div class="bg-dark-card border border-dark-border rounded-2xl p-5 flex items-center justify-between shadow-sm relative overflow-hidden group hover:border-vibrant-teal/40 transition-all duration-300">
        <div class="absolute -right-6 -bottom-6 w-20 h-20 bg-vibrant-teal rounded-full blur-2xl opacity-5"></div>
        <div>
          <span class="text-[10px] text-dark-muted font-bold block uppercase tracking-wider mb-1">اجتماعات منتهية</span>
          <span class="text-2xl font-mono font-bold text-vibrant-teal">{{ completedCount }}</span>
        </div>
        <div class="w-10 h-10 bg-vibrant-teal/10 rounded-xl flex items-center justify-center text-vibrant-teal text-lg">
          ✓
        </div>
      </div>

      <div class="bg-dark-card border border-dark-border rounded-2xl p-5 flex items-center justify-between shadow-sm relative overflow-hidden group hover:border-vibrant-purple/40 transition-all duration-300">
        <div class="absolute -right-6 -bottom-6 w-20 h-20 bg-primary-400 rounded-full blur-2xl opacity-5"></div>
        <div>
          <span class="text-[10px] text-dark-muted font-bold block uppercase tracking-wider mb-1">إجمالي الحجوزات</span>
          <span class="text-2xl font-mono font-bold text-vibrant-purple">{{ totalCount }}</span>
        </div>
        <div class="w-10 h-10 bg-primary-400/10 rounded-xl flex items-center justify-center text-vibrant-purple text-lg">
          📈
        </div>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
      
      <!-- Meetings Table (Dark Glassmorphism Grid) -->
      <div class="lg:col-span-2 space-y-4">
        <h3 class="text-base font-bold text-white mb-1">سجل الاجتماعات والمكالمات</h3>
        
        <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden shadow-sm">
          <div v-if="filteredBookings.length > 0" class="overflow-x-auto">
            <table class="w-full text-right text-xs border-collapse">
              <thead>
                <tr class="bg-dark-hover/60 text-dark-muted font-bold border-b border-dark-border">
                  <th class="p-4 w-10 text-center">#</th>
                  <th class="p-4">العميل</th>
                  <th class="p-4">النشاط التجاري</th>
                  <th class="p-4">الأنظمة المطلوبة / الفكرة</th>
                  <th class="p-4">الموعد المحجوز</th>
                  <th class="p-4 text-center">رابط البث</th>
                  <th class="p-4 text-center">الحالة</th>
                  <th class="p-4 text-center">إجراءات</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-dark-border/40">
                <tr 
                  v-for="(b, idx) in filteredBookings" 
                  :key="b.id" 
                  class="hover:bg-dark-hover/30 transition-colors duration-150"
                >
                  <td class="p-4 text-center font-mono text-dark-muted">{{ idx + 1 }}</td>
                  <td class="p-4">
                    <span class="font-bold block text-dark-text">{{ b.clientName }}</span>
                    <span class="text-[10px] text-dark-muted font-mono block mt-1" dir="ltr">{{ b.clientPhone }}</span>
                  </td>
                  <td class="p-4 text-dark-muted font-medium">{{ b.businessType }}</td>
                  
                  <td class="p-4">
                    <!-- Products Tagged -->
                    <div v-if="b.selectedProducts && b.selectedProducts.length > 0" class="flex flex-wrap gap-1">
                      <span 
                        v-for="p in b.selectedProducts" 
                        :key="p"
                        class="bg-primary-400/10 text-vibrant-purple px-2 py-0.5 rounded text-[9px] font-bold border border-primary-400/20"
                      >
                        {{ p }}
                      </span>
                    </div>
                    <!-- Custom Idea Indicator -->
                    <div v-if="b.customProgramIdea" class="mt-1">
                      <span 
                        class="inline-block bg-vibrant-pink/10 text-vibrant-pink px-2 py-0.5 rounded text-[9px] font-bold border border-vibrant-pink/20 cursor-pointer"
                        :title="b.customProgramIdea"
                        @click="showIdeaAlert(b.clientName, b.customProgramIdea)"
                      >
                        💡 فكرة مخصصة (اضغط للعرض)
                      </span>
                    </div>
                  </td>

                  <td class="p-4">
                    <span class="font-bold block text-vibrant-cyan font-mono">{{ b.meetingDate }}</span>
                    <span class="text-[10px] text-dark-muted block mt-0.5">{{ b.meetingTimeSlot }}</span>
                  </td>

                  <!-- Meeting Link cell -->
                  <td class="p-4 text-center">
                    <div v-if="b.meetingLink" class="flex items-center justify-center gap-1.5">
                      <a 
                        :href="b.meetingLink" 
                        target="_blank" 
                        class="text-vibrant-blue hover:text-blue-400 font-bold underline text-[10px] block"
                      >
                        دخول الاجتماع
                      </a>
                      <button 
                        @click="openLinkEdit(b)" 
                        class="text-dark-muted hover:text-white transition-colors"
                        title="تعديل الرابط"
                      >
                        ✏️
                      </button>
                    </div>
                    <button 
                      v-else 
                      @click="openLinkEdit(b)"
                      class="bg-dark-hover hover:bg-dark-border text-vibrant-cyan border border-dark-border px-2.5 py-1 rounded text-[10px] font-bold transition-all cursor-pointer"
                    >
                      + إضافة رابط
                    </button>
                  </td>

                  <!-- Status badge -->
                  <td class="p-4 text-center">
                    <span 
                      :class="[
                        'inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-bold border',
                        getStatusClasses(b.status)
                      ]"
                    >
                      {{ getStatusText(b.status) }}
                    </span>
                  </td>

                  <!-- Action buttons -->
                  <td class="p-4">
                    <div class="flex items-center justify-center gap-1.5">
                      <!-- WhatsApp -->
                      <button 
                        @click="contactClient(b)" 
                        class="bg-green-950/40 hover:bg-green-900/40 text-green-400 p-1.5 rounded-lg border border-green-900/30 transition-all cursor-pointer"
                        title="تواصل واتساب لتنسيق المقابلة"
                      >
                        💬
                      </button>

                      <!-- Change status toggle -->
                      <button 
                        @click="cycleStatus(b)" 
                        class="bg-dark-hover hover:bg-dark-border text-dark-text p-1.5 rounded-lg border border-dark-border transition-all cursor-pointer"
                        title="تحديث الحالة"
                      >
                        🔄
                      </button>

                      <!-- Delete -->
                      <button 
                        @click="deleteItem(b.id)" 
                        class="bg-red-950/40 hover:bg-red-900/40 text-red-400 p-1.5 rounded-lg border border-red-900/30 transition-all cursor-pointer"
                        title="حذف الحجز"
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
          <div v-else class="text-center py-16 px-4">
            <div class="w-16 h-16 bg-dark-hover rounded-full flex items-center justify-center text-dark-muted text-xl mx-auto mb-4 border border-dark-border">
              📅
            </div>
            <h4 class="font-bold text-sm text-white mb-1">لا توجد حجوزات اجتماعات</h4>
            <p class="text-dark-muted text-xs">لم يتم العثور على مواعيد مطابقة للتصفية الحالية.</p>
          </div>
        </div>
      </div>

      <!-- Settings Panel / Available Times Config -->
      <div class="space-y-6">
        <!-- Add/Edit Link Modal-like Card -->
        <div v-if="editingBooking" class="bg-dark-card border border-vibrant-purple/40 shadow-neon-purple rounded-2xl p-5 space-y-4">
          <h4 class="text-xs font-bold text-white flex items-center gap-1.5">
            <span class="text-vibrant-purple">🔗</span>
            <span>تحديث رابط البث المباشر</span>
          </h4>
          <p class="text-[10px] text-dark-muted">إضافة رابط Google Meet أو Zoom وتأكيده للعميل: <b class="text-dark-text">{{ editingBooking.clientName }}</b></p>
          
          <div>
            <label class="block text-[10px] font-bold text-dark-muted mb-1">رابط الاجتماع أونلاين</label>
            <input 
              type="url" 
              v-model="meetLinkInput" 
              placeholder="https://meet.google.com/..."
              class="w-full px-3 py-2 rounded-xl border border-dark-border bg-dark-bg text-xs focus:outline-none focus:ring-2 focus:ring-primary-400 text-left font-mono"
              dir="ltr"
            />
          </div>

          <div class="flex items-center gap-2 pt-1">
            <button 
              @click="saveMeetingLink" 
              class="flex-grow bg-gradient-to-r from-primary-400 to-vibrant-purple text-white text-[10px] font-bold py-2 px-3 rounded-lg transition-all shadow-neon-purple/20 cursor-pointer"
            >
              حفظ وتأكيد الرابط
            </button>
            <button 
              @click="cancelLinkEdit" 
              class="bg-dark-hover hover:bg-dark-border text-dark-text text-[10px] font-bold py-2 px-3 rounded-lg border border-dark-border transition-all cursor-pointer"
            >
              إلغاء
            </button>
          </div>
        </div>

        <!-- Available Times List -->
        <div class="bg-dark-card border border-dark-border rounded-2xl p-5 space-y-4">
          <h4 class="text-xs font-bold text-white flex items-center gap-1.5">
            <span class="text-vibrant-cyan">⏳</span>
            <span>المواعيد اليومية المتاحة</span>
          </h4>
          <p class="text-[10px] text-dark-muted leading-relaxed">المواعيد الافتراضية التي تظهر للعملاء في استمارة الحجز. يتم منع حجز نفس الوقت مرتين بنفس اليوم تلقائياً.</p>

          <!-- List of Slots -->
          <div class="space-y-1.5 max-h-60 overflow-y-auto pr-1">
            <div 
              v-for="time in timeSlots" 
              :key="time"
              class="flex items-center justify-between bg-dark-bg border border-dark-border p-2.5 rounded-xl text-xs hover:border-dark-hover"
            >
              <span class="font-mono text-dark-text font-bold">{{ time }}</span>
              <span class="text-[9px] px-2 py-0.5 bg-green-950/20 text-green-400 rounded-md border border-green-900/35">مفعلة وتعمل</span>
            </div>
          </div>
          
          <div class="bg-dark-hover/30 border border-dark-border/40 p-3 rounded-xl text-[10px] text-dark-muted font-body">
            💡 <b>ملاحظة:</b> لحجز موعد جديد، يختار العميل أي يوم عمل (باستثناء الجمعة) وأي فترة زمنية من هذه الفترات.
          </div>
        </div>
      </div>

    </div>

  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useBookingsStore } from '../../stores/useBookingsStore'

const bookingsStore = useBookingsStore()

const statusFilter = ref('all')
const editingBooking = ref(null)
const meetLinkInput = ref('')

onMounted(() => {
  bookingsStore.fetchBookings()
})

// Default slots display
const timeSlots = [
  '10:00 ص',
  '11:00 ص',
  '12:00 م',
  '01:00 م',
  '02:00 م',
  '03:00 م',
  '04:00 م',
  '05:00 م',
  '08:00 م'
]

const totalCount = computed(() => bookingsStore.bookings.length)
const newCount = computed(() => bookingsStore.bookings.filter(b => b.status === 'new').length)
const confirmedCount = computed(() => bookingsStore.bookings.filter(b => b.status === 'confirmed').length)
const completedCount = computed(() => bookingsStore.bookings.filter(b => b.status === 'completed').length)

const filteredBookings = computed(() => {
  if (statusFilter.value === 'all') return bookingsStore.bookings
  return bookingsStore.bookings.filter(b => b.status === statusFilter.value)
})

function getStatusText(status) {
  switch (status) {
    case 'new': return 'جديد'
    case 'confirmed': return 'تم التأكيد'
    case 'completed': return 'مكتمل'
    case 'cancelled': return 'ملغى'
    default: return status
  }
}

function getStatusClasses(status) {
  switch (status) {
    case 'new': return 'bg-vibrant-pink/10 text-vibrant-pink border-vibrant-pink/20 shadow-neon-purple/5'
    case 'confirmed': return 'bg-vibrant-blue/10 text-vibrant-blue border-vibrant-blue/20'
    case 'completed': return 'bg-vibrant-teal/10 text-vibrant-teal border-vibrant-teal/20'
    case 'cancelled': return 'bg-red-950/30 text-red-400 border-red-900/30'
    default: return 'bg-dark-hover text-dark-muted border-dark-border'
  }
}

function showIdeaAlert(client, idea) {
  alert(`💡 فكرة البرنامج المخصصة من العميل (${client}):\n\n"${idea}"`)
}

function openLinkEdit(booking) {
  editingBooking.value = booking
  meetLinkInput.value = booking.meetingLink || ''
}

function cancelLinkEdit() {
  editingBooking.value = null
  meetLinkInput.value = ''
}

function saveMeetingLink() {
  if (editingBooking.value) {
    bookingsStore.updateBookingMeetingLink(editingBooking.value.id, meetLinkInput.value)
    
    // Automatically confirm the meeting if it was new when link is added
    if (editingBooking.value.status === 'new') {
      bookingsStore.updateBookingStatus(editingBooking.value.id, 'confirmed')
    }
    
    editingBooking.value = null
    meetLinkInput.value = ''
  }
}

function cycleStatus(b) {
  const nextStatus = {
    new: 'confirmed',
    confirmed: 'completed',
    completed: 'cancelled',
    cancelled: 'new'
  }
  bookingsStore.updateBookingStatus(b.id, nextStatus[b.status] || 'new')
}

function contactClient(b) {
  const cleanPhone = b.clientPhone.replace(/[^0-9+]/g, '')
  let finalPhone = cleanPhone
  if (cleanPhone.startsWith('01')) {
    finalPhone = '2' + cleanPhone
  }
  
  let msgText = `مرحباً أ. ${b.clientName}، تواصلنا معك من فريق Remotelly بخصوص استشارة تفعيل نظامك المقرر عقدها يوم ${b.meetingDate} الساعة ${b.meetingTimeSlot}.`
  if (b.meetingLink) {
    msgText += ` رابط الاجتماع أونلاين: ${b.meetingLink}`
  }
  
  const msg = encodeURIComponent(msgText)
  window.open(`https://wa.me/${finalPhone}?text=${msg}`, '_blank')
}

function deleteItem(id) {
  if (confirm('هل أنت متأكد من حذف حجز الاجتماع هذا نهائياً؟')) {
    bookingsStore.deleteBooking(id)
  }
}
</script>
