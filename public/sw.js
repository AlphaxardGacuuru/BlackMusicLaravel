const staticCacheName = 'site-static';
const assets = [
	'/',
	'posts',
	'js/jquery/jquery-2.2.4.min.js',
	'js/bootstrap.min.js',
	'js/plugins.js',
	'js/active.js',
	'js/black_music.js',
	'https://fonts.googleapis.com/css?family=Nunito',
	'css/style.css',
	'css/black_music.css'
];

// install event
self.addEventListener('install', evt => {
  //console.log('service worker installed');
  evt.waitUntil(
    caches.open(staticCacheName).then(cache => {
      console.log('caching shell assets');
      cache.addAll(assets);
    })
  );
});

// activate event
self.addEventListener('activate', evt => {
  //console.log('service worker activated');
});

// fetch event
self.addEventListener('fetch', evt => {
  //console.log('fetch event', evt);
  evt.respondWith(
    caches.match(evt.request).then(cacheRes => {
      return cacheRes || fetch(evt.request);
    })
  );
});