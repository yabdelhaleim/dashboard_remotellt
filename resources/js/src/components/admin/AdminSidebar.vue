<template>
  <aside class="w-64 bg-dark-card text-dark-text min-h-screen p-5 flex flex-col justify-between border-l border-dark-border text-right select-none shrink-0 relative">
    <!-- Glowing background accent behind sidebar header -->
    <div class="absolute -top-12 -right-12 w-36 h-36 bg-primary-400 rounded-full blur-2xl opacity-10 pointer-events-none"></div>

    <div>
      <!-- Brand Header -->
      <div class="mb-8 border-b border-dark-border pb-5 relative">
        <span class="font-display font-black text-2xl tracking-wider block text-white">
          REMOTE<span class="text-vibrant-purple drop-shadow-[0_0_8px_rgba(168,85,247,0.5)]">lly</span>
        </span>
        <span class="text-[9px] text-vibrant-cyan font-mono tracking-widest block mt-1">SaaS ENTERPRISE</span>
      </div>

      <!-- Navigation -->
      <nav class="space-y-2 font-body">
        
        <!-- Requests Link -->
        <router-link 
          to="/admin/requests" 
          class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-dark-hover hover:text-white transition-all duration-200 text-sm group"
          active-class="bg-primary-400/20 text-white font-bold border-r-4 border-vibrant-purple shadow-neon-purple/20"
        >
          <div class="flex items-center gap-3">
            <span class="text-vibrant-pink group-hover:scale-110 transition-transform">📥</span>
            <span>طلبات التفعيل</span>
          </div>
          <span 
            v-if="newRequestsCount > 0"
            class="bg-vibrant-pink text-white text-[10px] font-mono font-bold px-2 py-0.5 rounded-lg shadow-sm"
          >
            {{ newRequestsCount }}
          </span>
        </router-link>

        <!-- Bookings Link -->
        <router-link 
          to="/admin/bookings" 
          class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-dark-hover hover:text-white transition-all duration-200 text-sm group"
          active-class="bg-primary-400/20 text-white font-bold border-r-4 border-vibrant-purple shadow-neon-purple/20"
        >
          <div class="flex items-center gap-3">
            <span class="text-vibrant-blue group-hover:scale-110 transition-transform">📅</span>
            <span>حجوزات الاجتماعات</span>
          </div>
          <span 
            v-if="newBookingsCount > 0"
            class="bg-vibrant-blue text-white text-[10px] font-mono font-bold px-2 py-0.5 rounded-lg shadow-sm animate-pulse"
          >
            {{ newBookingsCount }}
          </span>
        </router-link>

        <!-- Products Link -->
        <router-link 
          to="/admin/products" 
          class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-dark-hover hover:text-white transition-all duration-200 text-sm group"
          active-class="bg-primary-400/20 text-white font-bold border-r-4 border-vibrant-purple shadow-neon-purple/20"
        >
          <span class="text-vibrant-teal group-hover:scale-110 transition-transform">💻</span>
          <span>إدارة البرامج والأنظمة</span>
        </router-link>

        <!-- Packages Link -->
        <router-link 
          to="/admin/packages" 
          class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-dark-hover hover:text-white transition-all duration-200 text-sm group"
          active-class="bg-primary-400/20 text-white font-bold border-r-4 border-vibrant-purple shadow-neon-purple/20"
        >
          <span class="text-vibrant-teal group-hover:scale-110 transition-transform">📦</span>
          <span>إدارة الباقات والأسعار</span>
        </router-link>

        <!-- Tickets Link -->
        <router-link 
          to="/admin/tickets" 
          class="flex items-center justify-between px-4 py-3 rounded-xl hover:bg-dark-hover hover:text-white transition-all duration-200 text-sm group"
          active-class="bg-primary-400/20 text-white font-bold border-r-4 border-vibrant-purple shadow-neon-purple/20"
        >
          <div class="flex items-center gap-3">
            <span class="text-vibrant-purple group-hover:scale-110 transition-transform">🎫</span>
            <span>تذاكر الدعم الفني</span>
          </div>
          <span 
            v-if="openTicketsCount > 0"
            class="bg-vibrant-purple text-white text-[10px] font-mono font-bold px-2 py-0.5 rounded-lg shadow-sm"
          >
            {{ openTicketsCount }}
          </span>
        </router-link>

      </nav>
    </div>

    <!-- Sidebar Footer -->
    <div class="border-t border-dark-border pt-5">
      <button 
        @click="handleLogout" 
        class="w-full bg-dark-bg hover:bg-red-950/40 hover:text-red-400 text-dark-muted font-body text-xs font-bold py-3 px-4 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 border border-dark-border hover:border-red-900 cursor-pointer"
      >
        <span>🚪</span>
        <span>تسجيل الخروج</span>
      </button>
    </div>
  </aside>
</template>

<script setup>
import { computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useRequestsStore } from '../../stores/useRequestsStore'
import { useBookingsStore } from '../../stores/useBookingsStore'
import { useTicketsStore } from '../../stores/useTicketsStore'
import { useAuthStore } from '../../stores/useAuthStore'

const router = useRouter()
const requestsStore = useRequestsStore()
const bookingsStore = useBookingsStore()
const ticketsStore = useTicketsStore()
const authStore = useAuthStore()

const newRequestsCount = computed(() => requestsStore.newCount)
const newBookingsCount = computed(() => bookingsStore.newBookingsCount)
const openTicketsCount = computed(() => ticketsStore.openTicketsCount)

onMounted(() => {
  requestsStore.fetchRequests()
  bookingsStore.fetchBookings()
  ticketsStore.fetchTickets()
})

function handleLogout() {
  authStore.logout()
  router.push('/')
}
</script>
