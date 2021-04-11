<?php
	include_once 'connect.php';
	include 'methods.php';
	
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$start_date = mysqli_real_escape_string($conn, $_POST['start']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$end_date = mysqli_real_escape_string($conn, $_POST['end']);
	$location = mysqli_real_escape_string($conn, $_POST['location']);
	$email = get_email();//comes from admin's email 
	$category = $_POST['category'];
	$type = $_POST['type']; 
	if($type == "RSO"){
		$type = $_POST['rsoname'];
	}

		$sql = "INSERT INTO Events (name, category, start_date, end_date,description, location, type, email)
	VALUES ('$name', '$start_date','$end_date','$description', '$location','$type','$email');";
		mysqli_query($conn, $sql);
		
	//header("Location: login.php?signup=success");
		
	?>