<?php 

Class LivroDAO extends DAO {

	private $tableName = "bookdescriptions";

	function listLivros($conn){

		$query = "SELECT * FROM " . $this->tableName;
		
		$livros_arr["livros"] = array();
		
		$result = $this->executeQuery($conn, $query);

		if ($result) {
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				array_push($livros_arr["livros"], $this->gerarLivro($row));
            }			
		}

		return $livros_arr;

	}

	public function getLivroByIsbn($conn, $isbn){
		$query = "SELECT * FROM " . $this->tableName . " WHERE ISBN = '" . $isbn . "'";

        $livros_arr["livros"] = array();

        $result = $this->executeQuery($conn, $query);
		
		if ($result) {
			$row = mysqli_fetch_array($result, MYSQLI_BOTH);            
			return $this->gerarLivro($row);
        }else{
			return null;
		}
	
	}

	public function getLivroByTitle($conn, $title){
		$query = "SELECT * FROM " . $this->tableName . " WHERE title = '" . $title . "'";

        $livros_arr["livros"] = array();

        $result = $this->executeQuery($conn, $query);
		
		if ($result) {
			$row = mysqli_fetch_array($result, MYSQLI_BOTH);            
			if(!empty($row)){
				return $this->gerarLivro($row);	
			}else{
				return null;
			}
			
        }else{
			return null;
		}
	
	}

	public function getLivroByCategoria($conn, $categoriaNome){
		$query = 
			"SELECT * 
			FROM bookcategoriesbooks bcb JOIN bookdescriptions bd ON bcb.ISBN = bd.ISBN 
			WHERE bcb.CategoryID = (SELECT CategoryID FROM bookcategories WHERE CategoryName = '" . $categoriaNome ."')";

		$livros_arr["livros"] = array();

        $result = $this->executeQuery($conn, $query);
		
		if ($result) {
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				array_push($livros_arr["livros"], $this->gerarLivro($row));
            }					
		}

		return $livros_arr;
	}

	public function getLivroByAutor($conn, $autorID){
		$query = 
			"SELECT bd.title 
			FROM bookauthors ba JOIN bookauthorsbooks bab ON ba.AuthorID = bab.AuthorID 
				JOIN bookdescriptions bd ON bab.ISBN = bd.ISBN 
			WHERE ba.AuthorID = ". $autorID;

		$livros_arr = array();

        $result = $this->executeQuery($conn, $query);
		
		if ($result) {
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				array_push($livros_arr, $row["title"]);
            }					
		}

		return $livros_arr;

	}

	private function gerarLivro($row){
		$livro = new Livro();
		$livro->ISBN = $row["ISBN"];
		$livro->title = $row["title"];
		$livro->description = $row["description"];
		$livro->price = $row["price"];
		$livro->publisher = $row["publisher"];
		$livro->pubdate = $row["pubdate"];
		$livro->edition = $row["edition"];
		$livro->pages = $row["pages"];

		return $livro;
	}

}
?>