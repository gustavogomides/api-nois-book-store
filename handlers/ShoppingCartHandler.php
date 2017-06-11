<?php 


include_once("./RestHandler.php");
include_once("./controllers/ShoppingCartController.php");

Class ShoppingCartHandler extends RestHandler {

	public function validEmail($email){
		$shoppingCartController = new ShoppingCartController($this->db);
		$rawData = $shoppingCartController->validEmail($email);

		if($rawData){
			echo $this->generateResponse('Email valido!', "Email invalido!");
		}else{
			echo $this->generateResponse('Email invalido!', "Email invalido!");
		}
	}

	public function validState($state){
		$shoppingCartController = new ShoppingCartController($this->db);
		$rawData = $shoppingCartController->validState($state);

		if($rawData){
			echo $this->generateResponse('State valido!', "State invalido!");
		}else{
			echo $this->generateResponse('State invalido!', "State invalido!");
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

	public function insertCustomer($customer){
		$shoppingCartController = new ShoppingCartController($this->db);
		$rawData = $shoppingCartController->insertCustomer($customer);
		
		if($rawData != null){
			echo $this->generateResponse($rawData, 'Nenhum customer encontrado!');
		}else{
			echo $this->generateResponse('Erro na insercao do customer!', 'Nenhum customer encontrado!');
		}
	}

	public function updateCustomer($customer){
		$shoppingCartController = new ShoppingCartController($this->db);
		$rawData = $shoppingCartController->updateCustomer($customer);
		
		if($rawData){
			echo $this->generateResponse('Customer atualizado com sucesso!', 'Nenhum customer encontrado!');
		}else{
			echo $this->generateResponse('Erro na atualizacao do customer!', 'Nenhum customer encontrado!');
		}
	}

	public function insertBookOrders($bookOrder){
		$shoppingCartController = new ShoppingCartController($this->db);
		$rawData = $shoppingCartController->insertBookOrders($bookOrder);
		
		if($rawData != null){
			echo $this->generateResponse($rawData, 'Nenhum bookOrder encontrado!');
		}else{
			echo $this->generateResponse('Erro na insercao do bookOrder!', 'Nenhum bookOrder encontrado!');
		}
	}

	public function insertBookOrdersItems($bookOrderItem){
		$shoppingCartController = new ShoppingCartController($this->db);
		$rawData = $shoppingCartController->insertBookOrdersItems($bookOrderItem);
		
		if($rawData){
			echo $this->generateResponse('Book Order Item inserido!', 'Nenhum bookOrderItem encontrado!');
		}else{
			echo $this->generateResponse('Erro na insercao do bookOrderItem!', 'Nenhum bookOrderItem encontrado!');
		}
	}
	
	public function enviarEmail($email){
		$shoppingCartController = new ShoppingCartController($this->db);
		$shoppingCartController->enviarEmail($email);
	}

	public function getHistorico($custID){
		$shoppingCartController = new ShoppingCartController($this->db);
		$rawData = $shoppingCartController->getHistorico($custID);
		echo $this->generateResponse($rawData, 'Nenhum histórico encontrado!');
	}	
	
}

?>