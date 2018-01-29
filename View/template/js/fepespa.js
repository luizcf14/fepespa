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
                    console.log(data);
//                    response = JSON.parse(data);
                    html = "";
                    if (data) {
                        html = "
                        <table class = 'table table-striped table-hover'>
                                <thead>
                                        <tr>
                                                <th>Data Pagamento</th>
                                                <th>Valor Pago</th>
                                                <th>Opções</th>
                                        </tr>
                                </thead>
                                <tbody>";

                            nomeUsuario = data[1];
                            html = data;
                            result = data[0];
                            for (var i = 0; i < result.length; i++) {
                                
                            }


                            $("#tabela_pagamentos_usuario").html(html);
                            abrir_modal("modal_pagamentos");

                    } else {
                            html = " ";
                            alert("Nao há pagamentos para este usuário");                        
                    }
                }, "json");

    } else {
        alert('Escolha um registro !'); return;
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

function abrir_modal(idModal) {
	var obj;
	if (typeof idModal === 'string') {
		obj = $("#" + idModal);
	} else if (idModal && idModal.jquery) {
		obj = idModal;
	} else
		return;
        
	obj.modal({
		"backdrop": "static",
		"keyboard": true,
		"show": true
	});
}