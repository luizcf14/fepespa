<?php

class utils {

	public static function arrayUtf8Enconde(array $array) {
		$novo = array();
		foreach ($array as $i => $value) {
			if (is_array($value)) {
				$value = self::arrayUtf8Enconde($value);
			} elseif (!mb_check_encoding($value, 'UTF-8')) {//se não for array, verifica se o valor está codificado como UTF-8
				$value = utf8_encode($value);
			}
			$novo[$i] = $value;
		}
		return $novo;
	}

	public static function saidaJson($saida) {

		if (is_array($saida)) {
			die(json_encode(self::arrayUtf8Enconde($saida)));
		} else {
			die(json_encode($saida));
		}
	}

	public static function formata_dinheiro($valor) {

		$valor = number_format($valor, 2, ',', '');

		return $valor;
	}

	public static function valida_data($data) {
		$data = preg_split("/[-,\/]/", $data);

		if (!checkdate($data[1], $data[0], $data [2]) and ! checkdate($data[1], $data[2], $data[0])) {
			return false;
		}

		return true;
	}

	/**
	 * Utilizada para tanto para transformar as datas para serem inseridas no banco de dados
	 * quanto para as trazer do banco e mostra-las corretamente.
	 *
	 *
	 * @param date $data Data que será transformada
	 *
	 * @return
	 * Date transformada.
	 *
	 * Ou NULL caso a data seja composta totalmente por 0 (zeros);
	 *
	 */
	public static function converteData($data) {
		if (self::valida_data($data)) {
			return implode(!strstr($data, '/') ? "/" : "-", array_reverse(explode(!strstr($data, '/') ? "-" : "/", $data)));
		} else {
			return "";
		}
	}

	/**
	 * Utilizada para Inverter uma data no FORMATO YYYY/MM/DD para o formato DD/MM/YYYY
	 *
	 * @param date $data Data que será transformada
	 *
	 * @return
	 * Date Invertida
	 *
	 * Ou NULL caso a data seja composta totalmente por 0 (zeros);
	 *
	 */
	public static function inverteData($data) {

		if (self::valida_data($data)) {
			return implode("/", array_reverse(explode("/", $data)));
		} else {
			return "";
		}
	}

	/**
	 * Função para Traduzir uma data em Ingês para Português
	 *
	 * @author Bruno Haick
	 * @date Criação: 10/10/2013
	 *
	 * @param $data DD/MM/YYYY
	 *
	 * @return String $data_traduzida
	 *      $data traduzida no formato XX/mmm/XXXX
	 * mmm = 3 primeiras letras do nome do Mês, 
	 * por exemplo Jan, Fev, Mar, Nov, Dez...
	 * 
	 * Exemplo de retorno: out 2013
	 *
	 */
	public static function traduzData($data) {

		$arr_data = explode("/", $data);
		$mes = $arr_data[1];
		$ano = $arr_data[2];

		$Mes = substr(self::mostraMes($mes), 0, 3);
		$data_traduzida = $Mes . " " . $ano;

		return $data_traduzida;
	}

	/**
	 * Utilizada para encurtar uma string qualquer e um limite de caracteres
	 *
	 * @author Andrey Maia
	 * @date Criação: 05/09/2012
	 *
	 * @param string $string String que será encurtada
	 * @param integer $limite Limite de caracteres desejado
	 *
	 * @return
	 * 	String encurtada
	 *
	 */
	public static function mostraMes($m) {
		$mes = "";
		switch ($m) {
			case '01': case 1: $mes = "Janeiro";
				break;
			case '02': case 2: $mes = "Fevereiro";
				break;
			case '03': case 3: $mes = "Mar&ccedil;o";
				break;
			case '04': case 4: $mes = "Abril";
				break;
			case '05': case 5: $mes = "Maio";
				break;
			case '06': case 6: $mes = "Junho";
				break;
			case '07': case 7: $mes = "Julho";
				break;
			case '08': case 8: $mes = "Agosto";
				break;
			case '09': case 9: $mes = "Setembro";
				break;
			case '10': $mes = "Outubro";
				break;
			case '11': $mes = "Novembro";
				break;
			case '12': $mes = "Dezembro";
				break;
		}
		return $mes;
	}

	/**
	 * Função para Adicionar dias, meses ou anos a uma determinada data que é
	 * passada como parâmetro desta funcção.
	 *
	 * @param $data no formato xx/xx/xxxx
	 * @param $qtd
	 * @param $tipo (dia, mes ou ano)
	 *
	 * @author Bruno Haick
	 * @date Criação: 18/10/2012
	 *
	 * @return
	 * 	$data somando-se o que se deseja no formato xx/xx/xxxx
	 *
	 */
	public static function somarData($data, $qtd, $tipo) {

		if ($tipo == "dia") {
			$tipo = "days";
		} else if ($tipo == "mes") {
			$tipo = "month";
		} else if ($tipo == "ano") {
			$tipo = "year";
		}

		$data = utils::converteData($data);

		return date('d/m/Y', strtotime("+$qtd  $tipo", strtotime($data)));
	}

	/**
	 * Função para Diminuir dias, meses ou anos a uma determinada data que é 
	 * passada como parâmetro desta funcção.
	 *
	 * @param $data
	 * @param $qtdDias
	 * @param $tipo (dia, mes ou ano)
	 *
	 * @author Bruno Haick
	 * @date Criação: 18/10/2012
	 *
	 * @return
	 * 	$data subtraindo-se o que se deseja
	 *
	 */
	public static function subtrairData($data, $qtd, $tipo) {

		if ($tipo == "dia") {
			$tipo = "days";
		} else if ($tipo == "mes") {
			$tipo = "month";
		} else if ($tipo == "ano") {
			$tipo = "year";
		}

		$data = utils::converteData($data);

		return date('d/m/Y', strtotime("-$qtd  $tipo", strtotime($data)));
	}

}
