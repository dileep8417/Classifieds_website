<?php 
	@session_start();
	if(isset($_SESSION['chat_err'])){
		?><script>
			alert("Please Login to Chat");
		</script><?php
		unset($_SESSION['chat_err']);
	}
?>

<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="bootstrap/bootstrap.css">
	
</head>
<body>
	
		<?php 
		include "profile.php";
		?>
</body>
</html>