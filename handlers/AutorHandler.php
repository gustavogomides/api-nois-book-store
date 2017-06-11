<?php 

include_once("./RestHandler.php");
include_once("./controllers/AutorController.php");

Class AutorHandler extends RestHandler {
	
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

	public function getAutorByIsbn($isbn){
		$autorController = new AutorController($this->db);
		$rawData = $autorController->getAutorByIsbn($isbn);

		echo $this->generateResponse($rawData, 'Nenhum autor encontrado!');
	}
}



?>