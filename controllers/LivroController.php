<?php 

Class LivroController{

	private $conn;
	private $livroDAO;

	public function __construct($db){
        $this->conn = $db;
        $this->livroDAO = new LivroDAO();
    }

	public function listLivros(){
		return $this->livroDAO->listLivros($this->conn);
	}
	
	public function getLivroByIsbn($isbn){
		return $this->livroDAO->getLivroByIsbn($this->conn, $isbn);	
	}

	public function getLivroByTitle($title){
		return $this->livroDAO->getLivroByTitle($this->conn, $title);	
	}

	public function getLivroByCategoria($categoriaID){
		return $this->livroDAO->getLivroByCategoria($this->conn, $categoriaID);
	}
}

?>