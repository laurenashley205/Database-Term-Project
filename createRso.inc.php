<?php

include_once 'header.html';
include_once 'connect.inc.php';
include 'methods.inc.php';
	
if(isset($_POST["submit"])){
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$type = $_POST['university'];
	$rlocation = findLocation($conn,$_SESSION["email"]);
	$first = mysqli_real_escape_string($conn, $_POST['member1']);
	$second = mysqli_real_escape_string($conn, $_POST['member2']);
	$third = mysqli_real_escape_string($conn, $_POST['member3']);
	$fourth = mysqli_real_escape_string($conn, $_POST['member4']);
		
	if(EmptyInputRso($name,$first,$second,$third,$fourth)!== false){
		header("location: createRso.php?error=emptyinput");
		exit();
	}
	if(RsoExists($conn,$name)!== false){
		header("location: createRso.php?error=rsotaken");
		exit();
	}
	if(EmailExists($conn,$first)=== false || EmailExists($conn,$second)=== false || EmailExists($conn,$third)=== false || EmailExists($conn,$fourth)=== false){
		header("location: createRso.php?error=nouser");
		exit();
	}
	CreateRso($conn,$name,$type);
	$id = GetRid($conn,$name);
	UpdateMember($conn,$_SESSION["email"],$id);
	UpdateMember($conn,$first,$id);
	UpdateMember($conn,$second,$id);
	UpdateMember($conn,$third,$id);
	UpdateMember($conn,$fourth,$id);
		
	header("Location: createRso.php?signup=success");
}
else{
	header("location: createRso.php");
	exit();
}
	

	