<template>
    <fragment>
        <form @submit.prevent="submitForm('reset-password')" class="form">
            <input
                type="password"
                class="form__input"
                :class="{
                    'form__input--error' : form.errors.errors.errors ? (form.errors.errors.errors.password ? true : false ) : false
                }"
                :placeholder="$t('new_password')"
                required
                minlength="8"
                v-model="form.password">
            <template v-if="form.errors.errors.errors">
                <label
                    v-for="(item, index) in form.errors.errors.errors.password"
                    :key="`password-error-${index}`"
                    class="form__message form__message--error">{{item}}</label>
            </template>
            <input
                type="password"
                class="form__input"
                :class="{
                    'form__input--error' : form.errors.errors.errors ? (form.errors.errors.errors.password_confirmation ? true : false ) : false
                }"
                :placeholder="$t('new_password_confirmation')"
                required
                minlength="8"
                v-model="form.password_confirmation">
            <template v-if="form.errors.errors.errors">
                <label
                    v-for="(item, index) in form.errors.errors.errors.password_confirmation"
                    :key="`password_confirmation-error-${index}`"
                    class="form__message form__message--error">{{item}}</label>
            </template>
            <button
                type="submit"
                class="btn btn--green-gradient">{{ $t('submit') }}</button>
            <label
                v-if="form.errors.errors.message"
                class="form__message form__message--error">{{form.errors.errors.message}}</label>
            <label
                v-if="isSuccess"
                class="form__message form__message--success">Success.</label>
            <router-link :to="{ name: 'home' }">{{ $t('cancel') }}</router-link>
        </form>
    </fragment>
</template>

<script>
import { Fragment } from 'vue-fragment';

import Form from '@/utils/form';

export default {
    name: 'ResetPasswordForm',
    components: {
        Fragment,
    },
    data() {
        return {
            form: new Form({
                email: decodeURIComponent(this.$route.params.email),
                token: decodeURIComponent(this.$route.params.token),
                password: '',
                password_confirmation: '',
            }),
            isSuccess: false
        }
    },
    methods: {
        submitForm(url) {
            this.form.post(url)
                .then(response => {
                    this.form.reset();
                    this.isSuccess = true;

                    setTimeout(() => {
                        this.isSuccess = false;
                        this.$router.push({name: 'home'});
                    }, 1500);
                });
        }
    }
}
</script>
