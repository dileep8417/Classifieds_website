
<?php
    session_start();
    if(isset($_SESSION['mail'])){
        header("Location:profile.php");
    }
    include "loginheader.php";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include "connection.php";
        #Validating Login details
        if(isset($_POST["Luser"]) && isset($_POST["Lpass"])){
            function validate($data){
                $data=trim($data);
                $data=stripslashes($data);
                $data=htmlspecialchars($data);
                return $data;
            }
            $mail=validate($_POST['Luser']);
            $pass=validate($_POST['Lpass']);
            $query="SELECT * FROM signupdb WHERE email='$mail' AND password='$pass'";
            $res=mysqli_query($conn,$query);
            if(mysqli_num_rows($res)>0){
                while($row=mysqli_fetch_assoc($res)){
                    $_SESSION["mail"]=$row['email'];
                    $_SESSION['id']=$row['id'];
                    $_SESSION['username']=$row['uname'];
                }
                $update="UPDATE signupdb SET track=1 WHERE email='$mail'";
                $updateres=mysqli_query($conn,$update);
                header("Location:profile.php");
            }else{
               ?><script>alert("Invalid username or password");</script><?php
           }
        }
        #Validating Signup details
        $_SESSION['tusername']= $_SESSION['tmail']="";
        if(isset($_POST['uname']) && isset($_POST['mail']) && isset($_POST['pwd']) && isset($_POST['repwd'])){
            function validate($data){
                $data=trim($data);
                $data=stripslashes($data);
                $data=htmlspecialchars($data);
                return $data;
            }
            $_SESSION['tusername']=$_POST['uname'];
            $_SESSION['tmail']=$_POST['mail'];
            if($_POST['pwd']!=$_POST['repwd']){
                $_SESSION['passworderr']=true;
            }
            if(strlen($_POST['pwd'])<4){
                $_SESSION['pwdlenerr']=true;
            }
            else{
                $uname=validate($_POST['uname']);
                $mail=validate($_POST['mail']);
                $pass=validate($_POST['pwd']);
                $query="SELECT * FROM signupdb WHERE email='$mail'";
                $res=mysqli_query($conn,$query);
                if(mysqli_num_rows($res)>0){
                    $_SESSION['mailexist']=true;
                }else{
                     #Inserting image to db
                        $profile_pic=$_FILES['profile']['name'];
                         $tmp_name=$_FILES['profile']['tmp_name'];
                        $dir="profiles/";
                        $path=$dir.$profile_pic;
                       $up = move_uploaded_file($tmp_name,$path);
                           if($path==$dir){
                                $path="";
                           }
                                $query="INSERT INTO signupdb (uname,email,password,profile) 
                               VALUES ('$uname','$mail','$pass','$path')";
                               $res2=mysqli_query($conn,$query);
                         
                     if($res2){
                         ?><script>alert("Sucessfully registerd")</script><?php
                         echo("<script>location.href = 'http://localhost/phpfiles/modifiedproject/index.php';</script>");
                     }
            }
        }
    }
}
    #Error responses
    if(isset($_SESSION["passworderr"])){
        ?><script>alert("Password and Re-password must match")</script><?php
        unset($_SESSION["passworderr"]);
    }
    if(isset($_SESSION['pwdlenerr'])){
        ?><script>alert("Password should be more than 4 charecters")</script><?php
        unset($_SESSION['pwdlenerr']);
    }
    if(isset($_SESSION['mailexist'])){
        ?><script>alert("Email already exist")</script><?php
        unset($_SESSION['mailexist']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
    <meta name="google-signin-client_id" content="19400985300-14jnlclejp33790m2s3nji9hp34acvsj.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Cabin|Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">   
    <style>
        #details-container{
            position:relative;
        }
       body,html{
           width:100%;
           min-height:100vh;
           background:blue;
           overflow:auto;
       }
        body{
           background:linear-gradient(rgba(0,0,0,.75),
           rgba(0,0,0,.75)
           ),url(images/homebg2.jpg);
           background-repeat:no-repeat;
           background-size:cover;
            color:black;
            margin:0px;
            padding:0px;
          overflow:auto;
          height:100vh;
        }
        body img{
            height:100vh;
            width:100vw;
        }
        .navbar ul{
            display:none;
        }
        .frame{
            width:330px;
            height:500px;
            position: relative;
            margin:auto; 
            border:1px solid white;
            transition:all .5s;
            top:0px;  
            transition: all .5s; 
            overflow:hidden ;
            background:white;
            border-radius:10px;
           float:right;
           right:20px;
           display:none;
           transition:all .5s;
        }
        
        ::placeholder{
            color:black;
        }
        .login{
            width:100%;
            height:100%;
            position: relative;
            top:50%;
            transform:translateY(-50%);
            transition: all .5s;      
        }
        input{
            width:90%;
            display:block;
            margin:auto;
            border:none;
            border-bottom:1px solid black;
            outline:none;
            background:none;
        }
        .login-btn{
            width:80%;
            display: block;
            margin:auto;
            position: relative;
        }
        .line1,.line2{
            width:45%;
            border-top:2px solid grey;
            position:relative;
            top:60px;
        }
        .line1{
            top:66px;
        }
       .line2{
        top:40px;
           float:right;
           right:-2%;
       }
       .user-login{
           cursor:pointer;
       }
       .separator{
           display:block;
           text-align:center;
           position: relative;
           top:50px;
           left:5px;
       }
       .social-txt{
           position:relative;
           top:70px;
           left:5px;
       }
       .google-login{
           width:90%;
           display:block;
           margin:auto;
           position:relative;
           top:70px;
       }
     
        #user-signup{
           width:100%;
           height:100%;
           position:relative;
           top:-100%;
           right:-100%;
           transition: all .5s; 
        }
        #user-signup{
              transition: all .5s;
        }
        .signup-btn{
            display: block;
            margin: auto;
            width:80%;
            position: relative;
            top:-6px;
        }
        .options{
            width:150px;
        }
        table{
            width:90%;
            margin:auto;
        }
        input[type="file"]{
            position: relative;
            top:15px;
            background: transparent;
        }
        .register-txt{
            font-size:35px;
        }
        .user-register{
            cursor:pointer;
        }
        .signup-txt{
            position:relative;
            top:100px;
            left:15px;
        }
        .login-txt{
            position:relative;
            top:-5px;
            left:15px;
        }
        #loginbtn{
            background:rgb(74,189,172);
            width:70%;
            color:white;
        }
        .tb{
            position: relative;
            top:2px;
        }
        .err{
            color:red;
            display:block;
            text-align:center;
            padding:5px;
        }
        .instructions{
            position:absolute;
            margin-top:40px;
        }
     .upload-btn{
         width:180px;
         padding:6px;
     }
     
     .btn1{
         display:block;
         margin:auto;
         margin-top:55%;
         margin-left:60%;
     }
     .btn-2{
         position:relative;
         top:-20px;
     }
     .head-intro{
         position:relative;
         font-size:55px;
         font-family: 'Nunito', sans-serif;
     }
    .navbar-toggler-icon,.navbar button{
        display:none;
    }
   .delay{
        color:white;
         position:relative;
         top:30%;
         transform:translateY(-30%);
         animation:anim 1s ease-out;
   }
  
     #intro{
         border-radius:10px;
         position:relative;
         box-shadow:2px 3px 4px black;
         top:200px;
         left:20px;
     }
    .intro-txt{
        font-size:20px;
        font-family: 'Cabin', sans-serif;
        position:relative;
        color:#dfdce3;
    }
   #auth-details{
       width:350px;
       min-height:150px;
       position:absolute;
       right:33vw;
       top:12vh;
       font-size:3.5vmin;
       color:white;
       text-align:justify;
       display:none;
   }
   
    .continue-btn{
        position:relative;
        top:200px;
        left:25px;
        width:175px;
        border-radius:10px;
        box-shadow:2px 3px 4px black;
    }
    ::placeholder{
        color:rgba(0,0,0,.7);
    }
    .toggler-icon{
        color:white !important;
        z-index:1000 !important;
    }
    @keyframes anim{
        from{left:-100%}
        to{left:0}
    }
    @keyframes anim2{
        from{top:100vh;opacity:0}
        to{top:-20px}
    }
    @keyframes anim4{
        from{opacity:0;}
        to{opacity:1}
    }
   
      
        #forgot-window{
            width:350px;
            height:200px;
            position:absolute;
            background:white;
            left:50%;
            top:200px;
            transform:translateX(-50%);
            text-align:center;
            z-index:1000;
            border-radius:7px;
            transition:all .5s;
            overflow:hidden;
            transition:all .5s;
            display:none;
        }
        @media(max-width:1000px){
            #auth-details{
                left:25vw;
            }
        }
        @media(max-width:930px){
            #auth-details{
                left:20vw;
            }
        }
        @media(max-width:900px){
            #auth-details{
                left:15vw;
            }
        }
        @media(max-width:780px){
            #auth-details{
                display:none !important;
            }
            .frame{
                position:relative;
                transform:translateX(-50%);
            }
        }
        @media(max-width:550px){
            .frame{
                left:80px;
                float:right !important;
            }
        }
       
        #forgot-window input{
            position:relative;
            top:40px;
            border:1px solid #41B3A3;
            width:90%;
            height:30px;
            border-radius:10px;
            padding-left:10px;
            outline:none;
        }
     @keyframes anime1{
        from{transform:translateX(-50%) scale(0)}
        to{transform:translateX(-50%) scale(1)}
    }
    </style>
