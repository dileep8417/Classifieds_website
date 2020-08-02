<?php @session_start();
    if(!isset($_SESSION['id'])){
        ?>
          <script>alert("Please Login to use this feature.");
            location.href = "index.php";
          </script>
        <?php
        die();
      }
    include "connection.php";
    if(isset($_GET['sellerid'])){
     $_SESSION['sellerid'] = $_GET['sellerid'];
        header("Location:chat-window.php");
        $sellerid=$_SESSION['sellerid'];
        $query="SELECT * FROM signupdb WHERE id='$sellerid'";
        $res=mysqli_query($conn,$query);
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                $_SESSION['status'] = $row['track'];
            }
        }
    } 

    //Post Ad details
    if(isset($_POST['adDetails'])){
		$_SESSION['brand'] = $_POST['info'];
		print_r(json_decode($_POST["info"],true))["brand"];
		echo $_SESSION['brand'];
	}
?>
<script>
    var status='<?php echo $_SESSION['status']?>';
    if(status==1){
        $(".status").text("online");
    }else{
        $(".status").text("offline");
    }
</script>