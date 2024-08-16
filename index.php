  <?php require '/var/www/html/PHP_Project/config/dbconfig.php';
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  $ob = new DBconnection();
  var_dump($_POST);

  foreach ($_POST as $k => $v){
    echo $k.' => '.$v;
    echo '</br>';
  }
  

  $query  = 'select * from users';
  $query2 = 'select * from orders';
  $query3 = 'select * from order_items';
  $query4 = 'select * from products';
  // var_dump($ob->select($query));
  // var_dump($ob->select($query2));
  // var_dump($ob->select($query3));
  // var_dump($ob->select($query4));


  $queryi = 'insert into orders (user_id) values(1)';
  $products = array("1"=>"2","2"=>"1");
  $queryi2 = 'insert into order_items (order_id,quantity) values (1,2)';
  // $ob->insert($query2,$products);

  
  ?>











