<template>
    <div class="container mt-4">
        <h2>Lista de Usuarios</h2>

        <!-- Barra de herramientas -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <b-button variant="primary" @click="abrirModalCrear">
                    <i class="bi bi-person-plus-fill me-2"></i> Nuevo Usuario
                </b-button>
            </div>
            <div>
                <input type="text" class="form-control" placeholder="Buscar..."
                v-model="search" @input="debouncedBuscar" style="width: 250px;">
            </div>
        </div>

        <!-- Spinner overlay -->
        <div v-if="loading" class="overlay">
            <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>

        <!-- Modal CREAR -->
        <div class="modal fade" id="crearUsuarioModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="crearUsuario">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear nuevo usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label>Nombre</label>
                            <input type="text" v-model="form.nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Apellido</label>
                            <input type="text" v-model="form.apellido" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" v-model="form.email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Rol</label>
                            <select v-model="form.rol" class="form-select" required>
                                <option disabled value="">Selecciona un rol</option>
                                <option v-for="rol in roles" :key="rol" :value="rol">{{ rol }}</option>
                            </select>
                        </div>
                            <div class="mb-3">
                                <label>Contraseña</label>
                                <input type="password" v-model="form.password" class="form-control" required>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal EDITAR -->
        <div class="modal fade" id="editarUsuarioModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="editarUsuario">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nombre</label>
                            <input type="text" v-model="formEdit.nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Apellido</label>
                            <input type="text" v-model="formEdit.apellido" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" v-model="formEdit.email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Rol</label>
                            <select v-model="formEdit.rol" class="form-select" required>
                                <option disabled value="">Selecciona un rol</option>
                                <option v-for="rol in roles" :key="rol" :value="rol">{{ rol }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Nueva contraseña (opcional)</label>
                            <input type="password" v-model="formEdit.password" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabla -->
        <b-table :items="usuarios" :fields="campos" striped hover responsive>
            <template #cell(rol)="data">
                <span class="badge bg-primary">{{ data.item.rol }}</span>
            </template>
            <template #cell(acciones)="data">
                <button class="btn btn-sm btn-warning" @click="abrirModalEditar(data.item)">
                <i class="bi bi-pencil-fill"></i>
                </button>
            </template>
        </b-table>

        <!-- Paginador -->
        <nav class="mt-3">
            <ul class="pagination justify-content-center">
                <li class="page-item" :class="{ disabled: !pagination.prev_page_url }">
                    <button class="page-link" @click="cambiarPagina(pagination.current_page - 1)" :disabled="!pagination.prev_page_url">Anterior</button>
                </li>
                <li v-for="page in totalPages" :key="page" class="page-item" :class="{ active: page === pagination.current_page }">
                    <button class="page-link" @click="cambiarPagina(page)">{{ page }}</button>
                </li>
                <li class="page-item" :class="{ disabled: !pagination.next_page_url }">
                    <button class="page-link" @click="cambiarPagina(pagination.current_page + 1)" :disabled="!pagination.next_page_url">Siguiente</button>
                </li>
            </ul>
        </nav>
    </div>
</template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import api from '../../api/axios'
  import { Modal } from 'bootstrap'
  
  const usuarios = ref([])
  const campos = ['id', 'name', 'apellido', 'email', 'rol', 'acciones']
  const roles = ['admin', 'cliente']
  const loading = ref(false)

  import debounce from 'lodash.debounce' // npm install lodash.debounce
  const search = ref('')
  const pagination = ref({
        current_page: 1,
        last_page: 1,
        prev_page_url: null,
        next_page_url: null
    })
  const totalPages = ref([])

  const form = ref({ nombre: '', apellido: '', email: '', rol: '', password: '' })
  const formEdit = ref({ id: '', nombre: '', apellido: '', email: '', rol: '', password: '' })
  
  onMounted(async () => {
    cargarUsuarios()
  })

  async function cargarUsuarios(page = 1) {
    try {
        loading.value = true
        const res = await api.get(`/usuarios?page=${page}&search=${search.value}`)
        usuarios.value = res.data.data
        pagination.value = res.data
        totalPages.value = Array.from({ length: res.data.last_page }, (_, i) => i + 1)
    } catch (error) {
        console.error(error)
    } finally {
        loading.value = false
    }
  }

  const debouncedBuscar = debounce(() => {
    cargarUsuarios(1)
  }, 500)
  
  function cambiarPagina(page) {
    if (page >= 1 && page <= pagination.value.last_page) {
        cargarUsuarios(page)
    }
  }
  
  function abrirModalCrear() {
    const modal = new Modal(document.getElementById('crearUsuarioModal'))
    modal.show()
  }
  
  async function crearUsuario() {
    try {
      loading.value = true
      const res = await api.post('/usuarios', form.value)
      usuarios.value.push(res.data)
      Modal.getInstance(document.getElementById('crearUsuarioModal')).hide()
      form.value = { nombre: '', apellido: '', email: '', rol: '', password: '' }
    } catch (error) {
      console.error(error)
    } finally {
      loading.value = false
    }
  }
  
  function abrirModalEditar(usuario) {
    formEdit.value = { ...usuario, nombre: usuario.name, password: '' }
    const modal = new Modal(document.getElementById('editarUsuarioModal'))
    modal.show()
  }
  
  async function editarUsuario() {
    try {
      loading.value = true
      const res = await api.put(`/usuarios/${formEdit.value.id}`, formEdit.value)
      const index = usuarios.value.findIndex(u => u.id === res.data.id)
      if (index !== -1) usuarios.value[index] = res.data
      Modal.getInstance(document.getElementById('editarUsuarioModal')).hide()
    } catch (error) {
      console.error(error)
    } finally {
      loading.value = false
    }
  }
  </script>
  
<style scoped>
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.5);
  z-index: 2000;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
  