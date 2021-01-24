<template>
    <div class="notfound">
        <img src="/img/messenger-dark.svg" class="notfound__logo">
        <h1>Page not found :(</h1>
        <router-link :to="{ name: 'home' }">Go to Home Page</router-link>
    </div>
</template>

<script>
export default {
    name: "NotFound"
}
</script>
