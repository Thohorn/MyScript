<script setup lang="ts">
    import { useRouter } from 'vue-router';
    import { currentUser } from '../../user/store';
    import { categoriesStore } from '../store';

    const router = useRouter();

    if (currentUser.value.role !== 'admin'){
        router.push({name: 'tickets.overview'});    
    }

    categoriesStore.actions.getAll();
    const categories = categoriesStore.getters.all;    
    

</script>

<template>
    <table>
        <thead>
            <th>Titel</th>
        </thead>
        <tbody>
            <tr v-for="catgegory in categories" >
                <td> {{ catgegory.title }}</td>
            </tr>
        </tbody>
    </table>
</template>