import axios from 'axios'

// Crear instancia
const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api'
})

// Interceptor para enviar token automáticamente
api.interceptors.request.use(config => {
  const token = localStorage.getItem('token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
})

// Interceptor para manejar errores de expiración del token
api.interceptors.response.use(
  response => response,
  error => {
    if (error.response && error.response.status === 401) {
      if (msg === 'Token expirado') {
        localStorage.removeItem('token')
        window.location.href = '/login'
      }
    }
    return Promise.reject(error)
  }
)

export default api
