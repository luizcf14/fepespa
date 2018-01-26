<?php
include 'View/template/header.php';
include 'Router.php';
$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);

$router->get('/', 'View/crudUsuario');
$router->get('carteirinha', 'Event/carterinha');
$router->get('pagamentoCancelar', 'Event/pagamentoCancelar');
$router->get('inserirPagamento', 'Event/inserirPagamento');
$router->get('pagamento', 'View/crudPagamento');