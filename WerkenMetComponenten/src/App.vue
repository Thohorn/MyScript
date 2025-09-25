<script setup>
import { ref } from 'vue';
import ChildComponent from './components/ChildComponent.vue';
import DefineChildComponent from './components/DefineChildComponent.vue';

const initialMessage = "Welkom in Vue 3!";

const message = ref('');

const sharedMessage = ref('');

const handleMessage = (newMessage) => {
  message.value = newMessage;
};

</script>

<template>
  <ChildComponent @updateMessage="handleMessage" :initialMessage="initialMessage" />

  <p>Bericht van kindcomponent: {{ message }}</p>

  <h1> Werken met defineModel</h1>
  <DefineChildComponent v-model="sharedMessage" />
  <p>Huidig bericht: {{ sharedMessage }}</p>
</template>

<style scoped>

</style>
