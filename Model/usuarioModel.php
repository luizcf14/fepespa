<?php
include('./Controller/mysqlConnection.php');
class usuarioModel{
	private $connection = null;
	private $table = 'wp_users';
    private $table_meta = 'wp_usermeta';
	private $dbname = 'fepes861_fepespa';
	public function __construct() {
		$mysql = new mysqlConnection();
		$this->connection = $mysql->connect();
	}

//SELECT meta_key, meta_value FROM `wp_usermeta` WHERE user_id IN (1,74) AND meta_key IN ("birth_date","paintTeam","role","codigo_filiacao","data_filiacao" )
//ORDER BY `wp_usermeta`.`user_id` ASC
	
//        $query = "
//		SELECT
//			wp_users.*,
//			wp_usermeta.birth_date AS data_nasc,
//			wp_usermeta.paintTeam,
//			wp_usermeta.role,
//			wp_usermeta.codigo_filiacao,
//			wp_usermeta.data_filiacao
//		FROM 
//			$this->dbname.$this->table INNER JOIN $this->dbname.$this->table_meta
//			ON
//			wp_users.ID = wp_usermeta.user_id
//		ORDER BY
//			display_name
//		";

	
    function getAllUsers(){
        $query = "SELECT * FROM $this->dbname.$this->table ORDER BY display_name";
        $result = mysqli_query($this->connection,$query);
        return  $result->fetch_all(MYSQLI_ASSOC);
    }
    
    function getAllUSerMetaData($userId){
//        $query = "
//                SELECT 
//                    *                FROM
//                    wp_usermeta
//                WHERE
//                    user_id = 1
//                    AND
//                    meta_key IN ('birth_date','paintTeam','role','codigo_filiacao','data_filiacao')
//                ";
//        var_dump($query);
        $query = "SELECT meta_key, meta_value FROM $this->dbname.$this->table_meta WHERE  user_id = 1";
        $result = mysqli_query($this->connection,$query);
        return  $result->fetch_all(MYSQLI_ASSOC);
    }
            
    function setPagamento($id,$status = 0){
        $query = "UPDATE $this->dbname.$this->table SET carteirinha = '$status' WHERE id = '$id'";
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