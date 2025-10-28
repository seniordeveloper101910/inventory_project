import axios from 'axios'
import store from '../store'

const api = axios.create({
  baseURL: import.meta.env.VITE_API_BASE,
  timeout: 10000
})

api.interceptors.request.use(cfg=>{
  const t = store.state.auth.token
  if(t) cfg.headers.Authorization = `Bearer ${t}`
  return cfg
})

export default api
