'use strict';
const VERSION = 'v1';
var urls = [
  '/',
//   '/help',
//   '/errorreport',
//   '/malfunction',
//   '/ideas',
  '/fonts/SceneAH-Light.otf',
  '/fonts/SceneAH-Medium.otf',
  '/fonts/SceneProLight.woff',
  '/fonts/SceneProMedium.woff',
  '/images/logo.svg',
  '/images/bulbBlue.svg',
  '/images/bulbWhite.svg',
  '/images/houseGreen.svg',
  '/images/houseWhite.svg',
  '/images/trianglePink.svg',
  '/images/triangleWhite.svg',
  '/images/location.svg',
  '/css/app.css',
  '/js/app.js'

];

self.addEventListener('install', event => {
    event.waitUntil(caches.open(VERSION).then(cache => cache.addAll(urls)));
});
  
// Then we need to active the service worker and/or delete older versions.
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(keys => {
        return Promise.all(keys
            .filter(key => key !== VERSION)
            .map(key => caches.delete(key))
        );
        })
    );
});

// Finally we fetch the assets from the service worker or from the network if
// the browser haven't yet fetched the items.
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request).then(response => response || fetch(event.request))
    );
});
