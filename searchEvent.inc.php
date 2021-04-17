<?php
session_start();
include_once 'connect.inc.php';
include 'methods.inc.php';

if(isset($_GET["submit"])){
	if(!empty($_GET["event"]) && $_GET["submit"]=== "filter"){
		$name = mysqli_real_escape_string($conn, $_GET['event']);
		if(DisplayEvent($conn,$name) !== false){
			header('location: searchEvent.php?event='.$name);
			exit();
		}
		else{
			header("location: searchEvent.php?error=noevent");
			exit();
		}
	}
	if($_GET["submit"]==="reset"){
		header("location: searchEvent.php");
			exit();
	}
	if($_GET["submit"]==="leave"){
		$name = mysqli_real_escape_string($conn, $_GET["event"]);
		LeaveEvent($conn,$name,$_SESSION['uid']);
		header('location: searchEvent.php?left='.$name);
			exit();
	}
	if($_GET["submit"]==="join"){
		$name = mysqli_real_escape_string($conn, $_GET["event"]);
		JoinEvent($conn,$name,$_SESSION["uid"]);
		header('location: searchEvent.php?joined='.$name);
			exit();
	}
	if(isset($_GET["eventtype"])){	//array that holds whatever boxes were checked 
		$numFilters = count($_GET["eventtype"]);
		if($numFilters === 3 || $numFilters === 0){
			header('location: searchEvent.php');
			exit();
		}
		else if($numFilters === 2){
			$i = 0;
			foreach($_GET["eventtype"] as $filter){
				$filters[$i] = $filter;
				$i +=1;
			}
			header('location: searchEvent.php?filters='.$filters[0] . "&filters1=" .$filters[1]);
			exit();
		}
		else if($numFilters === 1){
			foreach($_GET["eventtype"] as $filter){
				header('location: searchEvent.php?filters='.$filter);
				exit();
			}
		}
	}
	header("location: searchEvent.php?error=norso");
	exit();
	
}
