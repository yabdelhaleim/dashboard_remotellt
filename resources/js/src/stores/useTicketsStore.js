import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

const API = '/api'

export const useTicketsStore = defineStore('tickets', () => {
  const tickets = ref([])
  const currentTicket = ref(null)
  const loading = ref(false)
  const error = ref(null)

  // ── Fetch all tickets (Admin) ───────────────────────────────────
  async function fetchTickets(params = {}) {
    loading.value = true
    error.value = null
    try {
      const queryParams = new URLSearchParams()
      if (params.status) queryParams.append('status', params.status)
      if (params.priority) queryParams.append('priority', params.priority)
      if (params.type) queryParams.append('type', params.type)
      if (params.search) queryParams.append('search', params.search)

      const res = await fetch(`${API}/tickets?${queryParams.toString()}`)
      if (!res.ok) throw new Error('فشل جلب التذاكر')
      tickets.value = await res.json()
    } catch (e) {
      error.value = e.message
    } finally {
      loading.value = false
    }
  }

  // ── Create a new ticket (Public) ────────────────────────────────
  async function createTicket(ticketData) {
    loading.value = true
    error.value = null
    try {
      const res = await fetch(`${API}/tickets`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(ticketData),
      })
      const data = await res.json()
      if (!res.ok) {
        throw new Error(data.message || 'فشل إرسال التذكرة')
      }
      return data
    } catch (e) {
      error.value = e.message
      throw e;
    } finally {
      loading.value = false
    }
  }

  // ── Track a ticket (Public) ─────────────────────────────────────
  async function trackTicket(ticketNumber, phone) {
    loading.value = true
    error.value = null
    currentTicket.value = null
    try {
      const queryParams = new URLSearchParams({
        ticket_number: ticketNumber,
        client_phone: phone
      })
      const res = await fetch(`${API}/tickets/track?${queryParams.toString()}`, {
        headers: { 'Accept': 'application/json' }
      })
      const data = await res.json()
      if (!res.ok) {
        throw new Error(data.message || 'فشل تتبع التذكرة')
      }
      currentTicket.value = data
      return data
    } catch (e) {
      error.value = e.message
      throw e;
    } finally {
      loading.value = false
    }
  }

  // ── Update status (Admin) ───────────────────────────────────────
  async function updateTicketStatus(id, status) {
    try {
      const res = await fetch(`${API}/tickets/${id}/status`, {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ status }),
      })
      const data = await res.json()
      if (!res.ok) throw new Error(data.message || 'فشل تحديث الحالة')
      
      const idx = tickets.value.findIndex(t => t.id == id)
      if (idx !== -1) tickets.value[idx] = data
      if (currentTicket.value && currentTicket.value.id == id) {
        currentTicket.value = data
      }
      return data
    } catch (e) {
      console.error(e)
      throw e
    }
  }

  // ── Update priority (Admin) ─────────────────────────────────────
  async function updateTicketPriority(id, priority) {
    try {
      const res = await fetch(`${API}/tickets/${id}/priority`, {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ priority }),
      })
      const data = await res.json()
      if (!res.ok) throw new Error(data.message || 'فشل تحديث الأهمية')

      const idx = tickets.value.findIndex(t => t.id == id)
      if (idx !== -1) tickets.value[idx] = data
      if (currentTicket.value && currentTicket.value.id == id) {
        currentTicket.value = data
      }
      return data
    } catch (e) {
      console.error(e)
      throw e
    }
  }

  // ── Reply to ticket (Admin) ─────────────────────────────────────
  async function replyToTicket(id, adminReply, status = null) {
    try {
      const body = { admin_reply: adminReply }
      if (status) body.status = status

      const res = await fetch(`${API}/tickets/${id}/reply`, {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(body),
      })
      const data = await res.json()
      if (!res.ok) throw new Error(data.message || 'فشل إرسال الرد')

      const idx = tickets.value.findIndex(t => t.id == id)
      if (idx !== -1) tickets.value[idx] = data
      if (currentTicket.value && currentTicket.value.id == id) {
        currentTicket.value = data
      }
      return data
    } catch (e) {
      console.error(e)
      throw e
    }
  }

  // ── Delete ticket (Admin) ───────────────────────────────────────
  async function deleteTicket(id) {
    try {
      const res = await fetch(`${API}/tickets/${id}`, {
        method: 'DELETE',
        headers: { 'Accept': 'application/json' }
      })
      if (!res.ok) throw new Error('فشل حذف التذكرة')
      tickets.value = tickets.value.filter(t => t.id != id)
    } catch (e) {
      console.error(e)
      throw e
    }
  }

  // ── Computed ────────────────────────────────────────────────────
  const openTicketsCount = computed(() => {
    return tickets.value.filter(t => t.status === 'open').length
  })

  return {
    tickets, currentTicket, loading, error, openTicketsCount,
    fetchTickets, createTicket, trackTicket,
    updateTicketStatus, updateTicketPriority, replyToTicket, deleteTicket
  }
})
