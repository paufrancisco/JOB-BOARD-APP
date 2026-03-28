import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import axios from 'axios'

export const useAuthStore = defineStore('auth', () => {
  const token = ref(localStorage.getItem('token'))
  const user  = ref(JSON.parse(localStorage.getItem('user') || 'null'))

  const isLoggedIn = computed(() => !!token.value)
  const isAdmin    = computed(() => user.value?.role === 'admin')
  const isCompany  = computed(() => user.value?.role === 'company')

  async function login(email, password) {
    const res = await axios.post('/api/login', { email, password })
    token.value = res.data.token
    user.value  = res.data.user
    localStorage.setItem('token', token.value)
    localStorage.setItem('user', JSON.stringify(user.value))
    axios.defaults.headers.common['Authorization'] = `Bearer ${token.value}`
  }

  async function logout() {
    await axios.post('/api/logout')
    token.value = null
    user.value  = null
    localStorage.removeItem('token')
    localStorage.removeItem('user')
    delete axios.defaults.headers.common['Authorization']
  }

  function init() {
    if (token.value) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${token.value}`
    }
  }

  return { token, user, isLoggedIn, isAdmin, isCompany, login, logout, init }
})