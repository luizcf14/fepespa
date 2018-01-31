<?php
include_once 'Model/pagamentoModel.php';
$usrID = $args[0];
$valorPag = $args[1];
$dataP = $args[2] . "/" . $args[3] . "/" . $args[4];
$dataPag = utils::converteData($dataP);
//var_dump($args);
//var_dump($dataPag);
//die();
$pagObj = new pagamentoModel($usrID);
$bool = $pagObj->inserirPagamento($usrID,$dataPag,$valorPag);

die(json_encode($bool));