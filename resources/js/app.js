import Vue from 'vue';
import App from '@/App.vue';
import i18n from '@/services/i18n';
import http from "@/services/http";
import VueCookies from 'vue-cookies';

import './bootstrap';
import router from '@/route/';
import store from '@/store/';

Vue.use(VueCookies)

// set default config
Vue.$cookies.config('7d');


new Vue({
    el: '#app',
    router,
    store,
    i18n,
    created() {
        http.init();
    },
    render: e => e(App)
});
