<?php 

include_once('DAO.php');

Class ShoppingCartDAO extends DAO {

	public function bookInfo($conn, $isbn){
    
        $query = "SELECT isbn, title, price
			        FROM bookdescriptions
			        WHERE isbn='$isbn'";

		$shoppingCart_arr["isbn"] = array();
		
		$result = $this->executeQuery($conn, $query);

		if ($result) {
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				array_push($shoppingCart_arr["isbn"], $this->gerarShoppingCart($row));
            }			
		}

		return $shoppingCart_arr;
	}

	private function gerarShoppingCart($row){
		$shoppingCart = new ShoppingCart();
        $shoppingCart->price = $row['price'];
        $shoppingCart->title = $row['title'];
 
		return $shoppingCart;
	}

}
?>