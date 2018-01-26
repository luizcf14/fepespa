$(document).ready(function() {

//	$('tr:even[name=table-color]').css('background', '#D3D6FF');
//	$('tr:odd[name=table-color]').css('background', '#FFF');
//
//	valor = 0;
//
//	$('body').keydown(function(event) {
//		if (event.which == 113) {
//			alert('Apertou F2');
//		}
//		if (event.which == 114) {
//			alert('Apertou F3');
//		}
//	});
//
});

function pagamentosUsuario() {

    if ($('input:radio[id=usuarioId]').is(':checked')) {
	id_usuario_selecionado = $('input:radio[id=usuarioId]:checked').val();

	$.post(
		'/pagamento/'+ id_usuario_selecionado,
		{},
                function(data) {
		html = "";
		if (data) {
			html = data;
			$("#tabela_pagamentos_usuario").html(html);
		} else {
			html = " ";
			alert("Nao há pagamentos para este usuário");                        
		}
	}, "json");

    } else {
        alert('Escolha um registro !');
    }

}

function cancelarPagamentoUsuario (idPag, idUsuario) {

	var id_usuario = idUsuario;
	var id_pag = idPag;
	if(idPag != undefined || idUsuario != undefined) {
		$.post(
			'/pagamentoCancelar/'+ id_pag + '/' + id_usuario,
			{},
			function(data) {
			html = "";
			if (data) {
				alert("Registro foi Deletado com sucesso.");
				$.post(
					'/pagamento/'+ id_usuario,
					{},
					function(res) {
					html = "";
					if (res) {
						html = res;
						$("#tabela_pagamentos_usuario").html(html);
					} else {
						html = " ";
						$("#tabela_pagamentos_usuario").html(html);                        
					}
				}, "json");
			} else {
				html = " ";
				alert("Nao há pagamentos para este usuário");                        
			}
		}, "json");
	} else {
		console.log('Id Usuario ou Id pagamento Vazio.')
	}
}