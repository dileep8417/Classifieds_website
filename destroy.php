<?php
    session_start();
    $userid=$_SESSION['mail'];
    include "connection.php";
    $query  = "UPDATE signupdb SET track=0 WHERE email='$userid'";
    $res = mysqli_query($conn,$query);
  
    session_destroy();
    header("Location:index.php");
?>