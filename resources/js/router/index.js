import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth'

import Login        from '../pages/Login.vue'
import JobList      from '../pages/JobList.vue'
import PostJob      from '../pages/PostJob.vue'
import Applications from '../pages/Applications.vue'

const routes = [
  { path: '/',            component: JobList },
  { path: '/login',       component: Login },
  { path: '/post-job',    component: PostJob,      meta: { requiresAuth: true, role: 'company' } },
  { path: '/applications',component: Applications, meta: { requiresAuth: true, role: 'admin' } },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to) => {
  const auth = useAuthStore()

  if (to.meta.requiresAuth && !auth.isLoggedIn) {
    return { path: '/login' }
  }

  if (to.meta.role === 'admin' && !auth.isAdmin) {
    return { path: '/' }
  }

  if (to.meta.role === 'company' && !auth.isCompany) {
    return { path: '/' }
  }
})

export default router