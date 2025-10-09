<script setup>
import { computed } from 'vue';

const products = [{name:'Rijst', price:1.00, quantity:1, total:1.00}, 
                  {name:'Broccoli', price:0.99, quantity:2, total:1.98},
                  {name:'Koekjes', price:1.20, quantity:4, total:4.80},
                  {name:'Noten', price:2.99, quantity:0, total:0.00}];

const listTotal = computed(() => {
    let myListTotal = 0;
    for (let product in products){
        myListTotal += products[product].total;
    }

    return myListTotal.toFixed(2);
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
            </tr>
        </thead>
        <tbody>
            <tr v-for="product in products">
                <td>{{ product.name }}</td>
                <td class="number">{{ product.price }}</td>
                <td class="number"><input type="number" value="0" v-model="product.quantity"/></td>
                <td class="number">{{ product.total }}</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Totaal</strong></td>
                <td class="number">{{ listTotal }}</td>
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
