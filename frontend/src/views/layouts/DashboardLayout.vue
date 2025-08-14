<template>
    <div id="app" class="d-flex">
      <!-- Sidebar -->
      <Sidebar :collapsed="sidebarCollapsed" @toggle="toggleSidebar" />
  
      <!-- Main content -->
      <div class="flex-grow-1">
        <Header @toggle-sidebar="toggleSidebar" :user="user" />
  
        <main class="p-4">
          <!-- Aquí se renderiza la vista hija -->
          <router-view />
        </main>
      </div>
    </div>
  </template>
  
  <script>
  import Sidebar from '../components/Sidebar.vue';
  import Header from '../components/Header.vue';
  import { ref } from 'vue';
  
  export default {
    components: { Sidebar, Header },
    setup() {
      const sidebarCollapsed = ref(false);
      const user = ref({
        nombre: localStorage.getItem('nombre'),
        apellido: localStorage.getItem('apellido')
      });
  
      const toggleSidebar = () => {
        sidebarCollapsed.value = !sidebarCollapsed.value;
      };
  
      return { sidebarCollapsed, toggleSidebar, user };
    }
  };
  </script>
  
  <style>
  #app {
    min-height: 100vh;
    background-color: #f8f9fa;
  }
  </style>
  