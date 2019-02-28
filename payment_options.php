<?php
  include("includes/db.php");
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  
</head>
<body>
  <div style="margin-top:75px;">
    <h1>Payment Options for you</h1>
    <?php

    $ip = getRealIpAddr();
    $get_customers =  "SELECT * FROM customers WHERE customer_ip = '$ip'";
    $query_run = mysqli_query( $conn ,  $get_customers );
    $customer = mysqli_fetch_array($query_run);
    $customer_id = $customer['customer_id'];

    ?>
    <b>Pay With</b>&nbsp<img src="images/paypal_logo.png" alt="" width="180" height="80"><b>OR <a href="order.php?c_id=<?php echo $customer_id; ?>">Payoffline</a></b>
  </div>
</body>
</html>