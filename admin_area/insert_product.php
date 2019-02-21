<?php
include("includes/db.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    <style>
        .row {
            margin-top: 70px;
            margin-bottom: 70px;
        }
        .whole_body{
            background: linear-gradient(180deg,#1976D2 0%,#36BAB1 100%);
            color:white;
        }
        label{
            font-size:x-large;
        }
        form{
            text-align: center; 
        }
        #img{
            color: greenyellow;
            font-size: 15px;
        }
    </style>
</head>
<body>
   <div class="whole_body">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-5">
                    <form method="post" enctype="multipart/form-data" action="insert_product.php">
                        <div class="form-group">
                            <label for="">Product Category</label>
                            <select class="form-control" name="product_cat">
                                <option>Select Category</option>
                                    <?php
                                    $get_cats = "SELECT * FROM categories";
                                    $run_cats = mysqli_query( $conn , $get_cats );
                                    while ($row_cats = mysqli_fetch_array($run_cats)) {
                                        $cat_id = $row_cats['cat_id'];
                                        $cat_title = $row_cats['cat_title'];
                                        echo "<option value='$cat_id'>$cat_title</option>";
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Product Brand</label>
                            <select class="form-control" name="product_brand">
                                <option>Select Brand</option>
                                    <?php
                                    $get_brands = "SELECT * FROM brands";
                                    $run_brands = mysqli_query( $conn , $get_brands );
                                    while ($row_brands = mysqli_fetch_array($run_brands)) {
                                    $brands_id = $row_brands['brand_id'];
                                    $brands_title = $row_brands['brand_title'];
                                        echo "<option value='$brands_id'>$brands_title</option>";
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Product Title</label>
                            <input type="text" class="form-control" id="" placeholder="Enter the Product Title" name="product_title">
                        </div>
                        
                        <div class="form-group">
                            <label>Product Image 1 <span id="img">*Compulsory</span></label>
                            <input type="file" class="form-control" name="product_img1">
                        </div>

                        <div class="form-group">
                            <label>Product Image 2</label>
                            <input type="file" class="form-control" name="product_img2">
                        </div>

                        <div class="form-group">
                            <label>Product Image 3</label>
                            <input type="file" class="form-control" name="product_img3">
                        </div>

                        <div class="form-group">
                            <label for="">Product Price</label>
                            <input type="text" class="form-control"  name="product_price" placeholder="Enter the Product Price">
                        </div>
                        <div class="form-group">
                            <label for="">Product Description</label>
                            <textarea class="form-control" rows="3" name="product_desc"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Product Keywords</label>
                            <input type="text" class="form-control" id="" placeholder="Enter the Keywords for search" name="product_keyword">
                        </div>
                        
                        <input type="submit" class="btn btn-primary" name="add_product" value="ADD PRODUCT">
                    </form>
                </div>
            </div>
        </div>
   </div>

    <script src="../js/bootstrap.js"></script>
</body>
</html>

<?php

if(isset($_POST['add_product'])){

    $cat_id = $_POST['product_cat'];
    $brand_id = $_POST['product_brand'];
    $product_title = $_POST['product_title'];

    $file1 = $_FILES['product_img1'];
   
    $filename1 =  $_FILES['product_img1']['name'];
    $tmpname1 =  $_FILES['product_img1']['tmp_name'];

    $filename2 =  $_FILES['product_img2']['name'];
    $tmpname2 =  $_FILES['product_img2']['tmp_name'];

    $filename3 =  $_FILES['product_img3']['name'];
    $tmpname3 =  $_FILES['product_img3']['tmp_name'];
    
     $destinationfile1 = 'product_images/'.$filename1;
     $destinationfile2 = 'product_images/'.$filename2;
     $destinationfile3 = 'product_images/'.$filename3;
     

    $status = "on";
    $product_price = $_POST['product_price'];
    $product_desc = $_POST['product_desc'];
    $product_keyword = $_POST['product_keyword'];

    $allowed = array( 'png' , 'jpg' , 'jpeg' , 'gif' );
  	$explodeImg = explode( '.', $filename1 );
  	$imgext = end($explodeImg);
  	

    if( $cat_id == "" or $brand_id == "" or $product_title == "" or $product_keyword == "" or $filename1 == "" or $product_price == "" or $product_desc == "" ){
        echo "<script>alert('PLEASE FILL THE ALL FIELDS CORRECTLY ');</script>";
    } elseif (in_array($imgext, $allowed)) {

        move_uploaded_file( $tmpname1 , $destinationfile1);
        move_uploaded_file( $tmpname2 , $destinationfile2);
        move_uploaded_file( $tmpname3 , $destinationfile3);

        $sql = "INSERT into products (cat_id , brand_id , date , product_title , product_img1 , product_img2 , product_img3 , product_price , product_descrip , product_keywords , status) VALUES ('$cat_id' , '$brand_id' , NOW() , '$product_title' , '$filename1' , '$filename2' , '$filename3' , '$product_price' , '$product_desc' , '$product_keyword' , '' )";
        $run = mysqli_query( $conn, $sql );
        if($run) {
            echo "<script>alert(' DATA IS SUBMITTED SUCCESSFULLY ');</script>";
        } else {
            echo "<script>alert(' DATA IS NOT SUBMITTED DUE TO SOME ERROR ');</script>";
        }
    } else {
        echo "<script>alert(' Check Image Extension ');</script>";
    }
}
?>


