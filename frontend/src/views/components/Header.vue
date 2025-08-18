<template>
  <nav class="navbar navbar-light bg-light justify-content-end px-3">
    <b-dropdown variant="outline-secondary" text="Opciones" class="me-2">
      <template #button-content>
        {{ user.nombre }} {{ user.apellido }}
      </template>
      <b-dropdown-item href="#">Datos personales</b-dropdown-item>
      <b-dropdown-divider></b-dropdown-divider>
      <b-dropdown-item @click="logout">Cerrar sesión</b-dropdown-item>
    </b-dropdown>
  </nav>
</template>

  
  <script>
  import { useRouter } from 'vue-router'
  
  export default {
    props: ['user'],
    setup() {
      const router = useRouter()
  
      const logout = () => {
        localStorage.removeItem('token')
        router.push('/login')
      }
  
      return {
        logout
      }
    }
  }
  </script>