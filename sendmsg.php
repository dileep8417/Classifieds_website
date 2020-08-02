<?php
    session_start();
    $bmail =  $_SESSION['mail'];
    $mail = $_SESSION['sellermail'];
    $name = $_POST['bname'];
    $msg = $_POST['msg'];
    $header= "Contact details:z
                Buyer name: $name
                Emai Id: $bmail";
    if(mail($mail,"Someone interested on your product","$msg",$header)){
        $_SESSION['sellermailsuccess']="exist";
        header("Location:profile.php");
    }else{
        $_SESSION['sellermailfail']="exist";
        header("Location:profile.php");
    }
   
?>