<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">   
   <?php
    @session_start();
   include "loginheader.php"?>
   <style>
       body{
           overflow-X:hidden;
       }
        .hide{
            display:none;
        }
      .title{
            padding:8px;
            font-size:20px;
        }
        .title:hover{
            cursor:pointer;
        }
        
        .item{
            padding:5px;
        }
         .hide .item:hover{
            background:#9b59b6;
            color:white;
            cursor:pointer;
        }
        #categories-list{
            width:350px;
            height:auto;
            padding:15px;
        }
       .content{
        width:350px;
                height:auto;
                position:relative;
                left:50%;
                top:20px;
                transform:translateX(-50%);
       }
       .tmp_text:hover{
           background:none !important;
       }
       @media(min-width:780px){
        .hide{
            height:auto;
            padding:50px;
            position:absolute;
            left:340px;
            top:30px;
            width:300px;
        }
       }
       @media(max-width:780px){
            .hide{
            height:auto;
            position:relative;
            padding:6px;
            top:-30px !important;
        }
        .tmp_text{
            display:none !important;
        }
        }
    </style>
</head>
<body>
    
    <div class="content">
            <div id="categories-list" class="card">
                    <h2 class="text-center mb-4">POST YOUR AD</h2>
                <h5>CHOOSE A CATEGORY</h5>
                <div class="">
                <div id="properties" class="cat-list card-title">
                    <P class="title">Properties <span><i class="fas fa-sort-down"></i></span></P>
                    <div class="hide" id="hide1">
                            <p><b class="tmp_text" style="text-decoration:underline"></b></p>
                            <p class="item" id="house">Houses & Appartments</p>
                            <p class="item" id="land">Lands & Plots</p>
                            <p class="item" id="office">Shops & Offices</p>
                    </div>
                </div>
                <div id="vehicles" class="cat-list card-title">
                    <P class="title ">Vehicles <span><i class="fas fa-sort-down"></i></span></P>
                    <div class="hide" id="hide2">
                    <p><b class="tmp_text" style="text-decoration:underline"></b></p>
                            <p class="item" id="car">Cars</p>
                            <p class="item" id="bike">Bikes</p>
                            <p class="item" id="other">Other vehicles</p>
                    </div>
                </div>
                <div id="gadgets" class="cat-list card-title">
                    <P class="title ">Gadgets <span><i class="fas fa-sort-down"></i></span></P>
                    <div class="hide" id="hide3">
                    <p><b class="tmp_text" style="text-decoration:underline"></b></p>
                            <p class="item" id="mobile">Mobiles & Tablets</p>
                            <p class="item" id="laptop">Computers & Laptops</p>
                            <p class="item" id="camera">Cameras & Recorders</p>
                            <p class="item" od="accessories">Accessories</p>
                    </div>
                </div>
                <div id="furniture" class="cat-list card-title">
                    <P class="title ">Home & Appliances <span><i class="fas fa-sort-down"></i></span></P>
                    <div class="hide" id="hide4">
                    <p><b class="tmp_text" style="text-decoration:underline"></b></p>
                            <p class="item" id="furniture">Furniture</p>
                            <p class="item" id="electrical">Electrical Appliances</p>
                    </div>
                </div>
                <div id="services" class="cat-list  card-title">
                    <P class="title ">Local Services <span><i class="fas fa-sort-down"></i></span></P>
                    <div class="hide" id="hide5">
                    <p><b class="tmp_text" style="text-decoration:underline"></b></p>
                            <p class="item" id="store">Local Store</p>
                            <p class="item" id="repair">Services & Repairs</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //Displaying options
        $(".title").click(function(){
            let text = $(this).text();
            $(".title").css("color","black");
            $(".title").css("background","none")
            $(this).css("background","#9b59b6");
            $(this).css("color","white");

            let parent = $(this).parent().attr("id");
             let child = $("#"+parent).children("div").attr('id');
         $(".hide").css("display","none");
            $("#"+child).toggle();
            $(".tmp_text").text(text);
        });

        //Redirecting
        $(".item").click(function(){
            let category = $(this).attr("id");
            let type = $(this).parent().parent().attr("id");
           $(".content").load("details.php?type="+type+"&cat="+category+"");
        });
    </script>
</body>
</html>