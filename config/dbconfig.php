<?php
class DBconnection
{
  private $servername = "localhost";
  private $username = "abdo";
  private $password = "123";
  private $database = "cafeteria";
  private $conn;
  private $rows;
  private $allrows;

  public function __construct()
  {
    $this->connect();
  }

  private function connect()
  {
    try {
      $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->database, $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }

  public function selectAll($query){
    $this->rows = $this->conn->query($query);
    $this->rows->execute();
    $this->allrows = $this->rows->fetchAll(PDO::FETCH_ASSOC);
    return $this->allrows;
  }

  public function select($query,$param){
    $this->rows = $this->conn->prepare($query);
    $this->rows->execute($param);
    $this->allrows = $this->rows->fetchAll(PDO::FETCH_ASSOC);
    return $this->allrows;
  }

  public function DML($query,$arr){
    $this->rows = $this->conn->prepare($query);
    $this->rows->execute($arr);
  }
}
