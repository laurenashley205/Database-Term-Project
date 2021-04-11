<?php

include_once 'connect.inc.php';

	
function RandomNum(){
	
	//generate user id 
	$text = "";
	$length = 7;
		
	for($i=0;$i<$length;$i++){
		$text.= rand(0,9);
	}
return $text;
}

function EmptyInputSignup($first,$last,$email,$password){
	
	$result;
	if(empty($first) || empty($last) || empty($email) || empty($password)){
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;	
}
	
function InvalidEmail($email){
	
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;	
}
	
function EmailExists($conn,$email){
	
	$sql = "SELECT * FROM Users WHERE email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location: signup.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"s",$email);
	mysqli_stmt_execute($stmt);
	
	$resultData = mysqli_stmt_get_result($stmt);
	
	if($row = mysqli_fetch_assoc($resultData)){
		return $row;
	}
	else{
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);
}

function CreateUser($conn,$first,$last,$email,$u_pid,$password,$security){
	
	$sql = "INSERT INTO Users (fname, lname, email, u_pid, password,security)
	VALUES (?,?,?,?,?,?);";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location: signup.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"ssssss",$first, $last, $email, $u_pid, $password, $security);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: login.php?error=none");
		exit();
}

function EmptyInputLogin($email,$password){
	
	$result;
	if(empty($email) || empty($password)){
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;	
}

function loginUser($conn,$email,$password){
	$emailExists = EmailExists($conn,$email);
	
	if($emailExists === false){
		header("location: login.php?error=emailnotfound");
		exit();
	}
	$pass = $emailExists["password"];
	$checkpassword = strcmp($password,$pass);
	
	if($checkpassword !== 0){
		header("location: login.php?error=wrongpassword");
		exit();
		
	}
	else if($checkpassword === 0){
		session_start();
		$_SESSION["pid"] =  $emailExists["u_pid"];				/*Here are the values for anything we might need in the site*/
		$_SESSION["name"] =  $emailExists["fname"];				/*Users can find this info on the "profile" page*/
		$_SESSION["lastName"] =  $emailExists["lname"];		
		$_SESSION["email"] =  $emailExists["email"];		
		$_SESSION["status"] =  $emailExists["security"];
		header("location: index.php");
		exit();
	}
}



	
	
	
	
