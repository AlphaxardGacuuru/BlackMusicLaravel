// staticCacheName needs to be changed after any of the assets are changed
const staticCacheName = 'site-static-v1';
const dynamicCacheName = 'site-dynamic-v1';
// Assests to be cached
const assets = [
	'/',
	'/posts',
	'manifest.webmanifest',
	'css/app.css',
	'css/custom.css',
	'js/app.js',
	'js/custom.js',
	'storage/img/musical-note-2.png',
	'storage/img/musical-note.png',
	'https://fonts.googleapis.com/css?family=Nunito',
	'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700',
	'/home',
];

// Cache size limit function
const limitCacheSize = (name, size) => {
	caches.open(name).then(cache => {
		cache.keys().then(keys => {
			if (keys.length > size) {
				cache.delete(keys[0]).then(limitCacheSize(name, size));
			}
		})
	})
};

// install event
self.addEventListener('install', evt => {
	//console.log('service worker installed');
	// Function to prevent the install event from stopping the async methods from finishing 
	evt.waitUntil(
		// Cache assets for faster page loading and offline mode
		caches.open(staticCacheName).then(cache => {
			console.log('caching shell assets');
			cache.addAll(assets);
		})
	);
});

// activate event
self.addEventListener('activate', evt => {
	//console.log('service worker activated');
	// Function to prevent the install event from stopping the async methods from finishing 
	evt.waitUntil(
		// Get cached assests based on keys
		caches.keys().then(keys => {
			//console.log(keys)
			// Returns multiple promises 
			return Promise.all(
				//for each return check whether the key of the already cached assests is present if not delete 
				keys.filter(key => key !== staticCacheName && key !== dynamicCacheName)
					.map(key => caches.delete(key))
			)
		})
	);
});

// fetch event
// self.addEventListener('fetch', evt => {
// 	// console.log('fetch event', evt);
// 	evt.respondWith(
// 		// Checks whether the resources being fetched are already cached and fetching those instead
// 		caches.match(evt.request).then(cacheRes => {
// 			// If resources are not cached and are obtainded from the server the add those to dynamic cache
// 			return cacheRes || fetch(evt.request).then(fetchRes => {
// 				return caches.open(dynamicCacheName).then(cache => {
// 					cache.put(evt.request.url, fetchRes.clone());
// 					//limitCacheSize(dynamicCacheName, 100);
// 					return fetchRes;
// 				})
// 			})
// 			// Redirect to fallback page if page is not cached
// 		}).catch(() => caches.match('/home'))
// 	);
// });