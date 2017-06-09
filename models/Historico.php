<?php 

Class Historico {
	public $title;
	public $isbn;
	public $orderID;
	public $orderdate;
	public $qty;

	public function __set($atrib, $value){ 
		$this->$atrib = $value;
	}

	public function __get($atrib){
		return $this->$atrib;
	}
}


?>