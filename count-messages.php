<?php
    #Getting no. of new messages
    include "connection.php";
    session_start();
    $count=0;
    $user=$_SESSION['id'];
    $query="SELECT * FROM chat WHERE send_to='$user' AND count=1";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        while($row=mysqli_fetch_assoc($res)){
            $count++;
        }
        $_SESSION['newmessages']=$count;
    }
?>