<?php
require 'connection.inc.php';

$email = $_GET['email'];
$v_code = $_GET['v_code'];
if(isset($_GET['email']) && isset($_GET['v_code'])){
    $query = "SELECT * FROM members WHERE email_address = '$email' AND  varification_code = '$v_code'";

    $result = mysqli_query($conn,$query);
    if($result){
        if(mysqli_num_rows($result)>0){
            $result_fetch = mysqli_fetch_assoc($result);
            if($result_fetch['is_verified']==0){
                $update = "UPDATE members SET is_varified ='1' WHERE email_address = '$email' ";

                if(mysqli_query($conn,$update)){
                    echo '<script>
                    alert("Email verification successful");
                    window.location.href = "index.php";
                    </script>';
                }
                else{
                    echo '<script>
                    alert("query failed");
                    window.location.href = "index.php";
                    </script>';
                }
            }
            else{
                echo '<script>
                alert("verified user");
                window.location.href = "index.php";
                </script>';
            }
        }
    }
    else{
        echo '<script>
        alert("server down");
        window.location.href = "index.php";
        </script>';
    }
}
?>