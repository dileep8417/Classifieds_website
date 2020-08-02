<?php include "myaccount.php";
    $id = $_GET['id'];
    if(@$_SESSION['mailalready']!=null){
        ?><script>alert("Email already exist enter another mail")</script>
        <?php
        unset($_SESSION['mailalready']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Email</title>
   <link rel="stylesheet" href="bootstrap/bootstrap.css">
  
    <style>
        body{
            background:#718093;
        }
        #main{
            position:relative;
            width:400px;
            height:200px;
            border:1px solid green;
            top:-70px;
            margin:auto;
            border-radius:10px;
            background:white;

        }
       form{
           position:absolute;
           width:90%;
           margin:auto;
           top:40%;
           margin-left:15px;
       }
       input{
        position:absolute;
           width:90%;
           left:20px;
           margin:auto;
           
       }
       .header{
           position:absolute;
           width:100%;
           height:60px;
           background:#29B6F6;
           border-top-left-radius:10px;
           border-top-right-radius:10px;
       }
       h4{
           position:absolute;
           top:50%;
           left:50%;
           transform:translate(-50%,-50%);
       }
        .details{
            display:none;
        }
        .mainframe{
            display:none;
        }
        ::placeholder{
            color:green;
        }
        @media(max-width:450px){
            #main{
                width:95%;
            }
        }

       
    </style>
</head>
<body>
        <div id="main">
            <div class="header"><h4>Update Mail</h4></div>
        <form action="updateemailDB.php?id=<?php echo $id?>" method="post">
            <input type="mail" placeholder="Enter new mail id" name="mail" required><br><br>
            <input type="submit" class="btn btn-success">
        </form>
        </div>
        

</body>
</html>