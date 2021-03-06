<?php 

include_once('./DAO/LivroDAO.php');
include_once('./models/Livro.php');

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

	public function getLivroByCategoria($categoriaNome){
		return $this->livroDAO->getLivroByCategoria($this->conn, $categoriaNome);
	}

	public function getLivroByAuthorName($authorName){
		return $this->livroDAO->getLivroByAuthorName($this->conn, $authorName);
	}

	public function inserirLivro($livro){
		return $this->livroDAO->inserirLivro($this->conn, $livro);
	}

	public function updateLivro($livro){
		return $this->livroDAO->updateLivro($this->conn, $livro);
	}

	public function deleteLivro($id){
		return $this->livroDAO->deleteLivro($this->conn, $id);
	}
}

?>