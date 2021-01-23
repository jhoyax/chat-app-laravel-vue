<template>
    <fragment>
        <div v-if="showForm">
            <a href="#" @click.prevent="toggleForm">close</a>
        </div>
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
