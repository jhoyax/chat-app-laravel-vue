<template>
    <div class="chats">
        <div class="chats__header">
            <h1>{{ $t('chats') }}</h1>
        </div>
        <div class="chats__search">
            <form>
                <input type="text" class="form__input" :placeholder="$t('search')" v-model="keyword" @keyup="handleSearchUser">
            </form>
        </div>
        <div class="chats__list">
            <ul>
                <template v-if="keyword">
                    <li>
                        <template v-if="userList">
                            <li v-for="(item, index) in userList" :key="index">
                                <router-link :to="{ name: 'chat', params: {fromId: user.id, toId: item.id} }" class="chats__item">
                                    <div class="chats__item-img" :style="getAvatarStyle(item.avatar)"></div>
                                    <label>{{ item.name }}</label>
                                </router-link>
                            </li>
                        </template>
                        <template v-else>
                            <li>
                                <div class="chats__label">No Result</div>
                            </li>
                        </template>
                    </li>
                </template>
                <template v-else>
                    <template v-if="chatList">
                        <li v-for="(item, index) in chatList" :key="index">
                            <router-link :to="{ name: 'chat', params: {fromId: user.id, toId: item.to} }" class="chats__item">
                                <div class="chats__item-img" :style="getAvatarStyle(item.to_avatar)"></div>
                                <label>{{ item.to_name }}</label>
                            </router-link>
                        </li>
                    </template>
                    <template v-else>
                        <li>
                            <div class="chats__label">No Result</div>
                        </li>
                    </template>
                </template>
            </ul>
        </div>
        <Menu/>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

import Menu from '@/components/Menu';
const store = require( '@/store/' ).default;
import setCurrentUser from '@/mixins/setCurrentUser';
import backgroundImageUrl from '@/mixins/backgroundImageUrl';
import { GET_CHAT_LIST, GET_USER_LIST } from '@/store/action-types';

export default {
    name: 'Chats',
    mixins: [setCurrentUser, backgroundImageUrl],
    data() {
        return {
            keyword: '',
            chatList: [],
            userList: [],
        }
    },
    components: {
        Menu,
    },
    mounted() {
        if (Object.keys(this.currentUser).length    ) {
            this.getChatList();
        } else {
            store.subscribe((mutation, state) => {
                if (mutation.type == 'SET_CURRENT_USER') {
                    this.getChatList();
                }
            });
        }
    },
    methods: {
        ...mapActions( [
            GET_CHAT_LIST,
            GET_USER_LIST,
        ]),
        getChatList() {
            let params = {
                from: this.user.id,
                name: this.keyword,
                successCb: res => {
                    this.chatList = res.data.data;
                },
                errorCb: error => {}
            };
            this.GET_CHAT_LIST(params);
        },
        getUserList() {
            let params = {
                name: this.keyword,
                successCb: res => {
                    this.userList = res.data.data;
                },
                errorCb: error => {}
            };
            this.GET_USER_LIST(params);
        },
        handleSearchUser() {
            this.getUserList();
        },
    }
}
</script>
