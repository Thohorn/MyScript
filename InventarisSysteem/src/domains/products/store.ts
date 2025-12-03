import {ref, computed} from 'vue';

interface Product {
    id: number;
    name: string;
    actualAmount: number;
    minimumAmount: number;
}

// State
const inventory = ref([
    {id: 0, name: 'power-bank', actualAmount: 2, minimumAmount: 10},
    {id: 1, name: 'keyboard', actualAmount: 3, minimumAmount: 20},
    {id: 2, name: 'mouse', actualAmount: 15, minimumAmount: 10},
    {id: 3, name: 'monitor', actualAmount: 12, minimumAmount: 30},
    {id: 4, name: 'usb-hub', actualAmount: 14, minimumAmount: 15},
    {id: 5, name: 'blu-ray drive', actualAmount: 5, minimumAmount: 5},
    {id: 6, name: 'speakers', actualAmount: 10, minimumAmount: 15},
]);

// Getters
export const getAllInventory = computed(() => inventory.value);
export const getProductById = (id: number) => computed(() => inventory.value.find(product => product.id == id));

// Actions
export const addProduct = (product: Product) => inventory.value.push(product);

export const updateProduct = (updateProduct: Product) => {
    let toUpdateIndex = inventory.value.findIndex(product => product.id == updateProduct.id);
    inventory.value[toUpdateIndex] = updateProduct;
};

export const removeProduct = (deleteProductId: number) => {
    let index = inventory.value.findIndex(product => product.id == deleteProductId);
    inventory.value.splice(index, 1);
};
