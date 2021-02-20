<template>
    <div class="chat">
        <div class="chat__header">
            <div class="chat__header-left">
                <router-link :to="{ name: 'chats' }">
                    <div class="chat__header-back"></div>
                </router-link>
                <router-link :to="{ name: 'profile', params: { profileId: 1 } }">
                    <div class="chat__header-img"></div>
                    <h1>User1</h1>
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
                <li class="chat__message-receiver">
                    <div class="chat__message-img"></div>
                    <div class="chat__message-text">
                        <p>lorem ipsum...</p><br>
                        <p>lorem ipsum...</p><br>
                        <p>lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
                    </div>
                </li>
                <li class="chat__message-sender">
                    <div class="chat__message-text">
                        <p>lorem ipsum...</p><br>
                        <p>lorem ipsum...</p>
                    </div>
                </li>
                <li class="chat__message-receiver">
                    <div class="chat__message-img"></div>
                    <div class="chat__message-text">
                        <p>lorem ipsum</p><br>
                        <p>lorem ipsum lorem ipsum</p><br>
                        <p>lorem ipsum</p>
                    </div>
                </li>
                <li class="chat__message-sender">
                    <div class="chat__message-text">
                        <p>lorem ipsum lorem ipsum</p><br>
                        <p>lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
                    </div>
                </li>
                <li class="chat__message-receiver">
                    <div class="chat__message-img"></div>
                    <div class="chat__message-text">
                        <p>lorem ipsum...</p><br>
                        <p>lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p><br>
                        <p>lorem ipsum...</p>
                    </div>
                </li>
                <li class="chat__message-sender">
                    <div class="chat__message-text">
                        <p>lorem ipsum...</p><br>
                        <p>lorem ipsum...</p>
                    </div>
                </li>
                <li class="chat__message-receiver">
                    <div class="chat__message-img"></div>
                    <div class="chat__message-text">
                        <p>lorem ipsum</p><br>
                        <p>lorem ipsum lorem ipsum</p>
                    </div>
                </li>
                <li class="chat__message-sender">
                    <div class="chat__message-text">
                        <p>lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="chat__message-bar">
            <textarea class="form__input" rows="1" placeholder="Type text here..."></textarea>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Chat',
    data() {
        return {
            showOption: false
        }
    },
    methods: {
        deleteChat() {
            this.showOption = false;
        }
    }
}
</script>
