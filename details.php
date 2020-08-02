<head>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
        <style>
            .form-group{
                width:450px;
                height:auto;
                position:relative;
                left:50%;
                top:20px;
                transform:translateX(-50%);
                padding:15px;
                box-sizing:border-box;
            }
            input,textarea,select{
                border:none;
                border-bottom:2px solid black;
                width:400px;
                height:45px;
                margin-bottom:18px;
                background:#ced6e0;
                padding-left:8px;
                padding:5px;
            }
            textarea{
                height:80px;
            }
        </style>
</head>
<?php
@session_start();

if(!isset($_SESSION['id'])){
       $_SESSION['aderr']="exist";
        header("Location:index.php");
    }
    $id = $_SESSION['id'];
   
?> 

<?php
        if(isset($_GET['type']) && isset($_GET['cat'])){
            $type = $_GET['type'];
            $category = $_GET['cat'];
            ?>

            <form method="POST" action="detailsDB.php" enctype="multipart/form-data" id="data">
            <div class="card form-group">
            <h2 class="text-center mb-4">POST YOUR AD</h2>
            <p style="padding:5px;font-size:20px">SELECTED CATEGORY:</p>
                        <p style="padding-left:15px;color:#8395a7"><?php echo ucfirst($type)."/".ucfirst($category)?></p>
                        <div style="width:450px;border:1px solid #ced6e0;position:relative;left:-16px;margin-bottom:20px"></div>
                        
                        <p style="margin-bottom:-15px">Upload images:</p>
                        <!-- Images -->
                        <div class="images" style="font-size:80px;color:#38ada9;cursor:pointer">
                            <img src="" alt="" id="img1" style="width:80px;height:80px;display:none" onClick="document.getElementById('file1').click()">
                                
                            <img src="" alt="" id="img2" style="width:80px;height:80px;display:none"  onClick="document.getElementById('file2').click()"> 
                            <span class="file1" onClick="document.getElementById('file1').click()"><i class="fas fa-plus-square"></i></span>
                                 
                            <span class="file2" onClick="document.getElementById('file2').click()"><i class="fas fa-plus-square"></i></span>
                            <input type="file" id="file1" name="file1" style="display:none" accept="image/png,image/jpg,image/jpeg" onchange="preview1.call(this)" >
                            <input type="file" id="file2" name="file2" style="display:none" accept="image/png,image/jpg,image/jpeg" onchange="preview2.call(this)">
                        </div>
                        <!-- ------------Hidden Category Field-------------- -->
                        <input type="text" style="display:none" name="category" value="<?php echo $category?>">

            <?php
                if($type=="properties"){
                    if($category=="house"){
                            ?> <input type="text" readonly value="Houses & Appartments"><?php
                    }
                    else if($category=="land"){
                        ?> <input type="text" readonly value="Lands & Plots"><?php
                        }else{
                            ?> <input type="text" readonly value="Shops & Offices"><?php
                        }
               ?>
                      <select name="sellorrent" id="">
                        <option value="">Type</option>
                        <option value="sell">Sell</option>
                        <option value="rent">Rent</option>
                      </select>
                        <select name="listedby" id="">
                            <option value="">Listed By</option>
                            <option value="owner">Owner</option>
                            <option value="builder">Builder</option>
                            <option value="mediator">Mediator</option>
                        </select>
                        <select name="facing" id="">
                            <option value="">Facing</option>
                            <option value="north">North</option>
                            <option value="south">South</option>
                            <option value="east">East</option>
                            <option value="west">West</option>
                            <option value="north-east">North-East</option>
                            <option value="north-west">North-West</option>
                            <option value="south-east">South-East</option>
                            <option value="south-west">South-West</option>
                        </select>
                        <input type="number" name="plotarea" placeholder="Carpet Area (Sq.ft)">
                        <span style="font-size:14px">(Add key features, name of the product.)</span>
                        <input type="text" name="title" placeholder="Add title">
                        
               <?php
               if($category=="house"){
                   //Houses & Appartments
                    ?>
                        <select name="bedrooms" id="">
                            <option value="">Bedrooms</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4+">4+</option>
                        </select>
                        <select name="bathrooms" id="">
                            <option value="">Bathrooms</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4+">4+</option>
                        </select>
                        <select name="floors" id="">
                            <option value="">Floors</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4+">4+</option>
                        </select>
                        <select name="parking" id="">
                            <option value="">Car Parking</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        <select name="furnish" id="">
                            <option value="">Furnishing</option>
                            <option value="furnished">Furnished</option>
                            <option value="semi-furnished">Semi-Furnished</option>
                            <option value="un-furnished">Un-Furnished</option>
                        </select>                        

                    <?php
               }else if($category=="land"){
                   //Lands & Plots
                    ?>
                        <input type="text" name="length" placeholder="Length">
                        <input type="text" name="breadth" placeholder="Breadth">
                    <?php
              }else{
                //Shops & Offices
                ?>
                    <select name="bathrooms" id="">
                            <option value="">Washrooms</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4+">4+</option>
                        </select>
                <?php
              }
           }else if($type=="vehicles"){
                #cars,Bikes,Cycles,Others=Cars details
                if($category=="bike"){
                    ?><input type="text" readonly value="Bikes"><?php
                }else if($category=="car"){
                    ?><input type="text" readonly value="Cars"><?php
                }else if($category=="cycle"){
                    ?><input type="text" readonly value="BiCycle"><?php
                }else{
                    ?><input type="text" readonly value="Other Vehicle">
                        
                    <?php
                }
                if($category=="bike" || $category=="car" || $category=="other"){
                   ?>
                    <div id="bike-form">

                    <select name="type" id="" required>
                        <option value="">Type</option>
                        <option value="new">New</option>
                        <option value="used">Used</option>
                    </select>
                    <span class="b-brand text-danger" style="font-size:12px"></span>
                        <input type="text" name="brand" id="b-brand" placeholder="Brand">
                        <span class="b-year text-danger" style="font-size:12px"></span>
                        <input type="number" name="manfyear" id="b-year"  placeholder="Manfactured Year">
                        <span style="font-size:14px">(Add key features, name of the product.)</span>
                        <input type="text" id="title" name="title" placeholder="Add title">
                       
                        <span class="b-distance text-danger" style="font-size:12px"></span>
                        <input type="number" name="distancetravelled" id="b-distance" placeholder="Distance Covered">
                    </div>
                   <?php
                }else if($category=="car" || $category=="other"){
                    ?>
                        <select name="fueltype" id="">
                            <option value="">Fuel Type</option>
                            <option value="diesel">Diesel</option>
                            <option value="petrol">Petrol</option>
                            <option value="lpg">LPG</option>
                        </select>
                    <?php
                }else{
                   ?>
                     <span class="b-brand text-danger" style="font-size:12px"></span>
                        <input type="text" name="brand" id="b-brand" placeholder="Brand">
                   <?php
                }
           }else if($type=="gadgets"){
                    //mobile laptop camera accessories
                    if($category=="mobile"){
                        ?><input type="text" readonly value="Mobiles & Tablets"><?php
                    }else if($category=="laptop"){
                        ?><input type="text" readonly value="Computers & Laptops"><?php
                    }else if($category=="camera"){
                        ?><input type="text" readonly value="Cameras & Recorders"><?php
                    }else{
                        ?><input type="text" readonly value="Accessories"><?php
                    }
                    ?>
                        <input type="text" name="brand" placeholder="Brand">
                        <span style="font-size:14px">(Add key features, name of the product.)</span>
                        <input type="text" name="title" placeholder="Add title">
                       
                        <select name="neworused" id="">
                            <option value="">Type</option>
                            <option value="new">New</option>
                            <option value="used">Used</option>
                        </select>
                    <?php
           }else if($type=="furniture"){
                    if($category=="furniture"){
                        ?><input type="text" readonly value="Furniture"><?php
                    }else{
                        ?><input type="text" readonly value="Electrical Appliances"><?php
                    }
                    ?>
                    <span style="font-size:14px">(Add key features, name of the product.)</span>
                    <input type="text" name="title" placeholder="Add title">
                    <select name="neworused" id="">
                            <option value="">Type</option>
                            <option value="new">New</option>
                            <option value="used">Used</option>
                        </select>
                <?php
           }else{
            ?>
                <span style="font-size:14px">(Name of the organisation or company)</span>
                <input type="text" name="title" placeholder="Add title">
            <?php
           }
        }
