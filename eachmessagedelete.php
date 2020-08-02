<?php
    include "connection.php";
    if(isset($_POST['msgid'])){
        $mid=$_POST['msgid'];
        $query="UPDATE chat SET message='This message was deleted' WHERE id='$mid'";
        $res=mysqli_query($conn,$query);
    }
?>