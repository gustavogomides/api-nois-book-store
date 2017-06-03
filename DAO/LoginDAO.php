<?php 

include_once('DAO.php');

Class LoginDAO extends DAO {

	public function findUser($conn, $email, $senha){

        $query = "SELECT nome, email, senha FROM usuarios WHERE email = '$email' AND senha = '$senha' ";

		$user_arr["user"] = array();
		
		$result = $this->executeQuery($conn, $query);

		if ($result) {
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				array_push($user_arr["user"], $this->geraUser($row));
            }			
		}

		return $user_arr;
	}

	private function geraUser($row){
		$login = new Login();
        $login->nome = $row['nome'];
        $login->email= $row['email'];
        $login->senha= $row['senha'];

		return $login;
	}

}
?>