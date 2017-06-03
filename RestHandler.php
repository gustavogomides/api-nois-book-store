<?php

include_once("SimpleRest.php");
include_once("models/DatabaseConnection.php");
include_once("controllers/LivroController.php");
include_once("controllers/CategoriaController.php");
include_once("controllers/AutorController.php");
include_once("controllers/SearchController.php");
include_once("controllers/ShoppingCartController.php");
include_once("controllers/LoginController.php");

class RestHandler extends SimpleRest {
	public $db;

	public function __construct(){
		$database = new DatabaseConnection();
        $this->db = $database->getConnection();
    }

	public function __destruct(){
		$this->db->close();
	}





	////////////////////////////////////////
	//// LIVRO
	////////////////////////////////////////
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







	////////////////////////////////////////
	//// CATEGORIA
	////////////////////////////////////////
	public function listCategorias() {	
		$categoriaController = new CategoriaController($this->db);
		$rawData = $categoriaController->listCategorias();

		echo $this->generateResponse($rawData, 'Nenhuma categoria encontrada!');
	}

	public function getCategoriaID($nome){
		$categoriaController = new CategoriaController($this->db);
		$id = $categoriaController->getCategoriaID($nome);
		
		if(empty($id)){
			echo $this->generateResponse($id, 'Nenhuma categoria encontrada!');
		} else{
			$rawData = '{id:' . $id . '}';
			echo $this->generateResponse($rawData, 'Nenhuma categoria encontrada!');
		}	
	}






	////////////////////////////////////////
	//// AUTOR
	////////////////////////////////////////
	public function listAutores() {	
		$autorController = new AutorController($this->db);
		$rawData = $autorController->listAutores();
		
		echo $this->generateResponse($rawData, 'Nenhuma autor encontrado!');
	}





	////////////////////////////////////////
	///// SEARCH
	////////////////////////////////////////
	public function searchBooks($search){
		$searchController = new SearchController($this->db);
		$rawData = $searchController->searchBooks($search);

		echo $this->generateResponse($rawData, 'Nenhum livro encontrado!');
	}






	////////////////////////////////////////
	///// SHOPPING CART
	////////////////////////////////////////
	public function booksToCart($ISBN){
		$shoppingCartController = new ShoppingCartController($this->db);
		$rawData = $shoppingCartController->booksToCart($ISBN);

		echo $this->generateResponse($rawData, 'Nenhum livro adicionado!');
	}





	////////////////////////////////////////
	///// LOGIN
	////////////////////////////////////////
	public function getUserIfExists($email, $senha){
		$loginController = new LoginController($this->db);
		$rawData = $loginController->getUserIfExists($email, $senha);

		echo $this->generateResponse($rawData, 'Nenhum user encontrado!');
	}



	private function generateResponse($rawData, $errorMessage){
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => $errorMessage);		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);				
		
		return json_encode($rawData);
	}

}


?>