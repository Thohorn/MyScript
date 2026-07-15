<template>
    <nav>
        <router-link :to="{name: 'user.overview'}">Gebruiker Overzicht</router-link> |
        <router-link :to="{name: 'user.login'}">Login</router-link>
    </nav>

    <router-view></router-view>
</template>