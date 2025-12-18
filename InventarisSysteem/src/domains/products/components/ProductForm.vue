<script setup lang="ts">
import { ref } from 'vue';
import {useRouter, useRoute} from 'vue-router';
import type { Product } from '../store';
const {product} = defineProps<{product: Product}>();

const localProduct = ref({...product});

const emit = defineEmits(['submit']);
const router = useRouter();
const route = useRoute();

const submit = () => {
    emit('submit', localProduct.value);
    router.push({path: '/overview'});
};
</script>

<template>
    <form>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" v-model="localProduct.name" />
        <br />
        <label for="actualAmount">actualAmount:</label>
        <input type="number" id="actualAmount" name="actualAmount" v-model="localProduct.actualAmount" />
        <br />
        <label for="amount">minimumAmount:</label>
        <input type="number" id="minimumamount" name="minimumamount" v-model="localProduct.minimumAmount" />
        <br />
        <router-link :to="'/overview'"><button type="button">Cancel</button></router-link>
        <button v-if="route.params.id === undefined" @click.prevent="submit">Add</button>
        <button v-else @click.prevent="submit">Edit</button>
    </form>
</template>

<style scoped>
button {
    margin: 5px;
}
</style>
