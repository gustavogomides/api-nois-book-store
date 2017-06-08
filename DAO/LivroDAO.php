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
		
		$this->base64_to_jpeg($livro->image, "test.png");

		$query1 = "INSERT INTO bookauthorsbooks ( ISBN, AuthorID) VALUES ('" . $livro->isbn ."','" . $livro->AuthorID ."')";
		$query2 = "INSERT INTO bookcategoriesbooks (CategoryID, ISBN) VALUES ('" . $livro->CategoryID ."','" . $livro->isbn ."')";
		$query3 = "INSERT INTO bookdescriptions
				(ISBN, title, description, price, publisher, pubdate, edition, pages) 
				VALUES ('" . $livro->isbn ."',
						'" . $livro->title ."',
						'" . $livro->description ."',
						" . $livro->price .",
						'" . $livro->publisher ."',
						'" . $livro->pubdate ."',
						" . $livro->edition .",
						" . $livro->pages .")";
				
        $result1 = $this->executeQuery($conn, $query1);
        $result2 = $this->executeQuery($conn, $query2);
        $result3 = $this->executeQuery($conn, $query3);

        if($result1 && $result2 && $result3){
        	return true;
        }else{
        	return false;
        }
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
		$query1 = "DELETE FROM bookauthorsbooks WHERE ISBN = '".$id."'";
		$query2 = "DELETE FROM bookcategoriesbooks WHERE ISBN = '".$id."'";
		$query3 = "DELETE FROM bookdescriptions WHERE ISBN = '".$id."'";

        $result1 = $this->executeQuery($conn, $query1);
        $result2 = $this->executeQuery($conn, $query2);
        $result3 = $this->executeQuery($conn, $query3);
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


	function base64_to_jpeg($base64_string, $output_file) {
		// open the output file for writing
		$ifp = fopen( $output_file, 'wb' ); 

		// split the string on commas
		// $data[ 0 ] == "data:image/png;base64"
		// $data[ 1 ] == <actual base64 string>
		$data = explode( ',', $base64_string );

		// we could add validation here with ensuring count( $data ) > 1
		fwrite( $ifp, base64_decode( $data[ 1 ] ) );

		// clean up the file resource
		fclose( $ifp ); 

		return $output_file; 
	}


}
?>