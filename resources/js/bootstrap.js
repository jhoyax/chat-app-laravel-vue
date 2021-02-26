window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

import echo from '@/utils/laravel-echo';

window.io = require('socket.io-client');

window.Echo = echo.new();

window.Echo.connector.socket.on('connect', () => {
    console.log('%c Websocket: connect ', 'background: #0c8e23; color: #fff');
});

window.Echo.connector.socket.on('sping', () => {
    console.log('%c Websocket: sping ', 'background: #1533cc; color: #fff');
});

window.Echo.connector.socket.on('reconnecting', () => {
    console.log('%c Websocket: reconnecting ', 'background: #1533cc; color: #fff');
});

window.Echo.connector.socket.on('disconnect', () => {
    console.log('%c Websocket: disconnect ', 'background: #ff0000; color: #fff');
});
