<?php
include_once 'Model/pagamentoModel.php';
$usrID = $args[0];
$dataPag = $args[1];
$valorPag = utils::converteData($args[2]);

var_dump($args);die();
//$pagObj = new pagamentoModel($usrID);
//$bool = $pagObj->inserirPagamento($usrID,$dataPag,$valorPag);
//
//die(json_encode($bool));