<?php
    session_start();
$id=$_GET['delete'];
include "connection.php";
$query = "Delete FROM itemsdb WHERE id='$id'";
$res = mysqli_query($conn,$query);
if($res){
    $_SESSION['deleted']="exist";
    header("Location:myaccount.php");
}

?>