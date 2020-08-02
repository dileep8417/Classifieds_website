<?php
    session_start();
    
    $userid=$_SESSION['id'];
    $id = $_GET['id'];
    if($userid==null){
        die();
    }
    include "connection.php";
   
    $query="SELECT * FROM itemsdb WHERE id='$id' AND id!='0'";
    $res=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($res)){
        $item=$row['image'];
        $imgid=$row['id'];
        $itemname=$row['category'];
    }
    $query="SELECT item FROM whishlist WHERE imgid='$id' AND userid='$userid'";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        $_SESSION['whishlisterr']="exist";
        header("Location:profile.php");
        die();
    }
    $query="INSERT INTO whishlist (userid,imgid,item,itemname) VALUES('$userid','$imgid','$item','$itemname')";
    $res=mysqli_query($conn,$query);
    $delquery="DELETE FROM whishlist WHERE imgid='0'";
    $delres=mysqli_query($conn,$delquery);
    header("Location:profile.php");
    $_SESSION['whishlistadd']="exist";
?>