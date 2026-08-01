<template>
  <div class="relative" v-click-outside="closeDropdown">
    <!-- Bell button -->
    <button
      @click="toggleDropdown"
      class="relative w-10 h-10 rounded-xl bg-dark-bg border border-dark-border/60 hover:border-primary-400/50 hover:bg-dark-hover flex items-center justify-center text-slate-300 hover:text-white transition-all duration-200 cursor-pointer"
      :class="{ 'border-primary-400/60 bg-dark-hover text-white': isOpen }"
      :aria-label="`${unreadCount} إشعار غير مقروء`"
    >
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 00-4-5.7V5a2 2 0 10-4 0v.3A6 6 0 006 11v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0" />
      </svg>

      <!-- Badge -->
      <span
        v-if="unreadCount > 0"
        class="absolute -top-1.5 -right-1.5 min-w-[20px] h-5 px-1.5 rounded-full bg-gradient-to-br from-red-500 to-pink-600 text-white text-[10px] font-bold flex items-center justify-center shadow-lg shadow-red-500/30 ring-2 ring-dark-card"
        :class="{ 'animate-bounce-once': justBumped }"
      >
        {{ unreadCount > 99 ? '99+' : unreadCount }}
      </span>

      <!-- Pulsing dot (when 1+ unread) -->
      <span
        v-if="unreadCount > 0 && !isOpen"
        class="absolute top-1 right-1 w-2 h-2 rounded-full bg-red-500 animate-pulse pointer-events-none"
      ></span>
    </button>

    <!-- Dropdown -->
    <Transition name="dropdown">
      <div
        v-if="isOpen"
        class="absolute top-full mt-2 right-0 rtl:left-0 rtl:right-auto w-[360px] max-h-[480px] bg-dark-card border border-dark-border rounded-2xl shadow-premium overflow-hidden z-50"
      >
        <!-- Header -->
        <div class="px-4 py-3 border-b border-dark-border bg-dark-bg/40 flex items-center justify-between">
          <div class="flex items-center gap-2">
            <span class="font-display font-bold text-sm text-white">الإشعارات</span>
            <span
              v-if="unreadCount > 0"
              class="bg-red-500/20 text-red-400 text-[10px] font-bold px-2 py-0.5 rounded-full border border-red-500/30"
            >
              {{ unreadCount }} جديد
            </span>
          </div>
          <div class="flex items-center gap-1">
            <button
              v-if="unreadCount > 0"
              @click="markAllRead"
              class="text-[10px] font-bold text-primary-400 hover:text-cyan-300 transition-colors cursor-pointer px-2 py-1 rounded-lg hover:bg-dark-hover"
              title="تحديد الكل كمقروء"
            >
              تحديد الكل كمقروء
            </button>
            <button
              @click="toggleMute"
              class="w-7 h-7 rounded-lg hover:bg-dark-hover text-slate-400 hover:text-white transition-all duration-200 flex items-center justify-center cursor-pointer"
              :title="muted ? 'إلغاء كتم الصوت' : 'كتم الصوت'"
            >
              <svg v-if="!muted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19 11a7 7 0 01-1.4 4.2l1.5 1.5a9 9 0 001.4-5.7M5 5l14 14M9 9v4l3 2 2-1m-5-5a7 7 0 0112 0" />
              </svg>
              <svg v-else viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5 5l14 14M12 19l3-3m-3 3l-3-3m6-9a7 7 0 00-10 0c0 1 .2 2 .5 2.9L5 12h7l3-3V5z" />
              </svg>
            </button>
          </div>
        </div>

        <!-- List -->
        <div class="max-h-[360px] overflow-y-auto">
          <div v-if="loading && notifications.length === 0" class="p-8 text-center">
            <div class="inline-block w-6 h-6 border-2 border-primary-400/30 border-t-primary-400 rounded-full animate-spin"></div>
            <p class="text-xs text-dark-muted mt-3 font-body">جاري التحميل...</p>
          </div>

          <div v-else-if="notifications.length === 0" class="p-8 text-center">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                 class="w-12 h-12 mx-auto text-dark-muted mb-3">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 00-4-5.7V5a2 2 0 10-4 0v.3A6 6 0 006 11v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0" />
            </svg>
            <p class="text-xs text-dark-muted font-body">لا توجد إشعارات حتى الآن</p>
          </div>

          <div
            v-for="n in notifications"
            :key="n.id"
            @click="onNotificationClick(n)"
            class="px-4 py-3 border-b border-dark-border/40 hover:bg-dark-hover cursor-pointer transition-colors duration-150"
            :class="{ 'bg-primary-400/5 border-r-2 rtl:border-l-2 rtl:border-r-0 border-primary-400': !n.is_read }"
          >
            <div class="flex items-start gap-3">
              <div
                class="w-9 h-9 shrink-0 rounded-xl flex items-center justify-center"
                :class="iconBg(n.type)"
              >
                <span class="text-lg" v-html="iconSvg(n.type)"></span>
              </div>
              <div class="min-w-0 flex-1">
                <div class="flex items-center justify-between gap-2 mb-1">
                  <span class="font-display font-bold text-xs text-white truncate">{{ n.title }}</span>
                  <span class="text-[9px] text-dark-muted font-mono whitespace-nowrap">{{ relativeTime(n.created_at) }}</span>
                </div>
                <p class="text-[11px] text-dark-muted font-body leading-relaxed line-clamp-2">{{ n.message }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <div v-if="notifications.length > 0" class="px-4 py-2 border-t border-dark-border/60 bg-dark-bg/30 text-center">
          <span class="text-[10px] text-dark-muted font-body">
            يتم التحديث كل {{ pollSeconds }} ثانية
          </span>
        </div>
      </div>
    </Transition>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount, watch } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()
