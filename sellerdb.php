<?php 
  
        include "connection.php";
    
          $cname = $_POST['cname'];
        $cat = $_POST['cat'];
        $uname = $_POST['uname'];
        $img1 = $_POST['img1'];
        $img2 = $_POST['img2'];
        $img3 = $_POST['img3'];
        $mobile = $_POST['mobile'];
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $loc = $_POST['loc'];
        $query =  mysqli_query($conn,"INSERT INTO sellers (company_name,category,username,password,mobile,email,img1,img2,img3,location) VALUES('$cname','$cat','$uname','$pass','$mobile','$mail','$img1','$img2','$img3','$loc')");
        if($query){
            ?>
                <script>
                    alert("Registered Successfully");
                </script>
            <?php
            header("Location:selller.php");
        }
       
?>