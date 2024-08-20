<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Product
{

  private $name;
  private $price;
  private $category;
  private $image;

  private $conn;

  public function __construct($name,$price,$category,$image){
    $this->name=$name;
    $this->price=$price;
    $this->category=$category;
    $this->image=$image;
  }

  public function addProduct()
  {
    $this->conn = new DBconnection();
    $query='INSERT INTO products (name,price,category,image) values (?,?,?,?)';
    $this->conn->DML($query,[$this->name,$this->price,$this->category,$this->image]);
  }
}
