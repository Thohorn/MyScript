<?php

use Core\Database;

$config = require(base_path('config.php'));
$db = new Database($config['database']);

$products = $db->query("select * from groceries")->fetchAll();

function calculateTotalPrice($carry, $product)
{
    $carry += $product['price'] * $product['quantity'];
    return $carry;
}

$totalPrice = array_reduce($products, "calculateTotalPrice");

view("index.view.php", [
    "products" => $products,
    "totalPrice" => $totalPrice
]);
