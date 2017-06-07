<?php 

include_once('DAO.php');

Class ShoppingCartDAO extends DAO {

	public function getCustomer($conn, $email){
		$query = "SELECT * FROM bookCustomers WHERE email = '$email'";

        $result = $this->executeQuery($conn, $query);
		
		$row = mysqli_fetch_array($result);

		if (mysqli_num_rows($result) == 0) {
			return null;
		} else{
			return $this->gerarCustomer($row);
		}
	}

	function gerarCustomer($row){
		$customer = new Customer();
		$customer->custID = $row["custID"];
		$customer->fname = $row["fname"];
		$customer->lname = $row["lname"];
		$customer->email = $row["email"];
		$customer->street = $row["street"];
		$customer->city = $row["city"];
		$customer->state = $row["state"];
		$customer->zip = $row["zip"];

		return $customer;
	}
}
?>