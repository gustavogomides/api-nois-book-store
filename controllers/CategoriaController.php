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
}

?>