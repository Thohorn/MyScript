<script setup>
    import { ref, reactive } from 'vue';

    const clicks = ref('0');
    const person = reactive({fisrtName: '', country: ''})
    const myFirstName = ref('');
    const myCountry = ref('');

    const incrementClicks = () => {
        clicks.value++;
    }

    const changeFirstName = () => {
        if (myFirstName.value) {
            person.fisrtName = myFirstName.value;
        }
    }

    const changeCountry = () => {
        if (myCountry.value) {
            person.country = myCountry.value;
        }
    }

</script>

<template>
    <h2>Klik teller</h2>
    <p>Huidige waarde: {{ clicks }}</p>
    <button @click="incrementClicks">Verhoog teller</button>

    <h2>Name</h2>
    <p>Je naam: {{person.fisrtName}}</p>
    <input v-model="person.fisrtName" placeholder="Naam veranderd direct" type="text" />
    <input v-model="myFirstName" placeholder="knop is nodig" type="text" />
    <button @click="changeFirstName">Verander je naam</button>

    <h2>Country</h2>
    <p>Je land: {{person.country}}</p>
    <input v-model="myCountry" placeholder="typ hier het land waar je woont" type="text" />
    <button @click="changeCountry">Verander je land</button>
</template>

<style scoped></style>
