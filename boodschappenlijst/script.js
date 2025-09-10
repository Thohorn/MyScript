const groceryTable = document.getElementById('grocery-table');
const prices = document.getElementsByClassName('productPrice');
const quantities = document.getElementsByClassName('productQuantity');
const productTotal = document.getElementsByClassName('productTotalCost');
const totalPrice = document.getElementById('totalCost')

function updateTable() {
    console.log('table updated');
    let newTotalPrice = 0;
    for (let i = 0; i < productTotal.length; i++) {
        console.log(quantities[i].value);
        let newProductTotal = prices[i].innerHTML * quantities[i].value;
        productTotal[i].innerHTML = newProductTotal.toFixed(2);
        newTotalPrice += newProductTotal;
    }
    totalPrice.innerHTML = newTotalPrice.toFixed(2);
}

groceryTable, addEventListener('change', updateTable);