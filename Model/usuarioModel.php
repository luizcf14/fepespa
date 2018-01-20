<?php
include('./Controller/mysqlConnection.php');
class crudUsuario{
    private $connection = null;
    private $table = 'wp_users';
    private $dbname = 'fepes861_fepespa';
    public function __construct() {
        $mysql = new mysqlConnection();
        $this->connection = $mysql->connect();
       
    }
    
    function getAllUsers(){
        $query = "SELECT * FROM $this->dbname.$this->table";
        $result = mysqli_query($this->connection,$query);
        return  $result->fetch_all(MYSQLI_ASSOC);
        
    }
    function getAllUsersPag(){
        $query = "SELECT * FROM $this->dbname.$this->table  WHERE pagamento = 1";
        $result = mysqli_query($this->connection,$query);
        return  $result->fetch_all(MYSQLI_ASSOC);
        
    }
    function getAllUsersNOTPag(){
        $query = "SELECT * FROM $this->dbname.$this->table WHERE pagamento is false";
        $result = mysqli_query($this->connection,$query);
        return  $result->fetch_all(MYSQLI_ASSOC);
    }
    function getUsuario($id){
        $query = "SELECT * FROM $this->table WHERE ID = $id";
        $result = $this->connection->query($query);
        return $result;
    }
}