<?php 
Class SearchDAO extends DAO {

	public function searchBooks($conn, $search){

        $query = "SELECT DISTINCT d.isbn, title, description, price
                    FROM bookauthors a, bookauthorsbooks ba, bookdescriptions d,
                            bookcategoriesbooks cb, bookcategories c
                    WHERE a.AuthorID = ba.AuthorID
                        AND ba.ISBN = d.ISBN
                        AND d.ISBN = cb.ISBN
                        AND c.CategoryID = cb.CategoryID
                        AND (CategoryName = '$search'
                        OR title LIKE '%$search%'
                        OR description LIKE '%$search%'
                        OR publisher LIKE '%$search%' 
                        OR concat_ws(' ', nameF, nameL, nameF) LIKE '%$search%' )
                    ORDER BY title";
		
		$search_arr["search"] = array();
		
		$result = $this->executeQuery($conn, $query);

		if ($result) {
			while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
				array_push($search_arr["search"], $this->gerarSearch($row));
            }			
		}

		return $search_arr;
	}

	private function gerarSearch($row){
		$search = new Search();
        $search->isbn = $row['isbn'];
        $search->title= $row['title'];
        $search->description= $row['description'];
        $search->price= $row['price'];

		return $search;
	}

}
?>