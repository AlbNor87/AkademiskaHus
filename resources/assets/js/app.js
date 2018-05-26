require('./bootstrap');

window.Vue = require('vue');

import * as VueGoogleMaps from 'vue2-google-maps'
 
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyDS-75H9sxSJoM2H7W7Eb8RvHAzyDnhAn0',
    libraries: 'places', 
  },
 
  //// If you intend to programmatically custom event listener code
  //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
  //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
  //// you might need to turn this on.
  // autobindAllEvents: false,
 
  //// If you want to manually install components, e.g.
  //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
  //// Vue.component('GmapMarker', GmapMarker)
  //// then disable the following:
  // installComponents: true,
})


Vue.component('posts', require('./components/posts.vue'));
Vue.component('manageposts', require('./components/ManagePosts.vue'));
Vue.component('googlemap', require('./components/GoogleMap.vue'));
Vue.component('errorreport', require('./components/ErrorReport.vue'));
Vue.component('managemalfunctions', require('./components/ManageMalfunctions.vue'));
Vue.component('malfunctions', require('./components/Malfunctions.vue'));
Vue.component('ideas', require('./components/Ideas.vue'));

const app = new Vue({
    el: '#app'
});
