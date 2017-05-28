<?php

Class Livro {
    public $ISBN;
    public $title;
    public $description;
    public $price;
    public $publisher;
    public $pubdate;
    public $edition;
    public $pages;

	public function __set($atrib, $value){ 
		$this->$atrib = $value;
	}

	public function __get($atrib){
		return $this->$atrib;
	}
}

?>


	 