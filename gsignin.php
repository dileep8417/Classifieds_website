<?php
    include "connection.php";
    @session_start();
    if(isset($_POST['profileinfo'])){
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $profile = $_POST['profileimg'];
        $pass = array();
        $arr = "abcdefghojklmnopqrstuxyz@_-.,/1234567890";
        for($i=0;$i<20;$i++){
            $pass[$i] = $arr[rand(0,strlen($arr)-1)]; 
        }
        $pass = implode(",",$pass);
        $query="SELECT * FROM signupdb WHERE email='$mail'";
        $res=mysqli_query($conn,$query);
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                $_SESSION["mail"]=$row['email'];
                $_SESSION['id']=$row['id'];
                $_SESSION['username']=$row['uname'];
        }
        $update="UPDATE signupdb SET track=1 WHERE email='$mail'";
        $updateres=mysqli_query($conn,$update);
        echo "success";
        }else{
            $pass = mysqli_real_escape_string($conn,$pass);
            $query = mysqli_query($conn,"INSERT INTO signupdb (uname,email,password,profile) VALUES('$name','$mail','$pass','$profile')");
            if($query){
                $_SESSION["mail"]=$row['email'];
                $_SESSION['id']=$row['id'];
                $_SESSION['username']=$row['uname'];
                $update="UPDATE signupdb SET track=1 WHERE email='$mail'";
                $updateres=mysqli_query($conn,$update);
               echo "success";
            }
        }
    }
  
?>

