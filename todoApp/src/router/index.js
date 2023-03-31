import { createRouter, createWebHistory } from '@ionic/vue-router';
import WelcomePage from '../views/welcome/WelcomePage.vue';
import LoginPage from '../views/auth/LoginPage.vue';

const routes = [
  {
    path: '/',
    redirect: '/welcome'
  },
  {
    path: '/welcome',
    name: 'WelcomePage',
    component: WelcomePage
  },
  {
    path: '/login',
    name: 'LoginPage',
    component: LoginPage
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
