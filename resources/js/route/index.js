import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/views/Home';
import Chats from '@/views/Chats';
import Profile from '@/views/Profile';
import NotFound from '@/views/NotFound';
import ResetPassword from '@/views/ResetPassword';

Vue.use(VueRouter);

let router = new VueRouter({
    mode: 'history',
    routes: [
        {
          path: '/',
          name: 'home',
          component: Home,
        },
        {
          path: '/reset-password',
          name: 'reset-password',
          component: ResetPassword,
        },
        {
          path: '/chats',
          name: 'chats',
          component: Chats,
          meta: { requiredAuth: true }
        },
        {
          path: '/profile',
          name: 'profile',
          component: Profile,
          meta: { requiredAuth: true }
        },
        {
            path: '*',
            name: 'notFound',
            component: NotFound,
        },
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
