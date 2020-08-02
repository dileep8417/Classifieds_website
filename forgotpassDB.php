<?php
    
    session_start();
    $mail=$_POST["vmail"];
    
    include "connection.php";
    $query = "SELECT * FROM signupdb WHERE email='$mail'";
    $res = mysqli_query($conn,$query);

    if(mysqli_num_rows($res)>0){
        $charecters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for($i=0;$i<6;$i++){
         $randomDigit[$i] = $charecters[rand(0,strlen($charecters)-1)];
        }
        $store =implode("",$randomDigit);
        $_SESSION['OTP'] = $store;
        $_SESSION["vmail"] = $mail;
        if(mail($mail,"Reset Password",$store,"The following is the Verification code")){
            echo "sent";
            header("Location:verification.php");
        }else{
            echo "Something wrong please try later";
        }      
        
    }else{
        $_SESSION['mailerr']="Enter valid EmailId";
        header("Location:forgotpass.php");
    }
    
    
?>