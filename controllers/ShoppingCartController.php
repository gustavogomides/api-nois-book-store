<?php

include_once('./DAO/ShoppingCartDAO.php');
include_once('./models/ShoppingCart.php');

class ShoppingCartController{

    private $cookieName = "myCart";
    private $conn;
    private $shoppingCartDAO;
    private $shoppingCart;
    private $bookArray;
    private $book;

    public function __construct($db){
        $this->conn = $db;
        $this->shoppingCartDAO = new ShoppingCartDAO();
        $this->shoppingCart = new ShoppingCart();
        $this->retriveCookie(); 
    }

    public function shoppingCartInfo(){
        foreach ($this->bookArray as $isbn => $qty) {
            // Book information
		     $bookInfo = $this->shoppingCartDAO->bookInfo($this->conn, $isbn);
             $price = $bookInfo["price"];
             $title = $bookInfo["title"];             
             $total = $price * $qty;

             // Shipping cart information
             $this->shoppingCart->subTot = $this->shoppingCart->subTot + $total;
             $this->shoppingCart->bookCount = $this->shoppingCart->bookCount + $qty;
             $this->shoppingCart->shipping = ($this->shoppingCart->bookCount - 1) *3 + 5;
             $this->shoppingCart->total = $this->shoppingCart->subTot + $this->shoppingCart->shipping;

             // Array of books ordered
             $this->book[$isbn]->isbn = $isbn;
             $this->book[$isbn]->title = $title;
             $this->book[$isbn]->price = $price;
             $this->book[$isbn]->qty = $qty;
             $this->book[$isbn]->total = $price * $qty;

             // The list of books
             array_push($this->shoppingCart->bookList, $this->book[$isbn]);
        }
	}

    // Retrieve cookie and unserialize into $bookArray
    public function retriveCookie(){
        if (isset($_COOKIE[$this->cookieName])) {
            $this->bookArray = unserialize($_COOKIE[$this->cookieName]);
        }
    }

    // Add items to cart
    private function addBooksToCart($addISBN){
        if (strlen($addISBN) > 0) {
            if (isset($addISBN, $this->bookArray)) {
                // Increment by +1
                $this->bookArray[$addISBN] += 1;
            } else {
                // Add new item to cart
                 $this->bookArray[$addISBN] += 1;
            }
        }
        
        $this->setCookies();
        $this->shoppingCartInfo();

        return $this->shoppingCart;
    }

    // Remove items from cart
    public function removeBooksFromCart($deleteISBN){
        if(strlen($deleteISBN)>0){
            if(isset($this->bookArray[$deleteISBN])){
                 // Deincrement by 1
                $this->bookArray[$deleteISBN] -= 1;
                // remove ISBN from array if qty==0
                if ($this->bookArray[$deleteISBN] == 0) {
                    unset($this->bookArray[$deleteISBN]);
                }
            }
        }

        $this->setCookies();
        $this->shoppingCartInfo();

        return $this->shoppingCart;
    }    

    public function booksToCart($ISBN){
        $method = substr($ISBN,0,3);
        $isbn = substr($ISBN,3);

        if($method == "add"){
            return $this->addBooksToCart($isbn);
        }else if($method == "rem"){
            return $this->removeBooksFromCart($isbn);
        }
    }

    // Set cookies
    private function setCookies(){
        if (isset($this->bookArray)) {
            // Write cookie
            setcookie($this->cookieName, serialize($this->bookArray), time() + 60 * 60 * 24 * 180);

            // Count total books in cart
            $totalbooks = 0;
            foreach ($this->bookArray as $isbn => $qty) {
                $totalbooks += $qty;
            }

            setCookie('BookCount', $totalbooks, time() + 60 * 60 * 24 * 180);
        }
    }

}
