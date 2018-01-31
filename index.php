<?php
//include 'View/template/header.php';
include 'Router.php';
Require_once 'Controller/utils.php';
$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);

$router->getView('/', 'View/crudUsuario');
$router->get('carteirinha', 'Event/carterinha');
$router->get('pagamentoCancelar', 'Event/pagamentoCancelar');
$router->get('inserirPagamento', 'Event/inserirPagamento');
$router->get('pagamento', 'View/crudPagamento');