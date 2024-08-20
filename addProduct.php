<?php require 'config/dbconfig.php'; ?>
<?php require 'product.php'; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg bg-primary">
      <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
      </div>
    </nav>
  </div>

  <div class="container">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (
        empty($_POST['name'])
        || empty($_POST['price'])
        || empty($_POST['category'])
        || empty($_FILES['image']['name'])
      ) {
        echo '<div class="alert alert-danger col-3 m-3" role="alert">
            <h5 style="display:inline;">Pleasse Fill All Fields!</h5>
          </div>';
      } else {
        $ext = explode('/', $_FILES['image']['type'])[1];
        $image =$_POST['name'].".".$ext;
        $file_path = "imgs/" . $image;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $file_path)) {
          echo "Sorry, there was an error uploading your image.";
        }

        $newproduct = new Product($_POST['name'], $_POST['price'], $_POST['category'], $image);
        $newproduct->addProduct();
        echo '<div class="alert alert-success" role="alert">
                  <h5 style="display:inline;">Product added successfuly :)</h5>
                </div>';
      }
    }
    ?>
    <form action="addProduct.php" enctype='multipart/form-data' method="POST">
      <fieldset>
        <br>
        <label for="name">Product name: </label>
        <input type="text" name="name" id="name">
        <br><br>
        <label for="price">Price: </label>
        <input type="number" name="price" id="price">
        <br><br>
        <label for="category">Category: </label>
        <select name="category" id="category">
          <option value="Hot Drinks">Hot Drinks</option>
          <option value="other">other</option>
        </select>
        <br><br>
        <label for="image">Product picture: </label>
        <input type="file" name="image" id="image">
        <br><br>
        <input type="submit" value="Submit">
      </fieldset>
    </form>



  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>