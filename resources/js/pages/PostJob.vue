<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()
const form   = ref({
  title:        '',
  company_name: '',
  location:     '',
  description:  '',
  salary:       '',
})
const error = ref('')

const submit = async () => {
  try {
    await axios.post('/api/jobs', form.value)
    router.push('/')
  } catch (e) {
    error.value = 'Failed to post job. Check all fields.'
  }
}
</script>

<template>
  <div class="wrap">
    <h2>Post a Job</h2>
    <p v-if="error" class="error">{{ error }}</p>
    <input v-model="form.title"        placeholder="Job title" />
    <input v-model="form.company_name" placeholder="Company name" />
    <input v-model="form.location"     placeholder="Location" />
    <textarea v-model="form.description" placeholder="Job description"></textarea>
    <input v-model="form.salary" type="number" placeholder="Salary (optional)" />
    <button @click="submit">Post Job</button>
  </div>
</template>

<style scoped>
.wrap {
  max-width: 500px;
  margin: 40px auto;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

input, textarea {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

textarea {
  height: 100px;
}

button {
  padding: 10px;
  background: #2c3e50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.error { color: red; }
</style>