import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

const API = '/api'

export const useProductsStore = defineStore('products', () => {
  const products = ref([])
  const loading  = ref(false)
  const error    = ref(null)

  // ── Fetch all products ──────────────────────────────────────────
  async function fetchProducts() {
    loading.value = true
    error.value   = null
    try {
      const res  = await fetch(`${API}/products`)
      products.value = await res.json()
    } catch (e) {
      error.value = e.message
    } finally {
      loading.value = false
    }
  }

  // ── Find by slug (local) ────────────────────────────────────────
  function findBySlug(slug) {
    return products.value.find(p => p.slug === slug)
  }

  // ── Add product ─────────────────────────────────────────────────
  async function addProduct(prod) {
    const res  = await fetch(`${API}/products`, {
      method:  'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body:    JSON.stringify({
        slug:         prod.slug?.trim().toLowerCase() || Date.now().toString(),
        name:         prod.name?.trim(),
        description:  prod.description?.trim(),
        icon:         prod.icon || '⚙️',
        external_url: prod.externalUrl?.trim() || null,
      }),
    })
    const data = await res.json()
    if (!res.ok) throw new Error(data.message || 'فشل إضافة المنتج')
    products.value.push(data)
    return data
  }

  // ── Update product ──────────────────────────────────────────────
  async function updateProduct(id, patch) {
    const res  = await fetch(`${API}/products/${id}`, {
      method:  'PUT',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body:    JSON.stringify({
        slug:         patch.slug,
        name:         patch.name,
        description:  patch.description,
        icon:         patch.icon,
        external_url: patch.externalUrl ?? patch.external_url ?? null,
      }),
    })
    const data = await res.json()
    if (!res.ok) throw new Error(data.message || 'فشل التحديث')
    const idx = products.value.findIndex(p => p.id == id)
    if (idx !== -1) products.value[idx] = data
    return data
  }

  // ── Delete product ──────────────────────────────────────────────
  async function deleteProduct(id) {
    await fetch(`${API}/products/${id}`, { method: 'DELETE' })
    products.value = products.value.filter(p => p.id != id)
  }

  // ── Add package to product ──────────────────────────────────────
  async function addPackage(productId, pkg) {
    const res  = await fetch(`${API}/products/${productId}/packages`, {
      method:  'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body:    JSON.stringify(pkg),
    })
    const data = await res.json()
    if (!res.ok) throw new Error(data.message || 'فشل إضافة الباقة')
    const prod = products.value.find(p => p.id == productId)
    if (prod) prod.packages.push(data)
    return data
  }

  // ── Remove package ──────────────────────────────────────────────
  async function removePackage(productId, pkgId) {
    await fetch(`${API}/packages/${pkgId}`, { method: 'DELETE' })
    const prod = products.value.find(p => p.id == productId)
    if (prod) prod.packages = prod.packages.filter(pk => pk.id != pkgId)
  }

  // ── Update package ──────────────────────────────────────────────
  async function updatePackage(productId, pkgId, patch) {
    const res = await fetch(`${API}/packages/${pkgId}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body: JSON.stringify({
        name: patch.name,
        price: patch.price,
        features: patch.features,
        highlighted: patch.highlighted,
      })
    })
    const data = await res.json()
    if (!res.ok) throw new Error(data.message || 'فشل تحديث الباقة')
    const prod = products.value.find(p => p.id == productId)
    if (prod) {
      const idx = prod.packages.findIndex(pk => pk.id == pkgId)
      if (idx !== -1) prod.packages[idx] = data
    }
    return data
  }

  return {
    products, loading, error,
    fetchProducts, findBySlug,
    addProduct, updateProduct, deleteProduct,
    addPackage, updatePackage, removePackage,
  }
})
