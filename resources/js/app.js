require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import Routes from './router';
import VueRouter from 'vue-router'
import App from './views/App';

Vue.use(VueRouter)

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// further down the file...
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
  
const router = new VueRouter({
    routes: Routes
})

Vue.component('app',App)

new Vue({
    el: "#app",
    router: router,
    // render: h => h(App)
})