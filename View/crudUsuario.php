<?php
	include('./Model/usuarioModel.php');
	$usuariosModel = new usuarioModel();
	$usuarios = $usuariosModel->getAllUsersPag();
	echo '<h1>Users CRUD - Usuarios Confirmados</h1>';
	$html = "";
	$html .= "<div class'container'>
			<div class='row-fluid'>
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
//			echo '<td>
//			echo '<a type="button" href="/carterinha/'.$u['ID'].'/0"> Gerar Carteirinha</a>';
//			echo '<a type="button" href="/pagamento/'.$u['ID'].'/0"> Pagamentos</a>';
//			echo '</td>';
//			echo '</tr>';
		}

                $html .= " </tbody>
                        </table>

                <div class='span2'>
                        <div class='row-fluid'>
                            <input id='usuario_pagamentos' class='btn btn-mini btn-success span12' type='button' name='usuario_pagamentos' value='Pagamentos' onclick='pagamentosUsuario();' />
                        </div>
                </div>

<!-- Button trigger modal -->
<button id='usuario_pagamentos'  type='button' class='btn btn-primary' data-toggle='modal' data-target='#modal_pagamentos' onclick='pagamentosUsuario();' > Launch demo modal</button>

";
				
	$html .= "	</div'>
		</div'>
		";
	
	?>

	<!-- Modal -->
	<div class='modal fade' id='modal_pagamentos' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
		<div class='modal-dialog modal-lg' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title' id='tabela_pagamentos_nome_usuario'>Bruno Haick</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<div class='modal-body'>
					<div id='tabela_pagamentos_adicionar' >
						Data do Pagamento: <input type="text" id='' name="dataPag"/>
						Valor: <input type="text" id='' name="valorPag"/>
						<button type='button' class='btn btn-primary'>Adicionar</button>
						<!--<input type="submit" value="Adicionar" />-->
					</div>
					<hr>
					<div id='tabela_pagamentos_usuario' > </div>
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
					<button type='button' class='btn btn-primary'>Save changes</button>
				</div>
			</div>
		</div>
	</div>


<?php
	
	echo $html;
	unset($html);
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