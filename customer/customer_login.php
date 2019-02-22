<?php
@SESSION_START();
include("includes/db.php");
?>

<div style="margin-top:75px;">
    <h2>LOGIN PAGE <span style="float:right"><a href="customer_register.php" class="btn btn-warning">SIGNUP</a></span></h2>
    <form action="checkout.php" method="post" >
        <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" placeholder="Enter email" name="c_email" required>
        </div>
        <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" placeholder="Enter password" name="c_pass" required>
        <a href="forgot.pass.php" style="color:maroon">Forgot Password</a>
        </div>
        <input type="submit" class="btn btn-default" value="LOGIN" name="c_login">
    </form>
    </div>

<?php
if (isset($_POST['c_login'])) {
    $customer_email = $_POST['c_email'];
    $customer_pass = $_POST['c_pass'];

    $sel_customer = "SELECT * FROM customers WHERE customer_email = '$customer_email' AND customer_pass = '$customer_pass' ";
    $run_customer = mysqli_query($conn , $sel_customer);
    $check_customer = mysqli_num_rows($run_customer);
    
    $get_ip = getRealIpAddr();

    $sel_cart = "SELECT * FROM cart where ip_add = '$get_ip'";
    $run_cart = mysqli_query($conn , $sel_cart);
    $check_cart = mysqli_num_rows($run_cart);
    if ($check_customer == 0 ) {
        echo "<script>alert('Check email and Password again')</script>";
        exit();
    }

    if ($check_customer == 1 AND $check_cart ==0) {

        $_SESSION['customer_email'] = $customer_email;
        echo "<script>window.open('customer/my_account.php','_self')</script>";

    } else {
        $_SESSION['customer_email'] = $customer_email;
        echo "<script>alert('Your are successfully Logged In')</script>";
       include("payment_options.php");
        
    }

}


?>