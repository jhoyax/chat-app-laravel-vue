<template>
    <div class="chats">
        <div class="chats__header">
            <h1>{{ $t('chats') }}</h1>
        </div>
        <div class="chats__search">
            <form>
                <input type="text" class="form__input" :placeholder="$t('search')">
            </form>
        </div>
        <div class="chats__list">
            <ul>
                <li>
                    <router-link :to="{ name: 'chat', params: {chatId: 1} }" class="chats__item">
                        <div class="chats__item-img"></div>
                        <label>User 1</label>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'chat', params: {chatId: 1} }" class="chats__item">
                        <div class="chats__item-img"></div>
                        <label>User 1</label>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'chat', params: {chatId: 1} }" class="chats__item">
                        <div class="chats__item-img"></div>
                        <label>User 1</label>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'chat', params: {chatId: 1} }" class="chats__item">
                        <div class="chats__item-img"></div>
                        <label>User 1</label>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'chat', params: {chatId: 1} }" class="chats__item">
                        <div class="chats__item-img"></div>
                        <label>User 1</label>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'chat', params: {chatId: 1} }" class="chats__item">
                        <div class="chats__item-img"></div>
                        <label>User 1</label>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'chat', params: {chatId: 1} }" class="chats__item">
                        <div class="chats__item-img"></div>
                        <label>User 1</label>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'chat', params: {chatId: 1} }" class="chats__item">
                        <div class="chats__item-img"></div>
                        <label>User 1</label>
                    </router-link>
                </li>
            </ul>
        </div>
        <Menu/>
    </div>
</template>

<script>
import Menu from '@/components/Menu';

export default {
    name: 'Chats',
    components: {
        Menu,
    }
}
</script>