</head>
<body>
        <button class="btn btn-md btn-primary" onClick="location.href='sellerlogin.php'" style="float:right;position:absolute;top:33px;right:15px;z-index:1000">Business Login</button>
        <!--Intro Animation-->
        <h1 class="head-intro col-md-8 col-lg-8 col-sm-12 col-xs-12 delay">Welcome users</h1>
        <p class="intro-txt col-md-8 col-lg-8 col-sm-12 col-xs-12 delay">This is the platform for selling your new or used products more easily with privacy
       <p class="intro-txt col-md-8 col-lg-8 col-sm-12 col-xs-12 delay">If you want a product (new or used) or sell a product this is the right place,here you can also ask sellers about your desired things</p> </p>
       <button class="intro-btn btn btn-md btn-primary delay"  id="intro">Login/Register</button><span class="continue-btn text-white or">OR</span>
       <button class="continue-btn btn btn-md btn-outline-warning text-white delay"><b>Continue to site</b></button>
       <!-- ------------------------------------------------------------------------- -->

       <div id="auth-details">
                    <p>After Login you can able to access <br>
                    Your profile, chats, whishlist and <br> many more.
                    </p>
       </div>

            <!--Login and signup details-->
      
  <div class="frame">
            <!--Login details-->
            <div class="login">
                <!--Login Form-->
                <!--Showing errors-->
                <div class="style" style="position:relative;width:10x;height:10px;background:#fc4a1a;top:0px;left:0px;"></div>
                <h2 class="display-5 text-center mb-3 text-primary" style="font-family:'Merriweather',serif;">Login</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                    <input type="text" placeholder="UserID"  name="Luser" id="login-username" required><br>
                    <input type="password" placeholder="Password" name="Lpass" id="login-password" required><br>
                    <button type="submit" class="btn login-btn" id="loginbtn">Login</button>
                    <p style="float:right;position:relative;right:15px;top:10px;diaplay:block;margin-bottom:-10px;">Forgot password <a  class="text-primary" href="#" onClick="showFgWindow()"><b>click here</b></a></p>
                </form>
                    <div class="lines">
                        <div class="line1"></div>
                        <div class="separator">OR</div>
                        <div class="line2"></div>
                    </div>
                    <p class="lead social-txt">Use Social Login</p>

                    <!-- Google Login -->
                    <button class="g-signin2" data-onsuccess="onSignIn" style="position:relative;top:75px;display:none;background:none;border:none;display:block;margin:auto"></button>
                    <p class="lead signup-txt">Don't have an account <span class="user-register text-primary"><b>Register</b></span></p>
                </div>

            <!--Signup details-->
        <!--User signup-->
        <div id="user-signup">

        <div class="style" style="position:relative;width:10x;height:10px;background:#fc4a1a;top:0px;left:0px;"></div>
            <h2 class="display-5 text-center signup-intro mb-3" style="color:rgb(74,189,172);font-family:'Merriweather',serif;">Signup</h2>
            <td><img src="images/profile.png" alt="" id="img" style="width:85px;height:85px;border-radius:50%"></td>
                            <td><button class="upload-btn btn-primary" onClick="document.getElementById('files').click()">Upload</button></td>
                            
                <form  class="form-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" enctype="multipart/form-data">
                <table class="tb">
                            <tr>
                            <td><input type="file" id="files" style="display:none" onchange="preview.call(this)"  name="profile"></td>
                            </tr>
                        </table><br>
                        <input type="text" placeholder="User name" value="<?php echo @$_SESSION['tusername']?>" name=uname required><br>
                        <input type="mail" placeholder="Email ID" value="<?php echo @$_SESSION['tmail']?>" name='mail' required><br>
                        <input type="password" placeholder="Password" name='pwd' required><br>
                        <input type="password" placeholder="Re-Password" name='repwd' required><br>
                        <input type="submit" class="btn btn-outline-success signup-btn" value="Register">
              </form>
                    <p class="lead login-txt">Already have account <span class="user-login text-primary"><b>Login</b></span></p>
    </div>
    </div>
    <!----------------------------------------------------------------------------->

    <!--------FORGOT PASSWORD WINDOW----------->
            <div id="forgot-window">
            <div id="fg-pass">
            <img src="images/wrong.jpg" class="wrong-img" width="80px" height="80px" alt="" style="position:absolute;margin-left:110px;margin-top:25px;display:none;">
            <img src="images/success.png" class="success-img" width="80px" height="80px" alt="" style="position:absolute;margin-left:110px;margin-top:25px;display:none;">
            <img src="images/spinner.gif" class="spinner" width="80px" height="80px" alt="" style="position:absolute;margin-left:110px;margin-top:25px;">
                <span class="close" style="position:relative;right:15px;top:5px;"><h5>X</h5></span>
                <div style="text-align:center"><h4>Forgot Password</h4></div>
                <span class="ferr text-warning" style="position:absolute"></span>
                <div class="fg-body" style="display:block">
                <input type="email" placeholder="Enter Reg. EmailID" id="fg-mail"><br>
                <button class="btn btn-info" id="get-pass" style="margin:auto;width:50%;position:relative;top:55px">Change password</button>
                </div>
            </div>
            </div>
            <!----------------------------------------------->

    <script>
        function preview(){
            if(this.files && this.files[0]){
                var obj = new FileReader();
                obj.onload=function(e){
                    var image = document.getElementById("img");
                    image.src=e.target.result;
                }
                obj.readAsDataURL(this.files[0]);
            }
        }
        
        function showFgWindow(){
           
            $("#forgot-window").css("display","block").css("animation","anime1 .3s linear");
        }

        $(".close").click(function(){
            $("#forgot-window").css("display","none");
        });
    $(document).ready(function(){
      
        $(".navbar").addClass("bg-transparent");
        $(".navbar").addClass("navbar-transparent");
        
        //image preview
        
        $(".user-login").click(function(){
            $("#user-signup").css("left","100%");
            $(".login").css("left","0px");
            $(".login-info").css("display","inline-block");
            $(".signup-info").css("display","none");
            $("#auth-details").html(`<p>After Login you can able to access <br>
                    Your profile, chats, whishlist and <br> many more.
                    </p>`);
           });
        $(".user-register").click(function(){
            $("#user-signup").css("left","0px");
            $(".login").css("left","-100%");  
            $(".login-info").css("display","none");
            $(".signup-info").css("display","inline-block");
            $("#auth-details").html(` <p>Uploading profile picture is optional and Enter valid details <br></p>
                    <p>Password must be greater than 4 charecters</p>`);
         });
         $(".continue-btn").click(function(){
             location.href="withoutlogin.php";
         });
        $("#intro").click(function(){
            $(".delay").animate({"left":"-100%","opacity":"0px"},500,"linear").hide(400);
            $(".frame").css("display","block").css("animation","anim2 1s linear");
            $(".login-info").css("animation","anim4 1.3s linear").css("display","inline-block");
            $(".or").css("display","none");
            $("#auth-details").fadeIn(1000);
        });
    });

    //FORGOT PASSWORD 
    $("#get-pass").click(function(){
        var mail = $("#fg-mail").val();
        if(mail.length<7){
            $(".ferr").html("Enter valid email").addClass("text-danger");
        }else{
            $(".fg-body").css("display","none");
            $(".spinner").css("display","block");
            $.ajax({
                url:"forgotpass.php?fgpass="+mail,
                type:"GET",
                success:function(response){
                    var c = response;
                    if(c=="mail sent"){
                        $(".spinner").css("display","none");
                        $(".wrong-img").css("display","none");
                        $(".fg-body").css("display","none");
                        $(".success-img").css("display","block");
                        $(".ferr").html("Reset link sent to your mail").addClass("text-success").css("margin-right","65px").css("margin-top","95px");
                    }
                    else if("mail not sent"){
                        $(".ferr").html("Something wrong try later").addClass("text-danger").css("margin-right","65px").css("margin-top","95px");
                    }
                    else{
                        $(".spinner").css("display","none");
                        $(".fg-body").css("display","none");
                        $(".wrong-img").css("display","block");
                        $(".ferr").html("EmailId not registered").addClass("text-danger").css("margin-right","65px").css("margin-top","95px");
                    }
                }
            });
        }
    });

    // Google
    function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
                let name = profile.getName();
                let profileimg =  profile.getImageUrl();
                let mail =  profile.getEmail();
                if(mail.length!=null){
                    $.ajax({
                        url:"gsignin.php",
                        type:"POST",
                        data:{
                            profileinfo:true,
                            name,
                            mail,
                            profileimg
                        },
                        success:function(resp){
                            resp=resp.trim();
                            if(resp=="success"){
                                location.href="profile.php";
                            }
                          
                        }
                    });
                }
            }
    </script>
</body>
</html>