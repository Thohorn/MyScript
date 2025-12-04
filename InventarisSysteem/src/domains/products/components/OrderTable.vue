<script setup>
defineProps({
    products: Array,
});
</script>

<template>
    <table>
        <thead>
            <tr>
                <th>What to Order</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(product, index) in products" :key="index">
                <td>{{ product.name }}</td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>
table {
    margin: auto;
    border-collapse: collapse;
}

th {
    text-align: left;
}

td {
    text-align: left;
}

td,
th {
    border: 1px solid #888;
    padding: 10px;
}

.number {
    text-align: right;
}
</style>
