<?php

Class ShoppingCart {
	public $bookList = array();
	public $subTot;
	public $shipping;
	public $total;
	public $bookCount;
    
    public function __set($atrib, $value){ 
		$this->$atrib = $value;
	}

	public function __get($atrib){
		return $this->$atrib;
	}
}

?>