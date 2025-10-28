import { createStore } from 'vuex'
import auth from './modules/auth'
import products from './modules/products'
import sales from './modules/sales'
import notifications from './modules/notifications'

export default createStore({
  modules: { auth, products, sales, notifications }
})
