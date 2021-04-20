<?php

include_once 'header.html';
include_once 'connect.inc.php';
include 'methods.inc.php';

if(isset($_POST["submit"])){
	$cid = mysqli_real_escape_string($conn, $_POST['cid']);
	$comment = mysqli_real_escape_string($conn, $_POST['comment']);
	if(EmptyInputLogin($comment,$cid)!== false){
		header('location: commentEvent.php?error=emptyinput');
		exit();
	}
	else{
		UpdateComment($conn,$cid,$comment);
		header('location: searchEvent.php?');
		exit();
	}
}
	