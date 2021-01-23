<template>
    <fragment>
        <div v-if="showForm">
            <a href="#" @click.prevent="toggleForm">close</a>
        </div>
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
