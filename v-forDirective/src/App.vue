<script setup>
  import { ref } from 'vue';

  const tasks = ref([ { name: 'Boodschappen doen', completed: false },
                      { name: 'Afwassen', completed: true },
                      { name: 'Hond uitlaten', completed: false }]
                    );

  const changeCompleted = (task) => {
    task.completed = !task.completed
  }

</script>

<template>
  <ul>
    <li v-for="({name, completed}, index) in tasks">{{ name }} {{ completed }} <button @click="changeCompleted(tasks[index])">af/niet af</button></li>
  </ul>
  
</template>

<style scoped>

</style>
