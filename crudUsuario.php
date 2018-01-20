<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include('./Model/usuarioModel.php');
        $usuariosModel = new crudUsuario();
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
                echo $u['user_registered'];
                echo '</td>';
                echo '<td>';
                echo $u['user_email'];
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
            echo $u['user_registered'];
            echo '</td>';
            echo '<td>';
            echo $u['user_email'];
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>'
        ?>
    </body>
</html>
