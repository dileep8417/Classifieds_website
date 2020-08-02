<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php include "withoutloginheader.php"?>
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <style>
        #main{
            height:150px;
            top:200px;
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
            if(isset($_POST["code"])){
               
                if($_POST["code"]==$_SESSION['OTP']){
                    header("Location:resetpass.php");
                    unset($_SESSION['OTP']);
                }else{
                    ?><script>
                        alert("Enter valid code");
                    </script>
                    <?php
                }
            }
        ?>

    <div id="main">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
        <input type="text" name="code" placeholder="Enter the code" required>
        <input type="submit" class="btn btn-primary" value="Verify">
    </form>
    </div>
    
</body>
</html>