import { io } from 'socket.io-client'

let socket = null

export function initSocket(store){
  if(socket) return
  socket = io(import.meta.env.VITE_SOCKET_URL, {
    auth: { token: store.state.auth.token }
  })
  socket.on('connect', ()=>console.log('Socket connected'))
  socket.on('low_stock', p=>store.dispatch('notifications/pushNotification', { type:'low_stock', payload:p }))
  socket.on('expiry_alert', p=>store.dispatch('notifications/pushNotification', { type:'expiry_alert', payload:p }))
  socket.on('reorder_reminder', p=>store.dispatch('notifications/pushNotification', { type:'reorder_reminder', payload:p }))
}
