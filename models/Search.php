<?php

Class Search {
	public $isbn;
    public $title;
    public $description;
    public $price;

	public function __set($atrib, $value){ 
		$this->$atrib = $value;
	}

	public function __get($atrib){
		return $this->$atrib;
	}
}
?>