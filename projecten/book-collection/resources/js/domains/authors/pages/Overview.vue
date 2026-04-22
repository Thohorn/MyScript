<script setup>
import { onMounted } from 'vue';
import { fetchAuthors, getAllAuthors } from '../store';


fetchAuthors();

</script>


<template>
        <table>
        <tr>
            <th>Name</th>
        </tr>
        <tr v-for="author in getAllAuthors" :key="author.id">
            <td>{{ author.name }}</td>
        </tr>
    </table>
</template>