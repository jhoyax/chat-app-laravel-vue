<template>
    <div class="menu">
        <ul class="menu__links">
            <li>
                <router-link :to="{ name: 'chats' }">
                    <img src="/img/messenger-light-gray.svg">
                    Chats
                </router-link>
            </li>
            <li>
                <router-link :to="{ name: 'profile', params: {profileId: 1} }">
                    <img src="/img/logout-light-gray.svg">
                    Profile
                </router-link>
            </li>
            <li>
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
