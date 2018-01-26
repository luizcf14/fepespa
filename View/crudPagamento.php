<?php
include_once 'Model/pagamentoModel.php';
$userID = $args[0];
$pagObj = new pagamentoModel($userID);
$user_pagObjInstance = ($pagObj->getUsuario()[0]);
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagamentos - <?= $user_pagObjInstance['display_name'] ?></title>
    </head>
    <body>
        <?php
        echo('<h1>Pagamento Usuario ' . $user_pagObjInstance['display_name'] . '</h1>');


        $pagamentosUsuario = $pagObj->getPagamentobyUser($userID);
        echo '<hr></hr>';
        echo '<h2>Adicionar Pagamento</h2>';
        echo '<form action="/inserirPagamento/'.$userID.'" method="POST">'
        . '<p> Data do Pagamento: <input type="text" name="dataPag"/></p>'
        . '<p> Valor: <input type="text" name="valorPag"/></p>'
        . '<p><input type="submit" value="Adicionar" /> </p>'
        . '</form>';
        echo '<hr></hr>';
        echo '<table>';
        echo '<tr>';
        echo '<td>';
        echo '<b>Data Pagamento</b>';
        echo '</td>';
        echo '<td>';
        echo '<b>Valor Pago</b>';
        echo '</td>';
        echo '<td>';
        echo '<b>Opções</b>';
        echo '</td>';
        echo '</tr>';
        foreach ($pagamentosUsuario as $p) {
            echo '<tr>';
            echo '<td>';
            echo $p['data'];
            echo '</td>';
            echo '<td>';
            echo $p['valor'];
            echo '</td>';
            echo '<td>';
            echo '<a type="button" href="/pagamentoCancelar/' . $p['id'] . '/' . $user_pagObjInstance['ID'] . '"> Cancelar Pagamento</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        ?>

    </body>
</html>
