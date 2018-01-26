<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8" >
        <title>FEPESPA</title>
        <link type="text/css" rel="stylesheet" href="View/css/bootstrap.css"/>

        <script src="View/js/bootstrap.js"> </script>
        <script src="View/js/jquery.js"> </script>
        
    </head>
    <body>
        <?php
        include('./Model/usuarioModel.php');
        $usuariosModel = new usuarioModel();
        $usuarios = $usuariosModel->getAllUsersPag();
        echo '<h1>Users CRUD - Usuarios Confirmados</h1>';
        if (sizeof($usuarios) >= 1) {
            echo "<table>";
            foreach ($usuarios as &$u) {
                echo '<tr>';
                echo '<td>';
                echo $u['display_name'];
                echo '</td>';
                echo '<td>';
                echo $u['user_login'];
                echo '</td>';
                echo '<td>';
                echo $u['data_filiacao'];
                echo '</td>';
                echo '<td>';
                echo $u['user_email'];
                echo '</td>';
                echo '<td>';
                echo $u['carteirinha'];
                echo '</td>';
                echo '<td>';
                echo '<a type="button" href="/carterinha/'.$u['ID'].'/0"> Gerar Carteirinha</a>';
                echo '<a type="button" href="/pagamento/'.$u['ID'].'/0"> Pagamentos</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<b>Sem Usuarios</b>';
            echo '</br>';
        }

        $usuarios = $usuariosModel->getAllUsersNOTPag();
        echo '<h1>Users CRUD - Usuarios Pendentes</h1>';
        echo "<table style='border:1px'>";
        foreach ($usuarios as &$u) {
            echo '<tr>';
            echo '<td>';
            echo $u['display_name'];
            echo '</td>';
            echo '<td>';
            echo $u['user_login'];
            echo '</td>';
            echo '<td>';
            echo $u['data_filiacao'];
            echo '</td>';
            echo '<td>';
            echo $u['user_email'];
            echo '</td>';
            echo '<td>';
            echo $u['carteirinha'];
            echo '</td>';
            echo '<td>';
           echo '<a type="button" href="/carterinha/'.$u['ID'].'/1"> Confirmar Pagamento</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>'
        ?>
    </body>
</html>
