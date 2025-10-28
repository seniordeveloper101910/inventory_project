import api from '../../services/api'

export default {
  namespaced: true,
  state: () => ({ list: [] }),
  actions: {
    async fetch({state}) {
      const res = await api.get('/sales')
      state.list = res.data.items
    },
    async create(_, payload){
      return api.post('/sales', payload)
    }
  }
}
