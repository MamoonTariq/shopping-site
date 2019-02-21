<?php
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
                                <span> - Tptal Items :<?php items();?> - Total Price: <?php total_price();?></span>
                            </div>
                        </div>
                    </div> <!--End of header of welcome cart-->

                    <div class="row">
                        <?php
                            if(isset($_GET['pro_id'])){
                                $product_id = $_GET['pro_id'];
                                $get_products = "SELECT * FROM products where product_id = '$product_id' ";
                                $run_products = mysqli_query( $conn , $get_products );
                                while ($row_products = mysqli_fetch_array($run_products)){
                                    $pro_id = $row_products['product_id'];
                                    $pro_title = $row_products['product_title'];
                                    $pro_cart = $row_products['cat_id'];
                                    $pro_brand = $row_products['brand_id'];
                                    $pro_desc = $row_products['product_descrip'];
                                    $pro_price = $row_products['product_price'];
                                    $pro_image1 = $row_products['product_img1'];
                                    $pro_image2 = $row_products['product_img2'];
                                    $pro_image3 = $row_products['product_img3'];
                    
                                    echo "
                                        <div class='col-md-8 product-details'>
                                            <img src='admin_area/product_images/$pro_image1' style='max-width:420px' ><br>
                                        </div>
                                        <div class='col-md-4 product-details-single'>
                                            <h1>$pro_title</h1>
                                            <div class='product-desc'><h2>Description:</h2>$pro_desc</div>
                                            <p id='price' class='btn btn-warning'>Price<b>: $pro_price PKR</b></p>
                                            <a href='index.php?add_cart=$pro_id'><button class='btn btn-primary'>Add to Cart</button></a><br>
                                            <a href='index.php' class='btn btn-default back-btn'>Go Back</a>
                                            
                                            
                                            
                                        </div>
                                        ";
                                }
                            }
                            getCatProducts();
                            getBrandProducts();   
                        ?>
                    </div>

                </div> <!--End Of Content-->
            </div>
        </div>
    </div><!--Div Containter End -->
    <footer style="background-color:black;color:white;height:50px;">
        This is the footer of this website
    </footer>



    <!--Attach Javascript Libraries-->
    <script src="js/bootstrap.js"></script>
</body>
</html>