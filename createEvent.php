<!-- <?php
	include_once 'connect.php';
	include 'methods.php';
	
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$category = mysqli_real_escape_string($conn, $_POST['category']);
	$start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
	$end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $L_name = mysqli_real_escape_string($conn, $_POST['L_name']);
    $E_id = random_num();
	$type = mysqli_real_escape_string($conn, $_POST['type']);

		$sql = "INSERT INTO events (name, category, start_date, end_date, description, L_name, E_id, type)
	VALUES ('$name', '$category', '$start_date', '$end_date', '$description', '$L_name', 'E_id', 'type');";
		mysqli_query($conn, $sql);
		
	header("Location: login.php?signup=success");
		
	?> -->

      
<?php
	include_once 'connect.php';
	include 'methods.php';
	
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$start_date = mysqli_real_escape_string($conn, $_POST['start']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$end_date = mysqli_real_escape_string($conn, $_POST['end']);
	$location = mysqli_real_escape_string($conn, $_POST['location']);
	// $email = get_email();//comes from admin's email 
    $email = mysqli_real_escape_string($conn, $_POST['email']);
	$category = $_POST['category'];
	$type = $_POST['type']; 
	if($type == "RSO"){
		$type = $_POST['rsoname'];
	}

		$sql = "INSERT INTO events (name, category, start_date, end_date,description, location, type, email)
	VALUES ('$name', '$category', $start_date','$end_date','$description', '$location','$type','$email');";
		mysqli_query($conn, $sql);
		
	header("Location: index.php");
		
	?>