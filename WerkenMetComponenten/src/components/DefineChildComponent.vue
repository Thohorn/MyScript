<script setup>
  const message = defineModel();

</script>

<template>
  <div>
    <input v-model="message[0]" placeholder="Typ iets..." />
    <input v-model="message[1]" placeholder="Typ hier ook iets..." />
  </div>

</template>

<style scoped>

</style>
