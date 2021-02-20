<template>
    <div class="profile">
        <div class="profile__header">
            <h1>{{ $t('profile') }}</h1>
        </div>
        <div class="profile__picture">
            <div class="profile__picture-img" style="background-image: url('/img/profile.jpg')"></div>
            <label for="">User 1</label>
        </div>
        <div class="profile__details">
            <form>
                <table>
                    <tr>
                        <td>{{ $t('name') }}</td>
                        <td v-if="!isEdit">User 1</td>
                        <td v-if="isEdit">
                            <input type="text" class="form__input" required maxlength="255">
                        </td>
                    </tr>
                    <tr>
                        <td>{{ $t('email') }}</td>
                        <td v-if="!isEdit">user@gmail.com</td>
                        <td v-if="isEdit">
                            <input type="text" class="form__input" required maxlength="255">
                        </td>
                    </tr>
                    <tr v-if="isEdit">
                        <td>{{ $t('new_password') }}</td>
                        <td>
                            <input type="password" class="form__input" minlength="8">
                        </td>
                    </tr>
                    <tr v-if="isEdit">
                        <td>{{ $t('new_password_confirmation') }}</td>
                        <td>
                            <input type="password" class="form__input" minlength="8">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="profile__actions">
            <button
                class="btn btn--green-gradient btn--small"
                @click="isEdit = true"
                    v-if="!isEdit">{{ $t('edit_profile') }}</button>
            <button
                class="btn btn--light-gray btn--small"
                @click="isEdit = false"
                    v-if="isEdit">{{ $t('cancel') }}</button>
            <button
                class="btn btn--green-gradient btn--small"
                @click="updateProfile"
                    v-if="isEdit">{{ $t('update') }}</button>
        </div>
        <Menu/>
    </div>
</template>

<script>
import Menu from '@/components/Menu';

export default {
    name: 'Profile',
    data() {
        return {
            isEdit: false,
        }
    },
    components: {
        Menu,
    },
    methods: {
        updateProfile() {
            this.isEdit = false;
        }
    }
}
</script>
