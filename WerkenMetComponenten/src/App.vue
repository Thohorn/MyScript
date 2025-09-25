<script setup>
  import { ref } from 'vue';
  import ChildComponent from './components/ChildComponent.vue';
  import DefineChildComponent from './components/DefineChildComponent.vue';

  const initialMessage = "Welkom in Vue 3!";
  const extraMessage = "Dit is extraMessage";

  const message = ref('');
  const extraEmitMessage = ref('');

  const defineChildMessages = ref([]);

  const handleMessage = (newMessage) => {
    message.value = newMessage[0];
    extraEmitMessage.value = newMessage[1];
  };

</script>

<template>
  <ChildComponent @updateMessage="handleMessage" :initialMessage="initialMessage" :extraPropMessage="extraMessage" />

  <p>Bericht van kindcomponent: {{ message }}</p>
  <p>Extra bericht van kindcomponent: {{ extraEmitMessage }}</p>

  <h1> Werken met defineModel</h1>

  <DefineChildComponent v-model="defineChildMessages" />

  <p>Huidig bericht: {{ defineChildMessages[0] }}</p>
  <p>Ander bericht: {{ defineChildMessages[1] }}</p>

</template>

<style scoped>

</style>
