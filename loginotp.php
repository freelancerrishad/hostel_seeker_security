<!DOCTYPE html>
<?php 
session_start();

$username = $_SESSION['member_username'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit OTP</title>
    <link rel="stylesheet" href="css/otp.css">
</head>
<body>
<div class="subscribe-box"> 
<?php 
    if(isset($_SESSION['member_username'])){


        ?>
<h2>Submit Your OTP Here</h2>
  <form class="subscribe" action="otpvarify.php" method="post">
    <input type="text" name="otp" placeholder="otp" autocomplete="off" required="required" />
    <button type="submit"> <span>Submit</span></button>
  </form>
<?php
    }
    else{
        echo "<script>alert('Please login to continue'); location.href='./index.php'</script>";
    }
    ?>
  
</div>
</body>
</html>