<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>change password</title>
    <style>
        body,html{
            width:100%;
            min-height:100%;
        }
    </style>
</head>
<body>
    
<?php
    #RUN WHEN CODE AND MAIL ARE SET
    if(isset($_GET['verify']) && isset($_GET['user'])){
        @session_start();
        include "connection.php";
        $_SESSION['tmp_mailid'] = $user = $_GET['user'];
        $_SESSION['tmp_code'] = $code = $_GET['verify'];
        $query = "SELECT * FROM signupdb WHERE email='$user'";
        $res = mysqli_query($conn,$query);

        #IF USER MAIL VALID
        if(mysqli_num_rows($res)>0){
            #CHECK CODE IS VALID OR NOT
            $cquery = "SELECT * FROM forgotpass WHERE code='$code'";
            $cres = mysqli_query($conn,$cquery);

            #IF CODE IS VALID
            if(mysqli_num_rows($cres)>0){

                #FINALLY DISPLAY FIELDS
                ?>
                    <?php include "withoutloginheader.php"?>
                    <style>
                        .navbar ul,.navbar button{
                            display:none;
                        }
                    </style>
                    <div class="chg-pass card" style="display:block;position:relative;top:20vh;left:40%;padding:15px;width:400px">
                    <div class="err"></div>
                            <h2 class="card-title">Change Password</h2>
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                                <table class="table" >
                                <tr>
                                    <td>Password:</td>
                                    <td> <input type="password" name="pass" required></td>
                                </tr>
                                <tr>
                                    <td>Re-Password:</td>
                                    <td> <input type="password" name="repass" required></td>
                                </tr>
                                <tr>
                                    <td colspan='2' class="text-center"><button class="btn btn-primary" style="margin-bottom:-20px">Update password</button></td>
                                </tr>
                                </table>
                                </form>
                            </div>
                      </div>
                      <?php
                          if(isset($_SESSION['pnm'])){
                            ?>
                                <script>
                                    $(".err").html("Password and Re-Password not matched").addClass("text-danger");
                                </script>
                            <?php
                             unset($_SESSION['pnm']);
                        }
                        if(isset($_SESSION['plen'])){
                            ?>
                            <script>
                                $(".err").html("Password length must be more than 4 charecters").addClass("text-danger");
                            </script>
                        <?php
                         unset($_SESSION['plen']);
                        }
                    ?>
                <?php
            }
        }
    }

    if(isset($_POST["pass"]) && isset($_POST["repass"])){
        @session_start();
        include "connection.php";
        $user = $_SESSION["tmp_mailid"];
        $code  = $_SESSION["tmp_code"];
        $pass = $_POST["pass"];
        $repass = $_POST["repass"];
        if($pass!=$repass){
            $_SESSION['pnm'] = true;
            header("Location:http://localhost/phpfiles/modifiedproject/verify.php?user=".$user."&verify=".$code."");
        }
        else if(strlen($pass)<4){
            $_SESSION['plen'] = true;
            header("Location:http://localhost/phpfiles/modifiedproject/verify.php?user=".$user."&verify=".$code."");
        }else{
            $update = mysqli_query($conn,"UPDATE signupdb SET password='$pass' WHERE email='$user'");
            if($update){
                $del = mysqli_query($conn,"DELETE FROM forgotpass WHERE code='$code'");
                ?>
                    <script>
                        alert("Password changed.");
                        location.href="index.php";
                    </script>
                <?php

            }
        }
    }
?>
</body>
</html>