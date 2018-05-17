require('./bootstrap');

window.Vue = require('vue');

Vue.component('posts', require('./components/posts.vue'));
Vue.component('manageposts', require('./components/ManagePosts.vue'));

const app = new Vue({
    el: '#app'
});
