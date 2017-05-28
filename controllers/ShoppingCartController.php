<?php

include_once('./DAO/ShoppingCartDAO.php');
include_once('./models/ShoppingCart.php');

class ShoppingCartController{

    private $cookieName = "myCart";
    private $conn;
    private $shoppingCartDAO;
    private $shoppingCart;

    public function __construct($db){
        $this->conn = $db;
        $this->shoppingCartDAO = new ShoppingCartDAO();
        $this->shoppingCart = new ShoppingCart();
        $this->retriveCookie();
    }

    public function shoppingCartInfo(){
        foreach ($this->shoppingCart->bookArray as $isbn => $qty) {
		     $price = $this->shoppingCartDAO->bookInfo($this->conn, $isbn)["price"];
             $total = $price * $qty;
             $this->shoppingCart->subTot = $this->shoppingCart->subTot + $total;
             $this->shoppingCart->bookCount = $this->shoppingCart->bookCount + $qty;
             $this->shoppingCart->shipping = ($this->shoppingCart->bookCount - 1) *3 + 5;
             $this->shoppingCart->total = $this->shoppingCart->subTot + $this->shoppingCart->shipping;
        }
	}

    // Retrieve cookie and unserialize into $bookArray
    public function retriveCookie(){
        if (isset($_COOKIE["myCart"])) {
            $this->shoppingCart->bookArray = unserialize($_COOKIE[$this->cookieName]);
        }
    }

    // Add items to cart
    public function addBooksToCart($addISBN){
        if (strlen($addISBN) > 0) {
            if (isset($addISBN, $this->shoppingCart->bookArray)) {
                // Increment by +1
                $this->shoppingCart->bookArray[$addISBN] += 1;
            } else {
                // Add new item to cart
                 $this->shoppingCart->bookArray[$addISBN] += 1;
            }
        }
        
        $this->setCookies();
        $this->shoppingCartInfo();

        return $this->shoppingCart;
    }

    // Remove items from cart
    public function removeBooksFromCart($deleteISBN){
        if(strlen($deleteISBN)>0){
            if(isset($this->shoppingCart->bookArray[$deleteISBN])){
                 // Deincrement by 1
                $this->shoppingCart->bookArray[$deleteISBN] -= 1;
                // remove ISBN from array if qty==0
                if ($this->shoppingCart->bookArray[$deleteISBN] == 0) {
                    unset($this->shoppingCart->bookArray[$deleteISBN]);
                }
            }
        }

        $this->setCookies();
        $this->shoppingCartInfo();

        return $this->shoppingCart;
    }    

    // Set cookies
    private function setCookies(){
        if (isset($this->shoppingCart->bookArray)) {
            // Write cookie
            setcookie($this->cookieName, serialize($this->shoppingCart->bookArray), time() + 60 * 60 * 24 * 180);

            // Count total books in cart
            $totalbooks = 0;
            foreach ($this->shoppingCart->bookArray as $isbn => $qty) {
                $totalbooks += $qty;
            }

            setCookie('BookCount', $totalbooks, time() + 60 * 60 * 24 * 180);
        }
    }

}
