<?php

require_once 'usuarioModel.php';

/**
 * Description of pagementoModel
 *
 * @author luizcf14
 */
class pagamentoModel {

    public $table = 'historico_pagamento';
    private $dbname = 'fepes861_fepespa';
    private $data_pagamento;
    private $valor;
    private $usuario = null;
    private $id_usuario = null;
    private $connection = null;
    public function __construct($id) {
        $mysql = new mysqlConnection();
        $this->connection = $mysql->connect();
        $user = new usuarioModel();
        $this->id_usuario = $id;
        $this->usuario = $user->getUsuario($id);
    }
    function getUsuario() {
        return $this->usuario;
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
    
    function cancelarPagamento($pagamento_id){
        $query = "DELETE FROM $this->dbname.$this->table WHERE id = $pagamento_id";
        $result = mysqli_query($this->connection, $query);
        return $result;
    }
    
    function inserirPagamento($user_id,$data,$valor){
        $query = "INSERT INTO $this->dbname.$this->table (data,valor,id_user) VALUES ('$data',$valor,$user_id);";
         //var_dump($query); die();
        $result = mysqli_query($this->connection, $query);
       
        return $result;
       }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

}
