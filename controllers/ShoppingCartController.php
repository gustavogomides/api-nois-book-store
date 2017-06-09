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

    public function validState($state){
        return fIsValidStateAbbr($state);
    }

    public function getCustomer($email){
        return $this->shoppingCartDAO->getCustomer($this->conn, $email);
    }

    public function insertCustomer($customer){
        return $this->shoppingCartDAO->insertCustomer($this->conn, $customer);
    }

    public function updateCustomer($customer){
        return $this->shoppingCartDAO->updateCustomer($this->conn, $customer);
    }

    public function insertBookOrders($bookOrder){
        return $this->shoppingCartDAO->insertBookOrders($this->conn, $bookOrder);
    }

    public function insertBookOrdersItems($bookOrderItem){
        return $this->shoppingCartDAO->insertBookOrdersItems($this->conn, $bookOrderItem);
    }

    public function enviarEmail($email){
        $headers = "Nois Book Store";
        mail($email->email, "Ordem de confirmação de Compra na Nois Book Store!", $email->body, $headers);
    }    
}
