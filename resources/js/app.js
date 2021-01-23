import Vue from 'vue';
import App from '@/App.vue';
import i18n from '@/services/i18n';
import http from "@/services/http";

import './bootstrap';
import router from '@/route/';
import store from '@/store/';


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
