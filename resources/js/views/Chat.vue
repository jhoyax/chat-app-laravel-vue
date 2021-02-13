<template>
    <div class="chat">
        <h1>Chat</h1>
        <router-link :to="{ name: 'chats' }">Back</router-link>
        <Menu/>
    </div>
</template>

<script>
import Menu from '@/components/Menu';

export default {
    name: 'Chat',
    components: {
        Menu,
    }
}
</script>
