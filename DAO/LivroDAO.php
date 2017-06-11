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
				array_push($livros_arr["livros"], $this->gerarLivro($row, false));
            }			
		}

		return $livros_arr;

	}

	public function getLivroByIsbn($conn, $isbn){
		$query = "SELECT * FROM bookdescriptions bd 
					RIGHT JOIN bookcategoriesbooks bcb ON bd.ISBN = bcb.ISBN 
					RIGHT JOIN bookauthorsbooks bab ON bd.ISBN = bab.ISBN
					LEFT JOIN bookcategories bc ON bc.CategoryID = bcb.CategoryID
                    LEFT JOIN bookauthors ba ON ba.AuthorID = bab.AuthorID
					WHERE bd.ISBN = '" . $isbn . "'";

        $livros_arr["livros"] = array();

        $result = $this->executeQuery($conn, $query);
		
		if ($result) {
			$row = mysqli_fetch_array($result, MYSQLI_BOTH);            
			return $this->gerarLivro($row, true);
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
				return $this->gerarLivro($row, false);	
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
				array_push($livros_arr["livros"], $this->gerarLivro($row, false));
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
		
		$this->base64_to_jpeg($livro->image, $livro->isbn);

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
		if($livro->image != ''){
			$this->base64_to_jpeg($livro->image, $livro->ISBN);
		}

		$query1 = "UPDATE bookauthorsbooks SET AuthorID = '" . $livro->AuthorID ."' WHERE ISBN ='" . $livro->ISBN ."'";
		$query2 = "UPDATE bookcategoriesbooks SET CategoryID = '" . $livro->CategoryID ."' WHERE ISBN ='" . $livro->ISBN ."'";
		$query3 = "UPDATE " . $this->tableName . " SET 
								title = '".$livro->title."',
								description = '".$livro->description."',
								price = '".$livro->price."',
								publisher = '".$livro->publisher."',
								pubdate = '".$livro->pubdate."' ,
								edition = '".$livro->edition."',
								pages = '".$livro->pages."'
				WHERE ISBN = '".$livro->ISBN."'";
        $result1 = $this->executeQuery($conn, $query1);
		$result2 = $this->executeQuery($conn, $query2);
        $result3 = $this->executeQuery($conn, $query3);
	}

	public function deleteLivro($conn, $id){
		$query1 = "DELETE FROM bookauthorsbooks WHERE ISBN = '".$id."'";
		$query2 = "DELETE FROM bookcategoriesbooks WHERE ISBN = '".$id."'";
		$query3 = "DELETE FROM bookdescriptions WHERE ISBN = '".$id."'";

        $result1 = $this->executeQuery($conn, $query1);
        $result2 = $this->executeQuery($conn, $query2);
        $result3 = $this->executeQuery($conn, $query3);
	}

	private function gerarLivro($row, $existeAtributo){
		$livro = new Livro();
		$livro->ISBN = $row["ISBN"];
		$livro->title = $row["title"];
		$livro->description = $row["description"];
		$livro->price = $row["price"];
		$livro->publisher = $row["publisher"];
		$livro->pubdate = $row["pubdate"];
		$livro->edition = $row["edition"];
		$livro->pages = $row["pages"];
		
		if($existeAtributo){
			$livro->CategoryName = $row["CategoryName"];
			$livro->nameL = $row["nameL"];	
		}		

		return $livro;
	}


	function base64_to_jpeg($base64_string, $isbn) {
		$data = explode( ',', $base64_string );
		$fileExtension = explode(';', explode('/', $data[0])[1])[0];
		$output_file = "../nois-book-store/img/capas/".$isbn.'.'.$fileExtension;
		$ifp = fopen( $output_file, 'wb' ); 
		fwrite( $ifp, base64_decode( $data[ 1 ] ) );
		fclose( $ifp ); 
		return $output_file; 
	}
}
?>