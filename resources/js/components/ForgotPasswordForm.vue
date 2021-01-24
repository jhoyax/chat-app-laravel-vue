<template>
    <fragment>
        <form v-if="showForm" class="form">
            <input type="email" class="form__input" :placeholder="$t('email')" required>
            <button class="btn btn--green-gradient">{{ $t('submit') }}</button>
            <a href="#" @click.prevent="toggleForm">{{ $t('cancel') }}</a>
        </form>
        <a v-else href="#" @click.prevent="toggleForm">{{ $t('forgot_password') }}?</a>
    </fragment>
</template>

<script>
import { Fragment } from 'vue-fragment';

export default {
    name: 'ForgotPasswordForm',
    components: {
        Fragment,
    },
    data() {
        return {
            showForm: false
        }
    },
    methods: {
        toggleForm() {
            this.showForm = !this.showForm;
            this.$emit('close', !this.showForm ? 'all' : 'forgot_password')
        }
    }
}
</script>
