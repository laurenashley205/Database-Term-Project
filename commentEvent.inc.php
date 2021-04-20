<?php
session_start();
include_once 'connect.inc.php';
include 'methods.inc.php';

if(isset($_POST["submit"])){
	$name = mysqli_real_escape_string($conn, $_POST['event']);
	$comment = mysqli_real_escape_string($conn, $_POST['comment']);
	$rate = $_POST['rating'];
	$rating = (int)$rate;
	if(EmptyInputEvent($name,$comment,$rating)!== false){
		header('location: commentEvent.php?error=emptyinput');
		exit();
	}
	else{
		$event = EventExists($conn,$name);
		$eid = $event['e_id'];
		CommentEvent($conn,$name,$comment,$rating,$_SESSION['uid'],$eid);
	}
	
	
}