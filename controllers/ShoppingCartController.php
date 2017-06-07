<?php

include_once('./DAO/ShoppingCartDAO.php');
include_once('./models/ShoppingCart.php');
include_once('./models/Customer.php');
include_once('./util/ValidationUtilities.php');

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

    public function validEmail($email){
        return fIsValidEmail($email);
    }

    public function getCustomer($email){
        return $this->shoppingCartDAO->getCustomer($this->conn, $email);
    }

}
