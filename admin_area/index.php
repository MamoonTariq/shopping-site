<?php
SESSION_START();
include("includes/db.php");
    if (!isset($_SESSION['email'])) {
        echo "<script>window.open('login.php' , '_self')</script>";
    } else{
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Area</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/index.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1>WELCOME TO ADMIN AREA</h1>
                <?php
                if (isset($_GET['insert_product'])) {
                   include("insert_product.php");
                }
                
                if (isset($_GET['view_products'])) {
                    include("view_products.php");
                 }

                ?>
            </div>
            
            <div class="col-md-3">
            <div class="list-group"> <!-- Start a Categories -->
                <h3>Manage Content</h3>
                        <ul>
                           <li><a href="index.php?insert_product" class='list-group-item'>Insert New Products</a></li>
                           <li><a href="index.php?view_products" class='list-group-item'>View All Products</a></li>

                           <li><a href="index.php?insert_cat" class='list-group-item'>Insert New Categories</a></li>
                           <li><a href="index.php?view_cats" class='list-group-item'>View All Categories</a></li>

                           <li><a href="index.php?insert_brand" class='list-group-item'>Insert New Brands</a></li>
                           <li><a href="index.php?insert_brands" class='list-group-item'>View All Brands</a></li>

                           <li><a href="index.php?view_customers" class='list-group-item'>View Customers</a></li>
                           <li><a href="index.php?view_orders" class='list-group-item'>View Orders</a></li>

                           <li><a href="index.php?view_payments" class='list-group-item'>View Payments</a></li>
                           <li><a href="logout.php" class='list-group-item'>Admin Logout</a></li>

    
                        </ul>
                    </div>
            </div>

        </div>
    </div>
    
</body>
</html>
                <?php }?>