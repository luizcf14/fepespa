<?php
include('./Controller/mysqlConnection.php');
class usuarioModel{
    private $connection = null;
    private $table = 'wp_users';
    private $dbname = 'fepes861_fepespa';
    public function __construct() {
        $mysql = new mysqlConnection();
        $this->connection = $mysql->connect();
       
    }
    
    function getAllUsers(){
        $query = "SELECT * FROM $this->dbname.$this->table ORDER BY display_name";
        $result = mysqli_query($this->connection,$query);
        return  $result->fetch_all(MYSQLI_ASSOC);
        
    }
    
    function setPagamento($id,$status = 0){
        $query = "UPDATE $this->dbname.$this->table SET carteirinha = '$status' WHERE id = '$id'";
       // var_dump($query);
        $result = mysqli_query($this->connection,$query);
        return $result;
    }
    
      function setFiliacao($id,$data){
        $query = "UPDATE $this->dbname.$this->table SET data_filiacao = $data WHERE id = '$id'";
        $result = mysqli_query($this->connection,$query);
        return $result;
    }
    
    function getAllUsersPag(){
        $query = "SELECT * FROM $this->dbname.$this->table  WHERE carteirinha = 1";
        $result = mysqli_query($this->connection,$query);
       // var_dump($query);die();
        return  $result->fetch_all(MYSQLI_ASSOC);
        
    }
    function getAllUsersNOTPag(){
        $query = "SELECT * FROM $this->dbname.$this->table WHERE carteirinha = 0";
        $result = mysqli_query($this->connection,$query);
        return  $result->fetch_all(MYSQLI_ASSOC);
    }
    function getUsuario($id){
        $query = "SELECT * FROM $this->dbname.$this->table WHERE ID = $id";
        $result = mysqli_query($this->connection,$query);
        //var_dump($query);die();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}