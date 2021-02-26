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
                        <template v-if="userList.length">
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
                    <template v-if="chatList.length">
                        <li v-for="(item, index) in chatList" :key="index">
                            <router-link
                                :to="{ name: 'chat', params: {fromId: user.id, toId: user.id != item.from ? item.from : item.to} }"
                                class="chats__item"
                                :title="item.created_at">
                                <div class="chats__item-img" :style="getAvatarStyle(user.id != item.from ? item.from_avatar : item.to_avatar)"></div>
                                <label>{{ user.id != item.from ? item.from_name : item.to_name }}</label>
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
        if (Object.keys(this.currentUser).length) {
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
                    this.chatListFilter(res.data.data);
                },
                errorCb: error => {}
            };
            this.GET_CHAT_LIST(params);
        },
        chatListFilter(data) {
            let idList = [];
            this.chatList = data.filter((item, index) => {
                let getTo = this.user.id != item.from ? item.from : item.to;

                if (idList.includes(getTo)) {
                    return false;
                }

                idList.push(getTo);
                return true;
            });
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
