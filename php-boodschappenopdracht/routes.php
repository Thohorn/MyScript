<?php

$router->get('/', 'controllers/index.php');

$router->get('/create', 'controllers/create.php');
$router->POST('/create', 'controllers/store.php');
