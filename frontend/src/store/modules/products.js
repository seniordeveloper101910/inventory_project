import api from '../../services/api'

export default {
  namespaced: true,
  state: () => ({
    items: [],
    pagination: { page:1, perPage:20, total:0 },
    filters: { q:'', category:null },
    loading: false
  }),
  mutations: {
    setItems(s, {items, pagination}){ s.items = items; s.pagination = pagination },
    setLoading(s,v){ s.loading=v },
    setFilters(s,f){ s.filters={...s.filters, ...f} }
  },
  actions: {
    async fetch({commit,state}){
      commit('setLoading',true)
      const params = {
        q: state.filters.q,
        page: state.pagination.page,
        per_page: state.pagination.perPage
      }
      const res = await api.get('/products', { params })
      commit('setItems', { items: res.data.items, pagination: res.data.pagination })
      commit('setLoading',false)
    }
  }
}
