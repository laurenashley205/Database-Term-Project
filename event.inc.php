//NOT BEING USED RN
<?php
	include_once 'header.html';
	include_once 'connect.inc.php';
	include 'methods.inc.php';
	
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$date = $_POST['date'];
	$category = $_POST['category'];
	$type = $_POST['type']; 
		
	if(EmptyInputEvent($name,$description,$date)!== false){
		header("location: events.php?error=emptyinput");
		exit();
	}
	if(EventExists($conn,$name)!== false){
		header("location: events.php?error=eventexists");
		exit();
	}
	
		
	if($type == "rso"){
		$rsotype = $_POST['rsoname'];
		if(EmptyInputEvent($rsotype,$description,$date)!== false){
			header("location: events.php?error=emptyinput");
			exit();
		}
		if(RsoExists($conn,$rsotype)!== false){
			
		}
		else{
			header("location: events.php?error=norso");
			exit();
		}
		if(RsoStatus($conn,$rsotype)!== false){
			CreateEvent($conn,$name,$description,$date,$category,$rsotype,$_SESSION["uid"]);
			CreateHost($conn,$name,$rsotype);
			$id = GetEid($conn,$name);
			UpdateMemberEvent($conn,$_SESSION["email"],$id);
		}
		else{
			header("location: events.php?error=inactiverso");
			exit();
		}
				
	}
	else{
		CreateEvent($conn,$name,$description,$date,$category,$type,$_SESSION["uid"]);
	}
	header("location: events.php?success");
			exit();
	
	
/*
		$sql = "INSERT INTO Events (name, category, start_date, end_date,description, location, type, email)
	VALUES ('$name', '$start_date','$end_date','$description', '$location','$type','$email');";
		mysqli_query($conn, $sql);
		
	//header("Location: login.php?signup=success");
		
*/