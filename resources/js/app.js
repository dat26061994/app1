require('./bootstrap');

window.Vue = require('vue');
import App from './views/App';
import Vue from 'vue';
import Routes from './router';
import VueRouter from 'vue-router'

Vue.use(VueRouter)
  
const router = new VueRouter({
    routes: Routes
})

new Vue({
    el: "#app",
    router: router,
    render: h => h(App)
})