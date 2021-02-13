<template>
    <div class="home">
        <img class="home__logo" src="/img/messenger.svg">
        <h1 class="home__title">{{ $t(title) }}</h1>
        <div class="home__form">
            <LoginForm v-if="showForm.login" @close="toggleForm"/>
        </div>
        <div class="home__form">
            <RegisterForm v-if="showForm.register" @close="toggleForm"/>
        </div>
        <div class="home__form">
            <ForgotPasswordForm v-if="showForm.forgot_password" @close="toggleForm"/>
        </div>
    </div>
</template>

<script>
import LoginForm from '@/components/LoginForm';
import RegisterForm from '@/components/RegisterForm';
import ForgotPasswordForm from '@/components/ForgotPasswordForm';

export default {
    name: 'Home',
    components: {
        LoginForm,
        RegisterForm,
        ForgotPasswordForm,
    },
    data() {
        return {
            title: 'site_title',
            showForm: {
                login: true,
                register: true,
                forgot_password: true
            },
        }
    },
    methods: {
        toggleForm(name) {
            for (var key of Object.keys(this.showForm)) {
                if (name == 'all') {
                    this.showForm[key] = true;
                    this.title = 'site_title';
                } else {
                    this.title = name;
                    if (name == key) {
                        this.showForm[key] = true;
                    } else {
                        this.showForm[key] = false;
                    }
                }
            }
        }
    },
    beforeRouteEnter(to, from, next) {
        if ($cookies.isKey('token')) next({name: 'chats'});
        else next();
    }
}
</script>
