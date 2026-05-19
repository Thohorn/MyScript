<template>
    <nav>
        <router-link :to="{name: 'books.overview'}" class="link">Boeken Overzicht</router-link> |
        <router-link :to="{name: 'books.create'}" class="link">Nieuw Boek</router-link> |
        <router-link :to="{name: 'authors.overview'}" class="link">Auteur Overzicht</router-link> |
        <router-link :to="{name: 'authors.create'}" class="link">Nieuwe Auteur toevoegen</router-link>
    </nav>
    <router-view></router-view>
</template>