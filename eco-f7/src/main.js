import Vue from 'vue'
import App from './App.vue'
import axios from 'axios'
import Framework7 from 'framework7/framework7.esm.bundle.js';
import Framework7Vue from 'framework7-vue/framework7-vue.esm.bundle.js'
// Import F7 Styles
import 'framework7/css/framework7.css';

// Import Icons and App Custom Styles
import './css/icons.css';
import './css/app.css';

//Vuex Store
import store from './store/index'

Framework7.use(Framework7Vue)

axios.defaults.baseURL = "http://127.0.0.1:8000/api"

Vue.config.productionTip = false

//Reauthenticate the user using the token that stored in localStorage
store.dispatch('auth/attempt', localStorage.getItem('token'))

new Vue({
  render: h => h(App),
  store,
}).$mount('#app')
