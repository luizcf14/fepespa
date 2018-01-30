<?php
    include_once 'Model/pagamentoModel.php';
    $userID = $args[0];
    $pagObj = new pagamentoModel($userID);
    $user_pagObjInstance = ($pagObj->getUsuario()[0]);

//    echo('<h1>Pagamento Usuario ' . $user_pagObjInstance['display_name'] . '</h1>');
    $pagamentosUsuario = $pagObj->getPagamentobyUser($userID);

    if(!empty($pagamentosUsuario)) {
        
//        $usuario_pagamento[0] = $pagamentosUsuario;
        $usuario_pagamento[1] = $user_pagObjInstance['display_name'];
        
        foreach ($pagamentosUsuario as $p) {

            $a['data'] = utils::converteData($p['data']);
            $a['valor'] = utils::formata_dinheiro($p['valor']);
            $a['id'] = $p['id'];
            
            $usuario_pagamento[0][] = $a;
        }

        utils::saidaJson($usuario_pagamento);

        } else {
        die(json_encode(0));
    }
