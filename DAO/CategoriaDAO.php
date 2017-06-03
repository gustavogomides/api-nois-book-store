<?php 

include_once('DAO.php');

Class CategoriaDAO extends DAO {

	private $tableName = "bookcategories";

	public function listCategorias($conn){

		$query = "SELECT DISTINCT * FROM " . $this->tableName . " ORDER BY CategoryName ASC";
		
		$categorias_arr["categorias"] = array();
		
		$result = $this->executeQuery($conn, $query);

		if ($result) {
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				array_push($categorias_arr["categorias"], $this->gerarCategoria($row));
            }			
		
		}

		return $categorias_arr;

	}

	public function getCategoriaID($conn, $nome){
		$query = "SELECT CategoryID FROM " . $this->tableName . " WHERE CategoryName = '" . $nome . "'";
		
		$result = $this->executeQuery($conn, $query);

		if ($result) {
			$row = mysqli_fetch_array($result, MYSQLI_BOTH);            
			return $row["CategoryID"];
        }else{
			return null;
		}

	}

	public function inserirCategoria($conn, $categoria){
		$query = "INSERT INTO bookcategories
				(CategoryName) 
				VALUES ('" . $categoria->nome ."')";

       $result = $this->executeQuery($conn, $query);
	}

	public function getCategoriaByID($conn, $id){
		$query = "SELECT * FROM " . $this->tableName . " WHERE CategoryID = '" . $id . "'";

        $result = $this->executeQuery($conn, $query);
		
		if ($result) {
			$row = mysqli_fetch_array($result, MYSQLI_BOTH);            
			return $this->gerarCategoria($row);
        }else{
			return null;
		}
	}

	public function updateCategoria($conn, $id, $nome){
		$query = "UPDATE " . $this->tableName . " SET CategoryName = '".$nome."' WHERE CategoryID = '".$id."'";
        $result = $this->executeQuery($conn, $query);
	}

	public function deleteCategoria($conn, $id){
		$query = "DELETE FROM " . $this->tableName . " WHERE CategoryID = '".$id."'";
        $result = $this->executeQuery($conn, $query);
	}

	private function gerarCategoria($row){
		$categoria = new Categoria();
		$categoria->CategoryID = $row["CategoryID"];
		$categoria->CategoryName = $row["CategoryName"];

		return $categoria;
	}

}
?>