<script setup>
    import { removeGrocery } from '../domains/groceries/store.js';
    defineProps({
    products: Array,
    });
</script>

<template>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Prijs</th>
                <th>Hoeveelhied</th>
                <th>subtotaal</th>
                <th>Aanpassen</th>
                <th>Verwijderen</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(product, index) in products" :key="index">
                <td>{{ product.name }}</td>
                <td class="number">{{ product.price }}</td>
                <td class="number"><input type="number" v-model="product.quantity" /></td>
                <td class="number">{{ (product.price * product.quantity).toFixed(2) }}</td>
                <td><router-link :to="'/edit/' + product.id">Aanpassen</router-link></td>
                <td><button @click="removeGrocery(product)">Verwijderen</button></td>
            </tr>
            <tr>
                <td colspan="3"><strong>Totaal</strong></td>
                <td class="number">{{ products.reduce((acc, product) => acc + (product.price * product.quantity), 0).toFixed(2) }}</td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>
    table {
        border-collapse: collapse;
    }

    th {
        text-align: left;
    }

    td {
        text-align: left;
    }

    td, th {
        border: 1px solid #888;
        padding: 10px;
    }

    .number {
        text-align: right;
    }
</style>
