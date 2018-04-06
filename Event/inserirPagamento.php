<?php
include_once 'Model/pagamentoModel.php';
$userID = $args[0];
$valorPag = $args[1];
$tipoPag = $args[2];
$dataPag = $args[3]; // YYYY-MM-DD
$dataRef = $args[4]; // YYYY-MM-DD

$pagObj = new pagamentoModel($userID);

$bool = $pagObj->inserirPagamento($userID, $dataPag, $valorPag, $tipoPag, $dataRef);

die(json_encode($bool));