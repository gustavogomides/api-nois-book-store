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

	public function insertCustomer($conn, $customer){
		$query = "INSERT INTO bookcustomers (fname, lname, zip, state, city, street, email)
	  			values (
		  			'" . $customer->nome ."', 
		  			'" . $customer->sobrenome ."', 
		  			" . $customer->cep .", 
		  			'" . $customer->estado ."', 
		  			'" . $customer->cidade ."', 
		  			'" . $customer->rua ."', 
		  			'" . $customer->email ."'
	  			)";
	  
	  	$result = $this->executeQuery($conn, $query);

        if($result){
        	return $conn->insert_id;
        }else{
        	return null;
        }
	}

	public function updateCustomer($conn, $customer){
		$query = "UPDATE bookcustomers SET 
					fname = '$customer->nome', 
					lname = '$customer->sobrenome', 
					zip = $customer->cep, 
				  	state = '$customer->estado', 
				  	city = '$customer->cidade',
				  	street = '$customer->rua', 
				  	email = '$customer->email'  
			  	WHERE custID = $customer->custID";
	  
	  	$result = $this->executeQuery($conn, $query);

        if($result){
        	return true;
        }else{
        	return false;
        }
	}

	public function insertBookOrders($conn, $bookOrder){
		$orderdate = time ();

		$query = "INSERT INTO bookorders (CustID, orderdate) values ('$bookOrder->custID', '$orderdate')";
	  
	  	$result = $this->executeQuery($conn, $query);

        if($result){
        	return $conn->insert_id;
        }else{
        	return null;
        }
	}


	public function insertBookOrdersItems($conn, $bookOrder){
		$discount = 0.8;
		$query = "INSERT INTO bookorderitems (orderID, isbn, qty, price) 
			VALUES ($bookOrder->orderID, '$bookOrder->isbn', $bookOrder->qty, (select (price * $discount) from bookdescriptions where ISBN = '$bookOrder->isbn'))";
	  
	  	$result = $this->executeQuery($conn, $query);

        if($result){
        	return true;
        }else{
        	return null;
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