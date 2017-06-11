<?php

include_once("Rest.php");
include_once("models/DatabaseConnection.php");
include_once("controllers/LivroController.php");
include_once("controllers/CategoriaController.php");
include_once("controllers/AutorController.php");
include_once("controllers/SearchController.php");
include_once("controllers/ShoppingCartController.php");
include_once("controllers/LoginController.php");

class RestHandler extends Rest {
	public $db;

	public function __construct(){
		$database = new DatabaseConnection();
        $this->db = $database->getConnection();
    }

	public function __destruct(){
		$this->db->close();
	}


	public function generateResponse($rawData, $errorMessage){
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