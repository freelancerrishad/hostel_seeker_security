<?php
require('connection.inc.php');
$msg='';

	$otp= mysqli_real_escape_string($conn,$_POST['otp']);
	
	$sql="select * from members where otp = '" 
    . $otp . "' ";
	$res=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($res);
    if($res){
        if($count>0){
           
           $result_fetch = mysqli_fetch_assoc($res);
           
         
               echo mysqli_fetch_assoc($res);  
              
                if($otp == $result_fetch['otp']){
         
                    $_SESSION['members']='yes';
                    $_SESSION['member_username']=$result_fetch['member_username'];

                   
                  
                    
                    $_SESSION['EMAIL']=$email;
               

                    header('location:memberpage.php');
                    die();
                 }
                 else{
                    echo '<script>alert("wrong otp"); location.href = "index.php"</script>';
                    
                 }
            
           
         
         
      }else{
        echo '<script>alert(Please enter correct login details"); location.href = "index.php"</script>';
        
       
    
        
      }
   }


?>