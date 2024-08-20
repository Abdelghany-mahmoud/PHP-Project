<?php require 'config/dbconfig.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');
$ob = new DBconnection();
?>

<style>
  table,
  th,
  td {
    border: 1px solid black;
    border-collapse: collapse;
  }

  th,
  td {
    padding: 10px;
    text-align: center;
  }
</style>
<h1>My Orders</h1>
<table>
  <tr>
    <th>Date</th>
    <th>Status</th>
    <th>Amount</th>
    <th>Action</th>
  </tr>

  <?php
  $query2 = 'select * from orders where user_id=?';
  $_SESSION['id'] = 1;
  $id = [$_SESSION['id']];
  $result = $ob->select($query2, $id);
  for ($i = 0; count($result) > $i; $i++) {
  ?>
    <tr>
      <td><?php echo $result[$i]['date'] ?></td>
      <td><?php echo $result[$i]['status'] ?></td>
      <td><?php echo $result[$i]['total_price'] ?></td>
      <td>
        <?php
        if ($result[$i]['status'] == 'Pending') {
        ?>
          <script>
            function showOrderDertails() {
            }
          </script>
          <button onclick="showOrderDertails()">Details</button>
          <button>Cancel</button>
        <?php
        }
        ?>
      </td>
    </tr>
  <?php
  }
  ?>

</table>
<br><br>
<hr><br>
<table>
  <tr>
    <th>Product</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Total Price</th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>