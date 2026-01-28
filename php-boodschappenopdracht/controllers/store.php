<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$errors = [];

if(!Validator::string($_POST['name'])){
    $errors['name'] = 'Een naam is verplicht';
}

if(!Validator::integer($_POST['price'])){
    $errors['price'] = "Een prijs van meer dan 0 is verplicht";
}

if(!Validator::decimal($_POST['quantity'])){
    $errors['quantity'] = "Een hoeveelheid van 0 of meer is verplicht";
}

if (! empty($errors)){
    return view("create.view.php", [
    'errors' => $errors
]);

}

$db->query('INSERT INTO groceries(name, price, quantity) VALUES(:name, :price, :quantity)', [
    'name' => $_POST['name'],
    'price' => $_POST['price'],
    'quantity' => $_POST['quantity']]
);

header('location: /');
die();

