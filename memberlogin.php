<?php
require('connection.inc.php');
require('functions.inc.php');
$msg='';
if(isset($_POST['submit'])){
	$username=get_safe_value($conn,$_POST['username']);
	$password=get_safe_value($conn,$_POST['password']);
	$sql="select * from members where member_username = '$username'";
	$res=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($res);
   $password1 = md5($password);
   if($res){
      
      if($count>0){
         $result_fetch = mysqli_fetch_assoc($res);
         
         if($result_fetch['is_varified']==1){

            if($password1 == $result_fetch['member_pass']){
              
               $_SESSION['members']='yes';
            
               $otp = rand(11111,99999);
               mysqli_query($conn,"update members set otp='$otp' where member_username='$username'");
               $email = $result_fetch['email_address'];
               $_SESSION['EMAIL']=$email;
               sendMail($email,$otp);
               session_start();
               $_SESSION['member_username']=$username;
               header('location:loginotp.php');
               die();
               
            }
            else{
               $msg = 'something wrong ';
            }
           
         }
         else{
            $msg="Please varify your email address";	
         }
         
      }else{
         $msg="Please enter correct login details";	
      }
   }

	
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendMail($email,$v_code){
  require 'PHPMailer/PHPMailer.php';
  require 'PHPMailer/SMTP.php';
  require 'PHPMailer/Exception.php';
  $mail = new PHPMailer(true);
  try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'wdrishad@gmail.com';                     //SMTP username
    $mail->Password   = 'akwgbxdwqpbcsyzs';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('wdrishad@gmail.com', 'Log In');
    $mail->addAddress($email);     //Add a recipient
   

   

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'OTP for verification';
    $mail->Body    = "Your OTP is '$v_code'
    ";
   

    $mail->send();
    return true;
} catch (Exception $e) {
    return false;
}
}



?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="css/memberlogin.css">
   </head>
   <body class="bg-dark">
      <div class="member-login">
         <div class="container">
            <div class="login-content">
               <h1 class="heading">Member Login </h1>
               <div class="heading-border"></div>
               <div class="login-form">
                  <form method="post">
                     <div class="form-group">
                        <label class="username">Username</label>
                        <input type="text" name="username"  class="form-control" placeholder="Username" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <button type="submit" name="submit" class="btn">Log in</button>
					</form>
              
               </div>
               <h1 style="text-align: center;" class="messagehead">Not a user Register here : <a href="index.php" style="color:blue">Register</a></h1>
					<div class="field_error"><?php echo $msg?></div>
            </div>
         </div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>