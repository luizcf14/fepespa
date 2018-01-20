<?php
include 'Router.php';
$request = $_SERVER['REQUEST_URI'];
$router = new Router($request);

$router->get('/', 'View/crudUsuario');
$router->get('/carterinha', 'Controller/usuarioController');