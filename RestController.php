<?php		
$method = "";
if(isset($_GET["method"]))
	$method = $_GET["method"];
/*
controls the RESTful services
URL mapping
*/
switch($method){
	//// LIVRO
	case "listLivro":
		$restHandler = new RestHandler();
		$restHandler->listLivros();
		break;
		
	case "getLivroByIsbn":
		$restHandler = new RestHandler();
		$restHandler->getLivroByIsbn($_GET["isbn"]);
		break;

	case "getLivroByTitle":
		$restHandler = new RestHandler();
		$restHandler->getLivroByTitle($_GET["title"]);
		break;

	case "getLivroByCategoria":
		$restHandler = new RestHandler();
		$restHandler->getLivroByCategoria($_GET["categoriaNome"]);
		break;

	//// CATEGORIA
	case "listCategoria":
		$restHandler = new RestHandler();
		$restHandler->listCategorias();
		break;

	case "getCategoriaID":
		$restHandler = new RestHandler();
		$restHandler->getCategoriaID($_GET["nome"]);
		break;

	//// AUTOR
	case "listAutor":
		$restHandler = new RestHandler();
		$restHandler->listAutores();
		break;

	//// SEARCH
	case "searchBooks":
		$resHandler = new RestHandler();
		$restHandler->searchBooks($_GET["search"]);
		break;

	case "" :
		//404 - not found;
		break;
}
?>
