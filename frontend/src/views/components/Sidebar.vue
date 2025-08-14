<template>
    <div :class="['bg-dark text-white p-3', collapsed ? 'sidebar-collapsed' : 'sidebar-expanded']">
      <button class="btn btn-sm btn-secondary mb-3" @click="$emit('toggle')">
        {{ collapsed ? '>>' : '<<' }}
      </button>
      <ul class="nav flex-column">
        <li class="nav-item" v-for="item in menu" :key="item.name">
          <a href="#" class="nav-link text-white d-flex align-items-center">
            <i :class="item.icon" style="width: 24px;"></i>
            <span v-if="!collapsed" class="ms-2">{{ item.name }}</span>
          </a>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: ['collapsed'],
    setup() {
      // Agregamos iconos de ejemplo, usa los que prefieras
      const menu = [
        { name: 'Dashboard', icon: 'bi bi-speedometer2' },
        { name: 'Usuarios', icon: 'bi bi-people' },
        //{ name: 'Pedidos', icon: 'bi bi-basket' },
        //{ name: 'Configuración', icon: 'bi bi-gear' },
      ];
      return { menu };
    },
  };
  </script>
  
  <style>
  .sidebar-expanded {
    width: 200px;
    transition: width 0.3s;
  }
  .sidebar-collapsed {
    width: 60px;
    transition: width 0.3s;
  }
  </style>
  