import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    isLoggedIn: JSON.parse(localStorage.getItem('remotelly_auth')) || false,
  }),
  actions: {
    login(password) {
      const ok = password === import.meta.env.VITE_ADMIN_PASSWORD
      this.isLoggedIn = ok
      localStorage.setItem('remotelly_auth', JSON.stringify(this.isLoggedIn))
      return ok
    },
    logout() {
      this.isLoggedIn = false
      localStorage.setItem('remotelly_auth', JSON.stringify(this.isLoggedIn))
    }
  }
})
