<?php
    @session_start();
    #if user act as a sender items will come to list
  include "connection.php";
  $user=$_SESSION['id'];
  $query="SELECT * FROM chat WHERE send_from='$user' OR send_to='$user'";
  #QUERY TO CHECK MESSAGES ARE EMPTY OR NOT
  $res=mysqli_query($conn,$query);
  if(mysqli_num_rows($res)>0){
    $query="SELECT * FROM chat WHERE send_from='$user'";
    #HOLDING USER
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
    while($row=mysqli_fetch_assoc($res)){
        #HOLDING RECEIVER
        $receiver=$row['send_to'];
        $query7="SELECT * FROM chatedlist WHERE sender='$user' AND target_id='$receiver'";
        #CHECKING CHATEDLIST IF DATA IS ALREADY THERE OR NOT
        #IF THERE DELETE THOSE AND INSERT ELSE INSERT
        $res7=mysqli_query($conn,$query7);
        if(mysqli_num_rows($res7)>0){
            $query_to_delete="DELETE FROM chatedlist WHERE sender='$user' AND target_id='$receiver'";
            #DELETING SENDER AND RECEIVER IF ALREADY EXISTED
            $res_to=mysqli_query($conn,$query_to_delete);
            $query_to_delete="DELETE FROM chatedlist WHERE sender='$receiver' AND target_id='$user'";
            #DELETING SENDER AND RECEIVER IF ALREADY EXISTED
            $res_to=mysqli_query($conn,$query_to_delete);
        }
        $query3="INSERT INTO chatedlist (target_id,sender) VALUES ('$receiver','$user')";
        $res3=mysqli_query($conn,$query3);
        $query4="INSERT INTO chatedlist (target_id,sender) VALUES ('$user','$receiver')";
        $res4=mysqli_query($conn,$query4);
    }
}
}else{
    ?><div class="text-info" style="font-size:30px" >No chats found <br><b><span style="color:red;font-size:15px">Recent Chats</span></b></div>
    <?php
}
#-----------------------------------------------------------------#
   $arr=array();
  $query="SELECT * FROM chatedlist WHERE sender='$user'";
  $res=mysqli_query($conn,$query);
  if(mysqli_num_rows($res)>0){
    $i=0;
    while($row=mysqli_fetch_assoc($res)){
        $member=$row['target_id']; 
        #array to reverse elements
        $arr[$i]=$member;
        $i++;
    }

$query="SELECT * FROM chatedlist WHERE target_id='$user'";
$res=mysqli_query($conn,$query);
if(mysqli_num_rows($res)>0){
  while($row=mysqli_fetch_assoc($res)){
      $member=$row['sender']; 
      #array to reverse elements
      $arr[$i]=$member;
      $i++;
  }
}  
$len=count($arr);
$i=0;
$j=$len-1;
while($i<$j){
    $tmp=$arr[$i];
    $arr[$i]=$arr[$j];
    $arr[$j]=$tmp;
    $i++;
    $j--;
}
$arr=array_unique($arr);
    foreach($arr as $member){
        $query2="SELECT * FROM signupdb WHERE id='$member'";
        $res2=mysqli_query($conn,$query2);
        if(mysqli_num_rows($res2)>0){
          while($row2=mysqli_fetch_assoc($res2)){
              $name=$row2['uname'];
              $user_profile = $row2['profile'];
              if($user_profile=="" || $user_profile==" "){
                $user_profile = "images/profile.jpg";
              }
          }
        }
        $query3="SELECT * FROM itemsdb WHERE user_id='$member'";
        $res3=mysqli_query($conn,$query3);
        if(mysqli_num_rows($res3)>0){
          while($row3=mysqli_fetch_assoc($res3)){
              $image=$row3['image1'];
          }
        }else{
            $image="";
        }
    
        if($member!=0){
            ?>
            <div data="<?php echo $member?>" class="member">
            <img id="pImg1" style="z-index:10" src="<?php echo $image?>" alt="">
            <img id="pImg2" style="position:relative;left:-35px;" src="<?php echo $user_profile?>" alt=""><h5 style="margin-left:65px"><?php echo ucfirst($name)?></h5>
            </div><span><i data="<?php echo ucfirst($member)?>" class="delete_chat fas fa-trash-alt"></i></span>

            <?php
            if($image==""){
                ?>
                    <style>
                        #pImg2{
                            left:20px !important;
                        }
                        #pImg1{
                            display:none;
                        }
                    </style>
                <?php
            }
        }
    }
}
    ?>
<script>
    $(document).ready(function(){
        $(".member").attr("id",function(index){
            return "member"+index;
        });
        $(".member").click(function(){
                 $(".contacts").css("left","-100%");
                $(".chats").css("left","0px");
                var mid=$(this).attr("id");
                $(".member").removeClass("active");
                $("#"+mid).addClass("active");
        });
    $(".back").click(function(){
                $(".contacts").css("left","0px");
                $(".chats").css("left","100%");
         });
        $(".member").click(function(){
              var id=$(this).attr("data");
                var txt=$(this).text();
                $(".chat_name").text(txt);
                $.ajax({
                url:"phpSessions.php?sellerid="+id,
                type:"GET",
                async:false,
                success:function(){
                    $(".chat-container").load("messageDB.php");
                }
                });
            });
        $(".delete_chat").click(function(){
              var delid=$(this).attr("data");
                if(confirm("Do you want to clear the chat")==true){
                    $.ajax({
                    url:"deletechat.php",
                    type:"POST",
                    async:false,
                    data:{
                        "sellerid":delid
                    }
                 });
                } 
            });
            
     });
</script>
    