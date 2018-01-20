<?php

class mysqlConnection {
private $servername = "fepespa.com.br";
private $username = "fepes861_admin";
private $password = "fepespa4dm1n";
public  $connection = null;
function connect(){
    // Create connection
    $conn = new mysqli($this->servername, $this->username, $this->password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $this->connection = $conn;
    return $conn;
    
    }
}
