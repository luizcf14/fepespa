<?php
include('./Model/usuarioModel.php');
$usuariosModel = new usuarioModel();
$usuarios = $usuariosModel->getAllUsers();

//		foreach ($usuarios as $u) {
//
//			$id_usuario = $u['ID'];
//                        $metadata = $usuariosModel->getAllUSerMetaData($id_usuario);
//                        foreach ($metadata as $a) {
//                                $key = $a['meta_key'] . " ";
//                                $u["$key"] = $a['meta_value'];
//                        }
//$x[] = $u;
//                        if (array_key_exists("role", $u)) {
//                            $tipo_usuario = $u['role'];
//                        }
//                        if (array_key_exists("birth_date", $u)) {
//                            $data_nasc = $u['birth_date'];
//                        }
//                        if (array_key_exists("paintTeam", $u)) {
//                            $paintTeam = $u['paintTeam'];
//                        }
//                        if (array_key_exists("codigo_filiacao", $u)) {
//                            $codigo_filiacao = $u['codigo_filiacao'];
//                        }
//                        if (array_key_exists("data_filiacao", $u)) {
//                            $data_filiacao = utils::converteData($u['data_filiacao']);
//                        }
//                }
//                print_r($x);
//                die();
?>

<h1>Users CRUD - Usuarios Confirmados</h1>
<div class="container">
	<div class='row-fluid'>
		<div class='span2'>

<?php
	if (sizeof($usuarios) >= 1) {
?>
			<table id='lista_todos_usuarios' class = 'display table table-striped table-hover table-sm'>
				<thead>
					<tr>
						<th>#</th>
						<th>Nome</th>
						<th>Email</th>
						<th>Filiação</th>
						<th>Data Filiação</th>
						<th>Data Nasc.</th>
						<th>Equipe</th>
						<th>Cart.</th>
					</tr>
				</thead>
				<tbody>
<?php
                        $i = 1;
	foreach ($usuarios as $u) {

		$id_usuario = $u['ID'];
		$metadata = $usuariosModel->getAllUSerMetaData($id_usuario);
		foreach ($metadata as $a) {
			$key = $a['meta_key'];
			$u["$key"] = $a['meta_value'];
		}

		if (array_key_exists("role", $u)) {
			$tipo_usuario = $u['role'];
		} else {
			$tipo_usuario = "";
		}

		if (array_key_exists("birth_date", $u)) {
			$data_nasc = utils::inverteData($u['birth_date']);
		} else {
			$data_nasc = "";
		}

		if (array_key_exists("paintTeam", $u)) {
			$paintTeam = strtoupper($u['paintTeam']);
                        } else {
                            $paintTeam = "";
                        }

                        if (array_key_exists("codigo_filiacao", $u)) {
			$codigo_filiacao = intval($u['codigo_filiacao']);
                        } else {
			$codigo_filiacao = "";
                        }

                        if (array_key_exists("data_filiacao", $u)) {
                            $data_filiacao = utils::traduzData(utils::inverteData($u['data_filiacao']));
                        } else {
                            $data_filiacao = "";
                        }

                        if($u['carteirinha'] == 0) {
                            $carteirinha = "Atual";
                        } else {
                            $carteirinha = "Nao Atual";
                        }

		$display_name = ucwords(strtolower($u['display_name']));
		$email = $u['user_email'];
?>
					<tr onclick="marcaRadio(<?php echo $id_usuario; ?>);">
						<th scope ='row'>
							<input type='radio' id='usuarioId' name='transf_opcao' class='default-checkbox' value='<?php echo $id_usuario; ?>'><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i>
						</th>
						<td><?php echo $display_name; ?></td>
						<td><?php echo $email; ?></td>
						<td><?php echo $codigo_filiacao; ?></td>
						<td><?php echo $data_filiacao; ?></td>
						<td><?php echo $data_nasc; ?></td>
						<td><?php echo $paintTeam; ?></td>
						<td><?php echo $carteirinha; ?></td>
					</tr>
<?php                        
		$i++;
	}
?>
				</tbody>
			</table>

			<div class='span2'>
				<div class='row-fluid'>
					<input id='usuario_pagamentos' class='btn btn-mini btn-success span12' type='button' name='usuario_pagamentos' value='Pagamentos' onclick='pagamentosUsuario();' />
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class='modal fade' id='modal_pagamentos' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
		<div class='modal-dialog modal-lg' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
					<h4 class='modal-title' id='tabela_pagamentos_nome_usuario'></h4>
				</div>
				<div class='modal-body'>
					<div id='tabela_pagamentos_adicionar' >
						Data do Pagamento: <input type="date" id='tabela_pagamentos_adicionar_data' name="dataPag"/>
						Valor: <input type="text" id='tabela_pagamentos_adicionar_valor' name="valorPag"/>
						<button type='button' class='btn btn-primary' onclick="inserirPagamentoUsuario();">Adicionar</button>
						<!--<input type="submit" value="Adicionar" />-->
					</div>
					<hr>
					<div id='tabela_pagamentos_usuario' > </div>
				</div>
<!--				<div class='modal-footer'>
					<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
					<button type='button' class='btn btn-primary'>Save changes</button>
				</div>-->
			</div>
		</div>
	</div>

<?php
	} else {
?>
	<b>Sem Registros</b> </br>';
<?php
	}
	
?>
</body>
</html>