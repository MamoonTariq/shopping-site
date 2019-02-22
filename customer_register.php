<?php
SESSION_START();
include("includes/db.php");
include("functions/functions.php");
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
    <script src="js/jquery.js"></script>
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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="all_products.php">All Products</a></li>
                    <li><a href="my_account.php">My Account</a></li>  
                    <li><a href="user_register.php">Sign Up</a></li>
                    <li><a href="cart.php">Shopping Cart</a></li>
                    <li><a href="contact.php">Contact Us</a></li>  
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
                <div class="col-md-2 categories"> <!--Start Of Left Side Bar Content-->
                    <h1 id="category-title">Categories</h1>
                    <div class="list-group"> <!-- Start a Categories -->
                        <ul>
                            <?php
                                getCats();  
                            ?>
                        </ul>
                    </div> <!-- End a Categories -->
                    <h1 id="category-title">BRANDS</h1>
                    <div class="list-group"> <!-- Start a Brands -->
                        <ul>
                            <?php
                                getBrands();    
                            ?>
                        </ul>
                    </div> <!-- End a Brands -->
                </div> <!--End Of Left Side Bar of Content-->


                <div class="col-md-10 content"> <!--Start Of Content-->
                    <div class="row">
                        <div class="header">
                            <div class="header-content"> <?php cart() ;?>
                                <b>Welcome Guest</b>
                                <b style="color:yellow;">Shopping Cart</b>
                                <span> - Total Items :<?php items();?> - Total Price: <?php total_price();?> - <a href="cart.php" class="btn btn-warning">Go to Cart</a> 
                                <?php
                                    if (!isset($_SESSION['customer_email'])) {
                                      echo "<a href='checkout.php'  class='btn btn-danger' >Login</a>" ;
                                    } else {
                                        echo "<a href='logout.php'  class='btn btn-danger' >Logout</a>" ; 
                                    }
                                 ?>
                                 </span>
                            </div>
                        </div>
                    </div> <!--End of header of welcome cart-->

                    <div class="row">   <div class="col-md-2"></div>
                        <div class="col-md-8" style="margin-top:75px;">
                            <form action="customer_register.php" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="c_name">Name:</label>
                                <input type="text" class="form-control" placeholder="Enter Name" name="c_name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" placeholder="Enter password" name="c_email" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="pass">Password:</label>
                                <input type="password" class="form-control" placeholder="Enter password" name="c_pass" required>
                            </div>

                            <div class="form-group">
                                <label for="country">Country:</label>
                                <input type="text" class="form-control" placeholder="Enter Country" name="c_country" required>
                            </div>

                            <div class="form-group">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" placeholder="Enter City" name="c_city" required>
                            </div>

                            <div class="form-group">
                                <label for="contact">Contact:</label>
                                <input type="text" class="form-control" placeholder="Enter Contact" name="c_cont" required>
                            </div>

                            <div class="form-group">
                                <label for="add">Address:</label>
                                <input type="text" class="form-control" placeholder="Enter Address" name="c_addr" required>
                            </div>

                            <div class="form-group">
                                <label for="img">Image:</label>
                                <input type="file" class="form-control" name="c_image" required>
                            </div>

                            <input type="submit" class="btn btn-default" value="LOGIN" name="register">
                            </form>
                        </div>
                    </div>

                </div> <!--End Of Content-->
            </div>
        </div>
    </div><!--Div Containter End -->

<?php

if (isset($_POST['register'])) {
    $customer_name = $_POST['c_name'];
    $customer_email = $_POST['c_email'];
    $customer_pass = $_POST['c_pass'];
    $customer_country = $_POST['c_country'];
    $customer_city = $_POST['c_city'];
    $customer_contact = $_POST['c_cont'];
    $customer_address = $_POST['c_addr'];
    $customer_ip = getRealIpAddr();
    
    $file = $_FILES['c_image'];
    $customer_image = $_FILES['c_image']['name'];
    $customer_image_tmp = $_FILES['c_image']['tmp_name'];

    $destinationfile = 'customer/customer_photos/'.$customer_image;

    $insert_customers = "INSERT INTO customers (customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image,customer_ip) VALUES ('$customer_name','$customer_email','$customer_pass','$customer_country','$customer_city','$customer_contact','$customer_address','$customer_image','$customer_ip')";

    $run_customer = mysqli_query($conn , $insert_customers);
    move_uploaded_file( $customer_image_tmp , $destinationfile);
    $sel_cart = "SELECT * FROM cart where ip_add = '$customer_ip'";
    $run_cart = mysqli_query($conn , $sel_cart);
    $check_cart = mysqli_num_rows($run_cart);
    if ($check_cart > 0) {
        $_SESSION['customer_email'] = $customer_email;
        echo "<scriptalert('ACCOUNT CREATED SUCCESSFULLY')</script>";
        echo "<script>window.open('checkout.php' , '_self')</script>";
    } else {
         $_SESSION['customer_email'] = $customer_email;
        echo "<scriptalert('ACCOUNT CREATED SUCCESSFULLY')</script>";   
        echo "<script>window.open('index.php' , '_self')</script>";
    }
}


?>


    <!--Attach Javascript Libraries-->
    <script src="js/bootstrap.js"></script>
</body>
</html>