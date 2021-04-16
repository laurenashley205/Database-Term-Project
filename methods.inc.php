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

function CreateUser($conn,$first,$last,$email,$u_pid,$password,$university,$security){
	
	$sql = "INSERT INTO Users (fname, lname, email, u_pid, password, university, security)
	VALUES (?,?,?,?,?,?,?);";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location: signup.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"sssssss",$first, $last, $email, $u_pid, $password,$university, $security);
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
		$_SESSION["university"] = $emailExists["university"];
		$_SESSION["uid"] = $emailExists["u_id"];
		header("location: index.php");
		exit();
	}
}

function findLocation($conn,$email){
	$location = EmailExists($conn,$email);
	$loc = $location['university'];
	return $loc;
	
}

function EmptyInputRso($name,$first,$second,$third,$fourth){
	
	$result;
	if(empty($name) || empty($first) || empty($second) || empty($third) || empty($fourth)){
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;	
	
}
	
function RsoExists($conn,$name){
	$sql = "SELECT * FROM Rsos WHERE name = ?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location: createRso.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"s",$name);
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

 function CreateRso($conn,$name,$type){
	
	$sql = "INSERT INTO Rsos (name, type) VALUES (?,?);";
	
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location: createRso.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"ss",$name, $type);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

function GetRid($conn,$name){
	$rid = RsoExists($conn,$name);
	$idnum = $rid["r_id"];
	return $idnum;
}

function UpdateMember($conn,$email,$r_id){
	$emailExists = EmailExists($conn,$email);
	$u_id = $emailExists["u_id"];
	$sql = "INSERT INTO Rso_members (r_id, u_id)
	VALUES (?,?);";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location: createRso.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"ss",$r_id, $u_id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}
	
function DisplayGroups($conn,$uid){
	
	$sql = "SELECT name FROM Rsos 
		INNER JOIN Rso_members ON Rso_members.r_id = Rsos.r_id
		INNER JOIN Users ON Users.u_id = Rso_members.u_id
		WHERE Users.u_id = $uid;";		
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo "<p> " .$row['name'] . "</p>";
			}
		}
}

function showAvailableRso($conn,$uni){
	
	
	$sql = "SELECT DISTINCT name, type FROM Rsos
		INNER JOIN Rso_members ON Rso_members.r_id = Rsos.r_id
		INNER JOIN Users ON Users.u_id = Rso_members.u_id
		WHERE Users.university = '$uni';";	
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck > 0){
				while($row = mysqli_fetch_assoc($result)){
					echo  "<h2>Name: \t" .$row["name"] .  "<br> Type: \t"  . $row["type"] . "</h2>";
				}
			}
			
			
}

function DisplayRso($conn,$name){
	$rsoName = RsoExists($conn,$name);
	if($rsoName!== false){
		echo "<p> " .$rsoName['name'] . "</p>";
		return $rsoName;
	}
	else{
		return $rsoName;
	}
	
}


function checkIfMember($conn,$uid,$name){
	$rso = RsoExists($conn,$name);
	$rid = $rso['r_id'];
	
	$sql = "SELECT 1 FROM Rso_members
		WHERE u_id = $uid AND r_id = $rid;";		
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			return true;
		}
		else{
			return false;
		}
	
}

function LeaveRso($conn,$name,$uid){
	$rso = RsoExists($conn,$name);
	$rid = $rso['r_id'];
	$sql = "DELETE FROM Rso_members
	WHERE Rso_members.u_id = $uid AND Rso_members.r_id = $rid;";		
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	UpdateRsoStatus($conn,$rid);
	
}

function JoinRso($conn,$name,$uid){
	$rso = RsoExists($conn,$name);
	$rid = $rso['r_id'];
	if(!checkIfMember($conn,$uid,$name)){
		$sql = "INSERT INTO Rso_members (r_id, u_id)
		VALUES (?,?);";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("location: searchRso.php?error=stmtfailed");
			exit();
		}
		mysqli_stmt_bind_param($stmt,"ss",$rid, $uid);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		UpdateRsoStatus($conn,$rid);
	}
	else{
		header("location: searchRso.php?error=alreadymember");
			exit();
	}
	
}

function UpdateRsoStatus($conn,$rid){
	$sql = "SELECT COUNT(r_id) as total FROM Rso_members 
	WHERE r_id = $rid;";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_assoc($result);
	if($data['total'] > 4){
		$sql = "UPDATE Rsos SET status = 'active' WHERE r_id = $rid;";
		$result = mysqli_query($conn, $sql);
	}
	else{
		$sql = "UPDATE Rsos SET status = 'inactive' WHERE r_id = $rid;";
		$result = mysqli_query($conn, $sql);
	}
}
	
function showFiltered($conn,$filter,$uni){
	$sql = "SELECT DISTINCT name FROM Rsos
		INNER JOIN Rso_members ON Rso_members.r_id = Rsos.r_id
		INNER JOIN Users ON Users.u_id = Rso_members.u_id
		WHERE Users.university = '$uni' AND Rsos.type = '$filter';";	
		$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck > 0){
				while($row = mysqli_fetch_assoc($result)){
					echo  "<h2>Name: \t" .$row["name"] .  "<br> Type: \t"  . $filter . "</h2>";
				}
			}
	
}