<?php

require_once 'usuarioModel.php';

/**
 * Description of pagementoModel
 *
 * @author luizcf14
 */
class pagamentoModel {

	public $table = 'historico_pagamento';
	public $table_mensalidade = 'mensalidade';
	private $dbname = 'fepes861_fepespa';
	private $data_pagamento;
	private $valor;
	private $usuario = null;
	private $id_usuario = null;
	private $data_filiacao = null;
	private $ultima_data_validade = null;
	private $connection = null;

	public function __construct($id) {
		$mysql = new mysqlConnection();
		$this->connection = $mysql->connect();
		$user = new usuarioModel();
		$this->id_usuario = $id;
		$this->usuario = $user->getUsuario($id);
		$this->data_filiacao = $user->getDataFiliacao($id);
		$this->ultima_data_validade = $user->getUltimaDataValidadePagamento($id);
	}

	function getUsuario() {
		return $this->usuario;
	}

	function getDataFiliacao() {
		return $this->data_filiacao;
	}

	function getUltimaDataValidade() {
		return $this->ultima_data_validade;
	}

	function getAllPagamentos() {
		$query = "SELECT * FROM $this->dbname.$this->table";
		$result = mysqli_query($this->connection, $query);
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	function getPagamento($id) {
		$query = "SELECT * FROM $this->dbname.$this->table WHERE id = $id";
		$result = mysqli_query($this->connection, $query);
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	function getPagamentobyUser($user_id) {

		$query = "SELECT * FROM $this->dbname.$this->table WHERE id_user = $user_id";
		$result = mysqli_query($this->connection, $query);
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	function getTable_name() {
		return $this->table_name;
	}

	function getData_pagamento() {
		return $this->data_pagamento;
	}

	function getValor() {
		return $this->valor;
	}

	function getId_usuario() {
		return $this->id_usuario;
	}

	function setTable_name($table_name) {
		$this->table_name = $table_name;
	}

	function setData_pagamento($data_pagamento) {
		$this->data_pagamento = $data_pagamento;
	}

	function setValor($valor) {
		$this->valor = $valor;
	}

	function cancelarPagamento($pagamento_id) {
		
		$query = "DELETE FROM $this->dbname.$this->table_mensalidade WHERE id_hist_pag = $pagamento_id";
		$result = mysqli_query($this->connection, $query);
		if($result) {
			$query = "DELETE FROM $this->dbname.$this->table WHERE id = $pagamento_id";
			$result = mysqli_query($this->connection, $query);
		}
		return $result;
	}

	function inserirPagamento($userID, $dataPag, $valorPag, $tipoPag, $dataRef) {
		$query = "INSERT INTO $this->dbname.$this->table (data_pagamento,valor,id_user,mes_ano_referencia,tipo_pagamento) VALUES ('$dataPag',$valorPag, $userID, '$dataRef', '$tipoPag');";
		//var_dump($query); die();
		$result = mysqli_query($this->connection, $query);


		if($result) {
			$dataR = utils::converteData($dataRef);
			$hist_pag_id = mysqli_insert_id($this->connection);
			unset($query);

			$query = "INSERT INTO $this->dbname.$this->table_mensalidade (id_hist_pag,mes_ano) VALUES ";

			for($i = 0; $i < 12; $i++) {
				if($i == 0)
					continue;

				$mes_ano = utils::inverteData(utils::converteData(utils::somarData($dataR, $i, 'mes')));
				$query .= "($hist_pag_id, '$mes_ano')";

				if($i < 11)
					$query .= ",";
			}
			$result = mysqli_query($this->connection, $query);
		}

		return $result;
	}

	function setId_usuario($id_usuario) {
		$this->id_usuario = $id_usuario;
	}

}
