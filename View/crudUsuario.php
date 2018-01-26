<?php
	include('./Model/usuarioModel.php');
	$usuariosModel = new usuarioModel();
	$usuarios = $usuariosModel->getAllUsersPag();
	echo '<h1>Users CRUD - Usuarios Confirmados</h1>';
	if (sizeof($usuarios) >= 1) {
			$html = "
			<table class = \"table table-striped\">
				<thead>
					<tr>
						<th>#</th>
						<th>Nome</th>
						<th>Email</th>
						<th>Cart.</th>
						<th>Pagamentos</th>
						<th>Cat.</th>						
					</tr>
				</thead>
				<tbody>';
		foreach ($usuarios as &$u) {
			$html .= "
			<table class = \"table table-striped\">
				<thead>
					<tr>
						<th>#</th>
						<th>Nome</th>
						<th>Email</th>
						<th>Cart.</th>
						<th>Pagamentos</th>
						<th>Cat.</th>						
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope =\"row\">1</th>
						<td>Mark</td>
						<td>Otto</td>
						<td>@mdo</td>
						</tr>
					<tr>
						<th scope = \"row\">2</th>
						<td>Jacob</td>
						<td>Thornton</td>
						<td>@fat</td>
					</tr>
					<tr>
						<th scope = \"row\">3</th>
						<td>Larry</td>
						<td>the Bird</td>
						<td>@twitter</td>
					</tr>
				</tbody>
		</table>
	';

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