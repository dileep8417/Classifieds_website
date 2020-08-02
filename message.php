<?php
    session_start();

    if($_SESSION['mail']==null){
        $_SESSION['sendmsgerr']="exist";
        header("Location:login.php");
    }
  @$_SESSION['sellermail']= $_GET['sellermail'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <style>
      body,html{
        height:100%;
        width:100%;
        color:white;
        background-image: url(images/homebg2.jpg);
        background-repeat: no-repeat;
        background-size:cover;
        overflow:hidden;
        box-sizing:border-box;
        
      }

#main{
    position: relative;
    text-align: center;
    top:10px;
    margin:auto;
    background:rgba(255,255,255,.8);
    width:400px;
    height:500px;
    border-radius: 10px;
    border:1px solid white;
    background:rgba(255,255,255,.5);
    box-shadow:15px 20px 6px black;
    border:none;
}

input{
    width:80%;
   border:none;
   border-bottom: 1px solid black;
    background: none;
    outline:none; 
}
textarea{
    outline: none;
    background: none;
    border:1px solid black;
    border-radius:10px;
}
#full{
    position: absolute;
    min-width:100%;
    min-height:100%;
    background:rgba(0,0,0,.6);
}

        #main{
            height:340px;
            top:60px;
            border-radius:10px;

        }
        form{
            position:relative;
            top:0px;
        }
        input{
            margin-bottom:15px;
        }
        textarea{
            margin-bottom:10px;
        }
        #txt{
            width:100%;
            height:70px;
            position:relative;
            transform:translateY(-50%);
            background:green;
            border-top-right-radius:20px;
            border-top-left-radius:20px;
        }
        #txt h3{
            position:relative;
            top:50%;
            transform:translateY(-50%);
        }

    </style>
    <title>Message</title>
    <?php include "loginheader.php"?>
</head>
<body>
<div id="full"></div>
    <div id="main">
    <div id="txt"><h3>Contact Seller</h3></div>
        <form action="sendmsg.php"method="post">
            <input type="text" placeholder="Name"  name="bname" required>
            <textarea name="msg" cols="44" rows="6" placeholder="message" required></textarea>
            <input type="submit" value="Send" class='btn btn-primary'>
        </form>
</div>

</body>
</html>