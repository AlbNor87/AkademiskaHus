self.addEventListener('install', function (event) {
    console.log('SW Installed');
    event.waitUntil(
      caches.open('static')
        .then(function (cache) {
          cache.addAll([
            '/',
            '/help',
            '/errorReport',
            '/malfunction',
            '/ideas',
            '/login',
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
          ]);
        })
    );
  });
  
  self.addEventListener('activate', function () {
    console.log('SW Activated');
  });

  self.addEventListener('fetch', event => {
    event.respondWith(
      caches.match(event.request).then(response => response || fetch(event.request))
    );
  });
