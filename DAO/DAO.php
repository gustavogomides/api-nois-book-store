<?php 

Class DAO {

	public function executeQuery($conn, $query){
		return mysqli_query($conn,$query);
	}

}

?>