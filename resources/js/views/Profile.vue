<template>
    <div class="profile">
        <h1>Profile</h1>
        <img src="">
        <label for="">User 1</label>
        <form action="" class="form__profile">
            <label for="">Name</label>
            <input placeholder="name">
        </form>
        <Menu/>
    </div>
</template>

<script>
import Menu from '@/components/Menu';

export default {
    name: 'Profile',
    components: {
        Menu,
    }
}
</script>
