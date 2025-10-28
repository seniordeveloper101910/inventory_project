import { createRouter, createWebHistory } from 'vue-router'
import store from '../store'

const Dashboard = () => import('../pages/Dashboard.vue')
const Products = () => import('../pages/Products.vue')
const Sales = () => import('../pages/Sales.vue')
const Purchases = () => import('../pages/Purchases.vue')
const Login = () => import('../pages/Login.vue')
const NotFound = () => import('../pages/NotFound.vue')

const routes = [
  { path: '/login', component: Login },
  { path: '/', component: Dashboard, meta: { requiresAuth: true } },
  { path: '/products', component: Products, meta: { requiresAuth: true } },
  { path: '/sales', component: Sales, meta: { requiresAuth: true, roles: ['admin','sales'] } },
  { path: '/purchases', component: Purchases, meta: { requiresAuth: true, roles: ['admin','purchasing'] } },
  { path: '/:pathMatch(.*)*', component: NotFound }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, _, next) => {
  const requiresAuth = to.meta.requiresAuth
  const token = store.state.auth.token
  const user = store.state.auth.user
  if (!requiresAuth) return next()
  if (!token) return next('/login')
  if (to.meta.roles && !to.meta.roles.includes(user?.role)) return next('/')
  next()
})

export default router
