<?php
    if (isset($_SESSION["SESSION_EMAIL"])) {
        header("Location: index.php");
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
        $mail->setFrom('wdrishad@gmail.com', 'Hostel Seeker');
        $mail->addAddress($email);     //Add a recipient
       
    
       
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email Varification from Hostel Seeker';
        $mail->Body    = "Thanks for registration. Click the link below to varify the email address.<br>
        <a href='http://localhost/hostel_seeker-main/varify.php?email=$email&v_code=$v_code'>Varify your mail</a>
        ";
       
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
    }


    if (isset($_POST["submit"])) {
        include 'connection.inc.php';

        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $username = htmlspecialchars($username);
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $name = htmlspecialchars($name);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $mobile_num = mysqli_real_escape_string($conn, $_POST["mobile_num"]);
        $profession = mysqli_real_escape_string($conn, $_POST["profession"]);
        $age = mysqli_real_escape_string($conn, $_POST["age"]);
        $nid = mysqli_real_escape_string($conn, $_POST["nid"]);
        $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
       $v_code = bin2hex(random_bytes(16));
       
        $address = mysqli_real_escape_string($conn, $_POST["address"]);
       
        $password1 = mysqli_real_escape_string($conn, $_POST["password"]);

        if(strlen($password1) < 8){
            echo '<script>alert("password length is less than 8"); window.location = "membersignup.php"</script>';
            
          }
          

        $password = md5($password1);
     

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM members WHERE email_address='{$email}'")) > 0) {
            echo "<script>alert('{$email} - This email has already taken.');</script>";
        }
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM members WHERE member_username='{$username}'")) > 0) {
          echo '<h2 style="color: red;">sorry, this username is already taken</h2>';
      }
      if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM members WHERE NID='{$nid}'")) > 0) {
        echo '<h2 style="color: red;">sorry, this NID is already taken</h2>';
    }
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM members WHERE mobile_number='{$mobile_num}'")) > 0) {
      echo '<h2 style="color: red;">sorry, this mobile number is already taken</h2>';
  }

        else {
            
                $sql = "INSERT INTO members(member_username,member_name,email_address,mobile_number,member_profession,age,NID,gender,address,member_pass,varification_code, is_varified) VALUES ('{$username}', '{$name}','{$email}','{$mobile_num}','{$profession}','{$age}','{$nid}','{$gender}','{$address}','{$password}','{$v_code}','0')";
                
                
          

                if (mysqli_query($conn, $sql) && sendMail($_POST['email'], $v_code)) {
                   echo "<script>alert('Please verify your email address.');
                   window.location.href = 'index.php';
                   </script>";
                    
                }else {
                    echo "error";
                }
            
            }
        }
    
?>
