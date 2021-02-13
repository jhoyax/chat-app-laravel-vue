<template>
    <div class="chats">
        <h1>Chats</h1>
        <form action="" class="search">
            <input type="text" class="search__input">
            <button class="search__submit">Search</button>
        </form>

        <ul>
            <li>
                <router-link :to="{ name: 'chat', params: {chatId: 1} }">User 1</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'chat', params: {chatId: 1} }">User 1</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'chat', params: {chatId: 1} }">User 1</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'chat', params: {chatId: 1} }">User 1</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'chat', params: {chatId: 1} }">User 1</router-link>
            </li>
        </ul>
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
