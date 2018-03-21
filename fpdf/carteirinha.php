<?php
//incluindo o arquivo do fpdf
require_once("fpdf.php");

//defininfo a fonte !
//define('FPDF_FONTPATH','font/');

//instancia a classe.. P=Retrato, mm =tipo de medida utilizada no casso milimetros, tipo de folha =A4
$pdf= new FPDF("L","mm","A4");

//define a fonte a ser usada
$pdf->SetFont('arial','',10);
$pdf->SetMargins(0,0,0);

function shortstr ($string, $limit = 13)
{
	$string = (strlen($string) > $limit)
		? substr($string, 0, $limit)
		: $string;
	return $string;
}

$usuario[0]['nome'] = "BRUNO GOMES HAICK";
$usuario[0]['rg'] = "4762957";
$usuario[0]['num_filiacao'] = "81";
$usuario[0]['data_filiacao'] = "Jun 2016";
$usuario[0]['tipo_sanguineo'] = "A+";
$usuario[0]['validade'] = "Jun 2018";

$usuario[1]['nome'] = "BRUNO GOMES HAICK";
$usuario[1]['rg'] = "4762957";
$usuario[1]['num_filiacao'] = "81";
$usuario[1]['data_filiacao'] = "Jun 2016";
$usuario[1]['tipo_sanguineo'] = "A+";
$usuario[1]['validade'] = "Jun 2018";


// posicao vertical no caso -1.. e o limite da margem
$pdf->SetY("-1");
$pdf->SetAutoPageBreak(1,1);

foreach ($usuario as $atleta) {
	
	$pdf->AddPage();

	$pdf->Image("./fpdf/carteirinha.jpg", 0,0);
	$pdf->SetFont('Arial','B',19);

	$pdf->Ln(30);
	$pdf->Cell(45,5,'',0,0,'L');
	$pdf->Cell(110,5,$atleta['nome'],0,0,'L');
	
	$pdf->Ln(17);
	$pdf->Cell(38,5,'',0,0,'L');
	$pdf->Cell(100,5,$atleta['rg'],0,0,'L');

	$pdf->Ln(17);
	$pdf->Cell(52,5,'',0,0,'L');
	$pdf->Cell(50,5,$atleta['num_filiacao'],0,0,'L');

	$pdf->Ln(17);
	$pdf->Cell(52,5,'',0,0,'L');
	$pdf->Cell(50,5,$atleta['data_filiacao'],0,0,'L');

	$pdf->Ln(18);
	$pdf->Cell(57,5,'',0,0,'L');
	$pdf->Cell(50,5,$atleta['tipo_sanguineo'],0,0,'L');

	$pdf->Ln(17);
	$pdf->Cell(52,5,'',0,0,'L');
	$pdf->Cell(50,5,$atleta['validade'],0,0,'L');

	//$pdf->Cell(20,5,'',0,1,'L');

//	$pdf->Cell(6,5,'',0,0,'L'); // ESPAÇO INICIAL
//	$pdf->Cell(35,5,$guiaTiss['guia-tiss-registro_ans'],0,0,'L'); // ANS 
//	$pdf->Cell(89,5,$guiaTiss['guia-tiss-guia_principal'],0,0,'L');
//	$pdf->Cell(33,5,$guiaTiss['guia-tiss-data_autorizacao'],0,0,'L');
//	$pdf->Cell(63,5,$guiaTiss['guia-tiss-senha'],0,0,'L');
//	$pdf->Cell(33,5,$guiaTiss['guia-tiss-data_validade_senha'],0,0,'L');
//	$pdf->Cell(33,5,$guiaTiss['guia-tiss-data_emissao_senha'],0,0,'L');
//	$pdf->Ln(11);
	// Fim da primeira linha
}
//imprime a saida do arquivo..
$pdf->Output("carteirinha.pdf","D");

?>