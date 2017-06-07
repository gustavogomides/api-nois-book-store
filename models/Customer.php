<?php 

Class Customer {
	public $custID;
	public $fname;
	public $lname;
	public $email;
	public $street;	
	public $city;
	public $state;	
	public $zip;


	public function __set($atrib, $value){ 
		$this->$atrib = $value;
	}

	public function __get($atrib){
		return $this->$atrib;
	}
}


?>