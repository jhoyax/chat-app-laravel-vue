<template>
    <div class="chat">
        <div class="chat__header">
            <router-link :to="{ name: 'chats' }"><div class="chat__header-back"></div></router-link>
            <div class="chat__header-img"></div>
            <h1>User1</h1>
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
            <textarea class="form__input" rows="1"></textarea>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Chat',
}
</script>
