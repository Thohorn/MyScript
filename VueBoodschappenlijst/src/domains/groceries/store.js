import { ref, computed } from 'vue';

// State
const groceries = ref([{id: 1, name:'Rijst', price:1.00, quantity:1}, 
                  {id: 2, name:'Broccoli', price:0.99, quantity:2},
                  {id: 3, name:'Koekjes', price:1.20, quantity:4},
                  {id: 4, name:'Noten', price:2.99, quantity:0}]);

// Getters
export const getAllGroceries = computed(() => groceries.value);
export const getGroceryById = (id) => computed(() => groceries.value.find(grocery => grocery.id == id));

// Actions
export const addGrocery = (grocery) => {
    if (grocery.id == 0){
        grocery.id = groceries.value.length + 1;
    }
    return groceries.value.push(grocery);
}

export const updateGrocery = (updateGrocery) => {
    let toUpdateIndex = groceries.value.findIndex(grocery=> grocery.id == updateGrocery.id);
    groceries.value[toUpdateIndex] = updateGrocery;
}

export const removeGrocery = (deleteGrocery) => {
    let index = groceries.value.findIndex(grocery=> grocery.id == deleteGrocery.id);
    groceries.value.splice(index, 1);
}