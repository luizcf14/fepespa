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
	atualizalistaPagamentoUsuario(id_usuario_selecionado);
	abrir_modal("modal_pagamentos");
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
                    if (data) {
                            alert("Registro foi Deletado com sucesso.");
                            atualizalistaPagamentoUsuario(id_usuario);
                    }
            }, "json");
    } else {
            console.log('Id Usuario ou Id pagamento Vazio.')
    }
}

function inserirPagamentoUsuario() {

    var id_usuario = $('input:radio[id=usuarioId]:checked').val();
    var valor_pag = $('#tabela_pagamentos_adicionar_valor').val();
    var data_pag = $('#tabela_pagamentos_adicionar_data').val();
	
//	data_p = data_pag.replace("/", "");
//	dat = data_p.replace("/", "");
;
    if(valor_pag != undefined || data_pag != undefined) {
        $.post(
                '/inserirPagamento/'+ id_usuario + '/' + valor_pag + '/' + data_pag,
                {},
                function(data) {
                    console.log(data);
                if (data) {
                            atualizalistaPagamentoUsuario(id_usuario);
                }
        }, "json");
    } else {
            console.log('Id Usuario ou Id pagamento Vazio.')
    }
}

function atualizalistaPagamentoUsuario(id_usuario) {
	$.post(
	'/pagamento/'+ id_usuario,
	{},
	function(data) {
		console.log(data);
		html = "";
		result = data[0];
		nomeUsuario = data[1];
		if (result) {
			html = "<table class = 'table table-striped table-hover'> " +
				"<thead>" +
					"<tr>" +
						"<th>Data Pagamento</th>" +
						"<th>Valor Pago</th>" +
						"<th>Opções</th>" +
					"</tr>" +
				"</thead>" +
				"<tbody>";

			for (var i = 0; i < result.length; i++) {
				data_pagamento = result[i]['data'];
				valor_pago = result[i]['valor'];
				idPag = result[i]['id'];
				idUsuario = id_usuario;
				html += "<tr>"+
						"<td>" + data_pagamento + "</td>" +
						"<td>" + valor_pago + "</td>" +
						"<td>" +
							"<a class='btn btn-mini btn-danger mrg-center' onclick='cancelarPagamentoUsuario("+ idPag + "," + idUsuario + ");'>" +
								"<span class='glyphicon glyphicon-trash'> Deletar</span>" +
							"</a>" +
						"</tr>";
			}

			html += "</tbody>" +
				 "</table>";
		} else {
			html = "Sem Registros.";
		}

		$("#tabela_pagamentos_nome_usuario").html(nomeUsuario);
		$("#tabela_pagamentos_usuario").html(html);

	}, "json");
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

function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
	    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	    s = '',
	    toFixedFix = function(n, prec) {
		var k = Math.pow(10, prec);
		return '' + Math.round(n * k) / k;
	    };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
	s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
	s[1] = s[1] || '';
	s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}