<template>
    <div class="menu">
        <ul class="menu__links">
            <li
                v-for="(item, index) in links"
                :key="index"
                :class="{
                    'menu__links-item' : true,
                    'menu__links-item--active' : currentRouteName == item.routeName,
                }">
                <router-link :to="{ name: item.routeName, params: item.routeParams }">
                    <img :src="currentRouteName == item.routeName ? item.imgActive : item.img">
                    {{item.name}}
                </router-link>
            </li>
            <li class="menu__links-item">
                <a href="#" @click.prevent="handleLogout">
                    <img src="/img/logout-light-gray.svg">
                    {{$t('logout')}}
                </a>
            </li>
        </ul>
    </div>
</template>
<script>
import { default as store } from '@/store';
import { LOGOUT } from '@/store/action-types';

export default {
    name: 'Menu',
    data() {
        return {
            links: [
                {
                    name: 'Chats',
                    img: '/img/message-light-gray.svg',
                    imgActive: '/img/message.svg',
                    routeName: 'chats',
                    routeParams: {},
                },
                {
                    name: 'Profile',
                    img: '/img/user-light-gray.svg',
                    imgActive: '/img/user.svg',
                    routeName: 'profile',
                    routeParams: {profileId: 1},
                },
            ]
        }
    },
    computed: {
        currentRouteName() {
            return this.$route.name;
        },
    },
    methods: {
        handleLogout() {
            let params = {
                successCb: res => {
                    // redirect to home
                    this.$router.push({name: 'home'});
                },
                errorCb: error => {}
            }
            store.dispatch(LOGOUT, params);
        }
    }
}
</script>
