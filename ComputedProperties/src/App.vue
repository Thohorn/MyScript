<script setup>
  import { ref, computed } from 'vue';

  const people = ref([{ name: 'Jan', age: 12 }, { name: 'Piet', age: 20 }]);

  const newName = ref('');
  const newAge = ref(null);

  const addToPeople = () => {
    if(newName && newAge){
      people.value.push({name: newName.value, age: newAge.value});
      newName.value = '';
      newAge.value = null;
    };
  }

  const children = computed(() => {
    let onlyChildren = people.value.filter(function (element) { return element.age < 18; })

    return onlyChildren
  });

</script>

<template>
<input v-model="newName" placeholder="Vul naam in" type="text" />
<input v-model="newAge" placeholder="vul leeftijd in" type="number" />
<button @click="addToPeople">Voeg persoon toe</button>

<h2>Alle personen</h2>
<li v-for="({name, age}, index) in people">{{ name }} {{ age }}</li>

<h2>Kinderen</h2>
<li v-for="({name, age}, index) in children">{{ name }} {{ age }}</li>
  
</template>

<style scoped>

</style>
