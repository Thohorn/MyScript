<script setup>
import { ref, computed } from 'vue';

const products = ref([{name:'Rijst', price:1.00, quantity:1}, 
                  {name:'Broccoli', price:0.99, quantity:2},
                  {name:'Koekjes', price:1.20, quantity:4},
                  {name:'Noten', price:2.99, quantity:0}]);

const listTotal = computed(() => {
    return products.value.reduce((acc, obj) => acc + (obj.price * obj.quantity), 0).toFixed(2)
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
            <tr v-for="(product, index) in products" :key="index">
                <td>{{ product.name }}</td>
                <td class="number">{{ product.price }}</td>
                <td class="number"><input id="index" type="number" v-model="product.quantity" /></td>
                <td class="number">{{ (product.price * product.quantity).toFixed(2) }}</td>
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
