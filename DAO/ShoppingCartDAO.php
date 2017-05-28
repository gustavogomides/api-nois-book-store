<?php 

include_once('DAO.php');

Class ShoppingCartDAO extends DAO {

	public function bookInfo($conn, $isbn){
    
        $query = "SELECT isbn, title, price
			        FROM bookdescriptions
			        WHERE isbn='$isbn'";

		
		$result = $this->executeQuery($conn, $query);
		$row = mysqli_fetch_array($result, MYSQLI_BOTH);
	
		return $this->gerarShoppingCart($row);
	}

	private function gerarShoppingCart($row){
		$bookInfo = array();
        $bookInfo["price"] = $row['price'];
        $bookInfo["title"] = $row['title'];
 
		return $bookInfo;
	}

}
?>