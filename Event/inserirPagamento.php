<?php
include_once 'Model/pagamentoModel.php';
$usrID= $args[0];
$pagObj = new pagamentoModel($usrID);
$pagObj->inserirPagamento($usrID,$_POST['dataPag'],$_POST['valorPag']);
header("location:/pagamento/$usrID");

