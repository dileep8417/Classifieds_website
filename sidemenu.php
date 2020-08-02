
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">  
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script
    src="https://code.jquery.com/jquery-2.2.4.js"
    integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous"></script>
    <style>
        *{
            padding:0px;
            margin:0px;
        }
        body{
            overflow-x:hidden;
        }
        .side-menu{
            width:280px;
            height:92.3vh;
            position:fixed;
            transition:all .5s;
            overflow-Y:auto;
            padding-top:25px;
        }
        .content{
            position:relative;
            width:77.4%;
            min-height:89.4vh;
            display:block;
            left:280px;
        }
        .content .head{
            position:relative;
            display:block;
            margin:auto;
        }           
        .list li{
            list-style-type:none;
            width:100% !important;
            padding:17px 12px;
            cursor:pointer;
            position:relative;
            left:0px;
            background:#f1f2f6;
        }
        .toggle-btn,.close-icon{
            position:absolute;
            left:284px;
            font-size:25px;
            display:none;
            cursor:pointer;
            z-index:100;
        }
        .close-icon{
            display:block;
            position:absolute;
            left:90%;
            z-index:1000;
            color:black;
        }
        .list-symbol{
            margin-right:8px;
        }
        .side-menu ul li ul li{
            line-height:10px;
        }
        .side-menu ul li{
            margin-bottom:-13px;
        }
        .jobs-content{
            width:85%;
            display:block;
            margin:auto !important;
        }
        .content .navbar{
            width:85vw;
        }
        @media(max-width:650px){
            .side-menu{
                display:none;
            }
            .mail{
                display:none;
            }
            .toggle-btn{
                display:block;
                left:5px;
            }
            .content{
                width:100%;
                left:0px;
            }
        }
        ul li ul li:hover{
            background:#ff9f43;
        }
        @media(min-width:700px){
            
        }
        @keyframes anime1{
            from{left:0px}
            to{left:-100%}
        }
        @keyframes anime2{
            from{left:-100%}
            to{left:0px}
        }
        @keyframes anime3{
            from{left:0px}
            to{left:280px}
        }
        .head{
            width:100%;
        }
    </style>

</head>
<body>
   
        
        <div class="side-menu" style="z-index:10;margin-top:-25px">
        <span class="close-icon"><i class="fas fa-times"></i></span>

                <ul class="list" style="color:black">
                    <li style="font-size:28px;margin-bottom:-16px;">Categories</li>
                        <li><b>Properties</b>
                            <ul>
                            <li onClick="location.href='home.php?cat=house'">Houses & Appartments</li>
                            <li onClick="location.href='home.php?cat=land'">Lands & Plots</li>
                            <li onClick="location.href='home.php?cat=office'">Shops & Offices</li>
                            </ul>
                        </li>
                        <li><b>Vehicles</b>
                            <ul>
                                <li onClick="location.href='home.php?cat=car'">Cars</li>
                                <li onClick="location.href='home.php?cat=bike'">Bikes</li>
                                <li onClick="location.href='home.php?cat=other'">Other Vehicles</li>
                            </ul>
                        </li>
                        <li><b>Gadgets</b>
                            <ul>
                                <li onClick="location.href='home.php?cat=mobile'">Mobiles & Tablets</li>
                                <li onClick="location.href='home.php?cat=laptop'">Computers & Laptops</li>
                                <li onClick="location.href='home.php?cat=camera'">Camera & Recorders</li>
                                <li onClick="location.href='home.php?cat=accessories'">Accessories</li>
                            </ul>
                            <li><b>Furniture</b>
                                <ul>
                                    <li onClick="location.href='home.php?cat=furniture'">Furniture & Decoratives</li>
                                    <li onClick="location.href='home.php?cat=electrical'">Electrical Appliances</li>
                                </ul>
                            </li>
                            <li onClick="location.href='home.php?cat=house'"><b>Services</b>
                                <ul>
                                    <li onClick="location.href='home.php?cat=repair'">Service centers & Repairs</li>
                                    <li onClick="location.href='home.php?cat=store'">Grocessory</li>
                                </ul>
                            </li>
                        </li>
                </ul>
            </div>
            <span class="toggle-btn" style="color:orange"><i class="fas fa-bars"></i></span>
      
<script>
    $(".close-icon").click(function(){
        $(".close-icon").css("display","none");
        $(".side-menu").css("animation","anime1 .7s linear");
        $(".side-menu").css("left","-280px");
        $(".toggle-btn").css("display","block");
        $(".toggle-btn").css("left","5px");
        $(".content").css("left","0px");
        $(".content").css("width","100%");
        $(".content .navbar").css("width","100%");
    });
    $(".toggle-btn").click(function(){
        $(".side-menu").css("display","block");
        $(".side-menu").css("left","0px");
        $(".toggle-btn").css("display","none");
        $(".content").css("animation","anime3 .1s linear");
        $(".content").css("left","280px");   
        $(".close-icon").css("display","block");    
        $(".content").css("width","77.4%");
        $(".content .navbar").css("width","85vw"); 
    });

</script>
</body>
</html>