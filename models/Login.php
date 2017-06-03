<?php

Class Login {
	public $nome;
    public $email;
    public $senha;

	public function __set($atrib, $value){ 
		$this->$atrib = $value;
	}

	public function __get($atrib){
		return $this->$atrib;
	}
}
?>