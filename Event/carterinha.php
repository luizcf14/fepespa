<?php
include_once 'Model/usuarioModel.php';
$userID = $args[0];
$status = $args[1];

$usuarioModel = new crudUsuario();
$resultado = $usuarioModel->setPagamento($userID , $status);
var_dump($resultado);
// TODO implementar tela que responde a requisição quanto a execução;.