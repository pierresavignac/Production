import { createRouter, createWebHistory } from 'vue-router'
import ProgressionTask from '../components/ProgressionTask.vue'

const routes = [
  {
    path: '/progression',
    name: 'progression',
    component: ProgressionTask
  }
  // ... vos autres routes
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router 