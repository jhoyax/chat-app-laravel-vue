<template>
    <div>
    <h1>Chats</h1>
    <a href="#" @click.prevent="handleLogout">{{$t('logout')}}</a>
    </div>
</template>

<script>
import { default as store } from '@/store';
import { LOGOUT } from '@/store/action-types';

export default {
    name: "Chats",
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
