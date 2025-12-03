<script setup>
defineProps({
    products: Array,
});
</script>

<template>
    <table>
        <thead>
            <th>Name</th>
            <th>Amount in inventory</th>
            <th>Should be in inventory</th>
            <th></th>
        </thead>
        <tbody>
            <tr v-for="(product, index) in products" :key="index">
                <td>{{ product.name }}</td>
                <td class="number"><input type="number" v-model="product.actualAmount" /></td>
                <td class="number">{{ product.minimumAmount }}</td>
                <td>
                    <router-link :to="'/edit/' + product.id"><button type="button">Edit</button></router-link>
                </td>
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

td,
th {
    border: 1px solid #888;
    padding: 10px;
}

.number {
    text-align: right;
}
</style>
