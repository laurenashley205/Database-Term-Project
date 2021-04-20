<?php
	include_once 'connect.php';
	// include 'methods.php';
	include 'methods.inc.php';
	
	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$studentID = mysqli_real_escape_string($conn, $_POST['studentID']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	// $u_pid = random_num();
	$u_pid = RandomNum();
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$university = mysqli_real_escape_string($conn, $_POST['university']);
	$level = mysqli_real_escape_string($conn, $_POST['level']);

		$sql = "INSERT INTO Users (fname, lname, studentID, email, u_pid, password, university, level)
	VALUES ('$first', '$last', '$studentID', '$email', '$u_pid', '$password', '$university', '$level');";
		mysqli_query($conn, $sql);
		
	header("Location: login.php?signup=success");
		
	?>