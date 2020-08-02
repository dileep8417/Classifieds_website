<?php @session_start();?>
<?php 
include "connection.php";
if(isset($_SESSION['sellerid'])){
    $seller=$_SESSION['sellerid'];
    $query="SELECT * FROM signupdb WHERE id='$seller'";
    $res=mysqli_query($conn,$query);
    if($res){
        while($row=mysqli_fetch_assoc($res)){
            $_SESSION["chating_person"]=$row['uname'];
        }
    }
if(!isset($_SESSION['mail'])){
header("Location:withoutLogin.php");
$_SESSION['chat_err']='exist';
}else{
$user=$_SESSION['id'];
}

#FETCHING MESSAGES
$user=$_SESSION['id'];
$query="SELECT * FROM chat WHERE send_to='$seller' AND send_from='$user' OR send_to='$user' AND send_from='$seller'";
$res=mysqli_query($conn,$query);
if(mysqli_num_rows($res)>0){
    while($row=mysqli_fetch_assoc($res)){
        $sender = $row['send_from'];
        $receiver = $row['send_to'];
        $message = $row['message'];
        $rmessage=$row['receivedmessage'];
        $smessage=$row['sentmessage'];
        $time=$row['time'];
        $messageid=$row['id'];
        #conditions
        #user is the sender
        if($sender==$user && $receiver==$seller){
            if($message=="This message was deleted"){
                ?><P  class="sent-message" style="background:#ff7979;color:#dcdde1;font-size:12px"><?php echo $message?><br><span class="time"><?php echo $time?></span></P> 
                <?php
                continue;
            }
            if($message!=null){
                ?><P  class="sent-message"><?php echo $message?><span class="mdelete" id=<?php echo $messageid?>><i class="fas fa-times"></i></span><br><span class="time"><?php echo $time?></span></P> 
                <?php
            }
            if($message==null && $smessage!=null){
                ?><P  class="sent-message"><?php echo $smessage?><span class="mdelete" id=<?php echo $messageid?>><i class="fas fa-times"></i></span><br><span class="time"><?php echo $time?></span></P> 
                <?php
            }
        }
        #user is the receiver
        if($sender==$seller && $receiver==$user){
            if($message=="This message was deleted"){
                ?><P  class="received-message" style="background:#ff7979;color:#dcdde1;font-size:12px"><?php echo $message?><br><span class="time"><?php echo $time?></span></P> 
                <?php
                continue;
            }
            if($message!=null){
                ?><P class="received-message"><?php echo $message?><br><span class="time"><?php echo $time?></span></P>
                <?php
            }
            if($message==null && $rmessage!=null){
                ?><P class="received-message"><?php echo $rmessage?><br><span class="time"><?php echo $time?></span></P>
                <?php
            }
        }
        }
        if($message==null && $rmessage==null && $smessage==null){
            $deleted="DELETE FROM chat WHERE send_to='$seller' AND send_from='$user' OR send_to='$user' AND send_from='$seller'";
            $dels=mysqli_query($conn,$deleted);
        }
    }
    
}
?>
<script>
    $(".mdelete").click(function(){
        var msgid=$(this).attr("id");
        if(confirm("This message will be deleted on both sides")==true){
            $.ajax({
                url:"eachmessagedelete.php",
                type:"POST",
                async:false,
                data:{
                    "msgid":msgid
                }
            });
        }
    });
</script>