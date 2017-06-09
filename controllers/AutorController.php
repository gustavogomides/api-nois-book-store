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

	public function inserirAutor($autor){
		return $this->autorDAO->inserirAutor($this->conn, $autor);
	}

	public function getAutorByID($id){
		return $this->autorDAO->getAutorByID($this->conn, $id);
	}

	public function updateAutor($autor){
		return $this->autorDAO->updateAutor($this->conn, $autor);
	}

	public function deleteAutor($id){
		return $this->autorDAO->deleteAutor($this->conn, $id);
	}

	public function getAutorByIsbn($isbn){
		return $this->autorDAO->getAutorByIsbn($this->conn, $isbn);
	}
}

?>