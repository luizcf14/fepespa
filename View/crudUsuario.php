<?php
include('./Model/usuarioModel.php');
$usuariosModel = new usuarioModel();
$usuarios = $usuariosModel->getAllUsers();
$hoje = date("Y-m-d");

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
//
?>

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
						<th>RG</th>
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

		$data_nasc = "";
		if (array_key_exists("birth_date", $u)) {
			$data_nasc = utils::inverteData($u['birth_date']);
		} else {
			$data_nasc = "";
		}

		$rg = "";
		if (array_key_exists("rg_numero", $u)) {
			$rg = $u['rg_numero'];
		} else {
			$rg = "";
		}

		$paintTeam = "";
		if (array_key_exists("paintTeam", $u)) {
			$paintTeam = strtoupper($u['paintTeam']);
		} else {
			$paintTeam = "";
		}

		$codigo_filiacao = "";
		if (array_key_exists("codigo_filiacao", $u)) {
			$codigo_filiacao = $u['codigo_filiacao'];
			if (preg_match('/^F/', $codigo_filiacao)) {
				$codigo_filiacao = $u['codigo_filiacao'];
			} else {
				$codigo_filiacao = intval($u['codigo_filiacao']);
			}
		} else {
			$codigo_filiacao = "";
		}

		$data_filiacao = "";
		if (array_key_exists("data_filiacao", $u)) {
			$data_filiacao = utils::traduzData(utils::inverteData($u['data_filiacao']));
		} else {
			$data_filiacao = "";
		}

		$carteirinha = "";
		if ($u['carteirinha'] == 0) {
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
						<td><?php echo $rg; ?></td>
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
					<input id='usuario_pagamentos' class='btn btn-mini btn-success span12' type='button' name='usuario_pagamentos' value='Pagamentos' onclick='pagamentosUsuario("<?php echo $hoje;?>");' />
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
					<a href="#tabela_pagamentos_adicionar" class="" data-toggle="collapse">Novo Pagamento</a>
					<div id='tabela_pagamentos_adicionar' class="collapse in" >
						<div class="container col-lg-12">
							<div class="row">
								<div class="col-lg-3">
									Valor: 
									<select class="form-control" id='tabela_pagamentos_adicionar_valor' name="valorPag"/>
										<option value='120' > R$ 120,00 </option>
										<option value='130'> R$ 130,00 </option>
									</select>
								</div>
								<div class="col-lg-3">
									Tipo Pagamento: 
									<select class="form-control" id='tabela_pagamentos_adicionar_tipo_pagamento' name="tipoPag"/>
										<option value='deposito' > Deposito </option>
										<option value='pagseguro'> Pagseguro </option>
									</select>
								</div>
								<div class="col-lg-3">
									Data do Pagamento: <input type="date" id='tabela_pagamentos_adicionar_data' name="dataPag"/>
								</div>
								<div class="col-lg-3">
									Mes de Referencia: <input type="date" id='tabela_pagamentos_adicionar_mes_ano_ref' name="dataReferencia"/>
								</div>
							</div>
							<div class="row"> &nbsp;
							</div>
							
							<div class="row">
							</div>
							<div class="row">
								<button type='button' class='btn btn-primary' onclick="inserirPagamentoUsuario();">Adicionar</button>
							</div>
							<hr>
						</div>
					</div>
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
