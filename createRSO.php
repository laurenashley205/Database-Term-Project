<?php
	include_once 'connect.php';
	include 'methods.php';
	
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$admin = mysqli_real_escape_string($conn, $_POST['admin']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
	$member1 = mysqli_real_escape_string($conn, $_POST['member1']);
    $member2 = mysqli_real_escape_string($conn, $_POST['member2']);
    $member3 = mysqli_real_escape_string($conn, $_POST['member3']);
    $member4 = mysqli_real_escape_string($conn, $_POST['member4']);
    $member5 = mysqli_real_escape_string($conn, $_POST['member5']);
    $emailDomain = mysqli_real_escape_string($conn, $_POST['emailDomain']);
	$r_pid = random_num();

		$sql = "INSERT INTO Users (name, admin, description, member1, member2, member3, member4, member5, emailDomain)
	VALUES ('$name', '$admin', '$description', '$member1', '$member2', '$member3', '$member4', '$member5', '$emailDomain);";
		mysqli_query($conn, $sql);
		
	header("Location: index.php");
		
	?>