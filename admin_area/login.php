<?php
SESSION_START();
include("includes/db.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css">
    
</head>
<body>
<div class="login">
	<h1>Login</h1>
    <form method="post">
    	<input type="text" name="email" placeholder="Username" required="required" />
        <input type="password" name="pass" placeholder="Password" required="required" />
        <input type="submit" name="login" class="btn btn-primary btn-block btn-large" value="Login">
    </form>
</div>
</body>
</html>


<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sel_customer = "SELECT * FROM admins WHERE email = '$email' AND pass = '$pass' ";
    $run_customer = mysqli_query($conn , $sel_customer);
    $check_customer = mysqli_num_rows($run_customer);
    

    if ($check_customer == 1 ) {
        $_SESSION['email'] = $email;
        echo "<script>window.open('index.php' , '_self')</script>";
      
    } else {
        echo "<script>alert('Check email and Password again')</script>";
    }
}