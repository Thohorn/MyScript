<script setup lang="ts"></script>

<template>
    <nav>
        <router-link to="/create"><button type="button">Create new</button></router-link>
        <router-link to="/overview"><button type="button">Overview</button></router-link>
    </nav>
    <main>
        <RouterView />
    </main>
</template>

<style scoped>
button {
    margin: 5px;
}
nav {
    padding-bottom: 10px;
}
</style>
