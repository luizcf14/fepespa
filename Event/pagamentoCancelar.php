<?php
include_once 'Model/pagamentoModel.php';
$pagID= $args[0];
$usrID= $args[1];

$pagObj = new pagamentoModel($usrID);
$bool = $pagObj->cancelarPagamento($pagID);

die(json_encode($bool));
//header("location:/pagamento/$usrID");