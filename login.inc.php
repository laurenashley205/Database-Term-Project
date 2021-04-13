<?php

if(isset($_POST["submit"])){
	$email = $_POST["email"];
	$password = $_POST["password"];
	
	require_once 'connect.inc.php';
	require_once 'methods.inc.php';
	
	if(EmptyInputLogin($email,$password)!== false){
		header("location: login.php?error=emptyinput");
		exit();
	}
	
	loginUser($conn,$email,$password);
}
else{
	header("location: login.php");
	exit();
}