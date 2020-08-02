
<!DOCTYPE html>
<html lang="en">
<head>
   <?php
         @session_start();
         include "loginheader.php";
   ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seller Login</title>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">   
    <style>
        input,select{
            width:200px;
        }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
        <div class="seller-frame" style="display:block;margin:auto;padding:15px;margin-top:10vh;background:white;border-radius:10px;box-shadow:1px 2px 2px black;width:450px">
            <p class="text-primary text-center" style="font-size:24px">Seller Login</p>    
            <table class="table table-borderless col-md-6"style="">
                <input type="file" onchange="preview1.call(this)" id="img1"  name="img1" style="display:none">
                <input type="file" onchange="preview2.call(this)" id="img2" name="img2" style="display:none">
                <input type="file" onchange="preview3.call(this)" id="img3" name="img3" style="display:none">
                <tr>
                    <td>Company/Organisation name:</td>
                    <td><input type="text" name="cname"></td>
                </tr>
                <tr>
                    <td>Organisation type</td>
                    <td>
                        <select name="cat">
                            <option value="">--Please select--</option>
                            <option value="Construction">Construction</option>
                            <option value="Grocessory">Grocessory</option>
                            <option value="Cloths">Cloths</option>
                            <option value="Electronics">Electronics</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="uname"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="passs"></td>
                </tr>
                <tr>
                    <td>Mobile No.:</td>
                    <td><input type="number" name="mobile"></td>
                </tr>
                <tr>
                    <td>Email Id:</td>
                    <td><input type="email" name="mail"></td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td><input type="text" name="loc"></td>
                </tr>
            </table>
           <b> Upload company images:</b>
           <div class="imgs text-info">
               <img src="" id='tmp1' style="width:65px;height:65px" alt="">
               <img src="" id='tmp2' style="width:65px;height:65px" alt="">
               <img src="" id='tmp3' style="width:65px;height:65px" alt="">
               <span style="font-size:65px;margin-right:10px;cursor:pointer" class='holder1' onClick='document.getElementById("img1").click()'><i class="far fa-plus-square"></i></span>
               <span style="font-size:65px;margin-right:10px;cursor:pointer" class='holder2' onClick='document.getElementById("img2").click()'><i class="far fa-plus-square"></i></span>
               <span style="font-size:65px;margin-right:10px;cursor:pointer" class='holder3' onClick='document.getElementById("img3").click()'><i class="far fa-plus-square"></i></span>
           </div>
           <button class="btn btn-outline btn-success" id="submit" style="display:block;margin:Auto">Create Account</button>
        </div>
    </form>
        <script>
           
             function preview1(){
                if(this.files && this.files[0]){
                    var obj = new FileReader();
                    obj.onload=function(e){
                        var image = document.getElementById('tmp1');
                        image.src=e.target.result;
                    }
                    obj.readAsDataURL(this.files[0]);
                    $('.holder1').css("display","none");
                }
            }
            
            function preview2(){
                if(this.files && this.files[0]){
                    var obj = new FileReader();
                    obj.onload=function(e){
                        var image = document.getElementById('tmp2');
                        image.src=e.target.result;
                    }
                    obj.readAsDataURL(this.files[0]);
                    $('.holder2').css("display","none");
                }
                }

                function preview3(){
                    if(this.files && this.files[0]){
                        var obj = new FileReader();
                        obj.onload=function(e){
                            var image = document.getElementById('tmp3');
                            image.src=e.target.result;
                        }
                        obj.readAsDataURL(this.files[0]);
                        $('.holder3').css("display","none");
                    }
                }
            
        </script>
</body>
</html>