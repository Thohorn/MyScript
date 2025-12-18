import {ref, computed} from 'vue';

export interface Product {
    id: number;
    name: string;
    actualAmount: number;
    minimumAmount: number;
}

// State
const inventory = ref<Product[]>([
    {id: 1, name: 'power-bank', actualAmount: 2, minimumAmount: 10},
    {id: 2, name: 'keyboard', actualAmount: 3, minimumAmount: 20},
    {id: 3, name: 'mouse', actualAmount: 15, minimumAmount: 10},
    {id: 4, name: 'monitor', actualAmount: 12, minimumAmount: 30},
    {id: 5, name: 'usb-hub', actualAmount: 14, minimumAmount: 15},
    {id: 6, name: 'blu-ray drive', actualAmount: 5, minimumAmount: 5},
    {id: 7, name: 'speakers', actualAmount: 10, minimumAmount: 15},
]);

// Getters
export const getAllInventory = computed(() => inventory.value);

export const getProductById = (id: number) => computed(() => inventory.value.find((product: Product) => product.id == id));

export const getToOrderInventory = computed(() => {
    const orderProducts: Product[] = [];
    inventory.value.forEach((product: Product) => {
        if (product.actualAmount < product.minimumAmount) {
            orderProducts.push(product);
        }        
    });
    return orderProducts
})

// Actions
export const addProduct = (product: Product) => {
    if (product.id == 0){
        product.id = inventory.value.length + 1;
    }
    return inventory.value.push(product);
}

export const updateProduct = (updateProduct: Product) => {
    const toUpdateIndex: number = inventory.value.findIndex((product: Product) => product.id == updateProduct.id);
    inventory.value[toUpdateIndex] = updateProduct;
};

export const removeProduct = (deleteProductId: number) => {
    const index: number = inventory.value.findIndex((product: Product) => product.id == deleteProductId);
    inventory.value.splice(index, 1);
};
