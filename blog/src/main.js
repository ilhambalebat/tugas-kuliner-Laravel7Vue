import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import 'bootstrap' 
import 'bootstrap/dist/css/bootstrap.css'
import 'jquery'
import 'jquery/dist/jquery.min.js'
import './assets/css/templatemo-style.css'


import axios from 'axios'
axios.defaults.withCredentials = true;
axios.defaults.baseURL = "http://localhost:8000/"

store.dispatch('auth/me').finally(() => {
  new Vue({
    router,
    store,
    render: h => h(App)
  }).$mount('#app')
})

Vue.config.productionTip = false

