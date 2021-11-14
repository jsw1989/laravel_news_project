require('./bootstrap');
window.Vue = require('vue');
import Vue2Editor from "vue2-editor";
import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

import App from './App.vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import axios from 'axios';
import { routes } from './routes';
import Vuelidate from 'vuelidate'
import Oruga from '@oruga-ui/oruga'
import '@oruga-ui/oruga/dist/oruga.css'

Vue.use(Vuelidate)
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Vue2Editor);
Vue.use(VueSweetalert2);
Vue.use(Oruga)

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
