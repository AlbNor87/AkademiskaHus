require('./bootstrap');

window.Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

Vue.component('navbar', require('./components/Navbar.vue'));
Vue.component('login', require('./components/authentication/Login.vue'));
Vue.component('posts', require('./components/Posts.vue'));

const app = new Vue({
    el: '#app'
});
