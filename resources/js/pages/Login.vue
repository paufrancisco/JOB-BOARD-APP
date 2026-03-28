<script setup>
import { ref } from 'vue'
import { useAuthStore } from '../stores/auth'
import { useRouter } from 'vue-router'

const auth     = useAuthStore()
const router   = useRouter()
const email    = ref('')
const password = ref('')
const error    = ref('')

const login = async () => {
  try {
    await auth.login(email.value, password.value)
    router.push('/')
  } catch (e) {
    error.value = 'Invalid email or password'
  }
}
</script>

<template>
  <div class="form-wrap">
    <h2>Login</h2>
    <p v-if="error" class="error">{{ error }}</p>
    <input v-model="email"    type="email"    placeholder="Email" />
    <input v-model="password" type="password" placeholder="Password" />
    <button @click="login">Login</button>
    <p>Test accounts:</p>
    <p>admin@test.com / company@test.com / juan@test.com</p>
    <p>All passwords: password</p>
  </div>
</template>

<style scoped>
.form-wrap {
  max-width: 400px;
  margin: 60px auto;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

input {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  padding: 10px;
  background: #2c3e50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.error {
  color: red;
}
</style>