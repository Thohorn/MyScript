const groceryTable = document.getElementById('grocery-table');
const prices = document.getElementsByClassName('productPrice');
const quantities = document.getElementsByClassName('productQuantity');
const productTotal = document.getElementsByClassName('productTotalCost');
const totalPrice = document.getElementById('totalCost')

function updateTable() {
    console.log('table updated');
    let newTotalPrice = 0;
    for (let i = 0; i < productTotal.length; i++){
        console.log(quantities[i].value);
        productTotal[i].innerHTML = (prices[i].innerHTML * quantities[i].value).toFixed(2);
        newTotalPrice += prices[i].innerHTML * quantities[i].value;
    }
    totalPrice.innerHTML = newTotalPrice.toFixed(2);
}

groceryTable,addEventListener('change', updateTable);