<?php

include_once 'header.html';
include_once 'connect.inc.php';
include 'methods.inc.php';
	
if(isset($_GET["submit"])){
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$numStudents = $_GET['numStudents'];
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$location = mysqli_real_escape_string($conn, $_POST['location']);
		
	if(EmptyInputSignup($name,$numStudents,$description,$location)!== false){
		header("location: university.php?error=emptyinput");
		exit();
	}
	if(UniExists($conn,$name)!== false){
		header("location: createRso.php?error=rsotaken");
		exit();
	}
	CreateUni($conn,$name,$numStudents,$description,$location);
	header("Location: createRso.php?signup=success");