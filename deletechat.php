<?php
    session_start();
    $user=$_SESSION['id'];
    include "connection.php";
    if(isset($_POST['sellerid'])){
        $sellerid=$_POST['sellerid'];

        #user is the sender

        $query="SELECT * FROM chat WHERE send_from='$user' AND send_to='$sellerid'";
        $res=mysqli_query($conn,$query);
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                $msg_id=$row['id'];
                $receivedmessage=$row['message'];
                $rmessage=$row['receivedmessage'];
                $smessage=$row['sentmessage'];
                if($receivedmessage!=null){
                    $query1="UPDATE chat SET message='',receivedmessage='$receivedmessage' WHERE id='$msg_id'";
                    $res1=mysqli_query($conn,$query1);
                    $delquery="DELETE FROM chatedlist WHERE sender='$user' AND target_id='$seller'";
                    $delres=mysqli_query($conn,$delquery);
                }
                if($receivedmessage==null && $smessage!=null){
                    $query2="DELETE FROM chat WHERE id='$msg_id'";
                    $res2=mysqli_query($conn,$query2);
                    $delquery="DELETE FROM chatedlist WHERE sender='$user' AND target_id='$seller'";
                    $delres=mysqli_query($conn,$delquery);
                }
                if($receivedmessage==null && $smessage!=null && $rmessage==null){
                    $delquery="DELETE FROM chatedlist WHERE sender='$user' AND target_id='$seller'";
                    $delres=mysqli_query($conn,$delquery);
                }
            }
        }

        #user is the receiver

        $query="SELECT * FROM chat WHERE send_from='$sellerid' AND send_to='$user'";
        $res=mysqli_query($conn,$query);
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                $msg_id=$row['id'];
                $sentmessage=$row['message'];
                $rmessage=$row['receivedmessage'];
                $smessage=$row['sentmessage'];
                if($sentmessage!=null){
                    $query1="UPDATE chat SET message='',sentmessage='$sentmessage' WHERE id='$msg_id'";
                    $res1=mysqli_query($conn,$query1);
                    $delquery="DELETE FROM chatedlist WHERE sender='$user' AND target_id='$seller'";
                    $delres=mysqli_query($conn,$delquery);
                }
                if($sentmessage==null && $rmessage!=null){
                    $query2="DELETE FROM chat WHERE id='$msg_id'";
                    $res2=mysqli_query($conn,$query2);
                    $delquery="DELETE FROM chatedlist WHERE sender='$user' AND target_id='$seller'";
                    $delres=mysqli_query($conn,$delquery);
                }
                if($receivedmessage==null && $smessage!=null && $rmessage==null){
                    $delquery="DELETE FROM chatedlist WHERE sender='$user' AND target_id='$seller'";
                    $delres=mysqli_query($conn,$delquery);
                }
            }
        }

        } 
        
?>