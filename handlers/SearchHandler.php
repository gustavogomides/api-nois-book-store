<?php 

include_once("./RestHandler.php");
include_once("./controllers/SearchController.php");

Class SearchHandler extends RestHandler {
	public function searchBooks($search){
		$searchController = new SearchController($this->db);
		$rawData = $searchController->searchBooks($search);

		echo $this->generateResponse($rawData, 'Nenhum livro encontrado!');
	}
}

?>