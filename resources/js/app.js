import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

console.log('Pusher Key:', import.meta.env.VITE_PUSHER_APP_KEY);
console.log('Pusher Cluster:', import.meta.env.VITE_PUSHER_APP_CLUSTER);

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.Echo.connector.pusher.connection.bind('error', function(err) {
    console.error('WebSocket error:', err);
});

window.Echo.channel('example-channel')
    .listen('ExampleEvent', (e) => {
        console.log(e.message);
    });
