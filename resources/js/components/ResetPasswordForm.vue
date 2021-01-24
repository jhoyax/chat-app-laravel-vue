<template>
    <fragment>
        <form class="form">
            <input type="password" class="form__input" :placeholder="$t('new_password')" required>
            <input type="password" class="form__input" :placeholder="$t('confirm_new_password')" required>
            <button class="btn btn--green-gradient">{{ $t('submit') }}</button>
            <router-link :to="{ name: 'home' }">{{ $t('cancel') }}</router-link>
        </form>
    </fragment>
</template>

<script>
import { Fragment } from 'vue-fragment';

export default {
    name: 'ResetPasswordForm',
    components: {
        Fragment,
    }
}
</script>
