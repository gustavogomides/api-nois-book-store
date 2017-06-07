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

	public function getCategoriaByID($id){
		$categoriaController = new CategoriaController($this->db);
		$rawData = $categoriaController->getCategoriaByID($id);
		
		echo $this->generateResponse($rawData, 'Nenhuma categoria encontrado!');	
	}

	public function inserirCategoria($categoria){
		$categoriaController = new CategoriaController($this->db);
		$rawData = $categoriaController->inserirCategoria($categoria);

		echo $this->generateResponse($rawData, 'Nenhum autor encontrado!');
	}

	public function deleteCategoria($id){
		$categoriaController = new CategoriaController($this->db);
		$rawData = $categoriaController->deleteCategoria($id);

		echo $this->generateResponse($rawData, 'Nenhum categoria encontrado!');
	}

	public function updateCategoria($categoria){
		$categoriaController = new CategoriaController($this->db);
		$rawData = $categoriaController->updateCategoria($categoria);

		echo $this->generateResponse($rawData, 'Nenhum categoria encontrado!');
	}


	////////////////////////////////////////
	//// AUTOR
	////////////////////////////////////////
	public function listAutores() {	
		$autorController = new AutorController($this->db);
		$rawData = $autorController->listAutores();
		
		echo $this->generateResponse($rawData, 'Nenhuma autor encontrado!');
	}

	public function inserirAutor($autor){
		$autorController = new AutorController($this->db);
		$rawData = $autorController->inserirAutor($autor);

		echo $this->generateResponse($rawData, 'Nenhum autor encontrado!');
	}

	
	public function getAutorByID($id){
		$autorController = new AutorController($this->db);
		$rawData = $autorController->getAutorByID($id);
		
		echo $this->generateResponse($rawData, 'Nenhuma autor encontrado!');	
	}

	public function deleteAutor($id){
		$autorController = new AutorController($this->db);
		$rawData = $autorController->deleteAutor($id);

		echo $this->generateResponse($rawData, 'Nenhum autor encontrado!');
	}

	public function updateAutor($autor){
		$autorController = new AutorController($this->db);
		$rawData = $autorController->updateAutor($autor);

		echo $this->generateResponse($rawData, 'Nenhum autor encontrado!');
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
	public function validEmail($email){
		$shoppingCartController = new ShoppingCartController($this->db);
		$rawData = $shoppingCartController->validEmail($email);

		if($rawData){
			echo $this->generateResponse('Email valido!', "Email invalido!");
		}else{
			echo $this->generateResponse('Email invalido!', "Email invalido!");
		}
	}

	public function getCustomer($email){
		$shoppingCartController = new ShoppingCartController($this->db);
		$rawData = $shoppingCartController->getCustomer($email);

		if($rawData == null){
			echo $this->generateResponse('Nenhum customer encontrado', "Nenhum customer encontrado");
		}else{
			echo $this->generateResponse($rawData, "Nenhum customer encontrado");
		}
	}



	////////////////////////////////////////
	///// LOGIN
	////////////////////////////////////////
	public function login($email, $senha){
		$loginController = new LoginController($this->db);
		$rawData = $loginController->login($email, $senha);

		echo $this->generateResponse($rawData, 'Nenhum user encontrado!');
	}

	////////////////////////////////////////
	///// INSERIR LIVRO
	////////////////////////////////////////
	



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