<?php
session_start();
    $id=$_GET['id'];
    $mail = $_POST['mail'];
    include "connection.php";
    $query = "SELECT email FROM signupdb WHERE email='$mail'";
    $res = mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        $_SESSION['mailalready']="exist";
        header("Location:updateemail.php");
        die();
    }else{
        $query = "UPDATE signupdb SET email='$mail' WHERE id='$id'";
    $res = mysqli_query($conn,$query);
     $query = "UPDATE itemsdb SET account='$mail' WHERE userid='$id'";
    $res = mysqli_query($conn,$query);
        unset($_SESSION['mail']);
        $_SESSION['mail']="$mail";
        header("Location:profile.php");
    }
?>