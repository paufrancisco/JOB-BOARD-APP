<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useAuthStore } from '../stores/auth'

const auth  = useAuthStore()
const jobs  = ref([])
const error = ref('')

onMounted(async () => {
  const res = await axios.get('/api/jobs')
  jobs.value = res.data
})

const apply = async (jobId) => {
  try {
    await axios.post(`/api/jobs/${jobId}/apply`, {
      cover_letter: 'I am interested in this position.'
    })
    alert('Application submitted!')
  } catch (e) {
    error.value = e.response?.data?.message || 'Failed to apply'
  }
}
</script>

<template>
  <div class="wrap">
    <h2>Open Jobs</h2>
    <p v-if="error" class="error">{{ error }}</p>
    <div v-for="job in jobs" :key="job.id" class="job-card">
      <h3>{{ job.title }}</h3>
      <p>{{ job.company_name }} — {{ job.location }}</p>
      <p>{{ job.description }}</p>
      <p v-if="job.salary">Salary: P{{ job.salary }}</p>
      <button
        v-if="auth.isLoggedIn && !auth.isAdmin && !auth.isCompany"
        @click="apply(job.id)"
      >
        Apply
      </button>
    </div>
    <p v-if="jobs.length === 0">No open jobs at the moment.</p>
  </div>
</template>

<style scoped>
.wrap {
  max-width: 700px;
  margin: 40px auto;
}

.job-card {
  border: 1px solid #ddd;
  border-radius: 6px;
  padding: 16px;
  margin-bottom: 16px;
}

button {
  padding: 8px 16px;
  background: #27ae60;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.error {
  color: red;
}
</style>