<?php


use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$products = $db->query("select * from groceries")->fetchAll();

function calculateTotalPrice($carry, $product)
{
    $carry += $product['price'] * $product['quantity'];
    return $carry;
}

$totalPrice = array_reduce($products, "calculateTotalPrice");

view("index.view.php", [
    "title" => 'Overzicht',
    "products" => $products,
    "totalPrice" => $totalPrice
]);
