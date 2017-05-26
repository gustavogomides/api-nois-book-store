<?php 

Class AutorDAO extends DAO {

	private $tableName = "bookauthors";
	private $livroDAO;

	public function __construct(){
		$this->livroDAO = new LivroDAO();
	}

	public function listAutores($conn){
		$query = "SELECT * FROM " . $this->tableName;
		
		$autores_arr["autores"] = array();
		
		$result = $this->executeQuery($conn, $query);

		if ($result) {
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				array_push($autores_arr["autores"], $this->gerarAutor($conn, $row));
            }			
		
		}

		return $autores_arr;
	}


	private function gerarAutor($conn, $row){
		$autor = new Autor();
		$autor->AuthorID = $row["AuthorID"];
		$autor->nameF = $row["nameF"];
		$autor->nameL = $row["nameL"];

		$autor->livros = $this->livroDAO->getLivroByAutor($conn, $row["AuthorID"]);

		return $autor;
	}

}

?>