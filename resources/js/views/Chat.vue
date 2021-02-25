<template>
    <div class="chat">
        <div class="chat__header">
            <div class="chat__header-left">
                <router-link :to="{ name: 'chats' }">
                    <div class="chat__header-back"></div>
                </router-link>
                <router-link :to="{ name: 'profileById', params: { profileId: toId } }">
                    <div class="chat__header-img" :style="getAvatarStyle(toDetails.avatar)"></div>
                    <h1>{{ toDetails.name }}</h1>
                </router-link>
            </div>
            <div class="chat__header-more" @click="showOption = !showOption"></div>
            <transition name="fade">
                <div v-if="showOption" class="chat__header-option">
                    <a href="#" @click.prevent="deleteChat">Delete</a>
                </div>
            </transition>
        </div>
        <div class="chat__message-list">
            <ul>
                <li
                    v-for="(item, index) in chats"
                    :key="index"
                    :class="{
                        'chat__message-receiver': fromId != item.from,
                        'chat__message-sender': fromId == item.from,
                    }">
                    <div v-if="fromId != item.from"
                        class="chat__message-img"
                        :style="getAvatarStyle(chats[index + 1] ? (chats[index + 1].to == item.to ? 'unset' : toDetails.avatar) : toDetails.avatar)"></div>
                    <div class="chat__message-text">
                        <p :title="item.created_at">{{ item.message }}</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="chat__message-bar">
            <textarea class="form__input" rows="1" placeholder="Type text here..." v-model="message"></textarea>
            <a href="#" @click.prevent="handleSend"><img src="/img/send.svg"></a>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

import { GET_CHAT_SINGLE, STORE_CHAT, DELETE_CHAT_SINGLE } from '@/store/action-types';
import backgroundImageUrl from '@/mixins/backgroundImageUrl';

export default {
    name: 'Chat',
    mixins: [backgroundImageUrl],
    data() {
        return {
            showOption: false,
            fromId: this.$route.params.fromId,
            toId: this.$route.params.toId,
            chats: [],
            toDetails: {},
            message: '',
        }
    },
    mounted() {
        this.getChatSingle()
    },
    methods: {
        ...mapActions( [
            GET_CHAT_SINGLE,
            STORE_CHAT,
            DELETE_CHAT_SINGLE,
        ]),
        deleteChat() {
            this.showOption = false;

            let params = {
                from: this.fromId,
                to: this.toId,
                successCb: res => {
                    this.$router.push({name: 'chats'});
                },
                errorCb: error => {}
            };
            this.DELETE_CHAT_SINGLE(params);
        },
        getChatSingle() {
            let params = {
                from: this.fromId,
                to: this.toId,
                successCb: res => {
                    this.chats = res.data.chats;
                    this.toDetails = res.data.toDetails;

                    setTimeout(() => {
                        window.scrollTo(0, document.body.scrollHeight);
                    }, 500);
                },
                errorCb: error => {
                    this.$router.push({name: 'chats'});
                }
            };
            this.GET_CHAT_SINGLE(params);
        },
        handleSend() {
            let params = {
                to: this.toDetails.id,
                to_name: this.toDetails.name,
                message: this.message,
                successCb: res => {
                    this.message = '';
                    this.getChatSingle();
                },
                errorCb: error => {}
            };
            this.STORE_CHAT(params);
        },
    }
}
</script>
