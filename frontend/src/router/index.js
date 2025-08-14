import { createRouter, createWebHistory } from 'vue-router'

// Vistas
import LoginView from '../views/LoginView.vue'

// Layout y vistas internas
import DashboardLayout from '../views/layouts/DashboardLayout.vue'
import Home from '../views/Dashboard.vue'
import UsuariosView from '../views/components/UsuariosView.vue'

const routes = [
  // Login (fuera del layout)
  { 
    path: '/login', 
    name: 'Login', 
    component: LoginView 
  },

  // Agrupamos las rutas internas dentro del layout
  {
    path: '/',
    component: DashboardLayout,
    meta: { requiresAuth: true },
    children: [
      { path: '', redirect: '/home' },
      { path: 'home', name: 'Home', component: Home },
      { path: 'usuarios', name: 'Usuarios', component: UsuariosView }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// Middleware de autenticación
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')
  if (to.meta.requiresAuth && !token) {
    next('/login')
  } else {
    next()
  }
})

export default router
