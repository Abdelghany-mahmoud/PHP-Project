<?php require 'config/dbconfig.php'; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$_SESSION['id'] = [1];
$ob = new DBconnection();
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

  <div class="container Latest order">
    <div class="justify-content-center align-items-center d-flex flex-column bg-secondary mb-3 p-2">
      <h1>Latest order</h1>
      <div class="justify-content-center align-items-center d-flex">
        <?php
        $query  = 'SELECT product_id FROM order_items where order_id =
        (SELECT id FROM orders where user_id= ? ORDER BY date DESC LIMIT 1)';
        $order_items = $ob->select($query, $_SESSION['id']);
        // var_dump($order_items);

        foreach ($order_items as $item) {
          $query3  = 'select * from products where id = ?';
          $product = $ob->select($query3, [$item['product_id']]);

          // var_dump($product);
          foreach ($product as $product) {
        ?>
            <label for="<?php echo $product['name'] ?>" class="mb-3">
              <div class="justify-content-center align-items-center d-flex rounded-5 rounded-top-0 me-5"
                style=" background-color: aqua; overflow:hidden; width:100px; height:90px;">
                <img src="imgs/<?php echo $product['image'] ?>" class="<?php echo $product['name'] ?>" alt="<?php echo $product['name'] ?>"
                  width="140%">
              </div>
            </label>
        <?php
          }
        }


        ?>
      </div>
    </div>
    <form action="index.php" method="post">
      <div class="row">
        <?php
        $query3  = 'select * from products';
        $products = $ob->selectAll($query3);
        // var_dump($products);
        foreach ($products as $product) {

        ?>

          <div style="overflow: hidden; background-color: #efefef;"
            class="m-2 <?php echo $product['name'] ?> col-4 p-2 justify-content-center align-items-center d-flex flex-column">
            <h3><?php echo strtoupper($product['name']) ?></h3>
            <label for="<?php echo $product['name'] ?>" class="mb-3">
              <div class="justify-content-center align-items-center d-flex rounded-5 rounded-top-0"
                style=" background-color: aqua; overflow:hidden; width:200px; height:180px;">
                <img src="imgs/<?php echo $product['image'] ?>" class="<?php echo $product['name'] ?>" alt="<?php echo $product['name'] ?>"
                  width="140%">
              </div>
            </label>
            <h5>Amount: </h5>
            <input type="number" name="<?php echo $product['id'] ?>" id="<?php echo $product['name'] ?>">
          </div>

        <?php
        }
        ?>
      </div>
      <input type="submit" class="my-5">
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>