<?php  @session_start();
if(!isset($_SESSION['id'])){
  ?>
    <script>alert("Please Login to use this feature.");</script>
  <?php
}
#INCLUDING NAVBAR
include "loginheader.php";

#FOR getting user name
if(isset($_SESSION['sellerid'])){
    $seller=$_SESSION['sellerid'];
    $query="SELECT * FROM signupdb WHERE id='$seller'";
    $res=mysqli_query($conn,$query);
    if($res){
        while($row=mysqli_fetch_assoc($res)){
            $_SESSION["chating_person"]=$row['uname'];
                }
    }
}

#FOR CHECKING NEW MESSAGES

if(@$_SESSION['newmessages']>0){
    include "connection.php";
    $user=$_SESSION['id'];
    $querycount="UPDATE chat SET count=0 WHERE send_to='$user'";
    $rescount=mysqli_query($conn,$querycount);
}
?>
<!-- CREATING CHATING SECTION -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">  
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
      <script
      src="https://code.jquery.com/jquery-2.2.4.min.js"
      integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
      crossorigin="anonymous"></script>
  <style>
@import url('https://fonts.googleapis.com/css?family=Libre+Baskerville|Open+Sans:400i|Rubik:500'); 

  body{
    background:linear-gradient(135deg,#48c6ef,#6f86d6);
  }
  .member:hover{
      cursor:pointer;
  }
  .frame{
    width:95%;
    height:550px;
    margin:auto;
    position:relative;
    margin-top:5px;
    border-top:5px solid white;
    border-bottom:3px solid #0984e3;
    border-bottom-left-radius:10px;
    border-top-left-radius:10px;
    overflow:hidden;
  }
  .chats{
    position:relative;
    background-color: linear-gradient(105deg,#606c88,#3f4c6b);
    width:60%;
    height:550px;
    float:right;
    top:-550px;
  }
  .contacts{
    width:40%;
    height:550px;
    background:#aaabb8;
    position:relative;
  }
  .chat-container{
    width:100%;
    height:445px;
    background:#EAF0F1;
    overflow:auto;    
  }
  .chat-head{
    position: relative;
    height:60px;
    background:white;
  }
  .chat-bottom{
    position:relative;
    width:100%;
    height:35px;
    background: rgba(0,255,0,.6);
    position:relative;
    top:-48px;
  }
  input{
    width:90%;
    min-width:100px;
    height:45px; 
  }
  .s-btn{
    float:right;
    position:absolute;
    top:0px;
    background: #20bf6b;
    border:none;
    height:35px;
    width:10%;
  }
  .send-btn{
    color:white; 
  }
  .s-btn:hover{
    background:green;
  }
  .member img{
      position:relative;
      width:80px;
      height:80px;
      border-radius:50%;
    padding:5px;
  }
  .member{
            width:98%;
            height:100px;
            display:block;
            margin:auto;
            color:white;
            position:relative;
            border-bottom:.5px solid #747d8c;
            border-top:.2px solid #747d8c;
        }
 .member:nth-child(first){
          border-top:none;
        }
 .member{
      position:relative;
      width:100%;
      height:80px;
      background:#f5f6fa;
      border:.5px solid white;
      border-left:none;
      border-right:none;
      color:black;
      cursor:pointer;
  }
  .active{
      background:#0984e3;
      border-bottom:2px solid white;
  }
  .member h5{
            padding:25px;
            position:relative;
            left:70px;
            top:-70px;
            font-family: 'Libre Baskerville', bold;

        }
 .fa-trash-alt{
        float:right;
        margin-right:25px;
        margin-top:-50px;
         position:relative;
         color:#ff6b81;
         z-index:1;
        }
  .s-post{
      display:none;
  }
  .member-head{
      width:100%;
      height:60px;
      color: white;
      font-size:30px;
      background:#2ecc71 !important;
      padding:2px;
      border-top-left-radius:10px;
      border-left:-10px solid white;
      text-align:center;
      position:relative;
  }
  .time{
            font-size:10px;
            position:relative;
            float:right;
            top:-4px;
            font-family: 'Rubik', sans-serif;
            color:white;
            padding:2px;
        }
   .sent-message{
            background:#3498DB;
            display:block;
            margin-right:20px;
            margin-left:70%;
            padding:15px;
            border-radius:5px;
            border-bottom-left-radius:25px;
            padding-left:10px;
            margin-bottom:10px;
            margin-top:10px; 
            position:relative;
            font-family: 'Open Sans', sans-serif;
            color:white;
            min-height:50px;
        } 
    
    .received-message{
            border-radius:5px;
            border-bottom-right-radius:25px;
            background:white;
            margin-top:10px;
            margin-left:20px;
            color:black;
            display:block;
            margin-right:70%;
            padding:15px;
            padding-left:10px;
            position:relative;
            min-height:40px;
            font-family: 'Open Sans', sans-serif
        } 
        .received-message .time{
          color:black;
        }
  .fa-trash-alt:hover{
            color:red;
        }
   .chat_name{
         display:block;
          margin:auto;
          width:200px;
          font-size:20px;
          position:relative;
          color:block;
          top:-475px;
        }
    .status{
        position:relative;
          top:-495px;
          left:55%;
    }
.mdelete{
    color:white;
    float:right;
    margin-top:-5px;
    cursor:pointer;
}
  @media(min-width:650px){
      
        .contacts{
            left:0px !important;
        }
        .chats{
            left:0px !important;
            float:right !important;
        }
        .back{
            display:none !important;
        }
    }
 @media(max-width:650px){
    .frame,.contacts,.chats{
        width:100%;
        transition:all .3s;
    }
    .frame{
          top:-10px;
      }
    .back{
        color:white;
        position:relative;
        top:20px;
        left:10px;
        cursor:pointer;
    }
    .contacts{
        left:0px;
    }
    .chats{
        left:100%;
    }
 }
  @media(max-width:700px){  
            .S-post{
                display:block;
            }
            .post-btn{
                display:none;
            }
        }
  @media(max-width:760px){
      .frame{
        width:100%;
      }
  }
  </style>
</head>
<body>
    <div class="frame">
    <!-- CONTACTS -->
      <div class="contacts">
          <div class="member-head bg-success">
          Chats</div>
          <!-- INCLUDING CHATLIST -->
          <div class="members">
          <?php include "chatlist.php"?>
          </div>
      </div>
      <!-- CHATS -->
      <div class="chats">
        <div class="chat-head"><div class="back"><i class="fas fa-arrow-left"></i></div></div>
        <div class="chat-container">
        </div>
        <h3 class="chat_name"><?php echo ucfirst(@$_SESSION['chating_person'])?></h3>
            <span class="status">offline</span>
        <!-- SENDING MESSAGE TO DATABASE -->
        <div class="chat-bottom">
          <input type="text" id="msg">
          <button class="s-btn sendbtn"><span class="send-btn"><i class="fas fa-paper-plane"></i></span></button>
        </div>
      </div>
    </div>
<script>
    //Responsive
    //-----------------------------------//
    $(".member").click(function(){
        $(".contacts").css("left","-100%");
        $(".chats").css("left","0px");
    });
    $(".back").click(function(){
        $(".contacts").css("left","0px");
        $(".chats").css("left","100%");
    });
    //-------------------------------------//

    $(document).ready(function(){
        //fetching messages
        setInterval(function(){
            $(".chat-container").load("messageDB.php");
        },300);
        //Sending messages
        $(".sendbtn").click(function(){
            var msg=$("#msg");
            $.ajax({
                url:"message-to-db.php",
                type:'POST',
                async:false,
                data:{
                    "messages":msg.val()
                },
                success:function(){
                    $("#msg").val("");
                    $(".members").load("chatlist.php");
                }
            });
        });
        //Showing msg of members
        $(".member").click(function(){
           var id=$(this).attr("data");
           $.ajax({
               url:"phpSessions.php?sellerid="+id,
               type:"GET",
               async:false,
               success:function(){
                $(".chat-container").load("messageDB.php");
               }
           });
        });
    });
        //Showing Status
        </script>
        
      
</body>
</html>