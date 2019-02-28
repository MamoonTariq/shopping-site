
<?php
SESSION_START();
include("includes/db.php");
    if (!isset($_SESSION['email'])) {
        echo "<script>window.open('login.php' , '_self')</script>";
    } else{
?>



<h3 style="text-align:center">All Product Details</h3>
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Product No</th>
        <th>Title</th>
        <th>Image</th>
        <th>Price</th>
        <th>Total Sold</th>
        <th>Status</th>
        <th>Delete</th>
      </tr>
    </thead>
    <?php 
    $get_orders = "SELECT * FROM products";
    $run_orders = mysqli_query($conn , $get_orders);
    $i = 0;
    while($row_orders = mysqli_fetch_array($run_orders)){

        $p_id = $row_orders['product_id'];
        $product_title = $row_orders['product_title'];
        $product_img1 = $row_orders['product_img1'];
        $product_price = $row_orders['product_price'];
        $status  = $row_orders['status'];
        $i++;

        $get_sold = "SELECT * FROM pending_orders WHERE product_id = '$p_id'";
        $run_sold = mysqli_query($conn , $get_sold);
        $count = mysqli_num_rows($run_sold);
       echo "
        <tbody>
            <tr>
                <td>$i</td>
                <td>$product_title</td>
                <td><img src='product_images/$product_img1' width='50' height='50'></td>
                <td>$product_price</td>
                <td>$count</td>
                <td>$status</td>
                <td><a href='' class='btn btn-danger'>Delete</a></td>
            </tr>
        </tbody>";
    }
    ?>
    
  </table>

  <?php }?>