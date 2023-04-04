import { createRouter, createWebHistory } from '@ionic/vue-router';
import WelcomePage from '../views/welcome/WelcomePage.vue';
import LoginPage from '../views/auth/Login.vue';
import DashboardPage from '../views/pages/Dashboard.vue';
import RegisterPage from '../views/pages/Register.vue';
import { defineCustomElements } from '@ionic/pwa-elements/loader';
defineCustomElements(window);

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
  },
  {
    path: '/register',
    name: 'RegisterPage',
    component: RegisterPage,
  },
  {
    path: '/dashboard',
    name: 'DashboardPage',
    component: DashboardPage,
    beforeEnter: () => {
      if (!localStorage.getItem('user')) return '/login';
    },
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
