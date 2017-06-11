<?php 

include_once("./RestHandler.php");
include_once("./controllers/LoginController.php");

Class LoginHandler extends RestHandler {
	public function login($email, $senha){
		$loginController = new LoginController($this->db);
		$rawData = $loginController->login($email, $senha);

		echo $this->generateResponse($rawData, 'Nenhum user encontrado!');
	}
}

?>