import api from '../../services/api'

export default {
  namespaced: true,
  state: () => ({
    user: null,
    token: localStorage.getItem('token') || ''
  }),
  mutations: {
    setUser(s, u){ s.user = u },
    setToken(s, t){ s.token = t; localStorage.setItem('token', t) },
    logout(s){ s.user=null; s.token=''; localStorage.removeItem('token') }
  },
  actions: {
    async login({commit}, creds){
      const res = await api.post('/auth/login', creds)
      commit('setToken', res.data.token)
      const userRes = await api.get('/users/me')
      commit('setUser', userRes.data)
    }
  }
}
