<?php 


include_once("./RestHandler.php");
include_once("./controllers/LivroController.php");

Class LivroHandler extends RestHandler {

	public function listLivros() {	
		$livroController = new LivroController($this->db);
		$rawData = $livroController->listLivros();

		echo $this->generateResponse($rawData, 'Nenhum livro encontrado!');
	}
		
	public function getLivroByIsbn($isbn) {
		$livroController = new LivroController($this->db);
		$rawData = $livroController->getLivroByIsbn($isbn);

		echo $this->generateResponse($rawData, 'Nenhum livro encontrado!');
	}

	public function getLivroByTitle($title){
		$livroController = new LivroController($this->db);
		$rawData = $livroController->getLivroByTitle($title);

		echo $this->generateResponse($rawData, 'Nenhum livro encontrado!');	
	}

	public function getLivroByCategoria($categoriaNome){
		$livroController = new LivroController($this->db);
		$rawData = $livroController->getLivroByCategoria($categoriaNome);

		echo $this->generateResponse($rawData, 'Nenhum livro encontrado!');
	}

	public function getLivroByAuthorName($authorName){
		$livroController = new LivroController($this->db);
		$rawData = $livroController->getLivroByAuthorName($authorName);
		
		echo $this->generateResponse($rawData, 'Nenhum livro encontrado!');
	}

	public function inserirLivro($livro){
		$livroController = new LivroController($this->db);
		$rawData = $livroController->inserirLivro($livro);
		
		if($rawData){
			echo $this->generateResponse('Livro inserido com sucesso!', 'Nenhum livro encontrado!');
		}else{
			echo $this->generateResponse('Erro na insercao do livro!', 'Nenhum livro encontrado!');
		}
	}

	public function deleteLivro($id){
		$livroController = new LivroController($this->db);
		$rawData = $livroController->deleteLivro($id);

		echo $this->generateResponse($rawData, 'Nenhum autor encontrado!');
	}

	public function updateLivro($livro){
		$livroController = new LivroController($this->db);
		$rawData = $livroController->updateLivro($livro);

		echo $this->generateResponse($rawData, 'Nenhum autor encontrado!');
	}
}

?>