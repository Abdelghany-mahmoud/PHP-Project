  <?php require 'config/dbconfig.php'; ?>
  <?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  $ob = new DBconnection();
  var_dump($_POST);

  $query  = 'select * from users';
  $query2 = 'select * from orders';
  $query3 = 'select * from order_items';
  $query4 = 'select * from products';
  // var_dump($ob->selectAll($query));
  var_dump($ob->selectAll($query2));
  var_dump($ob->selectAll($query3));
  // var_dump($ob->selectAll($query4));

  $Uid = 1;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $queryi = 'insert into orders (user_id) values(?)';
    $ob->DML($queryi, [$Uid]);
    $LOI_query = 'SELECT id FROM orders ORDER BY ID DESC LIMIT 1'; //LOI 'last order id'
    $LOI = $ob->selectAll($LOI_query)[0]['id'];

    foreach ($_POST as $k => $v) {
      $Item_Price_query = 'select price from products where id =?';
      $Item_Price = $ob->select($Item_Price_query, [$k])[0]['price'];
      $priceTotal = $Item_Price * $v;
      $queryi2 = 'INSERT INTO order_items values(?,?,?,?)';
      $ob->DML($queryi2, [$LOI, $k, $v, $priceTotal]);
    }

    var_dump($ob->selectAll($query2));
    var_dump($ob->selectAll($query3));

    $calc_price_query = 'SELECT sum(price) as total_price from order_items where order_id=?';
    $Total_Order_Price = $ob->select($calc_price_query, [$LOI])[0]['total_price'];
    $update_price_query = 'update orders set total_price =? where id=?';
    $ob->DML($update_price_query, [$Total_Order_Price, $LOI]);

    var_dump($ob->selectAll($query2));
  }
  ?>











