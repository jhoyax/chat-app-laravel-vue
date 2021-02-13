<template>
    <transition name="fade">
        <form v-if="showForm" @submit.prevent="submitForm('forgot-password')" class="form">
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
            <button
                type="submit"
                class="btn btn--green-gradient">{{ $t('submit') }}</button>
            <label
                v-if="form.errors.errors.message"
                class="form__message form__message--error">{{form.errors.errors.message}}</label>
            <label
                v-if="isSuccess"
                class="form__message form__message--success">Success.</label>
            <a
                href="#"
                @click.prevent="toggleForm('forgot_password')">{{ $t('cancel') }}</a>
        </form>
        <a v-else href="#" @click.prevent="toggleForm('forgot_password')">{{ $t('forgot_password') }}?</a>
    </transition>
</template>

<script>
import Form from '@/utils/form';
import homeForms from '@/mixins/homeForms';

export default {
    name: 'ForgotPasswordForm',
    mixins: [homeForms],
    data() {
        return {
            form: new Form({
                email: '',
            }),
            isSuccess: false
        }
    },
    methods: {
        submitForm(url) {
            this.form.post(url)
                .then(response => {
                    this.isSuccess = true;

                    setTimeout(() => {
                        this.isSuccess = false;
                        this.toggleForm('forgot_password');
                    }, 1500);
                });
        }
    }
}
</script>
