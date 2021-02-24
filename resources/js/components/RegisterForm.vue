<template>
    <transition name="fade">
        <form v-if="showForm" @submit.prevent="submitForm('register')" class="form">
            <input
                type="text"
                class="form__input"
                :class="{
                    'form__input--error' : form.errors.errors.errors ? (form.errors.errors.errors.name ? true : false ) : false
                }"
                :placeholder="$t('name')"
                required
                maxlength="255"
                v-model="form.name">
            <template v-if="form.errors.errors.errors">
                <label
                    v-for="(item, index) in form.errors.errors.errors.name"
                    :key="`name-error-${index}`"
                    class="form__message form__message--error">{{item}}</label>
            </template>
            <input
                type="email"
                class="form__input"
                :class="{
                    'form__input--error' : form.errors.errors.errors ? (form.errors.errors.errors.email ? true : false ) : false
                }"
                :placeholder="$t('email')"
                required
                maxlength="255"
                v-model="form.email">
            <template v-if="form.errors.errors.errors">
                <label
                    v-for="(item, index) in form.errors.errors.errors.email"
                    :key="`email-error-${index}`"
                    class="form__message form__message--error">{{item}}</label>
            </template>
            <input
                type="password"
                class="form__input"
                :class="{
                    'form__input--error' : form.errors.errors.errors ? (form.errors.errors.errors.password ? true : false ) : false
                }"
                :placeholder="$t('password')"
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
                :placeholder="$t('password_confirmation')"
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
                class="btn btn--orange">{{ $t('register') }}</button>
            <label
                v-if="form.errors.errors.message"
                class="form__message form__message--error">{{form.errors.errors.message}}</label>
            <label
                v-if="isSuccess"
                class="form__message form__message--success">Success.</label>
            <a
                href="#"
                @click.prevent="toggleForm('register')">{{ $t('cancel') }}</a>
        </form>
        <button v-else class="btn btn--orange" @click="toggleForm('register')">{{ $t('register') }}</button>
    </transition>
</template>

<script>
import Form from '@/utils/form';
import homeForms from '@/mixins/homeForms';

export default {
    name: 'RegisterForm',
    mixins: [homeForms],
    data() {
        return {
            form: new Form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }),
            isSuccess: false
        }
    },
    methods: {
        submitForm(url) {
            this.form.post(url)
                .then(res => {
                    this.isSuccess = true;

                    setTimeout(() => {
                        this.isSuccess = false;
                        this.toggleForm('register');
                    }, 1500);
                });
        }
    }
}
</script>
