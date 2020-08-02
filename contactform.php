<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/index.css">
    <?php       
            include "loginheader.php";
    ?>
    <style>
    
        #main{
            height:500px;
            top:30px;
            border-top-right-radius:20px;
            border-top-left-radius:20px;
        }
        form{
            position:relative;
            top:20px;
        }
        input{
            margin-bottom:15px;
        }
        textarea{
            margin-bottom:15px;
        }
        #txt{
            width:100%;
            height:80px;
            position:relaive;
            background:orange;
            border-top-right-radius:20px;
            border-top-left-radius:20px;
        }#txt h3{
            position:relative;
            top:50%;
            transform:translateY(-50%);
        }
        @media(max-width:450px){
         #main{
             width:90%;
         }   
        }

    </style>
</head>
<body>
    <div id="full"></div>
        <?php
            if(isset($_POST["uname"])&&isset($_POST["mail"])&&isset($_POST["reason"])&&isset($_POST["subject"])){
                $name= $_POST["uname"];
                $mail = $_POST["mail"];
                $message = $_POST["reason"];
                $subject = $_POST["subject"];
                
                mail("dileep8417@gmail.com","$subject","$name sends the following messege: $message","From: $mail");
                ?><script>
                    alert("Message successfully sent");
                </script>
                <?php
        }
        ?>
        <div class="full"></div>
    <div id="main">
        <div id="txt"><h3>Contact Form</h3></div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
        <input type="text" placeholder="Name" name="uname" required>
        <input type="text" placeholder="EmailId" name="mail" required>
        <input type="text" placeholder="Subject" name="subject" required>
        <textarea cols="44" rows="7" placeholder="Reason" name="reason"></textarea>
        <input type="submit" class="btn btn-primary">
    </form>
    </div>
</body>
</html>