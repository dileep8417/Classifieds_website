<?php 
session_start();
    include "loginheader.php"; 
?>
<?php
    $id = $_GET['id'];
    include "connection.php";
    $query = "SELECT * FROM itemsdb WHERE id='$id'";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        while($row = mysqli_fetch_assoc($res)){
           #Commomn Fields
            $category = $row["category"];
            $seller_id = $row["user_id"];
            $product_id = $row["id"];
            $title = $row["title"];
            $price = $row["price"];
            $date = $row["date"];
            $location = $row["location"];
            $img1 = $row["image1"];
            $img2 = $row["image2"];
            if($img2=="" || $img2==" "){
                $img2 = $img1;
            }
            $new_used = $row["new_used"]; 
            $sell_rent = $row["sell_rent"];
            $description = $row["description"]; 

            #Getting Seller Mail
            $get_mail = mysqli_query($conn,"SELECT email FROM signupdb WHERE id='$seller_id'");
            $seller_account = mysqli_fetch_assoc($get_mail);
            $seller_account = $seller_account['email'];
    #----------------------------------------------------------#

            #Gadgets
            $brand = $row["brand"]; 
    #----------------------------------------------------------#

            #Properties
            $parking = $row["parking"]; 
            $breadth = $row["breadth"];
            $length = $row["length"];
            $listed_by = $row["listed_by"]; 
            $facing = $row["facing"];
            $floors = $row["floors"]; 
            $furnish = $row["furnish"];
            $bathrooms = $row["bathrooms"]; 
            $bedrooms = $row["bedrooms"];
            $plot_area = $row["plot_area"];
   #----------------------------------------------------------#   

            #vehicles
            $fuel_type = $row["fuel_type"];
            $distance_travelled = $row["distance_travelled"];
            $manf_year = $row["manf_year"];
   #----------------------------------------------------------#
        }
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $category?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <style>
        .img-holder img{
            width:100%;
            height:100%;
        }
        .img-holder{
            width:537px;
            height:355px;
            display:block;
            margin:auto;
            position:relative;
        }
        body{
            background:#f5f6fa;
        }
        @media(max-width:500px){
            .img-holder{
                width:100%;
        }
        }
    </style>
    
