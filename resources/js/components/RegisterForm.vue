<template>
    <fragment>
        <form v-if="showForm" class="form">
            <input type="email" class="form__input form__input--error" :placeholder="$t('email')" required>
            <label class="form__message form__message--error">Error message here.</label>
            <input type="password" class="form__input form__input--error" :placeholder="$t('password')" required>
            <label class="form__message form__message--error">Error message here.</label>
            <label class="form__message form__message--error">Error message here.</label>
            <input type="password" class="form__input" :placeholder="$t('confirm_password')" required>
            <button class="btn btn--orange">{{ $t('register') }}</button>
            <label class="form__message form__message--success">Success message here.</label>
            <a href="#" @click.prevent="toggleForm">{{ $t('cancel') }}</a>
        </form>
        <button v-else class="btn btn--orange" @click="toggleForm">{{ $t('register') }}</button>
    </fragment>
</template>

<script>
import { Fragment } from 'vue-fragment';

export default {
    name: 'RegisterForm',
    components: {
        Fragment,
    },
    data() {
        return {
            showForm: false
        }
    },
    methods: {
        toggleForm(e) {
            this.showForm = !this.showForm;
            this.$emit('close', !this.showForm ? 'all' : 'register')
        }
    }
}
</script>
