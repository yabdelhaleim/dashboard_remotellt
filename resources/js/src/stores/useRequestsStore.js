import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

const API = '/api'

export const useRequestsStore = defineStore('requests', () => {
  const requests = ref([])
  const filter   = ref('all')
  const loading  = ref(false)
  const error    = ref(null)

  // ── Fetch all leads ─────────────────────────────────────────────
  async function fetchRequests() {
    loading.value = true
    try {
      const res  = await fetch(`${API}/leads`)
      requests.value = await res.json()
    } catch (e) {
      error.value = e.message
    } finally {
      loading.value = false
    }
  }

  // ── Add lead (from wizard) ──────────────────────────────────────
  async function addRequest(lead) {
    const res  = await fetch(`${API}/leads`, {
      method:  'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body:    JSON.stringify(lead),
    })
    const data = await res.json()
    if (!res.ok) throw new Error(data.message || 'فشل إرسال الطلب')
    requests.value.unshift(data)
    return data
  }

  // ── Update status (admin) ───────────────────────────────────────
  async function updateStatus(id, status) {
    const res  = await fetch(`${API}/leads/${id}/status`, {
      method:  'PATCH',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body:    JSON.stringify({ status }),
    })
    const data = await res.json()
    const idx  = requests.value.findIndex(r => r.id == id)
    if (idx !== -1) requests.value[idx] = data
    return data
  }

  // ── Delete lead (admin) ─────────────────────────────────────────
  async function deleteRequest(id) {
    await fetch(`${API}/leads/${id}`, { method: 'DELETE' })
    requests.value = requests.value.filter(r => r.id != id)
  }

  // ── Computed ────────────────────────────────────────────────────
  const filteredRequests = computed(() =>
    filter.value === 'all'
      ? requests.value
      : requests.value.filter(r => r.status === filter.value)
  )

  const newCount = computed(() =>
    requests.value.filter(r => r.status === 'new').length
  )

  return {
    requests, filter, loading, error,
    filteredRequests, newCount,
    fetchRequests, addRequest, updateStatus, deleteRequest,
  }
})
