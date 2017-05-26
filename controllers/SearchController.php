<?php 
Class SearchController {

	private $conn;
	private $seachDAO;

	public function __construct($db){
        $this->conn = $db;
        $this->searchDAO = new SearchDAO();
    }

	public function searchBooks($search){
		return $this->searchDAO->searchBooks($this->conn, $search);
	}
}

?>