<?php
include_once 'Model/pagamentoModel.php';
$pagID= $args[0];
$usrID= $args[1];

$pagObj = new pagamentoModel($usrID);
$pagObj->cancelarPagamento($pagID);
header("location:/pagamento/$usrID");