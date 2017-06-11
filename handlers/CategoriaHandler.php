<?php 

include_once("./RestHandler.php");
include_once("./controllers/CategoriaController.php");

Class CategoriaHandler extends RestHandler {

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
}

?>