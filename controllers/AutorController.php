<?php 

include_once('./DAO/AutorDAO.php');
include_once('./models/Autor.php');

Class AutorController {

	private $conn;
	private $autorDAO;

	public function __construct($db){
        $this->conn = $db;
        $this->autorDAO = new AutorDAO();
    }

	public function listAutores(){
		return $this->autorDAO->listAutores($this->conn);
	}
}

?>