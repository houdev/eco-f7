
import Vue from 'vue';
import router from "./router";
import vuetify from './vuetify';
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueAuth from '@websanova/vue-auth'
import auth from './auth'
import App from './components/app';
import { appBaseURL } from './appBaseURL'

Vue.router = router
Vue.use(VueAxios, axios)
Vue.use(VueAuth, auth)

require('./bootstrap');

axios.defaults.baseURL = `${appBaseURL}`

const app = new Vue({
    el: '#app',
    components:{
      App
    },
    router,
    vuetify
});
