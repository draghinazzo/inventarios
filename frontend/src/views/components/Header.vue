<template>
    <nav class="navbar navbar-light bg-light justify-content-end px-3">
      <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          {{ user.nombre  }} {{ user.apellido  }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="#">Datos personales</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" @click="logout">Cerrar sesión</a></li>
        </ul>
      </div>
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