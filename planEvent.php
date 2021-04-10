<?php
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
		
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>	</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
	
		<!-- action will take you to the next page-->
		<form action="planEvent.php" method="POST">
			<input type="text" name="name" placeholder="Event Name">
			<input type="text" name="category" placeholder="Category">
			<input type="text" name="start_date" placeholder="Start">
            <input type="text" name="end_date" placeholder="End">
            <input type="text" name="description" placeholder="Description">

			<br><button type="submit" name="submit">Submit</button>
		</form>
	
	
	</body>
</html>