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
$data_filiacao_usuario = ($pagObj->getDataFiliacao());
$ultima_data_validade = ($pagObj->getUltimaDataValidade());

$a = utils::inverteData($data_filiacao_usuario);
echo "a== " . $a;
var_dump($data_filiacao_usuario);
var_dump($nova_validade);
if($ultima_data_validade) {
	$nova_validade = utils::somarData(utils::inverteData($ultima_data_validade), 1, 'ano');
} else {
	$nova_validade = utils::somarData($a, 1, 'ano');
}


echo "nova == $nova_validade";

die();

$bool = $pagObj->inserirPagamento($usrID,$dataPag,$valorPag);




die(json_encode($bool));