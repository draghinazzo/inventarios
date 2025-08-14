<template>
  <div id="app" class="d-flex">
    <!-- Sidebar -->
    <Sidebar :collapsed="sidebarCollapsed" @toggle="toggleSidebar" />

    <!-- Main content -->
    <div class="flex-grow-1">
      <Header @toggle-sidebar="toggleSidebar" :user="user" />

      <main class="p-4">
        <h2>Bienvenido, {{ user.name }}</h2>

        <div class="row mt-4">
          <div class="col-md-4 mb-3" v-for="card in cards" :key="card.id">
            <div class="card p-3">
              <h5>{{ card.title }}</h5>
              <p>{{ card.value }}</p>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import Sidebar from './components/Sidebar.vue';
import Header from './components/Header.vue';
import { ref } from 'vue';

export default {
  components: { Sidebar, Header },
  setup() {
    const sidebarCollapsed = ref(false);
    const user = ref({ nombre: localStorage.getItem('nombre'), apellido: localStorage.getItem('apellido') });
    const cards = ref([
      { id: 1, title: 'Usuarios', value: 120 },
      { id: 2, title: 'Pedidos', value: 75 },
      { id: 3, title: 'Ventas', value: '$3,500' },
    ]);

    const toggleSidebar = () => {
      sidebarCollapsed.value = !sidebarCollapsed.value;
    };

    return { sidebarCollapsed, toggleSidebar, user, cards };
  },
};
</script>

<style>
#app {
  min-height: 100vh;
  background-color: #f8f9fa;
}
</style>
