<?php
include_once 'Model/pagamentoModel.php';
$userID = $args[0];
$pagObj = new pagamentoModel($userID);
$user_pagObjInstance = ($pagObj->getUsuario()[0]);

$pagamentosUsuario = $pagObj->getPagamentobyUser($userID);
$usuario_pagamento[1] = $user_pagObjInstance['display_name'];

if(!empty($pagamentosUsuario)) {
	
	foreach ($pagamentosUsuario as $p) {

		$a['data'] = utils::converteData($p['data']);
		$a['valor'] = utils::formata_dinheiro($p['valor']);
		$a['id'] = $p['id'];

		$usuario_pagamento[0][] = $a;
	}
} else {
	$usuario_pagamento[0] = "";
}
	utils::saidaJson($usuario_pagamento);
