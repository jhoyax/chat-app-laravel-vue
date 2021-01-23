<template>
    <fragment>
        <div v-if="showForm">
            <a href="#" @click.prevent="toggleForm">close</a>
        </div>
        <a v-else href="#" @click="toggleForm">{{ $t('forgot_password') }}</a>
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
