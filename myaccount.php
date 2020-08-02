<?php
    session_start();
    $active_ads=$total_ads=$sold=$wlist_count=0;
    include "loginheader.php";
    include "connection.php";
    $user=$_SESSION['id'];
    #Uploading profile
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(move_uploaded_file($_FILES['files']['tmp_name'],"profiles/".$_FILES['files']['name'])){
            $profile="profiles/".$_FILES['files']['name'];
            $query="UPDATE signupdb SET profile='$profile' WHERE id='$user'";
            $res=mysqli_query($conn,$query);
            header("Location:myaccount.php");
        }
    }
   
    #Counting active items 
    $query="SELECT * FROM itemsdb WHERE user_id='$user'";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        while(mysqli_fetch_assoc($res)){
            $active_ads++;
        }
    }
    #Counting wlist items
    $query="SELECT * FROM whishlist WHERE userid='$user'";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        while(mysqli_fetch_assoc($res)){
            $wlist_count++;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Account</title>
<head>
<script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Cabin|Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        #head{
            width:100vw;
            height:auto;
            border:1px solid black;
            position:relative;
            background:#2980b9;
            background-size:cover;
            background-repeat:no-repeat;
            margin:auto;
        }
        body{
            overflow-Y:auto !important;
            background:white !important;
            overflow-X:hidden;
        }
        .info{
            width:100%;
            height:auto;
            position:relative;
            top:30px;
            padding:10px;
            font-size:22px;
        }
        .details{
				width:500px;
				height:auto;
				position:relative;
                border:1px solid green;
                border-radius:10px;
                background:rgba(255,255,255,.5) !important;
                padding:5px;
                font-size:25px;
				top:80px;
                color:yellow !important;
                display:block;
                margin:auto;
			}
        .details table{
            color:black !important;
        }
        #chg{
               position:absolute;
                margin-left:10px;
                bottom:0px;
            }
        #profile{
            width:150px;
            height:170px;        
            position:relative;
            margin-top:1px;
            border-radius:15px;
            padding:0px;
            top:55px;
            left:25px;
           border:2px solid white;
        }
        #profile:hover{
            cursor:pointer;
        }
        }
        #pbtn{
            width:180px;
            text-align:center;   
        }
        .holder{
            width:500px;
            height:300px;
            position:relative;
        }
        img{
            width:150px;
            height:170px;
            padding:10px;
        }
        .headings{
            padding:7px;
            text-align:center;
        }
       .headings li{
           position:relative;
           display:inline;
       }
       .headings li{
           margin-left:20px;
       }
        .S-post{
            display:none;
        }
        .changes{
            box-shadow:2px 3px 4px black;
        }
       
       @media(max-width:700px){
        #profile{
                margin:auto;
            }
       }
        @media(max-width:600px){
            .S-post{
                display:block;
            }
            .details{
                width:100%;
            }
            .headings li{
                display:block;
                line-height:30px;
                text-align:center;
            }
            #head{
                width:100%;
            }
            .info{
                height:auto;
            }
            .post-btn{
                display:none;
            }
        }
        @media(max-width:550px){
            .changes{
                position:relative;
                right:23px;
            }
        }
    </style>
</head>
<body>
  
<?php 
         
        if(isset($_SESSION['mail'])){
           $mail=$_SESSION['mail'];
            #----------------------------------------------
            $query = "SELECT * FROM signupdb WHERE email='$mail'";
            $res = mysqli_query($conn,$query);
            if(mysqli_num_rows($res)>0){
                while($row = mysqli_fetch_assoc($res)){
                   $name = $row['uname'];
                   $first = $row['firstaccessed'];
                   $id = $row['id'];
                    $profile=$row['profile'];
                    $selled_count=$row['selled_items'];
                    $total_ads=$row['total_ads'];
                    if($profile==""){
                        $profile="images/profile.jpg";
                    }
                   
    if(isset($_SESSION['deleted'])){
        ?><script>
        alert("Your Ad sucessfully deleted");
    </script><?php
    unset($_SESSION['deleted']);
    }
?> 

                   <!--User Details-->
  <div id="head">
   <img id="profile" style="" onClick="document.getElementById('files').click()" src="<?php echo $profile?>" alt="">
   <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
   <input type="file" accept="image/jpg,image/jpeg,image/png" style="display:none" onchange="updateImg.call(this)" name="files" id="files">
    <button type="submit" class="uploadProfile btn btn-warning text-white" style="position:relative;top:18px; left:18px;box-shadow:2px 3px 4px black;display:none">Upload</button>
</form>

<!--info contains Total Ads, Active Ads, No.of wlist items,Sold items-->
<div class="info text-dark">
    <ul class="headings">
            <li>Total posted Ads :&nbsp; <?php echo $total_ads?></li>
            <li>Active Ads :&nbsp; <?php echo $active_ads?></li>
            <li>Selled :&nbsp; <?php echo  $selled_count?></li>
            <li>Whishlisted :&nbsp; <?php echo  $wlist_count?></li>
    </ul>
</div>
</div>

        <div class="container">
            <div class="row">
            <div class="table table-borderless card my-5 col-md-6 col-sm-12">
                   <h4 id="name1">My account</h4>
                   <table>
                <tr>
                   <td>Username</td>
                   <td><?php echo $name?></td>
                </tr>
                <tr>
                   <td>EmailId</td>
                   <td><?php echo $_SESSION['mail']?></td>
                   <td><button class="btn changes btn-primary">Update</button></td>
                </tr>
                <tr>
                    <td>First Accessed</td>
                    <td><?php echo $first?></td>
                </tr>
                <tr>
                <td>Total posted Ads </td>
                <td><?php echo $total_ads?></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>*********</td>
                    <td><button class="btn changes btn-warning">Change</button></td>
                </tr>
                </table>
                  
                   <script>
                       function update(){
                          var res = confirm("Do you want to change Email Id ?");
                            if(res==true){
                                window.location="updateemail.php?id=<?php echo $id?>";
                            }
                       }
                   </script>
           </div>

           <div class="forums  jumbotron my-5 col-md-6">
               <p class="text-center text-primary" style="font-size:18px;position:relative;top:-45px">Recently Asked Questions</p>
                       <?php include "forummyqns.php"?>
            </div>
            </div>
        </div>

<?php
                }
            }
        }
    ?>
  
    <style>
        body{
            width:100%;
            background:#718093;
        }
        .details{
            background:white;
        }
        .mainframe{
            width:100%;
            float:none;
            top:-60px;
            margin:auto;
            height:280px;
            position:relative;
            float:right;
        }
        .posted{
            width:100%;
            height:400px;
            top:90px;
            position:absolute;
            border-radius:10px;
            float:right;
            overflow:auto;
        }
        .txt{
            position:absolute;
        }
        img{
            width:180px;
            height:150px;
            padding:5px;
            position:absolute;
        }
    </style>
</head>

<body>
    <div class="mainframe">
    <p style="font-size:25px;position:relative;top:55px;left:15px;" class="text-info">Your Ads</p>
    <div class="container pannel posted">
        <?php include "myaccountDB.php"?>
    </div>
    </div>
    <script>
       function updateImg(){
            if(this.files && this.files[0]){
                var obj = new FileReader();
                obj.onload=function(e){
                    var img =document.getElementById("profile");
                    img.src=e.target.result;
                }
                obj.readAsDataURL(this.files[0]);
                $(".uploadProfile").css("display","block");
            }
        }
    </script>

</body>
</html>