</head>
<body>
        <?php include "sidemenu.php"?>
    <div class="content">
        <div class="row">
            <!-- Image Section -->
            <div class="img-holder mt-3">
                <img style="position:relative;" class="img1 img-responsive" src="<?php echo $img1?>" alt="">
                <img style="position:relative;display:none" class="img2" src="<?php echo $img2?>" alt="">
                <div style="font-size:50px;cursor:pointer;position:relative;left:25px;float:left" onClick="slideLeft()"><i class="fas fa-angle-left"></i></div>
                <div style="font-size:50px;cursor:pointer;position:relative;right:25px;float:right" onClick="slideRight()"><i class="fas fa-angle-right"></i></div>
                <div><img src="<?php echo $img1?>" class="s-img1" style="width:45px;height:45px;margin-left:50px;margin-top:5px;border:3px solid #74b9ff" alt=""><img src="<?php echo $img2?>" class="s-img2" style="width:45px;height:45px;margin-left:20px;margin-top:5px" alt=""></div>
            </div>
            <div class="container">
                <div class="card" style="margin-top:80px;padding:10px">
                <p class="card-title" style="font-size:28px;" class="text-info">Details</p>
                <div class="card-body">
                    <!-- Showing Reuired info based on category -->
                        <?php
                            #Houses & Appartments
                            if($category=="house"){
                                ?>
                                         <div class="col-md-6 float-left">
                                        <table class="table table-borderless">
                                                <tr>
                                                <th>Category</th>
                                                <td><?php echo ucfirst($sell_rent)?></td>
                                                </tr>
                                                <tr>
                                                <th>Title</th>
                                                <td><?php echo ucfirst($title)?></td>
                                                </tr>
                                                <tr>
                                                <tr>
                                                <th>Listed By</th>
                                                <td><?php echo ucfirst($listed_by)?></td>
                                                </tr>
                                                <tr>
                                                <th>Floors</th>
                                                <td><?php echo ucfirst($floors)?></td>
                                                </tr>
                                                <th>Plot area</th>
                                                <td><?php echo ucfirst($plot_area)?></td>
                                                </tr>
                                                <tr>
                                                <th>Facing</th>
                                                <td><?php echo ucfirst($facing)?></td>
                                                </tr>
                                                <tr>
                                                <th>Furnished</th>
                                                <td><?php echo ucfirst($furnish)?></td>
                                                </tr>
                                                <tr>
                                                <th>Bathrooms</th>
                                                <td><?php echo ucfirst($bathrooms)?></td>
                                                </tr>
                                                <tr>
                                                <th>Bedrooms</th>
                                                <td><?php echo ucfirst($bedrooms)?></td>
                                                </tr>
                                                <tr>
                                                <th>Parking</th>
                                                <td><?php echo ucfirst($parking)?></td>
                                                </tr>
                                            </table>
                                   </div>               
                                <?php
                            }
                            #Lands & Plots
                            else if($category=="land"){
                                    ?>
                                    <div class="col-md-6 float-left">
                                        <table class="table table-borderless">
                                                <tr>
                                                <th>Category</th>
                                                <td><?php echo ucfirst($sell_rent)?></td>
                                                </tr>
                                                <tr>
                                                <th>Title</th>
                                                <td><?php echo ucfirst($title)?></td>
                                                </tr>
                                                <tr>
                                                <tr>
                                                <th>Listed By</th>
                                                <td><?php echo ucfirst($listed_by)?></td>
                                                </tr>
                                                <tr>
                                                <th>Length</th>
                                                <td><?php echo ucfirst($length)?></td>
                                                </tr>
                                                <th>Breadth</th>
                                                <td><?php echo ucfirst($breadth)?></td>
                                                </tr>
                                                <th>Plot area</th>
                                                <td><?php echo ucfirst($plot_area)?></td>
                                                </tr>
                                                <tr>
                                                <th>Facing</th>
                                                <td><?php echo ucfirst($facing)?></td>
                                                </tr>
                                               
                                            </table>
                                   </div>
                                    <?php
                            }
                            else if($category=="office"){
                                ?>
                                <div class="col-md-6 float-left">
                                        <table class="table table-borderless">
                                                <tr>
                                                <th>Category</th>
                                                <td><?php echo ucfirst($sell_rent)?></td>
                                                </tr>
                                                <tr>
                                                <th>Title</th>
                                                <td><?php echo ucfirst($title)?></td>
                                                </tr>
                                                <tr>
                                                <tr>
                                                <th>Listed By</th>
                                                <td><?php echo ucfirst($listed_by)?></td>
                                                </tr>
                                                <th>Plot area</th>
                                                <td><?php echo ucfirst($plot_area)?></td>
                                                </tr>
                                                <tr>
                                                <th>Facing</th>
                                                <td><?php echo ucfirst($facing)?></td>
                                                </tr>
                                                <tr>
                                                <th>Washrooms</th>
                                                <td><?php echo ucfirst($bathrooms)?></td>
                                                </tr>
                                                <tr>
                                                <th>Furnished</th>
                                                <td><?php echo ucfirst($furnish)?></td>
                                                </tr>
                                               
                                            </table>
                                   </div>
                                <?php
                            }
                            else if($category=="bike"){
                                ?>
                                    <div class="col-md-6 float-left">
                                        <table class="table table-borderless">
                                                <tr>
                                                <th>Brand</th>
                                                <td><?php echo ucfirst($brand)?></td>
                                                </tr>
                                                <tr>
                                                <th>Title</th>
                                                <td><?php echo ucfirst($title)?></td>
                                                </tr>
                                                <tr>
                                                <th>Condition</th>
                                                <td><?php echo ucfirst($new_used)?></td>
                                                </tr>
                                                <tr>
                                                <th>Manfactured Year</th>
                                                <td><?php echo ucfirst($manf_year)?></td>
                                                </tr>
                                                <tr>
                                                <th>Distance travelled</th>
                                                <td><?php echo ucfirst($distance_travelled)."KM"?></td>
                                                </tr>
                                            </table>
                                   </div>
                                <?php
                            }
                            else if($category=="car" || $category=="other"){
                                ?>
                                   <div class="col-md-6 float-left">
                                        <table class="table table-borderless">
                                                <tr>
                                                <th>Brand</th>
                                                <td><?php echo ucfirst($brand)?></td>
                                                </tr>
                                                <tr>
                                                <th>Title</th>
                                                <td><?php echo ucfirst($title)?></td>
                                                </tr>
                                                <tr>
                                                <th>Condition</th>
                                                <td><?php echo ucfirst($new_used)?></td>
                                                </tr>
                                                <tr>
                                                <th>Manfactured Year</th>
                                                <td><?php echo ucfirst($manf_year)?></td>
                                                </tr>
                                                <tr>
                                                <th>Distance travelled</th>
                                                <td><?php echo ucfirst($distance_travelled)."KM"?></td>
                                                </tr>
                                                <tr>
                                                <th>Fuel Type</th>
                                                <td><?php echo ucfirst($fuel_type)?></td>
                                                </tr>
                                            </table>
                                   </div>
                                  
                                <?php
                            }else if($category=="cycle"){
                                ?>
                                    <div class="col-md-6 float-left">
                                        <table class="table table-borderless">
                                                <tr>
                                                <th>Brand</th>
                                                <td><?php echo ucfirst($brand)?></td>
                                                </tr>
                                                <tr>
                                                <th>Title</th>
                                                <td><?php echo ucfirst($title)?></td>
                                                </tr>
                                                <tr>
                                                <th>Condition</th>
                                                <td><?php echo ucfirst($new_used)?></td>
                                                </tr>
                                            </table>
                                   </div>
                                <?php
                            }
                            else if($category=="furniture"){
                                ?>
                                    <div class="col-md-6 float-left">
                                        <table class="table table-borderless">
                                                <tr>
                                                <th>Title</th>
                                                <td><?php echo ucfirst($title)?></td>
                                                </tr>
                                                <tr>
                                                <th>Condition</th>
                                                <td><?php echo ucfirst($new_used)?></td>
                                                </tr>
                                            </table>
                                   </div>
                                <?php
                            }
                            else if($category=="electrical"){
                                ?>
                                    <div class="col-md-6 float-left">
                                        <table class="table table-borderless">
                                                <tr>
                                                    <th>Brand</th>
                                                    <td><?php echo $brand?></td>
                                                </tr>
                                                <tr>
                                                <th>Title</th>
                                                <td><?php echo ucfirst($title)?></td>
                                                </tr>
                                                <tr>
                                                <th>Condition</th>
                                                <td><?php echo ucfirst($new_used)?></td>
                                                </tr>
                                            </table>
                                   </div>
                                <?php
                            }
                            else if($category=="mobile" || $category=="laptop" || $category=="camera" || $category=="accessories"){
                                ?>
                                    <div class="col-md-6 float-left">
                                        <table class="table table-borderless">
                                                <tr>
                                                    <th>Brand</th>
                                                    <td><?php echo $brand?></td>
                                                </tr>
                                                <tr>
                                                <th>Title</th>
                                                <td><?php echo ucfirst($title)?></td>
                                                </tr>
                                                <tr>
                                                <th>Condition</th>
                                                <td><?php echo ucfirst($new_used)?></td>
                                                </tr>
                                            </table>
                                   </div>
                                <?php
                            }
                            else if($category=="store"){
                                ?>
                                
                                <?php
                            }
                            else if($category=="repair"){
                                ?>
                                
                                <?php
                            }else{

                            }
                        ?>
                         <div class="col-md-6 float-right">
                                        <table class="table table-borderless">
                                            <tr>
                                            <th>Price</th>
                                                <td><?php echo ucfirst($price)?></td>
                                            </tr>
                                            <tr>
                                            <th>Location</th>
                                                <td><?php echo ucfirst($location)?></td>
                                            </tr>
                                            </table>  
                                               <div class="card-body">
                                               <b>Description</b>
                                               <p><?php echo ucfirst($description)?></p>
                                               </div>  
                                               <table>
                                                <tr><td><a href="phpSessions.php?sellerid=<?php echo $seller_id?>" class="btn btn-warning">Chat</a></td>
                                                    <td><a style="margin-left:15px" href="message.php?account=<?php echo $seller_account?>" class="btn btn-info">Message</a></td>
                                                </tr>
                                               </table>
                                    </div>
                                    
                                </div>
                </div>
            </div>
        </div>
    </div>
    
        <script>
            function slideLeft(){
                $(".img1").css("display","block");
                $(".s-img1").css("border","3px solid #74b9ff");
                $(".img2").css("display","none");
                $(".s-img2").css("border","none");
            }
            function slideRight(){
                $(".img2").css("display","block");
                $(".s-img2").css("border","3px solid #74b9ff");
                $(".img1").css("display","none");
                $(".s-img1").css("border","none");
            }
        </script>
</body>
</html>
<?php
        }
        ?>