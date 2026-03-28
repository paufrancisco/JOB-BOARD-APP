<script setup>
import { useAuthStore } from '../stores/auth'
import { useRouter } from 'vue-router'

const auth   = useAuthStore()
const router = useRouter()

const logout = async () => {
  await auth.logout()
  router.push('/login')
}
</script>

<template>
  <div>
    <nav>
      <router-link to="/">Jobs</router-link>
      <router-link v-if="auth.isCompany || auth.isAdmin" to="/post-job">Post a Job</router-link>
      <router-link v-if="auth.isAdmin" to="/applications">Applications</router-link>
      <span v-if="auth.isLoggedIn">
        Hello, {{ auth.user.name }}
        <button @click="logout">Logout</button>
      </span>
      <router-link v-else to="/login">Login</router-link>
    </nav>
    <router-view />
  </div>
</template>

<style scoped>
nav {
  display: flex;
  gap: 16px;
  padding: 12px 24px;
  background: #2c3e50;
  align-items: center;
}

nav a {
  color: white;
  text-decoration: none;
}

nav span {
  margin-left: auto;
  color: white;
  display: flex;
  align-items: center;
  gap: 10px;
}

nav button {
  padding: 4px 10px;
  background: #e74c3c;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
</style>