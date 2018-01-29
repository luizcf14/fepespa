<?php
    include_once 'Model/pagamentoModel.php';
    $userID = $args[0];
    $pagObj = new pagamentoModel($userID);
    $user_pagObjInstance = ($pagObj->getUsuario()[0]);

//    echo('<h1>Pagamento Usuario ' . $user_pagObjInstance['display_name'] . '</h1>');
    $pagamentosUsuario = $pagObj->getPagamentobyUser($userID);

    if(!empty($pagamentosUsuario)) {
        $html = "
        <table class = 'table table-striped table-hover'>
                <thead>
                        <tr>
                                <th>Data Pagamento</th>
                                <th>Valor Pago</th>
                                <th>Opções</th>
                        </tr>
                </thead>
                <tbody>";

        foreach ($pagamentosUsuario as $p) {

            $data_pagamento = $p['data'];
            $valor_pago = $p['valor'];
            $idPag = $p['id'];
            $idUsuario = $user_pagObjInstance['ID'];
            $html .= "
                    <tr>
                        <td>$data_pagamento</td>
                        <td>$valor_pago</td>
                        <td>
                        <a class='btn btn-mini btn-danger mrg-center' onclick='cancelarPagamentoUsuario ($idPag, $idUsuario);'>
                            <span class='glyphicon glyphicon-trash'> Deletar</span>
                        </a>
                    </tr>
                ";
        }

        $html .= " </tbody>
                </table>
                ";
//                    echo $html;

        if(is_array($html)){
            die(json_encode(arrayUtf8Enconde($html)));
        }else{
            die(json_encode($html));
        }
    } else {
        die(json_encode(0));
    }
