  <?php require '/var/www/html/PHP_Project/config/dbconfig.php';
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  $ob = new DBconnection();
  var_dump($_POST);

  $query  = 'select * from users';
  $query2 = 'select * from orders';
  $query3 = 'select * from order_items';
  $query4 = 'select * from products';
  var_dump($ob->selectAll($query));
  var_dump($ob->selectAll($query2));
  var_dump($ob->selectAll($query3));
  var_dump($ob->selectAll($query4));

  $Uid = [1];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $queryi = 'insert into orders (user_id) values(?)';
    $ob->DML($queryi, $Uid);
    $LOI_query = 'SELECT id FROM orders ORDER BY ID DESC LIMIT 1'; //LOI 'last order id'
    $LOI = $ob->selectAll($LOI_query)[0]['id'];

    foreach ($_POST as $k => $v) {
      $Item_Price_query = 'select price from products where id =?';
      $K = [$k];
      $Item_Price = $ob->select($Item_Price_query, $K)[0]['price'];
      $priceTotal = $Item_Price * $v;
      $queryi2 = 'INSERT INTO order_items values(?,?,?,?)';
      $arr = [$LOI, $k, $v, $priceTotal];
      $ob->DML($queryi2, $arr);
    }

    var_dump($ob->selectAll($query2));
    var_dump($ob->selectAll($query3));

    $calc_price_query = 'SELECT sum(price) as total_price from order_items where order_id=?';
    $LOI2 = [$LOI];
    $Total_Order_Price = $ob->select($calc_price_query, $LOI2)[0]['total_price'];
    $update_price_query = 'update orders set total_price =? where id=?';
    $arr = [$Total_Order_Price, $LOI];
    $ob->DML($update_price_query, $arr);

    var_dump($ob->selectAll($query2));
  }
  ?>











