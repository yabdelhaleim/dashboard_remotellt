import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/useAuthStore'
import { trackPageView } from '../utils/analytics'

const routes = [
  { path: '/', component: () => import('../views/public/HomeView.vue') },
  { path: '/product/:slug', component: () => import('../views/public/ProductView.vue') },
  { path: '/contact', component: () => import('../views/public/ContactView.vue') },
  { path: '/support', component: () => import('../views/public/SupportView.vue') },
  { path: '/admin/login', component: () => import('../views/admin/AdminLogin.vue') },
  {
    path: '/admin',
    component: () => import('../views/admin/AdminDashboard.vue'),
    meta: { requiresAuth: true },
    children: [
      { path: '', redirect: '/admin/requests' },
      { path: 'requests', component: () => import('../views/admin/AdminRequests.vue') },
      { path: 'bookings', component: () => import('../views/admin/AdminBookings.vue') },
      { path: 'products', component: () => import('../views/admin/AdminProducts.vue') },
      { path: 'packages', component: () => import('../views/admin/AdminPackages.vue') },
      { path: 'tickets', component: () => import('../views/admin/AdminTickets.vue') },
    ]
  }
]

const router = createRouter({ history: createWebHistory(), routes })

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    const auth = useAuthStore()
    if (!auth.isLoggedIn) return next('/admin/login')
    return next()
  }
  next()
})

// Fire page_view event on every successful route change (SPA-aware)
// GA4 already fires page_view on initial load via gtag('config'); we only
// need to re-fire it for client-side navigation after the first page.
let isFirstNavigation = true
router.afterEach((to, from) => {
  if (isFirstNavigation) {
    // Initial load: GA4 already tracked via config; only fire Meta Pixel
    if (typeof window.fbq === 'function') window.fbq('track', 'PageView')
    isFirstNavigation = false
    return
  }
  trackPageView(to.fullPath)
})

export default router
