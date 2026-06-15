<template>
  <div class="space-y-6 text-right text-dark-text font-body">
    
    <!-- Title Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-dark-border pb-5 gap-4">
      <div>
        <h2 class="font-display font-black text-2xl text-white">سجل طلبات تفعيل الأنظمة</h2>
        <p class="text-dark-muted text-xs mt-1">إدارة وتتبع طلبات العملاء الفورية لتفعيل الأنظمة والاشتراكات السحابية</p>
      </div>

      <!-- Filter Dropdown -->
      <div class="flex items-center gap-3">
        <span class="text-xs font-bold text-dark-muted">تصفية حسب:</span>
        <select 
          v-model="filter" 
          class="px-4 py-2.5 rounded-xl border border-dark-border bg-dark-card text-dark-text text-xs font-medium focus:outline-none focus:ring-2 focus:ring-primary-400 transition-all cursor-pointer"
        >
          <option value="all">كل الطلبات ({{ totalCount }})</option>
          <option value="new">طلبات جديدة ({{ newCount }})</option>
          <option value="contacted">تم التواصل</option>
          <option value="closed">مغلق / تم تفعيل النظام</option>
        </select>
      </div>
    </div>

    <!-- Table Container (Dark Glassmorphism Grid) -->
    <div class="bg-dark-card rounded-2xl border border-dark-border shadow-sm overflow-hidden">
      
      <div v-if="filteredRequests.length > 0" class="overflow-x-auto">
        <table class="w-full text-right text-xs border-collapse">
          <thead>
            <tr class="bg-dark-hover/60 text-dark-muted font-bold border-b border-dark-border">
              <th class="p-4 w-10 text-center">#</th>
              <th class="p-4">اسم العميل</th>
              <th class="p-4">رقم الهاتف</th>
              <th class="p-4">النشاط التجاري</th>
              <th class="p-4">البرنامج المطلوب</th>
              <th class="p-4">الباقة</th>
              <th class="p-4 text-center">الحالة</th>
              <th class="p-4">تاريخ الطلب</th>
              <th class="p-4 text-center">إجراءات</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-dark-border/40">
            <tr 
              v-for="(r, idx) in filteredRequests" 
              :key="r.id" 
              class="hover:bg-dark-hover/30 transition-colors duration-150"
            >
              <td class="p-4 text-center font-mono text-dark-muted">{{ idx + 1 }}</td>
              <td class="p-4">
                <span class="font-bold text-white block">{{ r.name }}</span>
                <span v-if="r.address" class="text-[10px] text-dark-muted block mt-0.5">{{ r.address }}</span>
              </td>
              <td class="p-4 font-mono text-dark-text" dir="ltr">{{ r.phone }}</td>
              <td class="p-4 text-dark-muted font-medium">{{ r.business }}</td>
              <td class="p-4">
                <span class="font-bold text-vibrant-purple">{{ r.product }}</span>
              </td>
              <td class="p-4">
                <span class="bg-dark-bg/80 border border-dark-border px-2 py-0.5 rounded text-[10px] font-mono text-vibrant-cyan">
                  {{ r.package }}
                </span>
              </td>
              
              <!-- Status Badge -->
              <td class="p-4 text-center">
                <span 
                  :class="[
                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-bold border',
                    getStatusBadgeClasses(r.status)
                  ]"
                >
                  {{ getStatusText(r.status) }}
                </span>
              </td>
              
              <!-- Created At -->
              <td class="p-4 text-[10px] font-mono text-dark-muted">
                {{ formatDateTime(r.createdAt) }}
              </td>

              <!-- Actions -->
              <td class="p-4">
                <div class="flex items-center justify-center gap-1.5">
                  <!-- WhatsApp Customer Link -->
                  <button 
                    @click="openWhatsapp(r)" 
                    class="bg-green-950/40 hover:bg-green-900/40 text-green-400 p-1.5 rounded-lg border border-green-900/30 transition-all cursor-pointer"
                    title="تواصل واتساب مباشر لتفعيل النظام"
                  >
                    💬
                  </button>

                  <!-- Cycle Status -->
                  <button 
                    @click="cycleStatus(r)" 
                    class="bg-dark-hover hover:bg-dark-border text-dark-text p-1.5 rounded-lg border border-dark-border transition-all cursor-pointer"
                    title="تحديث حالة الطلب"
                  >
                    🔄
                  </button>

                  <!-- Delete -->
                  <button 
                    @click="removeRequest(r.id)" 
                    class="bg-red-950/40 hover:bg-red-900/40 text-red-400 p-1.5 rounded-lg border border-red-900/30 transition-all cursor-pointer"
                    title="حذف الطلب"
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
          📥
        </div>
        <h3 class="font-bold text-sm text-white mb-1">لا توجد طلبات تفعيل</h3>
        <p class="text-dark-muted text-xs">لا تتوفر أي طلبات مطابقة لمعايير البحث الحالية.</p>
      </div>

    </div>

  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRequestsStore } from '../../stores/useRequestsStore'

const requestsStore = useRequestsStore()
const filter = ref('all')

onMounted(() => {
  requestsStore.fetchRequests()
})

const filteredRequests = computed(() => {
  if (filter.value === 'all') return requestsStore.requests
  return requestsStore.requests.filter(r => r.status === filter.value)
})

const totalCount = computed(() => requestsStore.requests.length)
const newCount = computed(() => requestsStore.requests.filter(r => r.status === 'new').length)

function getStatusText(status) {
  switch (status) {
    case 'new': return 'جديد'
    case 'contacted': return 'تم التواصل'
    case 'closed': return 'تم التفعيل / مغلق'
    default: return status
  }
}

function getStatusBadgeClasses(status) {
  switch (status) {
    case 'new': return 'bg-vibrant-pink/10 text-vibrant-pink border-vibrant-pink/20 shadow-neon-purple/5'
    case 'contacted': return 'bg-vibrant-blue/10 text-vibrant-blue border-vibrant-blue/20'
    case 'closed': return 'bg-vibrant-teal/10 text-vibrant-teal border-vibrant-teal/20'
    default: return 'bg-dark-hover text-dark-muted border-dark-border'
  }
}

function formatDateTime(isoString) {
  if (!isoString) return ''
  try {
    return new Date(isoString).toLocaleString('ar-EG', {
      year: 'numeric',
      month: 'numeric',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    })
  } catch (e) {
    return isoString
  }
}

function openWhatsapp(r) {
  const cleanPhone = r.phone.replace(/[^0-9+]/g, '')
  let finalPhone = cleanPhone
  if (cleanPhone.startsWith('01')) {
    finalPhone = '2' + cleanPhone
  }
  const msg = encodeURIComponent(`مرحباً أ. ${r.name}، تواصلنا معك من فريق Remotelly بخصوص طلبك لتفعيل نظام "${r.product}" - باقة "${r.package}".`)
  window.open(`https://wa.me/${finalPhone}?text=${msg}`, '_blank')
}

function cycleStatus(r) {
  const map = {
    new: 'contacted',
    contacted: 'closed',
    closed: 'new'
  }
  requestsStore.updateStatus(r.id, map[r.status] || 'new')
}

function removeRequest(id) {
  if (confirm('هل أنت متأكد من رغبتك في حذف هذا الطلب نهائياً؟')) {
    requestsStore.deleteRequest(id)
  }
}
</script>
