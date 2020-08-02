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
    <?php session_start();
    include "loginheader.php"?>
    <style>
        .posted-qns{
            
        }
        .replied-qns{
            margin-left:25px;
        }
        .profile{
            width:95px;
            height:95px;
            border-radius:50%;
        }
        @media(max-width:550px){
            #ask{
                display: block;
                margin: auto;   
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="jumbotron mt-4" style="padding:15px;">
                <p class="display 4"><b>What is <span class="text-info">Ask Seller Forum</span></b></p>
                <p style="text-align: justify;text-indent: 38px;line-height:28px">
                    This is a forum where you can query about your desired product and the users who see's your query having that product may contacts you then you can make your transactions.
                </p>
                <p class="text-warning"><b>Note:</b></p>
                <p  style="text-align: justify;text-indent: 38px;line-height:17px">A person must register to participate in this forum.</p>
            </div>
        </div>
    </div>

    <div class="container mb-4">
        <div class="row">
            <p class="text-primary mt-4 col-md-12" style="font-size:20px">Your questions</p>
            <div class="questions card col-md-12" style="width:100%;padding:15px">
               <?php include "forummyqns.php"?>
            </div>
        </div>
    </div>

    <div class="container mb-4">
            <div class="row">
                <div id="search-fied" class="col-md-12">
                    <div class="float-right">
                            <input type="text" id="search" style="padding-left:6px;width:200px"  placeholder="search questions"><button class="btn-info">search</button>
                    </div>
                    
                </div>
                <h3 class="text-info col-md-12 mb-3">Have a question ?</h3>
                    <div class="" style="padding:15px">
                        <textarea name="" id="qtxt" placeholder="Ask Question..." style="width:350px;padding:10px" rows="4"></textarea><br>
                        <select style="width:200px;padding:3.5px" name="" id="catselect">
                                <option value="">Select Category</option>
                                <option value="houses&appartments">Houses & Appartments</option>
                            </select>
                            <button class="btn btn-primary" id="ask">Ask</button>
                    </div>                
            </div>
    </div>

    

    <div class="container">
        <div class="row">
            <p class="text-primary mt-4 col-md-12 mb-3" style="font-size:22px;margin-top:-10px;">Recently asked questions</p>
            <div class="allquestions jumbotron" style="width:100%">
                <?php include "forumaskedqns.php"?>
            </div>
        </div>
    </div>
    <script>
        $("#ask").click(function(){
            let txt = $("#qtxt").val();
            let cat = $("#catselect").val();
            if(txt.length<6){
                $("input").css("border-color","red");
                return;
            }else{
                $("input").css("border-color","green");
            }
             if(cat.length<=0){
                    $("#catselect").css("border-color","red");
                    return;
            }else{
                $("#catselect").css("border-color","green");
            }
            $.ajax({
                url:"forumdb.php",
                type:"POST",
                async:false,
                data:{
                    question:txt,
                    cat
                },
                success:function(resp){
                    resp = resp.trim();
                    if(resp=="success"){
                        alert("Question posted.");
                        $(".questions").load("forummyqns.php");
                        $(".allquestions").load("forumaskedqns.php");
                    }else{
                        alert("Unable to process your request");
                    }
                }
            });
        });
    </script>
</body>
</html>