const props = defineProps({
  pollSeconds: { type: Number, default: 10 },
})

const isOpen       = ref(false)
const loading      = ref(false)
const notifications = ref([])
const unreadCount  = ref(0)
const muted        = ref(localStorage.getItem('remotely_notif_muted') === '1')
const justBumped   = ref(false)

let pollTimer = null

const fetchNotifications = async (silent = false) => {
  if (!silent) loading.value = true
  try {
    const { data } = await axios.get('/api/admin/notifications', { params: { limit: 25 } })
    const newUnread = data.unread_count
    const hadNew    = newUnread > unreadCount.value
    notifications.value = data.notifications || []
    unreadCount.value    = newUnread
    if (hadNew && !muted.value) {
      playBeep()
      justBumped.value = true
      setTimeout(() => (justBumped.value = false), 1200)
    }
  } catch (e) {
    console.warn('[notifications] poll failed', e.message)
  } finally {
    if (!silent) loading.value = false
  }
}

const toggleDropdown = () => {
  isOpen.value = !isOpen.value
  if (isOpen.value) fetchNotifications(true)
}

const closeDropdown = () => (isOpen.value = false)

const onNotificationClick = async (n) => {
  if (!n.is_read) await markRead(n.id)
  closeDropdown()
  if (n.link) router.push(n.link)
}

const markRead = async (id) => {
  try {
    await axios.post(`/api/admin/notifications/${id}/read`)
    const item = notifications.value.find(x => x.id === id)
    if (item) item.is_read = true
    unreadCount.value = Math.max(0, unreadCount.value - 1)
  } catch (e) {
    console.warn('[notifications] mark read failed', e.message)
  }
}

const markAllRead = async () => {
  try {
    await axios.post('/api/admin/notifications/read-all')
    notifications.value.forEach(n => (n.is_read = true))
    unreadCount.value = 0
  } catch (e) {
    console.warn('[notifications] mark all read failed', e.message)
  }
}

const toggleMute = () => {
  muted.value = !muted.value
  localStorage.setItem('remotely_notif_muted', muted.value ? '1' : '0')
}

// ─────────────────────────────────────────────
// Web Audio API beep (no audio file needed)
// ─────────────────────────────────────────────
let audioCtx = null
const playBeep = () => {
  try {
    if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)()
    const osc = audioCtx.createOscillator()
    const gain = audioCtx.createGain()
    osc.type = 'sine'
    osc.frequency.setValueAtTime(880, audioCtx.currentTime)
    osc.frequency.exponentialRampToValueAtTime(660, audioCtx.currentTime + 0.15)
    gain.gain.setValueAtTime(0.18, audioCtx.currentTime)
    gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.4)
    osc.connect(gain).connect(audioCtx.destination)
    osc.start()
    osc.stop(audioCtx.currentTime + 0.4)
  } catch (e) {
    /* no audio available — silent fail */
  }
}

// ─────────────────────────────────────────────
// Helpers
// ─────────────────────────────────────────────
const iconSvg = (type) => {
  const map = {
    booking: '📅',
    ticket:  '🎫',
    lead:    '📥',
  }
  return map[type] || '🔔'
}

const iconBg = (type) => {
  const map = {
    booking: 'bg-primary-400/15 text-primary-400',
    ticket:  'bg-vibrant-purple/15 text-vibrant-purple',
    lead:    'bg-vibrant-cyan/15 text-vibrant-cyan',
  }
  return map[type] || 'bg-dark-hover text-slate-400'
}

const relativeTime = (iso) => {
  if (!iso) return ''
  const t = new Date(iso).getTime()
  const diff = Math.floor((Date.now() - t) / 1000)
  if (diff < 60)        return 'الآن'
  if (diff < 3600)      return `${Math.floor(diff / 60)} د`
  if (diff < 86400)      return `${Math.floor(diff / 3600)} س`
  return `${Math.floor(diff / 86400)} يوم`
}

// ─────────────────────────────────────────────
// Click-outside directive (inline)
// ─────────────────────────────────────────────
const vClickOutside = {
  mounted(el, binding) {
    el.__coHandler = (e) => { if (!el.contains(e.target)) binding.value?.(e) }
    document.addEventListener('click', el.__coHandler)
  },
  unmounted(el) {
    document.removeEventListener('click', el.__coHandler)
  },
}

// ─────────────────────────────────────────────
// Lifecycle
// ─────────────────────────────────────────────
onMounted(() => {
  fetchNotifications(true)
  pollTimer = setInterval(() => fetchNotifications(true), props.pollSeconds * 1000)
})

onBeforeUnmount(() => {
  if (pollTimer) clearInterval(pollTimer)
})
</script>

<style scoped>
/* Dropdown fade/slide */
.dropdown-enter-active,
.dropdown-leave-active {
  transition: all 0.18s cubic-bezier(0.16, 1, 0.3, 1);
}
.dropdown-enter-from,
.dropdown-leave-to {
  opacity: 0;
  transform: translateY(-6px) scale(0.96);
}

/* One-shot bounce when badge increments */
@keyframes bump {
  0%   { transform: scale(1); }
  35%  { transform: scale(1.25); }
  70%  { transform: scale(0.92); }
  100% { transform: scale(1); }
}
.animate-bounce-once {
  animation: bump 0.55s cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* Scrollbar inside dropdown */
.max-h-\[360px\]::-webkit-scrollbar { width: 4px; }
.max-h-\[360px\]::-webkit-scrollbar-track { background: transparent; }
.max-h-\[360px\]::-webkit-scrollbar-thumb { background: #1E2536; border-radius: 4px; }
</style>