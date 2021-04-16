<?php
session_start();
include_once 'connect.inc.php';
include 'methods.inc.php';

if(isset($_GET["submit"])){
	if(!empty($_GET["rso"]) && $_GET["submit"]=== "filter"){
		$name = mysqli_real_escape_string($conn, $_GET['rso']);
		if(DisplayRso($conn,$name) !== false){
			header('location: searchRso.php?rso='.$name);
			exit();
		}
		else{
			header("location: searchRso.php?error=norso");
			exit();
		}
	}
	if($_GET["submit"]==="reset"){
		header("location: searchRso.php");
			exit();
	}
	if($_GET["submit"]==="leave"){
		$name = mysqli_real_escape_string($conn, $_GET["rso"]);
		LeaveRso($conn,$name,$_SESSION['uid']);
		header('location: searchRso.php?left'.$name);
			exit();
		
	}
	if($_GET["submit"]==="join"){
		$name = mysqli_real_escape_string($conn, $_GET["rso"]);
		JoinRso($conn,$name,$_SESSION["uid"]);
		header('location: searchRso.php?joined'.$name);
			exit();
	}
	if(isset($_GET["rsotype"])){	//array that holds whatever boxes were checked 
		$numFilters = count($_GET["rsotype"]);
		if($numFilters === 3 || $numFilters === 0){
			header('location: searchRso.php');
			exit();
		}
		else if($numFilters === 2){
			$i = 0;
			foreach($_GET["rsotype"] as $filter){
				$filters[$i] = $filter;
				$i +=1;
			}
			header('location: searchRso.php?filters='.$filters[0] . "&filters1=" .$filters[1]);
			echo "just a test";
			exit();
		}
		else if($numFilters === 1){
			foreach($_GET["rsotype"] as $filter){
				header('location: searchRso.php?filters='.$filter);
				exit();
			}
		}
	}
	
	header("location: searchRso.php?error=norso");
	exit();
	
}


