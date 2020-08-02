<?php 
    session_start();
    include "loginheader.php";
    if(@$_SESSION['mail']==null){
        header("Location:index.php");
    }
?>
<head>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

<style>
    img{
        width:240px;
            height:220px;
            border-top-left-radius:5px;
            border-bottom-left-radius:5px;
            padding:5px;
    }
    .del{
        position:absolute;
        right:10px;
        bottom:5px;
       
    }.ctn h5{
        position:absolute;
        bottom:25px;
        left:250px;
    }
    @media(max-width:700px){
        img{
            width:220px;
            height:180px;
        }
    }
    }
</style>
</head>
<?php

    if(@ $_SESSION['whishlistrem']!=null){
        ?><div class="alert alert-success alt">
                   <a href="#" class="close" data-dismiss="alert">&times;</a>
                   <h6>Whishlist removed</h6>
        </div><?php
        unset($_SESSION['whishlistrem']);
    }
        $id = $_SESSION['id'];
        $q = mysqli_query($conn,"SELECT * FROM whishlist WHERE userid='$id'");   
        if(mysqli_num_rows($q)>0){
            ?>
            <p class="text-warning my-4" style="font-size:25px">Your Cart</p>
            <?php
            while($d = mysqli_fetch_assoc($q)){
                $imgid = $d['imgid'];
                $rowid = $d['id'];
                $q2 = mysqli_query($conn,"SELECT * FROM itemsdb WHERE id='$imgid'");
                $d2 = mysqli_fetch_assoc($q2);
                $img = $d2['image1'];
                $img_title = $d2['title'];
                $posted = $d2['date'];
       
?>

            <a href="productdetails.php?id=<?php echo $imgid?>"><div class="holder">
            <div class="ctn card col-md-12 mt-3">
            <img src="<?php echo $img?>" alt="">
            <h5><?php echo $img_title?></h5>
            <p style="font-size:22px;position:relative;"><b><?php echo $posted?></b></p>
            <div><a href="removewhishlist.php?delete=<?php echo $rowid?>" class="btn del btn-danger msg">Remove</a></div>
            </div></a>
            </div>
            <?php
      }
    }else{
        ?>
            <p class="text-info text-center mt-5">No items in your cart</p>
        <?php
    }
?>
</div>