<template>
    <transition name="fade">
        <form v-if="showForm" @submit.prevent="submitForm('login')" class="form">
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
            <button
                type="submit"
                class="btn btn--green-gradient">{{ $t('login') }}</button>
            <label
                v-if="form.errors.errors.message"
                class="form__message form__message--error">{{form.errors.errors.message}}</label>
            <a
                href="#"
                @click.prevent="toggleForm('login')">{{ $t('cancel') }}</a>
        </form>
        <button v-else class="btn btn--green-gradient" @click="toggleForm('login')">{{ $t('login') }}</button>
    </transition>
</template>

<script>
import Form from '@/utils/form';
import homeForms from '@/mixins/homeForms';

export default {
    name: 'LoginForm',
    mixins: [homeForms],
    data() {
        return {
            form: new Form({
                email: '',
                password: '',
            })
        }
    },
    methods: {
        submitForm(url) {
            this.form.post(url)
                .then(response => {
                    this.$router.push({name: 'chats'});
                });
        }
    }
}
</script>
