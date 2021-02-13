<template>
    <div class="home">
        <img class="home__logo" src="/img/messenger.svg">
        <h1 class="home__title">{{ $t('reset_password') }}</h1>
        <ResetPasswordForm/>
    </div>
</template>

<script>
import ResetPasswordForm from '@/components/ResetPasswordForm';

export default {
    name: 'Home',
    components: {
        ResetPasswordForm,
    },
}
</script>