?>
        <span class="loc text-danger" style="font-size:12px"></span>
        <input type="text" name="location" id="loc" placeholder="Location">
        <span class="desc text-danger" style="font-size:12px"></span>
        <textarea name="desc" id="desc" cols="30" rows="8" placeholder="Description"></textarea>
         <?php
            if($type!="services"){
                ?>
                    <span class="price text-danger" style="font-size:12px"></span>
                    <input type="number" name="price" id="price" placeholder="Price">
                <?php
            }
         ?>
     <!-- Post Ad -->
     <button class="btn btn-info text-center" type="submit" id="b-post" style="display:block;margin:auto;width:100px">Post</button>
</div>
</form>
<script>
    function preview1(){
            if(this.files && this.files[0]){
                var obj = new FileReader();
                obj.onload=function(e){
                    var image = document.getElementById("img1");
                    image.src=e.target.result;
                }
                obj.readAsDataURL(this.files[0]);
                $("#img1").css("display","inline-block");
                $(".file1").css("display","none");
            }
        }
    function preview2(){
            if(this.files && this.files[0]){
                var obj = new FileReader();
                obj.onload=function(e){
                    var image = document.getElementById("img2");
                    image.src=e.target.result;
                }
                obj.readAsDataURL(this.files[0]);
                $("#img2").css("display","inline-block");
                $(".file2").css("display","none");
            }
        }

        //Changing border color
        $("input").blur(function(){
            let id = $(this).attr("id");
            if(($(this).val()).length<3){
                $(this).css("border-color","red");
                $("."+id).text("Enter valid details");
            }else{
                $(this).css("border-color","green");
                $("."+id).text("");
            }
        });
        console.log($("input").css("border-color"));
        $("textarea").blur(function(){
            let id = $(this).attr("id");
            if(($(this).val()).length<20){
                $(this).css("border-color","red");
                $("."+id).text("Description must me more than 20 charecters");
            }else{
                $(this).css("border-color","green");
                $("."+id).text("");
            }
        });
        
</script>
