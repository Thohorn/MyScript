<script setup lang="ts">
    import { ref } from 'vue';
    import { categoriesStore } from '../store';
    import { Category } from '../types';
    import ConfirmationModal from '../../../components/ConfirmationModal.vue';

    categoriesStore.actions.getAll();
    const categories = categoriesStore.getters.all;    
    
    const showModal = ref(false);
    const currentCategory = ref<Category>()

    const showConfirmation = (category:Category) => {
        currentCategory.value = category;
        showModal.value = true;
    }

    const deleteCategory = () => {
        //delete category. Make route in api.
        // Create delete in the controller. 
        // Check if the category has any tickets. If so send back error and say it can't be done.
        
    };

</script>

<template>
    <div v-if="showModal"><confirmation-modal @canceled="showModal = false" @confirmed="deleteCategory" body="Weet je zeker dat je de categorie wil verwijderen?" title="currentCategory.title" /></div>
    <router-link :to="{name: 'categories.create'}">Maak een category</router-link>
    <table>
        <thead>
            <th>Titel</th>
        </thead>
        <tbody>
            <tr v-for="catgegory in categories" >
                <td> {{ catgegory.title }}</td>
                <td v-if="catgegory.id"><router-link :to="{name: 'categories.edit', params: {id: catgegory.id}}">Aanpassen</router-link></td>
                <td v-if="catgegory.id"><button @click="showConfirmation(catgegory)">Verwijder</button></td>
            </tr>
        </tbody>
    </table>
</template>