<?php 
	if(!isset($_SESSION['mail'])){
		include "withoutloginheader.php";
	}else{
		$name = $_SESSION["mail"];
		
?>
	<link rel="shortcut icon" type="image/jpg" href="images/tabimg.jpg"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

		<style>
		a{
			text-decoration:none;
		}
		li{
			list-style-type:none;
		}
		.txt{
			display:inline-block;
		}
		#ddlist{
			position:relative;
			right:10px;
		}
	
		@media(max-width:760px){
			.post-btn{
					display:none !important;
				}
				.S-post{
					display:block;
				}
		}
			@media(min-width:760px){
				.txt{
					display:none;
				}
				li a{
					position:relative;
					top:4px;
				}
				.askseller{
					position:relative;
					right:22px;
					font-size:22px;
				}
				.chat-nav-symbol{
					position:relative;
					top:4px;
					right:11px;
				}
				.S-post{
					display:none !important;
				}
			}
		</style>
       <div class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
        <div class="navbar-brand"><span class="s-logo"><b><span style="color:#ffdd59">Selling</span><span style="color:#ffa801">Cop</span></span></b></div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="togl" data-target="#togl">
        <span class="navbar-toggler-icon"></span>     
		</button>
		
        <div class="navbar-collapse collapse" id="togl">
		<ul class="navbar-nav ">
		<li class="nav-item"><a href="profile.php" class="nav-link text-white">Home</a></li>
		<li class="nav-item"><a href="contactform.php" class="nav-link text-white">Feedback</a></li>
		<li class="nav-item"><a href="category.php" class="btn btn-lg btn-outline-warning post-btn">Post Ad</a></li>
		<li class="nav-item"><a href="category.php" class="S-post nav-link text-white">Post Ad</a></li>
		</ul>
		<ul class="navbar-nav ml-auto">
		<li class="nav-item"><a href="forum.php" class="nav-link text-info askseller">Ask Sellers</a></li>		</ul>

		<a href="chat-window.php"><span class="chat_icon chat-nav-symbol"><i style="color:white" class="fas fa-comment-alt"></i><b><span style="position:relative;text-info;font-size:16px;top:-7px;color:red;" class="count badge"></span></b><span class="txt" style="color:white">Chats</span></span></a>
		<li class="nav-item dropdown">
			<a href="#" role="button" class="text-white nav-link dropdown-toggle" data-toggle="dropdown" id="ddlist" aria-haspopup="true"><span class="pro_icon"><i class="fas fa-user"></i></span><?php echo ucfirst($name);?></a>
		<div class="dropdown-menu" aria-labelledby="ddlist">
		<a href="myaccount.php" class="dropdown-item"><span class="list-symbol"><i class="fas fa-user"></i></span> My Account</a>
			<a href="contactform.php" class="dropdown-item"><span class="list-symbol"><i class="fas fa-comment"></i></span> Feedback</a>
			<a href="details.php" class="dropdown-item"><span class="list-symbol"><i class="fas fa-audio-description"></i></span> Post Ad</a>
			<a href="whishlist.php" class="dropdown-item"><span class="list-symbol"><i class="fas fa-shopping-cart"></i></span> Your Cart</a>
			<a href="destroy.php" class="dropdown-item"><span class="list-symbol"><i class="fas fa-sign-out-alt"></i></span> Logout</a>
			</div>
		</li>
        </ul>
		</div>
    </div>
	<script src="https://code.jquery.com/jquery-2.2.4.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<?php
include "connection.php";
 $count=0;
 $user=$_SESSION['id'];
 $querycount="SELECT * FROM chat WHERE send_to='$user' AND count=1";
 $rescount=mysqli_query($conn,$querycount);
 if(mysqli_num_rows($rescount)>0){
	 while($row=mysqli_fetch_assoc($rescount)){
		 $count++;
	 }
 }
if($count>0){
		?>
		<script>
		$(window).ready(function(){
			var count='<?php echo $_SESSION['newmessages']?>';
			if(count>0){
				$(".count").text(count);
			}
		});
			
	</script>
	<?php
	}
?>
	
<?php
	}

	?>