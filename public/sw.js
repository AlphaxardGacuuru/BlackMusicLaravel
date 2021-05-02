const staticCacheName = 'site-static';
const assets = [
	'/',
	'posts',
	'js/custom.js',
	'https://fonts.googleapis.com/css?family=Nunito',
	'css/custom.css',
];

// install event
self.addEventListener('install', evt => {
	//console.log('service worker installed');
});

// activate event
self.addEventListener('activate', evt => {
	//console.log('service worker activated');
});

// fetch event
self.addEventListener('fetch', evt => {
	//console.log('fetch event', evt);
});