<?php 

// return [
//     "/" => "controllers/index.php",
//     "/create" => "controllers/create.php",
// ];

$router->get('/', 'controllers/index.php');
$router->get('/create', 'controllers/create.php');