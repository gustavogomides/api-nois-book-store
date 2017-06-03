<?php 

include_once('./DAO/LoginDAO.php');
include_once('./models/Login.php');

Class LoginController {

	private $conn;
	private $loginDAO;
	private $login;
	private $user_arr;

	public function __construct($db){
        $this->conn = $db;
		$this->login = new Login();
        $this->loginDAO = new LoginDAO();
    }

	public function login($email, $senha){
		$this->user_arr = $this->loginDAO->findUser($this->conn, $email, $senha);

		if($this->user_arr["nome"] != null){
			session_start();
			$_SESSION["nome"] = $this->user_arr["nome"]; 
			header("Location:admin");
		}else{
			header("Location:login");
		}

		return $this->user_arr;
	}
	

}

?>