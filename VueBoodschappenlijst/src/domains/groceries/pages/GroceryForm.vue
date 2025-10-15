<script setup>
    const {grocery} = defineProps({grocery:Object});
    const localGrocery = grocery;

    const emit = defineEmits(['submit']);

    const submit = () => {
    emit('submit', {name:localGrocery.name, price:localGrocery.price, quantity:localGrocery.quantity});
    };

</script>

<template>
    <form>
        <label for="name">Name: </label>
        <input type="text" id="name" name="name" v-model="localGrocery.name"><br>
        <label for="price">Price: </label>
        <input type="number" id="price" name="price" v-model="localGrocery.price"><br>
        <label for="amount">Amount: </label>
        <input type="number" id="amount" name="amount" v-model="localGrocery.quantity"><br>
        <button @click.prevent="submit">Submit</button>
    </form>
</template>

<style scoped>

</style>
