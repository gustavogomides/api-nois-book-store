<?php 

include_once('DAO.php');

Class LoginDAO extends DAO {

	public function findUser($conn, $email, $senha){
        $query = "SELECT nome, email, senha FROM usuarios WHERE email = '$email' AND senha = '$senha' ";		
		$result = $this->executeQuery($conn, $query);
		$row = mysqli_fetch_array($result, MYSQLI_BOTH);
	
		return $this->geraUser($row);
	}

	private function geraUser($row){
		$login = array();
        $login["nome"] = $row['nome'];
        $login["email"]= $row['email'];
        $login["senha"]= $row['senha'];

		return $login;
	}

}
?>