<?php
include_once 'Model/usuarioModel.php';
$module = $args[0];
$status = $args[1];

//$usuarioModel = new usuarioModel();
//$resultado = $usuarioModel->setPagamento($userID , $status);
//var_dump($resultado);
//switch ($module) {

//    case 'carteirinha':
        require('fpdf/carteirinha.php');
//        break;
//}



//header("location:");
// TODO implementar tela que responde a requisição quanto a execução;.