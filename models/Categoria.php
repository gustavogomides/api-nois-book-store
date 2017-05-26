<?php 

Class Categoria {

	public $CategoryID;
    public $CategoryName;

	public function __set($atrib, $value){ 
		$this->$atrib = $value;
	}

	public function __get($atrib){
		return $this->$atrib;
	}
}


?>