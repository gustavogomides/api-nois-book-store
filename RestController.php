<?php		
require_once("RestHandler.php");

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
	
	case "inserirLivro":
		$restHandler = new RestHandler();
		$json_str = file_get_contents('php://input');
		$livro = json_decode($json_str);
		$restHandler->inserirLivro($livro);
		break;
	
	case "updateLivro":
		$restHandler = new RestHandler();
		$json_str = file_get_contents('php://input');
		$livro = json_decode($json_str);
		$restHandler->updateLivro($livro);
		break;
	
	case "deleteLivro":
		$restHandler = new RestHandler();
		$restHandler->deleteLivro($_GET["id"]);
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

	case "inserirCategoria":
		$restHandler = new RestHandler();
		$json_str = file_get_contents('php://input');
		$categoria = json_decode($json_str);
		$restHandler->inserirCategoria($categoria);
		break;

	case "getCategoriaByID":
		$restHandler = new RestHandler();
		$restHandler->getCategoriaByID($_GET["id"]);
		break;
	
	case "updateCategoria":
		$restHandler = new RestHandler();
		$json_str = file_get_contents('php://input');
		$categoria = json_decode($json_str);
		$restHandler->updateCategoria($categoria);
		break;
	
	case "deleteCategoria":
		$restHandler = new RestHandler();
		$restHandler->deleteCategoria($_GET["id"]);
		break;

	//// AUTOR
	case "listAutor":
		$restHandler = new RestHandler();
		$restHandler->listAutores();
		break;

	case "inserirAutor":
		$restHandler = new RestHandler();
		$json_str = file_get_contents('php://input');
		$autor = json_decode($json_str);
		$restHandler->inserirAutor($autor);
		break;

	case "getAutorByID":
		$restHandler = new RestHandler();
		$restHandler->getAutorByID($_GET["id"]);
		break;
	
	case "updateAutor":
		$restHandler = new RestHandler();
		$json_str = file_get_contents('php://input');
		$autor = json_decode($json_str);
		$restHandler->updateAutor($autor);
		break;
	
	case "deleteAutor":
		$restHandler = new RestHandler();
		$restHandler->deleteAutor($_GET["id"]);
		break;


	//// SEARCH
	case "searchBooks":
		$restHandler = new RestHandler();
		$restHandler->searchBooks($_GET["search"]);
		break;

	//// SHOPPING CART
	case "validEmail":
		$restHandler = new RestHandler();
		$restHandler->validEmail($_GET["email"]);
		break;

	case "validState":
		$restHandler = new RestHandler();
		$restHandler->validState($_GET["state"]);
		break;

	case "getCustomer":
		$restHandler = new RestHandler();
		$restHandler->getCustomer($_GET["email"]);
		break;

	case "insertCustomer":
		$restHandler = new RestHandler();
		$json_str = file_get_contents('php://input');
		$customer = json_decode($json_str);
		$restHandler->insertCustomer($customer);
		break;

	case "updateCustomer":
		$restHandler = new RestHandler();
		$json_str = file_get_contents('php://input');
		$customer = json_decode($json_str);
		$restHandler->updateCustomer($customer);
		break;

	case "insertBookOrders":
		$restHandler = new RestHandler();
		$json_str = file_get_contents('php://input');
		$bookOrders = json_decode($json_str);
		$restHandler->insertBookOrders($bookOrders);
		break;

	case "insertBookOrdersItems":
		$restHandler = new RestHandler();
		$json_str = file_get_contents('php://input');
		$bookOrdersItems = json_decode($json_str);
		$restHandler->insertBookOrdersItems($bookOrdersItems);
		break;
	
	case "enviarEmail":
		$restHandler = new RestHandler();
		$json_str = file_get_contents('php://input');
		$email = json_decode($json_str);
		$restHandler->enviarEmail($email);
		break;

	//// Login
	case "login":
		$restHandler = new RestHandler();
		$json_str = file_get_contents('php://input');
		$json_obj = json_decode($json_str);
		$restHandler->login($json_obj->email, $json_obj->senha);
		break;

	case "" :
		//404 - not found;
		break;
}
?>
