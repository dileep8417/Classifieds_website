<?php
session_start();
    include "connection.php";
    $message=$_POST['messages'];
    $sender=$_SESSION['id'];
    $receiver=$_SESSION['sellerid'];
    if($sender!=$receiver){
        $query="INSERT INTO chat (send_from,send_to,message) VALUES ('$sender','$receiver','$message')";
        $res=mysqli_query($conn,$query);
    }
    
?>