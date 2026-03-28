<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const applications = ref([])

onMounted(async () => {
  const res = await axios.get('/api/applications')
  applications.value = res.data
})

const updateStatus = async (application, status) => {
  const res = await axios.put(`/api/applications/${application.id}`, { status })
  application.status = res.data.status
}
</script>

<template>
  <div class="wrap">
    <h2>All Applications</h2>
    <div v-for="app in applications" :key="app.id" class="app-card">
      <p><strong>Applicant:</strong> {{ app.user.name }}</p>
      <p><strong>Job:</strong> {{ app.job.title }}</p>
      <p><strong>Cover Letter:</strong> {{ app.cover_letter }}</p>
      <p>
        <strong>Status:</strong>
        <span :class="app.status">{{ app.status }}</span>
      </p>
      <div v-if="app.status === 'pending'" class="btn-row">
        <button class="approve" @click="updateStatus(app, 'approved')">Approve</button>
        <button class="reject"  @click="updateStatus(app, 'rejected')">Reject</button>
      </div>
    </div>
    <p v-if="applications.length === 0">No applications yet.</p>
  </div>
</template>

<style scoped>
.wrap {
  max-width: 700px;
  margin: 40px auto;
}

.app-card {
  border: 1px solid #ddd;
  border-radius: 6px;
  padding: 16px;
  margin-bottom: 16px;
}

.btn-row {
  display: flex;
  gap: 8px;
  margin-top: 8px;
}

.approve {
  background: #27ae60;
  color: white;
  border: none;
  padding: 6px 14px;
  border-radius: 4px;
  cursor: pointer;
}

.reject {
  background: #e74c3c;
  color: white;
  border: none;
  padding: 6px 14px;
  border-radius: 4px;
  cursor: pointer;
}

.pending  { color: orange; }
.approved { color: green; }
.rejected { color: red; }
</style>