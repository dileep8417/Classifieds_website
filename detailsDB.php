<?php
session_start();
if(!isset($_SESSION['mail'])){
	header("Location:index.php");
	die("Mail not set");
}else{
	$mail = $_SESSION['mail'];
}


	include "connection.php";
	$user = $_SESSION['id'];

	$img1_name = $_FILES["file1"]["name"];
	$img2_name = $_FILES["file2"]["name"];
	if(strlen($img1_name)<1){
		die();
	}else{
		$img1_tmp_name = $_FILES["file1"]["tmp_name"];
		$ext1 = pathinfo($img1_name,PATHINFO_EXTENSION);
		$new_file1 = date("YMhi").".".$ext1;
		$path1 = "postedimages/".$new_file1;
		move_uploaded_file($img1_tmp_name,$path1);
	}
	if(strlen($img2_name)!=0){
		$img2_tmp_name = $_FILES["file2"]["tmp_name"];
		$ext2 = pathinfo($img1_name,PATHINFO_EXTENSION);
		$new_file2 = $img2_name.date("YMhi").".".$ext2;
		$path2 = "postedimages/".$new_file2;
		move_uploaded_file($img2_tmp_name,$path2);
	}else{
		$path2 = "";
	}

	#variables
	$category = $_POST['category'];


	if(isset($_POST['neworused'])){
		$new_used = $_POST['neworused'];
	}else{
		$new_used = "";
	}

	if(isset($_POST['sellorrent'])){
		$sell_rent = $_POST['sellorrent'];
	}else{
		$sell_rent = "";
	}
	if(isset($_POST['brand'])){
		$brand = $_POST['brand'];
	}else{
		$brand = "";
	}
	if(isset($_POST['title'])){
		$title = $_POST['title'];
	}else{
		$title = "";
	}

	if(isset($_POST['price'])){
		$price = $_POST['price'];
	}else{
		$price = "";
	}
	
	if(isset($_POST['manfyear'])){
		$manf_year = $_POST['manfyear'];
	}else{
		$manf_year = "";
	}

	if(isset($_POST['distancetravelled'])){
		$distance_travelled = $_POST['distancetravelled'];
	}else{
		$distance_travelled = "";
	}

	if(isset($_POST['fueltype'])){
		$fuel_type = $_POST['fueltype'];
	}else{
		$fuel_type = "";
	}
	if(isset($_POST['listedby'])){
		$listed_by = $_POST['listedby'];
	}else{
		$listed_by = "";
	}

	if(isset($_POST['plotarea'])){
		$plot_area = $_POST['plotarea'];
	}else{
		$plot_area = "";
	}

	if(isset($_POST['desc'])){
		$description = $_POST['desc'];
	}else{
		$description = "";
	}

	if(isset($_POST['bathrooms'])){
		$bathrooms = $_POST['bathrooms'];
	}else{
		$bathrooms = "";
	}
	if(isset($_POST['bedrooms'])){
		$bedrooms = $_POST['bedrooms'];
	}else{
		$bedrooms = "";
	}
	if(isset($_POST['furnish'])){
		$furnish = $_POST['furnish'];
	}else{
		$furnish = "";
	}
	if(isset($_POST['location'])){
		$location = $_POST['location'];
	}else{
		$location = "";
	}
	if(isset($_POST['floors'])){
		$floors = $_POST['floors'];
	}else{
		$floors = "";
	}
	if(isset($_POST['facing'])){
		$facing = $_POST['facing'];
	}else{
		$facing = "";
	}	
	if(isset($_POST['parking'])){
		$parking = $_POST['parking'];
	}else{
		$parking = "";
	}
	if(isset($_POST['length'])){
		$length = $_POST['length'];
	}else{
		$length = "";
	}
	if(isset($_POST['breadth'])){
		$breadth = $_POST['breadth'];
	}else{
		$breadth = "";
	}	
	$date = date("d M");

	$query = mysqli_query($conn,"INSERT INTO itemsDB (category,new_used,brand,manf_year,distance_travelled,fuel_type,price,title,sell_rent,listed_by,plot_area,facing,description,bedrooms,bathrooms,furnish,floors,location,parking,length,breadth,user_id,date,image1,image2)
	VALUES('$category','$new_used','$brand','$manf_year','$distance_travelled','$fuel_type','$price','$title','$sell_rent','$listed_by','$plot_area','$facing','$description','$bedrooms','$bathrooms','$furnish','$floors','$location','$parking','$length','$breadth','$user','$date','$path1','$path2')");
		$update = mysqli_query($conn,"SELECT * FROM signupdb WHERE id='$user'");
		$det = mysqli_fetch_assoc($update);
		$total = $det['total_ads'];
		$total = $total+1;
		$sec = mysqli_query($conn,"UPDATE signupdb SET total_ads='$total' WHERE id='$user'");
		header("Location:profile.php");
?>