<?php
SESSION_START();
include("includes/db.php");
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style>
    body{
        background-color: blanchedalmond;
    }
    h1{
        text-align: center;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
        <h1>PLEASE CONFIRM YOUR PAYMENTS</h1>
            <div class="col-md-6">
                <form action="confirm.php?update_id=<?php echo $order_id;?>" method="post">

                <div class="form-group">
                    <label for="invoice">Inovice No:</label>
                    <input type="text" class="form-control" name="invoice">
                </div>

                <div class="form-group">
                    <label for="">Amount Sent:</label>
                    <input type="" class="form-control" name="amount_Sent">
                </div>

                <div class="form-group">
                    <label for="">Select Payment Mode:</label>
                    <select name="payment_method">
                        <option>Select Payment</option>
                        <option>Bank Transfer</option>
                        <option>EasyPaisa/UBL</option>
                        <option>Western Union</option>
                        <option>Paypal</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Transaction/Refference ID:</label>
                    <input type="" class="form-control" name="ref_id">
                </div>
                
                <div class="form-group">
                    <label for="">EasyPaisa/UBL OMNI CODE:</label>
                    <input type="" class="form-control" name="code">
                </div>

                <div class="form-group">
                    <label for="">Date:</label>
                    <input type="" class="form-control" name="date">
                </div>

                <input type="submit" class="btn btn-info" name="submit" value="Confirm">
                <a href="my_account.php" class="btn btn-info">< BACK</a>
                </form>
            </div>
        </div>
    </div>
    

    <?php
    if (isset($_POST['submit'])) {

        $update_id = $_GET['update_id'];
        $invoice = $_POST['invoice'];
        $amount_Sent = $_POST['amount_Sent'];
        $payment_method = $_POST['payment_method'];
        $ref_id = $_POST['ref_id'];
        $code = $_POST['code'];
        $date = $_POST['date'];

        $insert = "INSERT INTO payments (invoice_no , amount , payment_mode , ref_no , code , payment_date) VALUES ('$invoice' ,' $amount_Sent' , '$payment_method' , '$ref_id ', '$code' , '$date' )";
        $run_query = mysqli_query($conn , $insert);
        if ($run_query) {
           $update_order = "UPDATE customer_orders SET order_status = 'Complete' WHERE order_id = '$update_id'";
           $run_order = mysqli_query($conn , $update_order);
           echo "<h2> Payment Received , Your order will be complete within 24 hors ! </h2>";
        }
    }
    
    
    
    
    ?>
    
</body>
</html>