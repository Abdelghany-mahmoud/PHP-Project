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


  public function add_user()
  {
    if (isset($_FILES['image'])) {
      $upload_dir = '../uploads/users/';
      $product_image = $upload_dir . basename($_FILES['profile_pic']['name']);
      move_uploaded_file($_FILES['image']['tmp_name'], $product_image);
    } else {
      $product_image = '';
    }

    $query = "insert into users(name, email, password,room_no,ext,profile_pic,is_admin) values (?,?,?,?,?,?,?)";

    $stmt = $this->conn->prepare($query);

    $stmt->execute([$_POST['name'], $_POST['email'], $hashed_password, $_POST['room_no'], $_POST['ext'], $upload_dir . $_FILES['profile_pic']['name'], $_POST['is_admin']]);

    echo "user added successfully";
  }
}
