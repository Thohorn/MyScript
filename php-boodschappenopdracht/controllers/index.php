<?php

$products_old = [
    "rice" => ["name" => "Rijst", "price" => 1.00, "quantity" => 1],
    "broccoli" => ["name" => "Broccoli", "price" => 0.99, "quantity" => 2],
    "cake" => ["name" => "Koekjes", "price" => 1.20, "quantity" => 4],
    "nuts" => ["name" => "Noten", "price" => 2.99, "quantity" => 0]
];

$products = $db->query("select * from groceries")->fetchAll();

function calculateTotalPrice($carry, $product)
{
    $carry += $product['price'] * $product['quantity'];
    return $carry;
}

$totalPrice = array_reduce($products, "calculateTotalPrice");

require "views/index.view.php";
