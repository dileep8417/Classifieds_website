<?php

if(isset($_SESSION['mail'])){
	$id = $_SESSION['id'];
	include "connection.php";
   $query = "SELECT * FROM itemsdb WHERE user_id='$id'";
   $res = mysqli_query($conn,$query);
   if(mysqli_num_rows($res)>0){
		 ?> <?php
	   while($row = mysqli_fetch_assoc($res)){
		   $img = $row['image1'];
		   $id = $row['id'];
		   $price =$row['price'];
		   $category = $row['category'];
		   $title = $row['title'];
		   $date = $row['date']; 
   ?>
    
    <!DOCTYPE html>
	<head>
	<style>
			
			.msg{
			float:right;
			position:absolute;
			bottom:20px;
			right:20px;
			}
			img{
				width:200px;
				height:150px;
				padding:10px;
			}
			
			.holder{
				width:100%;
				height:150px;
				background: #81ecec;
				position:relative;
				top:20px;
				border-radius:10px;
				margin:auto;
				margin-bottom:15px;
			}
			.price{
				float:right;
				position:absolute;
				right:10px;
				top:10px;
				
			}
			.date{
				position:absolute;
				bottom:10px;
				left:220px;
				color:black;
			}
			.item{
				position:absolute;
				bottom:40px;
				left:220px;
				color:blue;
			}.itemdetails{
				position:absolute;
				bottom:50px;
				left:220px;
				color:black;
			}
			@media(max-width:600px){
				.holder{
					width:100%;
				}
				img{
					width:150px;
					height:100px;
				}
				.date{
					left:20px;
					top:120px;	
				}
				.itemdetails{
					left:50px;
					top:80px;
				}
			}
			
		</style>
	<div class="holder table">
		<h4 class="price">₹<?php echo $price?></h4>
		<a href="productdetails.php?id=<?php echo $id?>"><img src="<?php echo $img?>" alt="image not found">
		<p class="date"><b><?php echo $date?></b></p>
		<table class="itemdetails">
			<tr>
				<td><p style="font-size:20px"><?php echo $title?></p></td>
			<td><p style="font-size:18px"><?php echo $category?></p></td>
		</tr>
		
	</table></a>
		<a href="deletead.php?delete=<?php echo $row['id']?>" class="btn hide btn-danger msg">Delete</a>
		
		
	</div>
    <?php
    }
  }
  else{
	echo "<h2 class='text-primary'>You don't have any Ads</h2>";
	?>
	<?php	
}
}

 

?>
