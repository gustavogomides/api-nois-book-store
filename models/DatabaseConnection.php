<?php
class DatabaseConnection{
 
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "sandvigbookstore";
    private $username = "root";
    private $password = "admin";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        
        return $this->conn;
    }
}
?>