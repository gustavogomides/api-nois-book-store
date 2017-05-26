<?php 

Class Autor {
	public $AuthorID;
	public $nameF;
	public $nameL;
	public $livros = [];

	public function __set($atrib, $value){ 
		$this->$atrib = $value;
	}

	public function __get($atrib){
		return $this->$atrib;
	}
}


?>