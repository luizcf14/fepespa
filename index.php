<?php
//ob_start();
//session_start();
//$module = isset($_GET['module']) ? $_GET['module'] : '';
//        require('fpdf/carteirinha.php');
//die();

//include 'View/template/header.php';
include 'Router.php';
Require_once 'Controller/utils.php';
$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);

$router->getView('/', 'View/crudUsuario');
$router->get('carteirinha', './Event/carteirinha');
$router->get('pagamentoCancelar', 'Event/pagamentoCancelar');
$router->get('inserirPagamento', 'Event/inserirPagamento');
$router->get('pagamento', 'View/crudPagamento');