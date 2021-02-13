import Vue from 'vue';
import App from '@/App.vue';
import i18n from '@/utils/i18n';
import http from "@/utils/http";
import VueCookies from 'vue-cookies';

import '@/bootstrap';
import store from '@/store/';
import router from '@/route/';

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
