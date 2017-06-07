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
    }

}
