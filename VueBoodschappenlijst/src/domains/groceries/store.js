import { ref, computed } from 'vue';

// State
const groceries = ref([{name:'Rijst', price:1.00, quantity:1}, 
                  {name:'Broccoli', price:0.99, quantity:2},
                  {name:'Koekjes', price:1.20, quantity:4},
                  {name:'Noten', price:2.99, quantity:0}]);

// Getters
export const getAllGroceries = computed(() => groceries.value);
export const getGroceryById = (id) => computed(() => groceries.value.find(grocery => grocery.id == id));

// Actions
export const addGrocery = (grocery) => {
    return groceries.value.push(grocery);
}