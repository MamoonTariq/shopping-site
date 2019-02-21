<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myshop";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



    // FETCH IP ADDRESS
function getRealIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){ //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


    //FETCH THE PRODUCT BRANDS
function getBrands(){
    global $conn;
    $get_brands = "SELECT * FROM brands";
    $run_brands = mysqli_query( $conn , $get_brands );
    while ($row_brands = mysqli_fetch_array($run_brands)) {
        $brands_id = $row_brands['brand_id'];
        $brands_title = $row_brands['brand_title'];
        echo "<li><a href='index.php?brand=$brands_id' class='list-group-item'>$brands_title</a></li>";
    }
}

    //FETCH THE CATEGORIES
function getCats(){
    global $conn;
    $get_cats = "SELECT * FROM categories";
    $run_cats = mysqli_query( $conn , $get_cats );
    while ($row_cats = mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];
        echo "<li><a href='index.php?cat=$cat_id' class='list-group-item'>$cat_title</a></li>";
    }
}

    //FETCH THE PRODUCTS IN INDEX.PHP PAGE
function getProducts(){
    global $conn;
    if(!isset($_GET['cat'])){
        if(!isset($_GET['brand'])){
            $get_products = "SELECT * FROM products order by rand() Limit 0,6";
            $run_products = mysqli_query( $conn , $get_products );
            while ($row_products = mysqli_fetch_array($run_products)){
                $pro_id = $row_products['product_id'];
                $pro_title = $row_products['product_title'];
                $pro_cart = $row_products['cat_id'];
                $pro_brand = $row_products['brand_id'];
                $pro_desc = $row_products['product_descrip'];
                $pro_price = $row_products['product_price'];
                $pro_image = $row_products['product_img1'];

                echo "
                    <div class='col-md-3 product-details'>
                        <h3>$pro_title</h3>
                        <img src='admin_area/product_images/$pro_image' width='200px' height='200px' >
                        <p id='price'>Price<b>: $pro_price PKR</b></p>
                        <a href='details.php?pro_id=$pro_id' class='details-btn'>Details</a>
                        <a href='index.php?add_cart=$pro_id' class='cart-btn'><button>Add to Cart</button></a>
                    </div> ";
            }
        }
    }
}





    //Fetch Products in index page After click the CATEGORIES
    function getCatProducts(){
        global $conn;
        if(isset($_GET['cat'])){
            $cat_id = $_GET['cat'];
            $get_cat_products = "SELECT * FROM products WHERE cat_id = '$cat_id' ";
            $run_cat_products = mysqli_query( $conn , $get_cat_products );
            $count = mysqli_num_rows($run_cat_products);
            if($count == 0){
                echo "<h2 class='no-data-found'>NO PRODUCTS FOUND IN THIS CATEGORY</h2>";
            } else {
                while ($row_cat_products = mysqli_fetch_array($run_cat_products)){
                    $pro_id = $row_cat_products['product_id'];
                    $pro_title = $row_cat_products['product_title'];
                    $pro_cart = $row_cat_products['cat_id'];
                    $pro_brand = $row_cat_products['brand_id'];
                    $pro_desc = $row_cat_products['product_descrip'];
                    $pro_price = $row_cat_products['product_price'];
                    $pro_image = $row_cat_products['product_img1'];
    
                    echo "
                        <div class='col-md-3 product-details'>
                            <h3>$pro_title</h3>
                            <img src='admin_area/product_images/$pro_image' width='200px' height='200px' >
                            <p id='price'>Price<b>: $pro_price PKR</b></p>
                            <a href='details.php?pro_id=$pro_id' class='details-btn'>Details</a>
                            <a href='index.php?add_cart=$pro_id' class='cart-btn'><button>Add to Cart</button></a>
                        </div> ";
                }
            }
        }
    }



    //Fetch Products in index page After click the BRANDS
    function getBrandProducts(){
        global $conn;
        if(isset($_GET['brand'])){
            $brand_id = $_GET['brand'];
            $get_brand_products = "SELECT * FROM products WHERE brand_id = '$brand_id' ";
            $run_brand_products = mysqli_query( $conn , $get_brand_products );
            $count = mysqli_num_rows($run_brand_products);
            if($count == 0){
                echo "<h2 class='no-data-found'>NO PRODUCTS FOUND IN THIS BRAND</h2>";
            } else {
                while ($row_brand_products = mysqli_fetch_array($run_brand_products)){
                    $pro_id = $row_brand_products['product_id'];
                    $pro_title = $row_brand_products['product_title'];
                    $pro_cart = $row_brand_products['cat_id'];
                    $pro_brand = $row_brand_products['brand_id'];
                    $pro_desc = $row_brand_products['product_descrip'];
                    $pro_price = $row_brand_products['product_price'];
                    $pro_image = $row_brand_products['product_img1'];
    
                    echo "
                        <div class='col-md-3 product-details'>
                            <h3>$pro_title</h3>
                            <img src='admin_area/product_images/$pro_image' width='200px' height='200px' >
                            <p id='price'>Price<b>: $pro_price PKR</b></p>
                            <a href='details.php?pro_id=$pro_id' class='details-btn'>Details</a>
                            <a href='index.php?add_cart=$pro_id' class='cart-btn'><button>Add to Cart</button></a>
                        </div> ";
                }
            }
        }
    }




    


 //FETCH ALL THE PRODUCTS IN ALL PRODUCTS PAGE
 function getAllProducts(){
    global $conn;
    if(!isset($_GET['cat'])){
        if(!isset($_GET['brand'])){
            $get_products = "SELECT * FROM products";
            $run_products = mysqli_query( $conn , $get_products );
            while ($row_products = mysqli_fetch_array($run_products)){
                $pro_id = $row_products['product_id'];
                $pro_title = $row_products['product_title'];
                $pro_cart = $row_products['cat_id'];
                $pro_brand = $row_products['brand_id'];
                $pro_desc = $row_products['product_descrip'];
                $pro_price = $row_products['product_price'];
                $pro_image = $row_products['product_img1'];

                echo "
                    <div class='col-md-3 product-details'>
                        <h3>$pro_title</h3>
                        <img src='admin_area/product_images/$pro_image' width='200px' height='200px' >
                        <p id='price'>Price<b>: $pro_price PKR</b></p>
                        <a href='details.php?pro_id=$pro_id' class='details-btn'>Details</a>
                        <a href='index.php?add_cart=$pro_id' class='cart-btn'><button>Add to Cart</button></a>
                    </div> ";
            }
        }
    }
}





