<template>
    <fragment>
        <form v-if="showForm" class="form">
            <input type="email" class="form__input" :placeholder="$t('email')" required>
            <input type="password" class="form__input" :placeholder="$t('password')" required>
            <button class="btn btn--green-gradient">{{ $t('login') }}</button>
            <a href="#" @click.prevent="toggleForm">{{ $t('cancel') }}</a>
        </form>
        <button v-else class="btn btn--green-gradient" @click="toggleForm">{{ $t('login') }}</button>
    </fragment>
</template>

<script>
import { Fragment } from 'vue-fragment';

export default {
    name: 'LoginForm',
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
            this.$emit('close', !this.showForm ? 'all' : 'login')
        }
    }
}
</script>
