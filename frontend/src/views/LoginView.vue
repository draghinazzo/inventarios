<template>
    <b-card title="Iniciar sesión" class="mt-5 mx-auto" style="max-width: 400px;">
      <form @submit.prevent="login">
        <div class="mb-3">
          <label for="email" class="form-label">Correo</label>
          <input v-model="email" type="email" class="form-control" id="email" required />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Contraseña</label>
          <input v-model="password" type="password" class="form-control" id="password" required />
        </div>
        <b-button type="submit" variant="primary">Entrar</b-button>
        <p class="text-danger mt-3" v-if="error">{{ error }}</p>
      </form>
    </b-card>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'
  import api from '../api/axios'
  
  const email = ref('')
  const password = ref('')
  const error = ref('')
  const router = useRouter()
  
  const login = async () => {
    try {
      const { data } = await api.post('/login', {
        email: email.value,
        password: password.value
      })
      localStorage.setItem('token', data.token)
      localStorage.setItem('nombre', data.user.nombre)
      localStorage.setItem('apellido', data.user.apellido)
      localStorage.setItem('rol', data.user.rol)
      router.push('/dashboard')
    } catch (err) {
      error.value = 'Credenciales incorrectas o error de conexión'
    }
  }
  </script>
  