<?php
	if(isset($_GET['cat']) || isset($_GET['s'])){
		@session_start();
		include "loginheader.php";
		include "sidemenu.php";
		?>
			<style>
				.content{
					margin-top:25px;
				}
				.card{
					min-width:250px !important;
            		max-width:260px;
				}
			</style>
		<?php
	}
	?>
<!DOCTYPE html>
	<head>
		<style>
			
			.pimg{
				width:190px;
				height:210px;
				position:relative;
				left:-18px !important;
				padding:10px;
			}
			.wlist{
				position:absolute;
				font-size:30px;
				float:right;
				top:0px;
				right:2px;
				z-index:1000;
			}
			.date{
				position:absolute;
				bottom:-18px;
				right:25px;
				color:black;
			}
			.holder{
				margin-right:15px;
			}
			@media(max-width:450px){
				.hide{
					display:none;
				}
			}
			
			
		</style>
		
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	</head>
<body>
<div class="container content">
	<div class="row">
<?php

		if(isset($_GET['s'])){
			include "search.php";
			?>
				<style>
					.content{
						margin-top:145px;
					}
					#search-field{
						position:relative;
						width:100%;
						left:20vw;
						top:-130px;
					}
					@media(max-width:550px){
						#search-field input{
							width:80%;
							margin-left:20px;
						}
						#search-btn{
							display:block;
							margin:auto;
						}
					}
				</style>
			<?php
			
		}

@session_start();
include "connection.php";
  
if(isset($_SESSION['id'])){
	$arr=array();
	$i=0;
	@$user_id=$_SESSION['id'];
		$query2 = "SELECT * FROM whishlist WHERE userid='$user_id'";
		$res2=mysqli_query($conn,$query2);
		if(mysqli_num_rows($res2)>0){
			
			while($row2=mysqli_fetch_assoc($res2)){
				$arr[$i]=$row2['imgid'];
				$i++;
			}
		}
		$len = count($arr);	
}

$latest = array();
if(isset($_GET['cat'])){
	$cat = $_GET['cat'];
	$query = "SELECT * FROM itemsDB WHERE category='$cat'";
}
else if(isset($_GET['s'])){
	$s = mysqli_real_escape_string($conn,$_GET['s']);
$query = "SELECT * FROM itemsDB WHERE category LIKE '%$s%' OR title LIKE '%$s%'  OR brand LIKE '%$s%' OR description LIKE '%$s%'"; 
}
else{
	$query = "SELECT * FROM itemsDB";
}
		$res = mysqli_query($conn,$query);
		if(mysqli_num_rows($res)>0){

			if(isset($_GET['s'])){
				?>
					<p style="font-size:29px;margin-top:-50px;display:block;" class="text-primary col-md-12">Your search Results</p>
				<?php
			}

			while($row = mysqli_fetch_assoc($res)){
				array_push($latest,$row['id']);
			}
		}else{
			if(isset($_GET['s'])){
				?>
					<p style="font-size:29px;margin-right:10px" class="text-info">No results found for <span class="text-danger"><?php echo '"'.$s.'"'?></span></p>
				<?php
			}else{
			echo "No recent ads found<br><br>Be the first person to post your ads";
			?>
			<style>
				#postadbtn{
					position:relative;
					left:10px;
					color:white;
					width:90px;
					height:45px;
					top:35px;
					margin-bottom:150px;
				}
			</style>
			<a  href="category.php" id="postadbtn" class="btn btn-primary">Post Ad</a>
			<?php
		 	die();
		}
	}
$_SESSION['count'] = $prolen = count($latest)-1;
if(isset($_GET['q'])){
	$q = $_GET['q'];
}else{
	$q = 3;
}
$track=0;
for($x=$prolen;$x>=0;$x--){
	$track+=1;
	if(!isset($_GET['cat'])){
		if($track>$q){
			break;
		}
	}
		$product = $latest[$x];	
		$query = "SELECT * FROM itemsDB WHERE id='$product'";
		$res = mysqli_query($conn,$query);
			while($row = mysqli_fetch_assoc($res)){
				$img = $row['image1'];
				$id = $row['id'];
				$price =$row['price'];
				$description = $row['description'];
				$category = $row['category'];
				$title= $row['title'];
				$date = $row['date'];
				$condition = $row['new_used'];
				$seller_id = $row['user_id'];
				
?>
 <div class="holder card col-sm-3">
	<?php
	if(isset($_SESSION['id'])){
		$target=false;
		foreach($arr as $a){
			if($a==$id){
				?>
				<div class="wlist"><i style="color:red" data="<?php echo $id?>" class="fas fa-heart"></i></div>
				<?php
				$target=true;
			}
		}
		if($target==false){
			?>
				<div class="wlist"><i style="color:silver" data="<?php echo $id?>" class="fas fa-heart"></i></div>
				<?php
		}
	}
	
		
		?>
	<?php
	if(isset($_SESSION['id'])){
		if(!isset($posted_account)){
			$posted_account=false;
		}
		if($seller_id==$_SESSION['id']){
			?><a href="myaccount.php" style="width:80px" class="btn hide btn-success msg">Your Ad</a><?php
		}else{
			//check new or used
			if($condition=="new"){
				?><a href="#" style="width:80px;padding:10px;position:relative;left:-14px" class="btn hide btn-info msg">New</a><?php
			}else if($condition=="used"){
				?><a href="#" style="width:80px;padding:10px;position:relative;left:-14px" class="btn hide btn-warning msg">Used</a><?php
			}else if($condition=="rent"){
				?><a href="#" style="width:80px;padding:10px;position:relative;left:-14px" class="btn hide btn-warning msg">Rent</a><?php
			}else if($condition=="sell"){
				?><a href="#" style="width:80px;padding:10px;position:relative;left:-14px" class="btn hide btn-info msg">Sell</a><?php
			}
			?><?php
		}
	}
		
	?>
	<a href="productdetails.php?id=<?php echo $id?>&cat=<?php echo $category?>">
	<div class="card-body">
	<img src="<?php echo $img?>" class='pimg' alt="Product Image">
		<table>
		<tr>
			<td><p class="date"><b><?php echo $date?></b></p></td>
		</tr>
			<tr>
			<td><h4><?php echo ucfirst($title)?></h4></td>
		</tr>
		<tr>
			<td><h5 class="price">₹<?php echo $price?></h5></td>
		</tr>
		
	</table></a>
	
		</div>
	</div>

<?php
		}
}	
?>
</div>
</div>
</body>
</html>
	<script>
		$(window).ready(function(){
			$("i").attr("id",function(index){
				return "wlist-symbol"+index;
			});
			$("i").click(function(){
				var id=$(this).attr("id");
				var color=$("#"+id).css("color");
				var imgid=$("#"+id).attr("data");
				if(color=="rgb(192, 192, 192)"){ //white
					$.ajax({
						url:"whishlistDB.php?id="+imgid,
						type:"GET",
						async:false,
						success:function(){
							$("#"+id).css("color","red");
						}
					});	
				}
				if(color=="rgb(255, 0, 0)"){ //red
					$.ajax({
						url:"removewhishlist.php?wlist_imgid="+imgid,
						type:"GET",
						async:true,
						success:function(){
							$("#"+id).css("color","silver")
						}
					});
				}				
			});
		});
		</script>
