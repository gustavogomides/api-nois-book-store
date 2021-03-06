<?php 

include_once('./DAO/CategoriaDAO.php');
include_once('./models/Categoria.php');

Class CategoriaController {

	private $conn;
	private $categoriaDAO;

	public function __construct($db){
        $this->conn = $db;
        $this->categoriaDAO = new CategoriaDAO();
    }

	public function listCategorias(){
		return $this->categoriaDAO->listCategorias($this->conn);
	}

	public function getCategoriaID($nomeCategoria){
		return $this->categoriaDAO->getCategoriaID($this->conn, $nomeCategoria);
	}

	public function inserirCategoria($categoria){
		return $this->categoriaDAO->inserirCategoria($this->conn, $categoria);
	}

	public function getCategoriaByID($id){
		return $this->categoriaDAO->getCategoriaByID($this->conn, $id);
	}

	public function updateCategoria($categoria){
		return $this->categoriaDAO->updateCategoria($this->conn, $categoria);
	}

	public function deleteCategoria($id){
		return $this->categoriaDAO->deleteCategoria($this->conn, $id);
	}
}

?>