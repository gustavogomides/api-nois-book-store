<?php 

include_once('./DAO/LoginDAO.php');
include_once('./models/Login.php');

Class LoginController {

	private $conn;
	private $loginDAO;
	private $user_arr;

	public function __construct($db){
        $this->conn = $db;
        $this->loginDAO = new LoginDAO();
    }

	public function getUserIfExists($email, $senha){
		$this->user_arr = $this->loginDAO->findUser($this->conn, $email, $senha);
	}


}

?>