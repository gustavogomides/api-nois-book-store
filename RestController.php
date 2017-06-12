<?php		
require_once("RestHandler.php");
require_once("handlers/CategoriaHandler.php");
require_once("handlers/LivroHandler.php");
require_once("handlers/AutorHandler.php");
require_once("handlers/ShoppingCartHandler.php");
require_once("handlers/SearchHandler.php");
require_once("handlers/LoginHandler.php");

$method = "";
if(isset($_GET["method"]))
	$method = $_GET["method"];

switch($method){
	//// LIVRO
	case "listLivro":
		$livroHandler = new LivroHandler();
		$livroHandler->listLivros();
		break;
		
	case "getLivroByIsbn":
		$livroHandler = new LivroHandler();
		$livroHandler->getLivroByIsbn($_GET["isbn"]);
		break;

	case "getLivroByTitle":
		$livroHandler = new LivroHandler();
		$livroHandler->getLivroByTitle($_GET["title"]);
		break;

	case "getLivroByCategoria":
		$livroHandler = new LivroHandler();
		$livroHandler->getLivroByCategoria($_GET["categoriaNome"]);
		break;

	case "getLivroByAuthorName":
		$livroHandler = new LivroHandler();
		$livroHandler->getLivroByAuthorName($_GET["authorName"]);
		break;
	
	case "inserirLivro":
		$livroHandler = new LivroHandler();
		$json_str = file_get_contents('php://input');
		$livro = json_decode($json_str);
		$livroHandler->inserirLivro($livro);
		break;
	
	case "updateLivro":
		$livroHandler = new LivroHandler();
		$json_str = file_get_contents('php://input');
		$livro = json_decode($json_str);
		$livroHandler->updateLivro($livro);
		break;
	
	case "deleteLivro":
		$livroHandler = new LivroHandler();
		$livroHandler->deleteLivro($_GET["id"]);
		break;

	//// CATEGORIA
	case "listCategoria":
		$categoriaHandler = new CategoriaHandler();
		$categoriaHandler->listCategorias();
		break;

	case "getCategoriaID":
		$categoriaHandler = new CategoriaHandler();
		$categoriaHandler->getCategoriaID($_GET["nome"]);
		break;

	case "inserirCategoria":
		$categoriaHandler = new CategoriaHandler();
		$json_str = file_get_contents('php://input');
		$categoria = json_decode($json_str);
		$categoriaHandler->inserirCategoria($categoria);
		break;

	case "getCategoriaByID":
		$categoriaHandler = new CategoriaHandler();
		$categoriaHandler->getCategoriaByID($_GET["id"]);
		break;
	
	case "updateCategoria":
		$categoriaHandler = new CategoriaHandler();
		$json_str = file_get_contents('php://input');
		$categoria = json_decode($json_str);
		$categoriaHandler->updateCategoria($categoria);
		break;
	
	case "deleteCategoria":
		$categoriaHandler = new CategoriaHandler();
		$categoriaHandler->deleteCategoria($_GET["id"]);
		break;

	//// AUTOR
	case "listAutor":
		$autorHandler = new AutorHandler();
		$autorHandler->listAutores();
		break;

	case "inserirAutor":
		$autorHandler = new AutorHandler();
		$json_str = file_get_contents('php://input');
		$autor = json_decode($json_str);
		$autorHandler->inserirAutor($autor);
		break;

	case "getAutorByID":
		$autorHandler = new AutorHandler();
		$autorHandler->getAutorByID($_GET["id"]);
		break;
	
	case "updateAutor":
		$autorHandler = new AutorHandler();
		$json_str = file_get_contents('php://input');
		$autor = json_decode($json_str);
		$autorHandler->updateAutor($autor);
		break;
	
	case "deleteAutor":
		$autorHandler = new AutorHandler();
		$autorHandler->deleteAutor($_GET["id"]);
		break;

	case "getAutorByIsbn":
		$autorHandler = new AutorHandler();
		$autorHandler->getAutorByIsbn($_GET["isbn"]);
		break;

	//// SEARCH
	case "searchBooks":
		$searchHandler = new SearchHandler();
		$searchHandler->searchBooks($_GET["search"]);
		break;

	//// SHOPPING CART
	case "validEmail":
		$shoppingCartHandler = new ShoppingCartHandler();
		$shoppingCartHandler->validEmail($_GET["email"]);
		break;

	case "validState":
		$shoppingCartHandler = new ShoppingCartHandler();
		$shoppingCartHandler->validState($_GET["state"]);
		break;

	case "getCustomer":
		$shoppingCartHandler = new ShoppingCartHandler();
		$shoppingCartHandler->getCustomer($_GET["email"]);
		break;

	case "insertCustomer":
		$shoppingCartHandler = new ShoppingCartHandler();
		$json_str = file_get_contents('php://input');
		$customer = json_decode($json_str);
		$shoppingCartHandler->insertCustomer($customer);
		break;

	case "updateCustomer":
		$shoppingCartHandler = new ShoppingCartHandler();
		$json_str = file_get_contents('php://input');
		$customer = json_decode($json_str);
		$shoppingCartHandler->updateCustomer($customer);
		break;

	case "insertBookOrders":
		$shoppingCartHandler = new ShoppingCartHandler();
		$json_str = file_get_contents('php://input');
		$bookOrders = json_decode($json_str);
		$shoppingCartHandler->insertBookOrders($bookOrders);
		break;

	case "insertBookOrdersItems":
		$shoppingCartHandler = new ShoppingCartHandler();
		$json_str = file_get_contents('php://input');
		$bookOrdersItems = json_decode($json_str);
		$shoppingCartHandler->insertBookOrdersItems($bookOrdersItems);
		break;
	
	case "enviarEmail":
		$shoppingCartHandler = new ShoppingCartHandler();
		$json_str = file_get_contents('php://input');
		$email = json_decode($json_str);
		$shoppingCartHandler->enviarEmail($email);
		break;

	case "getHistorico":
		$shoppingCartHandler = new ShoppingCartHandler();
		$shoppingCartHandler->getHistorico($_GET["custID"]);
		break;

	//// Login
	case "login":
		$loginHandler = new LoginHandler();
		$json_str = file_get_contents('php://input');
		$json_obj = json_decode($json_str);
		$loginHandler->login($json_obj->email, $json_obj->senha);
		break;

	case "" :
		//404 - not found;
		break;
}
?>
