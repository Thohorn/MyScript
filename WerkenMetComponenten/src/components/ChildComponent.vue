<script setup>
defineProps({
  initialMessage: String,
});

const emit = defineEmits(['updateMessage']);

const emitEvent = () => {
  emit('updateMessage', 'Nieuw bericht van het kindcomponent');
};

</script>

<template>
    <div>
        <h3>{{ initialMessage }}</h3>
    </div>
    <h3>Stuur bericht naar oudercomponent</h3>
    <button @click="emitEvent">Verzend Bericht</button>

</template>

<style scoped>

</style>
