<?php

    // session start
    session_start();

    // include db connection
    include 'connection.inc.php';

    // declaring variables
    $sent_by = "";
    $received_by = "";
    $message = "";
    $createdAt = date("Y-m-d h:i:sa");

    // get data from form
    if(isset($_POST['sent_by'])) {

        $sent_by = $_POST['sent_by'];

    }

    if(isset($_POST['received_by'])) {

        $received_by = $_POST['received_by'];

    }

    if(isset($_POST['message'])) {

        $message = $_POST['message'];

    }
    if(isset($_POST['file'])) {

        $file = $_POST['file'];

    }


    if($message != "") { // if message box is not empty!

        // send message
        $sendMessage = "INSERT INTO messages(sent_by,received_by,message,createdAt,image) VALUES('$sent_by','$received_by','$message','$createdAt','$file')";
        $sendMessageStatus = mysqli_query($conn,$sendMessage) or die(mysqli_error($conn));
        
        if($sendMessageStatus) {

            header("Location: message.php?username=$sent_by&&id=$received_by");

        } else {

            header("Location: message.php?username=$sent_by&&id=$received_by");

        }
    }
?>