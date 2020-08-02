<?php
    @session_start();
    include "connection.php";
    #storing questions
    if(isset($_POST['question']) && isset($_POST['cat'])){
        $id = $_SESSION['id'];
        $date = date("d-M-Y");
        $q = mysqli_real_escape_string($conn,htmlspecialchars($_POST['question']));
        $cat = mysqli_real_escape_string($conn,htmlspecialchars($_POST['cat']));
       
        $query = mysqli_query($conn,"INSERT INTO forum_queries (id_asked_user,question,category,posted) VALUES ('$id','$q','$cat','$date')");
        if($query){
            echo "success";
        }
    }
    #Deleting posted questions
    if(isset($_GET["del"])){
        $del = $_GET["del"];
        $query = mysqli_query($conn,"DELETE FROM forum_queries WHERE id='$del' OR replied_question='$del'");
    }
    #storing replies
    if(isset($_POST['reply']) && isset($_POST['q'])){
        $id = $_SESSION['id'];
        $reply = $_POST['q'];
        $date = date("d-M-Y");
        $q = mysqli_real_escape_string($conn,htmlspecialchars($_POST['reply']));
        $query = mysqli_query($conn,"INSERT INTO forum_queries (replied_question,replied_user,replies,posted) VALUES ('$q','$id','$reply','$date')");
        if($query){
            echo "success";
        }
    }
?>