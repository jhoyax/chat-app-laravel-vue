import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/views/Home';

Vue.use(VueRouter);

let router = new VueRouter({
    mode: 'history',
    routes: [
        {
          path: '/',
          name: 'home',
          component: Home,
        }
    ]
});

Vue.router = router;

router.beforeEach ((to, from, next) => {
    if (
        to.meta.requiredAuth === true &&
        !$cookies.isKey('token')
    ) {
        next({path: '/'});
    } else {
        next();
    }
});

export default router;
