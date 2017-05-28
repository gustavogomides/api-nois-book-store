<?php

include_once('./DAO/ShoppingCartDAO.php');
include_once('./models/ShoppingCart.php');

class ShoppingCartController{

    private $cookieName = "myCart";
    private $conn;
    private $shoppingCartDAO;

    public function __construct($db){
        $this->conn = $db;
        $this->shoppingCartDAO = new ShoppingCartDAO();
        $this->retriveCookie();
    }

    public function shoppingCartInfo(){
        foreach ($this->shoppingCartDAO->bookArray as $isbn => $qty) {
		     $this->shoppingCartDAO->bookInfo($this->conn, $isbn);
             $this->shoppingCartDAO->total = $this->shoppingCartDAO->price * $qty;
             $this->shoppingCartDAO->subTot = $this->shoppingCartDAO->subTot + $total;
             $this->shoppingCartDAO->bookCount = $this->shoppingCartDAO->bookCount + $qty;
             $this->shoppingCartDAO->shipping = ($this->shoppingCartDAO->bookcount -1) *3 +5;
        }
	}

    // Retrieve cookie and unserialize into $bookArray
    public function retriveCookie(){
        if (isset($_COOKIE[$this->cookieName])) {
            $this->shoppingCartDAO->bookArray = unserialize($_COOKIE[$this->cookieName]);
        }
    }

    // Add items to cart
    public function addBooksToCart($addISBN){
        if (strlen($addISBN) > 0) {
            if (isset($addISBN, $this->shoppingCartDAO->bookArray)) {
                // Increment by +1
                $this->shoppingCartDAO->bookArray[$addISBN] += 1;
            } else {
                // Add new item to cart
                 $this->shoppingCartDAO->bookArray[$addISBN] += 1;
            }
        }
        
        $this->setCookies();
        $this->shoppingCartInfo();

        return $this->shoppingCartDAO;
    }

    // Remove items from cart
    public function removeBooksFromCart($deleteISBN){
        if (strlen($deleteISBN) > 0) {
            if (isset($this->shoppingCartDAO->bookArray[$deleteISBN])) {
                // Deincrement by 1
                $this->shoppingCartDAO->bookArray[$deleteISBN] -= 1;
                // remove ISBN from array if qty==0
                if ($this->shoppingCartDAO->bookArray[$deleteISBN] == 0) {
                    unset($this->shoppingCartDAO->bookArray[$deleteISBN]);
                }
            }
        }

        $this->setCookies();
        $this->shoppingCartInfo();

        return $this->shoppingCartDAO;
    }

    // Set cookies
    private function setCookies(){
        if (isset($this->shoppingCartDAO->bookArray)) {
            // Write cookie
            setcookie($this->cookieName, serialize($this->shoppingCartDAO->bookArray), time() + 60 * 60 * 24 * 180);

            // Count total books in cart
            $totalbooks = 0;
            foreach ($this->shoppingCartDAO->bookArray as $isbn => $qty) {
                $totalbooks += $qty;
            }

            setCookie('BookCount', $totalbooks, time() + 60 * 60 * 24 * 180);
        }
    }

}
