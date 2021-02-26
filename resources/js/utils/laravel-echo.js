import Echo from "laravel-echo";

export default {
    new() {
        let port = '';
        if (process.env.MIX_LARAVEL_ECHO_PORT) port = ':' + process.env.MIX_LARAVEL_ECHO_PORT;

        let hostName = window.location.hostname;
        if (process.env.MIX_LARAVEL_ECHO_HOST) hostName = process.env.MIX_LARAVEL_ECHO_HOST;

        return new Echo({
            broadcaster: 'socket.io',
            host: hostName + port,
            auth: {
                headers: {
                    Authorization: `Bearer ${$cookies.get('token')}`
                },
            },
            transports: ['websocket'],
        });

    }
};
