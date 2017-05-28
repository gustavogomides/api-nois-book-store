<?php

Class ShoppingCart {
    public $title;
    public $price;
	
    
    public function __set($atrib, $value){ 
		$this->$atrib = $value;
	}

	public function __get($atrib){
		return $this->$atrib;
	}
}

?>