<?php 

include_once('DAO.php');

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

	public function inserirLivro($conn, $livro){
		//$this->fileUpload();
		$query1 = "INSERT INTO bookauthorsbooks ( ISBN, AuthorID) VALUES ('" . $livro->isbn ."','" . $livro->AuthorID ."')";
		$query2 = "INSERT INTO bookcategoriesbooks (CategoryID, ISBN) VALUES ('" . $livro->CategoryID ."','" . $livro->isbn ."')";
		$query3 = "INSERT INTO bookdescriptions
				(ISBN, title, description, price, publisher, pubdate, edition, pages) 
				VALUES ('" . $livro->isbn ."',
						'" . $livro->title ."',
						'" . $livro->description ."',
						'" . $livro->price ."',
						'" . $livro->publisher ."',
						'" . $livro->pubdate ."',
						'" . $livro->edition ."',
						'" . $livro->pages ."')";
		echo $query1;
		
        $result1 = $this->executeQuery($conn, $query1);
        $result2 = $this->executeQuery($conn, $query2);
        $result3 = $this->executeQuery($conn, $query3);
	}

	public function updateLivro($conn, $livro){
		$query = "UPDATE " . $this->tableName . " SET 
								ISBN = '".$livro->isbn."', 
								title = '".$livro->title."',
								description = '".$livro->description."',
								price = '".$livro->price."',
								publisher = '".$livro->pusblisher."',
								pubdate = '".$livro->pubdate."' ,
								edition = '".$livro->edition."',
								pages = '".$livro->pages."'
				WHERE ISBN = '".$livro->isbn."'";
        $result = $this->executeQuery($conn, $query);
	}

	public function deleteLivro($conn, $id){
		$query = "DELETE FROM " . $this->tableName . " WHERE ISBN = '".$id."'";
        $result = $this->executeQuery($conn, $query);
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


	public function fileUpload(){
		/* PUT data comes in on the stdin stream */
		$putdata = fopen("/home/francis/Imagens/heihei.png", "r");

		/* Open a file for writing */
		$fp = fopen("/home/francis/Imagens/asd.png", "w");

		/* Read the data 1 KB at a time
		and write to the file */
		while ($data = fread($putdata, 1024))
		fwrite($fp, $data);

		/* Close the streams */
		fclose($fp);
		fclose($putdata);
		echo 'fechou';
	}

}
?>