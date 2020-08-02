<?php
    session_start();
    include "connection.php";
    if(isset($_GET['fgpass'])){
        $fmail=$_GET['fgpass'];
        $query="SELECT * FROM signupdb WHERE email='$fmail'";
        $res = mysqli_query($conn,$query);
        #CHECKING MAIL EXISTED OR NOT

        if(mysqli_num_rows($res)>0){
            #GENERATING LINK
                $charecters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                for($i=0;$i<6;$i++){
                    $randomDigit[$i] = $charecters[rand(0,strlen($charecters)-1)];
                }
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $code=implode("",$randomDigit);
                    $_SESSION['linkcheck'] = $code =implode("",$randomDigit);
                    $link= "http://localhost/phpfiles/modifiedproject/verify.php?user=".$fmail."&verify=".$code;
                    $link = "<a href='".$link."'>Click here</a>";
                if(mail($fmail,"Forgot Password","click the below link to change password:-\n".$link,$headers)){
                    $upass="INSERT INTO forgotpass (code) VALUES ('$code')";
                    $ures=mysqli_query($conn,$upass);
                    if($ures){
                        echo "mail sent";
                    } 
                }
                else{
                    echo "mail not sent";
                }               
            }
            else{
                echo "mail fail";
            }

    }

?>