<?php
    session_start();
    $userid=$_SESSION['id'];
    if(isset($_GET['delete'])){
        $id=$_GET['delete'];
    include "connection.php";
    $query="DELETE FROM whishlist WHERE id='$id'";
    $res = mysqli_query($conn,$query);
    $_SESSION['whishlistrem']="exist";
    header("Location:whishlist.php");
    }

    if(isset($_GET["wlist_imgid"])){
        $id=$_GET["wlist_imgid"];
        include "connection.php";
        $query="DELETE FROM whishlist WHERE imgid='$id' AND userid='$userid'";
        $res = mysqli_query($conn,$query);
    }

    
?>