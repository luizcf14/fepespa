<?php
	include('./Model/usuarioModel.php');
	$usuariosModel = new usuarioModel();
	$usuarios = $usuariosModel->getAllUsersPag();
	echo '<h1>Users CRUD - Usuarios Confirmados</h1>';
	$html = "";
	$html .= "<div class'container'>
			<div class='row-fluid'>
				<div class='span2'>bruno</div>
				<div class='span2'>fffff</div>
				<div class='span2'>
			
			";
	
	if (sizeof($usuarios) >= 1) {
			$html .= "
			<table class = 'table table-striped table-hover table-sm'>
				<thead>
					<tr>
						<th>#</th>
						<th>Nome</th>
						<th>Email</th>
						<th>Filiação</th>
						<th>Pagamentos</th>
						<th>Cat.</th>						
					</tr>
				</thead>
				<tbody>";
                        $i = 1;
		foreach ($usuarios as &$u) {

		$display_name = ucwords(strtolower($u['display_name']));
		$email = $u['user_email'];
		$data_filiacao = $u['data_filiacao'];
		$carteirinha = $u['carteirinha'];
		$id_usuario = $u['ID'];
                        $html .= "
                                    <tr>
                                        <th scope ='row'>
                                            <input type='radio' id='usuarioId' name='transf_opcao' class='default-checkbox' value='$id_usuario'>
                                    </th>
                                        <td>$display_name</td>
                                        <td>$email</td>
                                        <td>$data_filiacao</td>
                                        <td>$carteirinha</td>
                                        <td>$carteirinha</td>
                                    </tr>
                                ";
                        
                        $i++;
//			echo '<td>';
//			echo '<a type="button" href="/carterinha/'.$u['ID'].'/0"> Gerar Carteirinha</a>';
//			echo '<a type="button" href="/pagamento/'.$u['ID'].'/0"> Pagamentos</a>';
//			echo '</td>';
//			echo '</tr>';
		}

                $html .= " </tbody>
                        </table>

                <div class='span2'>
                        <div class='row-fluid'>
                            <input id='usuario_pagamentos' class='btn btn-mini btn-success span12' type='button' name='usuario_pagamentos' value='Pagamentos' onclick='pagamentosUsario();' />
                        </div>
                </div>

                ";
				
	$html .= "</div'></div'></div'></div'>";
	echo $html;
	unset($html);
	die();
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