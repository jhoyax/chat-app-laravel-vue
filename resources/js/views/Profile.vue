<template>
    <div class="profile">
        <div class="profile__header">
            <h1>{{ $t('profile') }}</h1>
        </div>
        <div class="profile__picture">
            <div class="profile__picture-img" :style="getAvatarStyle(user.avatar)">
                <input
                    v-if="user.isCurrentUser"
                    type="file"
                    @change="onFileChange"
                    accept=".jpg, .jpeg, .png, .gif">
            </div>
            <label for="">{{ user.name }}</label>
        </div>
        <div class="profile__details">
            <form>
                <table>
                    <tr>
                        <td>{{ $t('name') }}</td>
                        <td v-if="!isEdit">{{ user.name }}</td>
                        <td v-if="isEdit">
                            <input type="text" class="form__input" required maxlength="255" v-model="form.name">
                            <template v-if="form.errors.errors.errors">
                                <label
                                    v-for="(item, index) in form.errors.errors.errors.name"
                                    :key="`name-error-${index}`"
                                    class="form__message form__message--error">{{item}}</label>
                            </template>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ $t('email') }}</td>
                        <td v-if="!isEdit">{{ user.email }}</td>
                        <td v-if="isEdit">
                            <input type="text" class="form__input" required maxlength="255" v-model="form.email">
                            <template v-if="form.errors.errors.errors">
                                <label
                                    v-for="(item, index) in form.errors.errors.errors.email"
                                    :key="`name-error-${index}`"
                                    class="form__message form__message--error">{{item}}</label>
                            </template>
                        </td>
                    </tr>
                    <tr v-if="isEdit">
                        <td>{{ $t('new_password') }}</td>
                        <td>
                            <input type="password" class="form__input" minlength="8" v-model="form.password">
                            <template v-if="form.errors.errors.errors">
                                <label
                                    v-for="(item, index) in form.errors.errors.errors.password"
                                    :key="`name-error-${index}`"
                                    class="form__message form__message--error">{{item}}</label>
                            </template>
                        </td>
                    </tr>
                    <tr v-if="isEdit">
                        <td>{{ $t('new_password_confirmation') }}</td>
                        <td>
                            <input type="password" class="form__input" minlength="8" v-model="form.password_confirmation">
                            <template v-if="form.errors.errors.errors">
                                <label
                                    v-for="(item, index) in form.errors.errors.errors.password_confirmation"
                                    :key="`name-error-${index}`"
                                    class="form__message form__message--error">{{item}}</label>
                            </template>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <label
            v-if="form.errors.errors.message"
            class="form__message form__message--error">{{form.errors.errors.message}}</label>
        <label
            v-if="isSuccess"
            class="form__message form__message--success">Success.</label>
        <div class="profile__actions" v-if="user.isCurrentUser">
            <button
                class="btn btn--green-gradient btn--small"
                @click="editProfile"
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
import { mapActions } from 'vuex';

import Form from '@/utils/form';
import Menu from '@/components/Menu';
import setCurrentUser from '@/mixins/setCurrentUser';
import backgroundImageUrl from '@/mixins/backgroundImageUrl';
import { UPDATE_USER, UPDATE_USER_AVATAR } from '@/store/action-types';

export default {
    name: 'Profile',
    mixins: [setCurrentUser, backgroundImageUrl],
    data() {
        return {
            isEdit: false,
            form: new Form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }),
            isSuccess: false,
        }
    },
    components: {
        Menu,
    },
    methods: {
        ...mapActions( [
            UPDATE_USER,
            UPDATE_USER_AVATAR,
        ]),
        updateProfile() {
            let params = {
                id: this.user.id,
                name: this.form.name,
                email: this.form.email,
                password: this.form.password,
                password_confirmation: this.form.password_confirmation,
                successCb: res => {
                    this.form.errors.clear();
                    this.isSuccess = true;

                    this.user = res.data.data;
                    if (this.user.isCurrentUser) {
                        this.SET_CURRENT_USER({user: res.data.data});
                    }

                    setTimeout(() => {
                        this.isSuccess = false;
                    }, 1500);
                },
                errorCb: error => {
                    this.form.onFail(error.response.data);
                }
            }
            this.UPDATE_USER(params);
        },
        editProfile() {
            this.form.name = this.user.name;
            this.form.email = this.user.email;

            this.isEdit = true;
        },
        onFileChange(e) {
            let files = e.target.files;
            let params = {
                id: this.user.id,
                avatar: files[0],
                successCb: res => {
                    this.user = res.data.data;
                    if (this.user.isCurrentUser) {
                        this.SET_CURRENT_USER({user: res.data.data});
                    }
                },
                errorCb: error => {}
            }
            this.UPDATE_USER_AVATAR(params);
        }
    }
}
</script>
