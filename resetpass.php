<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php include "header.php"?>
    <style>
     #main{
            height:220px;
            top:150px;
        }
        form{
           position:relative;
           top:40px;
        }
        input{
            margin-bottom:20px;
        }
    </style>
</head>
<body>
    <?php 
    session_start();
    if(!isset($_SESSION['vmail'])){
        header("Location:login.php");
    }
        if(isset($_POST["newpass"])&&isset($_POST["repass"])){
            $pass = $_POST["newpass"];
            $repass = $_POST["repass"];
            $mail = $_SESSION["vmail"];
            if($pass!=$repass){
                ?><script>
                    alert("Password and re entered password must match");
                </script>
                <?php
            }else if(strlen($pass)<3){
                ?><script>
                alert("Password length must be more than 4 charecters");
            </script>
            <?php
            }else{
                include "connection.php";
                $query = "SELECT * FROM signupdb WHERE email='$mail'";
                $res = mysqli_query($conn,$query);
                if(mysqli_num_rows($res)>0){
                    $query = "UPDATE signupdb SET password='$pass' WHERE email='$mail'";
                    $res = mysqli_query($conn,$query);
                    if($res){
                        ?><script>alert("Password successfully updated!");</script>
                    <?php
                    $_SESSION['passupdated']="Password Sucessfully updated";
                    header("Location:login.php");
                    }
                }
            }
        }
    ?>

    <div id="main">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <input type="password" name="newpass" placeholder="Enter the new password">
            <br><br>
            <input type="password" name="repass" required placeholder="Re-enter the password">
            <input type="submit" value="Change" class="btn btn-primary">
        </form>
    </div>
</body>
</html>