<template>
    <div class="profile">
        <div class="profile__header">
            <h1>Profile</h1>
        </div>
        <div class="profile__picture">
            <img src="https://www.w3schools.com/howto/img_avatar2.png">
            <label for="">User 1</label>
        </div>
        <div class="profile__details">
            <table>
                <tr>
                    <td>Name</td>
                    <td>User 1</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>user@gmail.com</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>User 1</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>user@gmail.com</td>
                </tr>
                <tr>
                    <td></td>
                    <td><button class="btn btn--green-gradient btn--small">Edit Profile</button></td>
                </tr>
            </table>
        </div>
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
