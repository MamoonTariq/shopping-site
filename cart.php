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
                <div class="col-md-12 content"> <!--Start Of Content-->
                    <div class="row">
                        <div class="header">
                            <div class="header-content"> <?php cart() ;?>
                                <b>Welcome Guest</b>
                                <b style="color:yellow;">Shopping Cart</b>
                                <span> - Total Items :<?php items();?> - Total Price: <?php total_price();?> - <a href="index.php" class="btn btn-warning">Go to Home</a> 
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

                    <div class="row">
                        <form action="cart.php" method="post" enctype="multipart/form-data">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>REMOVE</th>
                                    <th>PRODUCT(s)</th>
                                    <th>QUANTITY</th>
                                    <th>PRICE</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                 $ip_add = getRealIpAddr();
                                 $total = 0;
                                 $sel_price = "SELECT * FROM cart WHERE ip_add = '$ip_add' ";
                                 $run_price = mysqli_query( $conn , $sel_price );
                                 while ($record = mysqli_fetch_array($run_price)) {
                                     $pro_id = $record['p_id'];
                                     
                                     $pro_price = "SELECT * FROM products WHERE product_id = '$pro_id'";
                                     $run_pro_price = mysqli_query( $conn , $pro_price );
                                     while ($p_price = mysqli_fetch_array($run_pro_price)) {
                                         $product_price = array($p_price['product_price']);
                                         $product_title = $p_price['product_title'];
                                         $product_image = $p_price['product_img1'];
                                         $only_price = $p_price['product_price'];
                                         $values = array_sum($product_price);
                                         $total += $values;
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
                                    <td><?php echo $product_title ;?><br><img src="admin_area/product_images/<?php echo $product_image ;?>" height="80" width="80"></td>
                                    <td><input type="text" name="qty" ></td>
                                    <?php
                                    if (isset($_POST['update'])){
                                        $qty = $_POST['qty'];
                                        $insert_qty = "UPDATE cart set qty = '$qty' WHERE p_id = '$pro_id'";
                                        $run_qty = mysqli_query( $conn , $insert_qty );
                                        $total = $total*$qty;
                                    }
                                    
                                    ?>
                                    <td>PKR <?php echo $only_price ;?></td>
                                </tr> 
                                <?php
                                    }
                                }  
                                ?>    
                                </tbody>
                            </table>
                            
                            <table class="table">
                                <thead>
                                <tr class="danger">
                                    <th><input type="submit" name="update" value="Update Cart" class="btn btn-warning" ></th>
                                    <th><input type="submit" name="continue" value="Continue Shopping" class="btn btn-info" ></th>
                                    <th><a href="checkout.php" class="btn btn-success">Checkout</a></th>
                                </tr>
                                </thead>
                            </table>

                            <table class="table" style="width:50%;float:right">
                                <thead>
                                <tr class="danger">
                                    <th>TOTAL PRICE</th>
                                    <th>PKR <?php echo $total;?></th>
                                </tr>
                                </thead>
                            </table>
                        </form>
                    </div>

                </div> <!--End Of Content-->
            </div>
        </div>
    </div><!--Div Containter End -->

<?php
function updatecart(){
    global $conn;
    if (isset($_POST['update'])) {
        foreach ($_POST['remove'] as $remove_id) {
            $delete_product = "DELETE FROM cart WHERE p_id = '$remove_id'";
            $run_delete = mysqli_query( $conn , $delete_product );
            if ($run_delete) {
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }
    }
}
echo @$up_cart = updatecart();

if (isset($_POST['continue'])) {
    echo "<script>window.open('index.php','_self')</script>";
}

?>


    <!--Attach Javascript Libraries-->
    <script src="js/bootstrap.js"></script>
</body>
</html>