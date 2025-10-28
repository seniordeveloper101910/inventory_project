export default {
  namespaced: true,
  state: () => ({ list: [] }),
  mutations: {
    push(s, n){ s.list.unshift({ id: Date.now(), read:false, ...n }) },
    markRead(s,id){ const it=s.list.find(x=>x.id===id); if(it) it.read=true }
  },
  actions: {
    pushNotification({commit}, payload){
      commit('push', payload)
      if (typeof Notification !== 'undefined' && Notification.permission === 'granted') {
        new Notification('Inventory Alert', { body: payload.type })
      }
    }
  }
}
