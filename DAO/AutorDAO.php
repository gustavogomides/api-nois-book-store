<?php 

include_once('DAO.php');

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

	public function inserirAutor($conn, $autor){
		$query = "INSERT INTO bookauthors
				(nameF, nameL) 
				VALUES ('" . $autor->nameF ."','" . $autor->nameL ."')";
		
		$result = $this->executeQuery($conn, $query);
	}

	public function getAutorByID($conn, $id){
		$query = "SELECT * FROM " . $this->tableName . " WHERE AuthorID = '" . $id . "'";

        $result = $this->executeQuery($conn, $query);
		
		if ($result) {
			$row = mysqli_fetch_array($result, MYSQLI_BOTH);            
			return $this->gerarAutor($conn, $row);
        }else{
			return null;
		}
	}

	public function updateAutor($conn, $autor){
		$query = "UPDATE " . $this->tableName . " SET nameF = '".$autor->nome."', nameL = '".$autor->sobrenome."' WHERE AuthorID = '".$autor->id."'";
        $result = $this->executeQuery($conn, $query);
	}

	public function deleteAutor($conn, $id){
		$query = "DELETE FROM " . $this->tableName . " WHERE AuthorID = '".$id."'";
        $result = $this->executeQuery($conn, $query);
	}

	public function getAutorByIsbn($conn, $isbn){
		$query = "SELECT *
                FROM bookauthors, bookauthorsbooks
                WHERE bookauthorsbooks.ISBN = '$isbn'
                AND bookauthors.AuthorID = bookauthorsbooks.AuthorID
                ORDER BY nameL";

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