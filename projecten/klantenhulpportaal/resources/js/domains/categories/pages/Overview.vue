<script setup lang="ts">
    import { categoriesStore } from '../store';

    categoriesStore.actions.getAll();
    const categories = categoriesStore.getters.all;    
    

</script>

<template>
    <router-link :to="{name: 'categories.create'}">Maak een category</router-link>
    <table>
        <thead>
            <th>Titel</th>
        </thead>
        <tbody>
            <tr v-for="catgegory in categories" >
                <td> {{ catgegory.title }}</td>
                <td v-if="catgegory.id"><router-link :to="{name: 'categories.edit', params: {id: catgegory.id}}">Aanpassen</router-link></td>
            </tr>
        </tbody>
    </table>
</template>