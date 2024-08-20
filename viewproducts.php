<?php require 'config/dbconfig.php'; ?>
<?php require 'product.php'; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$ob = new DBconnection();
$query = 'select * from products';
$products = $ob->selectAll($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Home</title>
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg bg-primary">
      <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
      </div>
    </nav>
  </div>

  <div class="container d-flex flex-column">
    <div class="align-self-end m-3"><a href="addProduct.php" class="btn btn-success">Add New Product</a></div>
    <table class="table table-striped mt-5 text-center">
      <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
      <?php
      if ($products) {

        foreach ($products as $product) {
      ?>
          <tr>
            <td> <?php echo ucfirst($product['name']); ?></td>
            <td> <?php echo $product['price']; ?> EGP</td>
            <td>
              <div style="width: 70px; height:70px; overflow:hidden;">
                <img width="100%" src=" imgs/<?php echo $product['image']; ?> ">
              </div>
            </td>
            <td>
              <button class="available btn btn-success"><?php echo ucfirst($product['availability']); ?></button>
              <a href="" class="btn btn-info">EDIT</a>
              <a href="" class="btn btn-danger">DELETE</a>
            </td>
          </tr>
      <?php
        }
      } else {
        echo '
        <tr>
          <td colspan="4">
            <div class="alert alert-primary" role="alert">
              You have no products to display ! <a href="addProduct.php" class="btn btn-success">Add Product</a>
            </div>
          </td>
        </tr>';
      }
      ?>
    </table>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script>
    $('.available').click(function() {
      if ($(this).text() == 'Available') {
        $(this).addClass('btn-warning').removeClass("btn-success").text('Unavailable')
      } else {
        $(this).addClass('btn-success').removeClass("btn-warning").text('Available')
      }
    })
  </script>
</body>

</html>