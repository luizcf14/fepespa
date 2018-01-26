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

function pagamentosUsario() {

    if ($('input:radio[id=usuarioId]').is(':checked')) {
        id_usuario_selecionado = $('input:radio[id=usuarioId]:checked').val();
    
	$.post(
		'/pagamento/'+ id_usuario_selecionado + '/0',
		{},
                function(data) {
		html = "";
		if (data) {
                    if (data == 0)
                        alert("Nao há pagamentos para este usuário");                        
                    console.log(data);
			for (var i = 0; i < data.length; i++) {
				html += "<tr name='table-color'  class='dayhead '>";
				html += "<th align='center'>" + data[i]['status'] + "  </th>";
				html += "<th align='center'>" + data[i]['data'] + "</th>";
				html += "<th align='center'> " + data[i]['nome'] + " </th>";
				html += "<th align='center'>" + data[i]['dose'] + "  </th>";
				html += "<th align='center'></th>";
				html += "</tr>";
			}
		} else {
			html = " ";
		}

		$("#tbody-listaimunoterapia-cliente").html(html);
	}, "json"
		);

    } else {
        alert('Escolha um registro !');
    }

}
