<script setup>
  import { ref } from 'vue';
  import ThrownDice from './components/ThrownDice.vue';
  import ScoreTable from './components/ScoreTable.vue';

  const dice = ref([0, 0, 0, 0, 0]);

</script>

<template>
  <ThrownDice v-model="dice" />
  <!-- <ScoreTable v-model="dice"/> -->
   <ScoreTable :dice="dice" />

</template>

<style scoped>

</style>
