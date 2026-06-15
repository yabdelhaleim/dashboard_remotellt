import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

const API = '/api'

export const useBookingsStore = defineStore('bookings', () => {
  const bookings        = ref([])
  const availableDates  = ref([])
  const loading         = ref(false)
  const error           = ref(null)

  // ── Fetch all bookings (admin) ──────────────────────────────────
  async function fetchBookings() {
    loading.value = true
    try {
      const res = await fetch(`${API}/bookings`)
      bookings.value = await res.json()
    } catch (e) {
      error.value = e.message
    } finally {
      loading.value = false
    }
  }

  // ── Fetch available dates (public) ──────────────────────────────
  async function fetchAvailableDates() {
    const res = await fetch(`${API}/bookings/available-dates`)
    availableDates.value = await res.json()
    return availableDates.value
  }

  // ── Fetch available time slots for a given date ─────────────────
  async function fetchAvailableSlots(date) {
    const res   = await fetch(`${API}/bookings/available-slots?date=${date}`)
    return await res.json()   // returns array of time strings
  }

  // ── Add booking (public wizard) ─────────────────────────────────
  async function addBooking(data) {
    const res  = await fetch(`${API}/bookings`, {
      method:  'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body:    JSON.stringify(data),
    })
    const json = await res.json()
    if (!res.ok) throw new Error(json.message || 'فشل الحجز')
    bookings.value.unshift(json)
    return json
  }

  // ── Update status (admin) ───────────────────────────────────────
  async function updateBookingStatus(id, status) {
    const res  = await fetch(`${API}/bookings/${id}/status`, {
      method:  'PATCH',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body:    JSON.stringify({ status }),
    })
    const data = await res.json()
    const idx  = bookings.value.findIndex(b => b.id == id)
    if (idx !== -1) bookings.value[idx] = data
    return data
  }

  // ── Update meeting link (admin) ─────────────────────────────────
  async function updateBookingMeetingLink(id, link) {
    const res  = await fetch(`${API}/bookings/${id}/link`, {
      method:  'PATCH',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body:    JSON.stringify({ meeting_link: link }),
    })
    const data = await res.json()
    const idx  = bookings.value.findIndex(b => b.id == id)
    if (idx !== -1) bookings.value[idx] = data
    return data
  }

  // ── Delete booking (admin) ──────────────────────────────────────
  async function deleteBooking(id) {
    await fetch(`${API}/bookings/${id}`, { method: 'DELETE' })
    bookings.value = bookings.value.filter(b => b.id != id)
  }

  // ── Computed ────────────────────────────────────────────────────
  const newBookingsCount = computed(() =>
    bookings.value.filter(b => b.status === 'new').length
  )

  return {
    bookings, availableDates, loading, error, newBookingsCount,
    fetchBookings, fetchAvailableDates, fetchAvailableSlots,
    addBooking, updateBookingStatus, updateBookingMeetingLink, deleteBooking,
  }
})
