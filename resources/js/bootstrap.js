/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
// import 'bootstrap';
// import 'bootstrap/dist/js/bootstrap.bundle.min';

import axios from 'axios';
window.axios = axios;

// ATUALIZE ESTAS LINHAS DO ARQUIVO bootstrap.js
import $ from 'jquery';
window.$ = $;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

$(function(){

    // obtém o valor do token CSRF
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // configura o cabeçalho padrão X-CSRF-TOKEN em todas as requisições Ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });
})

import 'bootstrap';
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
*/

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
    //     broadcaster: 'pusher',
    //     key: import.meta.env.VITE_PUSHER_APP_KEY,
    //     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    //     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    //     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    //     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    //     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    //     enabledTransports: ['ws', 'wss'],
    // });