// FUNCTION FOR CART

function cart(){
    if(isset($_GET['add_cart'])){
        global $conn;
        $ip_add = getRealIpAddr();
        $p_id = $_GET['add_cart'];

        $check_pro = "SELECT * FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' ";
        $run_check = mysqli_query( $conn , $check_pro );
        if ( mysqli_num_rows($run_check) > 0 ) {
            echo "";
        } else {
            $q = "INSERT INTO cart ( p_id , ip_add ) VALUES ('$p_id' , '$ip_add')";
            $run_q = mysqli_query( $conn , $q );
            echo "<script>window.open('index.php' , '_self')</script>";
        }
    }
}


// FETCH TOTAL NUMBERS OF ITEMS
function items(){
    if(isset($_GET['add_cart'])){
        global $conn;
        $ip_add = getRealIpAddr();

        $check_pro = "SELECT * FROM cart WHERE ip_add = '$ip_add' ";
        $run_item = mysqli_query( $conn , $check_pro );
        $count_items = mysqli_num_rows($run_item);
    } else {
        global $conn;
        $ip_add = getRealIpAddr();

        $check_pro = "SELECT * FROM cart WHERE ip_add = '$ip_add' ";
        $run_item = mysqli_query( $conn , $check_pro );
        $count_items = mysqli_num_rows($run_item);
    }
    
    echo $count_items;
}



    //FETCH THE PRICE OF TOTAL ITEMS AFTER THE CART
function total_price(){
    global $conn;
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
            $values = array_sum($product_price);
            $total += $values;
        }
    }

    echo "PKR " . $total;
}


?>