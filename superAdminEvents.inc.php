<?php
session_start();
include_once 'connect.inc.php';
include 'methods.inc.php';

if(isset($_GET["submit"])){
	
	if($_GET["submit"]==="approve"){
		$name = mysqli_real_escape_string($conn, $_GET["event"]);
		updateEvent($conn,$name);	
	}
	if($_GET["submit"]==="reject"){
		$name = mysqli_real_escape_string($conn, $_GET["event"]);
		deleteEvent($conn,$name);	
	}
}