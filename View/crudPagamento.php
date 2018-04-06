<?php
include_once 'Model/pagamentoModel.php';
$userID = $args[0];
$pagObj = new pagamentoModel($userID);
$user_pagObjInstance = ($pagObj->getUsuario()[0]);
$data_filiacao = $pagObj->getDataFiliacao();  // YYYY/MM/DD
$data_filiacao_traduzida = utils::traduzData(utils::inverteData($data_filiacao));  // YYYY/MM/DD

$mes_ano_ref = $pagObj->getUltimaDataValidade();

/*
 * Se Existe registro em historico_pagamento, o proximo mes_ano_referencia
 * deve ser um ano depois do existente, porem, se esta vazio a referencia eh a 
 * propria data de filiacao.
 */

if($mes_ano_ref) {
	$ref = utils::somarData($mes_ano_ref, 1, 'ano');
} else {
	$ref = $data_filiacao;
}

$pagamentosUsuario = $pagObj->getPagamentobyUser($userID);
$usuario_pagamento[1] = $user_pagObjInstance['display_name'];
$usuario_pagamento[2] = $data_filiacao_traduzida;
$usuario_pagamento[3] = utils::converteData(utils::inverteData($ref)); // mes_ano_referencia

if(!empty($pagamentosUsuario)) {
	
	foreach ($pagamentosUsuario as $p) {

		$a['data_pagamento'] = utils::converteData($p['data_pagamento']);
		$a['data_ref'] = utils::converteData($p['mes_ano_referencia']);
		$a['valor'] = utils::formata_dinheiro($p['valor']);
		$a['id'] = $p['id'];
		$a['tipo_pagamento'] = $p['tipo_pagamento'];

		$usuario_pagamento[0][] = $a;
	}
} else {
	$usuario_pagamento[0] = "";
}
	utils::saidaJson($usuario_pagamento);
