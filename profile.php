<?php @session_start();

include "connection.php";
$count=0;
if(isset($_SESSION['id'])){
    $user=$_SESSION['id'];
}else{
    $user="";
}
#For Messages
$querycount="SELECT * FROM chat WHERE send_to='$user' AND count=1";
$rescount=mysqli_query($conn,$querycount);
if(mysqli_num_rows($rescount)>0){
    while($row=mysqli_fetch_assoc($rescount)){
        $count++;
    }
    $_SESSION['newmessages']=$count;
}

    #Normal Sessions for response
    if(@$_SESSION['sellermailsuccess']!=null){
        ?><script>alert("Message sent to seller sucessfully");</script>
        <?php
        unset($_SESSION['sellermailsuccess']);
    }
    if(@$_SESSION['sellermailfail']!=null){
        ?><script>alert("Something wrong message not sent");</script>
        <?php
         unset($_SESSION['sellermailfail']);
    }
    if( @$_SESSION['whishlistadd']!=null){
        ?><script>alert("Item Whishlisted");</script>
        <?php
         unset($_SESSION['whishlistadd']);
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $_SESSION['username']?></title>
    
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <style>
        body{
            overflow-X:hidden;
        }
        .table tr:hover{
            cursor:pointer;
            background:#9b59b6;
        }
        .product-details .card,.product-details .card-body{
            min-width:250px !important;
            max-width:300px;
        }
       #intro-img{
           margin:0px;
           padding:0px;
           width:100vw;
           height:450px;
       }
      
    </style>
</head>
<body>
    <?php include "loginheader.php";
        #Starting code
    ?>
    <div id="intro-img" class="container-fluid text-center">
      <?php include "search.php"?>
    <img src="images/intro.jpg" alt="" style="width:90vw;height:100%">
    </div>
    <div class="container my-5">
        <div class="row">
                <div class="card col-md-4">
                    <h3 class="card-title">Properties</h3>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr onClick="location.href='home.php?cat=house'">
                            <td>
                                <span style="font-size:30px;color:#2ed573"><i class="fas fa-building"></i></i></span>
                            </td>
                            <td>Houses & Appartments</td>
                            </tr>
                            <tr onClick="location.href='home.php?cat=land'">
                                <td>
                                    <span style="font-size:30px;color:green"><i class="fas fa-tree"></i></span>
                                </td>
                                <td>Lands & Plots</td>
                            </tr>
                            <tr onClick="location.href='home.php?cat=office'">
                                <td>
                                    <span style="font-size:30px;color:#F79F1F"><i class="fas fa-store"></i></i></span>
                                </td>
                                <td>Shops & Offices</td>
                            </tr>
                        </table class="table table-borderless">
                    </div>
                </div>
                <div class="card col-md-4">
                    <h3 class="card-title">Vehicles</h3>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr onClick="location.href='home.php?cat=car'">
                                <td> <span style="font-size:30px;color:#1e90ff"><i class="fas fa-car"></i></span></td>
                                <td>Cars</td>
                            </tr>
                            <tr onClick="location.href='home.php?cat=bike'">
                                <td><span style="font-size:30px;color:#6ab04c"><i class="fas fa-motorcycle"></i></span></td>
                                <td>Bikes</td>
                            </tr>
                            <tr onClick="location.href='home.php?cat=other'">
                                <td><span style="font-size:30px;color:#535c68"><i class="fas fa-truck"></i></span></td>
                                <td>Other</td>
                            </tr>
                        </table class="table table-borderless">
                    </div>
                </div>
                <div class="card col-md-4">
                    <h3 class="card-title">Gadgets</h3>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr onClick="location.href='home.php?cat=mobile'">
                                <td><span style="font-size:30px;color:#2f3640"><i class="fas fa-mobile-alt"></i></span></td>
                                <td>Mobiles & Tablets</td>
                            </tr>
                            <tr onClick="location.href='home.php?cat=computer'">
                                <td><span style="font-size:30px;color:#7f8fa6"><i class="fas fa-laptop"></i></span></td>
                                <td>Laptops & Computers</td>
                            </tr>
                            <tr onClick="location.href='home.php?cat=camera'">
                                <td><span style="font-size:30px;color:#192a56"><i class="fas fa-camera-retro"></i></span></td>
                                <td>Camera & Recorders</td>
                            </tr>
                            <tr onClick="location.href='home.php?cat=accessories'">
                                <td><span style="font-size:30px;color:#44bd32"><i class="far fa-keyboard"></i></span></td>
                                <td>Accessories</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card col-md-4">
                    <h3 class="card-title">Furniture</h3>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr onClick="location.href='home.php?cat=furniture'">
                                <td><span style="font-size:30px;color:#d63031"><i class="fas fa-couch"></i></span></td>
                                <td>Furniture and Decoratives</td>
                            </tr>
                            <tr onClick="location.href='home.php?cat=electronic'">
                                <td><span style="font-size:30px;color:#636e72"><i class="fas fa-plug"></i></span></td>
                                <td>Electronic furniture</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card col-md-4">
                    <h3 class="card-title">Local Stores</h3>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr onClick="location.href='home.php?cat=repair'">
                                <td><span style="font-size:30px;color:#f39c12"><i class="fas fa-store-alt"></i></span><br></td>
                                <td>Service centers & Repairs</td>
                            </tr>
                            <tr onClick="location.href='home.php?cat=store'">
                                <td><span style="font-size:30px;color:#95a5a6"><i class="fas fa-shopping-cart"></i></span></td>
                                <td>Grocessory</td>
                            </tr>
                        </table>
                    </div>
                </div>
        </div>
    </div>
  <h3 class="text-danger" style="padding-left:15px;">Recent Posts</h3>
        <div class="product-details offset-2" style="margin-bottom:25px">
        <?php include "home.php"?>
        </div>
   <button class="btn btn-lg btn-primary loadmore" onClick="loadMore()" style="position:relative;margin-bottom:35px; left:50%;transform:translateX(-50%)">Load More</button>
    
        <div class="footer" style="position:relative;left:0px;padding:0px;width:100vw;height:85px;background:#b8e994">
        <p class="lead text-dark text-center" style="position:relative;top:50%;transform:translateY(-50%)"><b>Copyright@Dileep8417</b></p>
    </div>
    <script>
        var n = 3;
        var q = 3;
        function loadMore(){
            q=q+n;
            $(".product-details").load("home.php?q="+q);
            let count = "<?php echo $_SESSION['count']?>";
            if(count<q){
                $(".loadmore").css("display","none");
            }
            console.log(count)
        }
    </script>
</body>
</html>