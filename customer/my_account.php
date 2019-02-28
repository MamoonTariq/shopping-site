<?php
SESSION_START();
include("includes/db.php");
include("../functions/functions.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/index.css" media="all" />
</head>
<body>
   
    <div class="container">  <!--Div Containter Starts -->
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../all_products.php">All Products</a></li>
                    <li><a href="my_account.php">My Account</a></li>  
                    <li><a href="../user_register.php">Sign Up</a></li>
                    <li><a href="../cart.php">Shopping Cart</a></li>
                    <li><a href="../contact.php">Contact Us</a></li>  
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li id="nav-search">
                        <form class="navbar-form" method="get" enctype="multipart/form-data" action="results.php" >
                            <div class="input-group add-on">
                            <input class="form-control" placeholder="Search" spellcheck="false"  type="text" name="user_query">
                            <div class="input-group-btn">
                                <input class="btn" id="search-btn" type="submit" value="Search" name="searchs">
                            </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </nav> <!--End of nav-collapse -->
            <!-- Start a content part -->
        <div class="wrapper">
            <div class="row">

            <div class="col-md-10 content"> <!--Start Of Content-->
                    <div class="row">
                        <div class="header">
                            <div class="header-content"> <?php cart() ;?>
                                <b>
                                <?php
                                    if (!isset($_SESSION['customer_email'])) {
                                      echo "Welcome Guest" ;
                                    } else {
                                        echo "<span style='color:red;'>Welcome</span>   ". $_SESSION['customer_email']; 
                                    }
                                 ?>
                                </b>
                               
                                <?php
                                    if (!isset($_SESSION['customer_email'])) {
                                      echo "<a href='../checkout.php'  class='btn btn-danger' >Login</a>" ;
                                    } else {
                                        echo "<a href='../logout.php'  class='btn btn-danger' >Logout</a>" ; 
                                    }
                                 ?>
                                 </span>
                            </div>
                        </div>
                    </div> <!--End of header of welcome cart-->

                    <div class="row">
                       <div class="wrapper order-list">
                          <h1 style="text-align:center; color:white">Manage Your Account Here</h1>
                            <?php
                            getDefault();
                            ?>

                            <?php
                                if (isset($_GET['my_orders'])) {
                                    include("my_orders.php");
                                }
                            ?>
                       </div>
                    </div>
                </div> <!--End Of Content-->

                <div class="col-md-2 categories"> <!--Start Of Left Side Bar Content-->
                    <h3 id="category-title">Manage Account</h3>
                    <div class="list-group"> <!-- Start a Categories -->
                        <ul>
                            <li><a href='my_account.php?my_orders' class='list-group-item'>My Orders</a></li>
                            <li><a href='edit.php' class='list-group-item'>Edit Account</a></li>
                            <li><a href='index.php' class='list-group-item'>Change Password</a></li>
                            <li><a href='index.php' class='list-group-item'>Delete Account</a></li>
                            <li><a href='../logiut.php' class='list-group-item'>Logout</a></li>
                            
                        </ul>
                    </div> <!-- End a Categories -->
                   
                </div> <!--End Of Left Side Bar of Content-->


                
            </div>
        </div>
    </div><!--Div Containter End -->




    <!--Attach Javascript Libraries-->
    <script src="js/bootstrap.js"></script>
</body>
</html>