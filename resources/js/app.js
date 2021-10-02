
require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';

import router from './routes';
import swal from 'sweetalert';

Vue.config.productionTip = false
const app = new Vue({
    router,
    el: '#app'
});


