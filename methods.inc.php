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
		header("location: profile.php");
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

function EventExists($conn,$name){	//possibly add a check to see if the school is the same as well
	$sql = "SELECT * FROM Events WHERE name = ?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location: events.php?error=stmtfailed");
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

function DisplayEvents($conn,$uid){
	
	$sql = "SELECT name FROM Events 
		INNER JOIN Event_members ON Event_members.e_id = Events.e_id
		INNER JOIN Users ON Users.u_id = Event_members.u_id
		WHERE Users.u_id = $uid;";		
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo "<p> " .$row['name'] . "</p>";
			}
		}
}

function DisplayRsoEvents($conn,$uid){	
	$sql = "SELECT E.name 
	FROM events E, Users U, Rso_members M, Rsos R
	WHERE $uid = U.u_id
	AND U.u_id = M.u_id
	AND M.r_id = R.r_id
	AND E.r_id = R.r_id;";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo "<p> " .$row['name'] . "</p>";
			}
		}
}

function DisplayRsoEventInfo($conn,$uid){	
	$sql = "SELECT E.* 
	FROM events E, Users U, Rso_members M, Rsos R
	WHERE $uid = U.u_id
	AND U.u_id = M.u_id
	AND M.r_id = R.r_id
	AND E.r_id = R.r_id;";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				// <h1 style="color: black; font-family: alata;font-size: 20px;text-align: center;">RSO EVENTS</h1>
				// echo "<div class = "general-screen"";
				echo "<p>NAME: " .$row['name'] . "</p>";
				echo "<br>";
				echo "<p>Description:  " .$row['description'] ."</p>";
				echo "<p>Start:  " .$row['start_date'] . "</p>";
				echo "<p>End:  " .$row['end_date'] ."</p>";
				echo "<p>Location: "  .$row['location'] ."</p>";
				echo "<p>Contact: "  .$row['email'] ."</p>";
				echo "<p>Category: "  .$row['category'] ."</p>";
				echo "<p>Event type: "  .$row['type'] ."</p>";
				// echo "</div>";
				echo "<p align=center> _________________________________________________________________ </p>";
				echo "<br><br><br><br><br>";
			}
		}
}

function DisplayUniEventInfo($conn,$uid){	
	$sql = "SELECT E.name 
	FROM events E, Users U 
	WHERE $uid = U.u_id
	AND U.university = E.location;";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				// <h1 style="color: black; font-family: alata;font-size: 20px;text-align: center;">RSO EVENTS</h1>
				// echo "<div class = "general-screen"";
				echo "<p>NAME: " .$row['name'] . "</p>";
				echo "<br>";
				echo "<p>Description:  " .$row['description'] ."</p>";
				echo "<p>Start:  " .$row['start_date'] . "</p>";
				echo "<p>End:  " .$row['end_date'] ."</p>";
				echo "<p>Location: "  .$row['location'] ."</p>";
				echo "<p>Contact: "  .$row['email'] ."</p>";
				echo "<p>Category: "  .$row['category'] ."</p>";
				echo "<p>Event type: "  .$row['type'] ."</p>";
				// echo "</div>";
				echo "<p align=center> _________________________________________________________________ </p>";
				echo "<br><br><br><br><br>";

				// comment();
			}
		}
}

function DisplayPublicEventInfo($conn,$uid){	
	$sql = "SELECT E.name 
	FROM events E, Users U 
	WHERE $uid = U.u_id
	AND E.type = 'Public'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				// <h1 style="color: black; font-family: alata;font-size: 20px;text-align: center;">RSO EVENTS</h1>
				// echo "<div class = "general-screen"";
				echo "<p>NAME: " .$row['name'] . "</p>";
				echo "<br>";
				echo "<p>Description:  " .$row['description'] ."</p>";
				echo "<p>Start:  " .$row['start_date'] . "</p>";
				echo "<p>End:  " .$row['end_date'] ."</p>";
				echo "<p>Location: "  .$row['location'] ."</p>";
				echo "<p>Contact: "  .$row['email'] ."</p>";
				echo "<p>Category: "  .$row['category'] ."</p>";
				echo "<p>Event type: "  .$row['type'] ."</p>";
				// echo "</div>";
				echo "<p align=center> _________________________________________________________________ </p>";
				echo "<br><br><br><br><br>";

				// // echo "<textarea style=color:black name=comment rows=10 cols=10 placeholder=Comment on event.></textarea>";
				// $comment = readline('Comment here!');
				// echo $comment;

				// // comment($conn);
			}
		}
}

// function comment($conn){
// 	// echo "<textarea style=color:black name=comment rows=10 cols=10 placeholder=Comment on event.></textarea>";
// 	// CREATE table Comments ( 		
// 	// 	c_id 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
// 	// 	comment TEXT,
// 	// 	e_id	INT,
// 	// 	FOREIGN KEY (e_id) REFERENCES events(e_id)
// 	// );
// 	$sql = "INSERT INTO Comments (c_id, comment, u_id, e_id)
// 	VALUES (?,?,?,?);";
// 	$stmt = mysqli_stmt_init($conn);
// 	if(!mysqli_stmt_prepare($stmt,$sql)){
// 		header("location: profile.php?error=stmtfailed");
// 		exit();
// 	}
// 	mysqli_stmt_bind_param($stmt,"ssss",$c_id, $comment, $u_id, $e_id);
// 	mysqli_stmt_execute($stmt);
// 	mysqli_stmt_close($stmt);
// }

function setComments($conn){
	if(isset($_POST["submit-comment"])){
		$comment = $_POST['comment'];
		$u_id = $_POST['u_id'];
		$e_id = $_POST['e_id'];

		$comment = mysqli_real_escape_string($conn, $_POST['comment']);
		$u_id = mysqli_real_escape_string($conn, $_POST['u_id']);
		$e_id = mysqli_real_escape_string($conn, $_POST['e_id']);
			
		$sql = "INSERT INTO Comments (comment, u_id, e_id) VALUES (?,?,?);";


		$stmt = mysqli_stmt_init($conn);

   		if(!mysqli_stmt_prepare($stmt,$sql)){
	   		header("location: viewEvent.php?error=stmtfailed");
	   		exit();
	   		// echo "SQL ERROR!";
   		} else{
	  		mysqli_stmt_bind_param($stmt,"sss", $comment, $u_id, $e_id);
            //   mysqli_stmt_bind_param($stmt,"ss", $comment);

	   		mysqli_stmt_execute($stmt);
	   		mysqli_stmt_close($stmt);
	   		header("location: profile.php?comment=posted");

	   		exit();
   		}

    }
}

function getComments($conn){
	$sql = "SELECT * FROM comments";

	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		while($row = mysqli_fetch_assoc($result)){
			// echo "<div class='general-screen'>";
			echo "<p>USER: " .$row['u_id'] . "</p>";
			echo "<p>COMMENT: " .$row['comment'] . "</p>";
			echo "<br>";
			
			// echo "</div>";
			// echo "<br><br><br>";
			echo"<p>
				<form method='POST' action='editComments.inc.php'>
					<input type='hidden' name='id' value='".$row['c_id']."'>
					<input type='hidden' name='comment' value='".$row['comment']."'>
					<input type='hidden' name='u_id' value='".$row['u_id']."'>
					<input type='hidden' name='e_id' value='".$row['e_id']."'>

					<button>Edit</button>
				</form>
				</p>";

				echo "<p align=center> _________________________________________________________________ </p>";
				echo "<br><br><br>";
		}
	}
	
}

function editComments($conn){
	if(isset($_POST["submit-comment"])){
		$c_id = $_POST['c_id'];
		$comment = $_POST['comment'];
		$u_id = $_POST['u_id'];
		$e_id = $_POST['e_id'];

		$comment = mysqli_real_escape_string($conn, $_POST['comment']);
		$u_id = mysqli_real_escape_string($conn, $_POST['u_id']);
		$e_id = mysqli_real_escape_string($conn, $_POST['e_id']);
			
		$sql = "UPDATE Comments SET comment='$comment' WHERE c_id='$c_id';";

		$result = $conn ->query($sql);
		header("Location: profile.php?comment=updated");

    }
}

function DisplayUniEvents($conn,$uid){		
	$sql = "SELECT E.name 
	FROM events E, Users U 
	WHERE $uid = U.u_id
	AND U.university = E.location;";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo "<p> " .$row['name'] . "</p>";
			}
		}
}

function DisplayPublicEvents($conn,$uid){	
	$sql = "SELECT E.name 
	FROM events E, Users U 
	WHERE $uid = U.u_id
	AND E.type = 'Public'";
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

function CreateEvent($conn,$name,$description,$date,$category,$type,$uid){
	if($type === "public" || $type === "private"){
		$approved = "unapproved";
	}
	else{
		$approved = "approved";
	}
	
	$sql = "INSERT INTO Events (name,description,date,category,type,approved,u_id)
	VALUES (?,?,?,?,?,?,?);";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location: events.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"sssssss",$name,$description,$date,$category,$type,$approved,$uid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

function UpdateMemberEvent($conn,$email,$e_id){
	$emailExists = EmailExists($conn,$email);
	$u_id = $emailExists["u_id"];
	$sql = "INSERT INTO Event_members (e_id, u_id)
	VALUES (?,?);";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)){
		header("location: createRso.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"ss",$e_id, $u_id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
}

function RsoStatus($conn,$name){
	$rso = RsoExists($conn,$name);
	$status = $rso['status'];
	if($status==='inactive'){
		$status = false;
		
	}
	else{
		$status = true;
	}
	return $status;
}

function CreateHost($conn,$name,$rsotype){	//Can only happen if the rso is active 
	//rsotype is rso name
	//name is event name 
	$event = EventExists($conn,$name);
	$rso = RsoExists($conn,$rsotype);
	$rid = $rso['r_id'];
	$eid = $event['e_id'];
	$sql = "INSERT INTO hosts (r_id, e_id)
		VALUES (?,?);";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("location: searchRso.php?error=stmtfailed");
			exit();
		}
		mysqli_stmt_bind_param($stmt,"ss",$rid, $eid);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	
}

// function showAvailableEvents($conn,$uni){
// 	$sql = "SELECT DISTINCT name, category FROM Events
// 		INNER JOIN Event_members ON Event_members.e_id = Events.e_id
// 		INNER JOIN Users ON Users.u_id = Event_members.u_id
// 		WHERE Users.university = '$uni';";	
// 	$result = mysqli_query($conn, $sql);
// 	$resultCheck = mysqli_num_rows($result);
// 	if($resultCheck > 0){
// 		while($row = mysqli_fetch_assoc($result)){
// 			echo  "<h2>Name: \t" .$row["name"] .  "<br> Type: \t"  . $row["category"] . "</h2>";
// 			$name = $row["name"];
// 			echo  "<a href='searchEvent.php?more=$name'><h2 style='margin-top: 0px;'> See Event </h2></a>";
// 		}
// 	}	
// }

function showAvailableEvents($conn,$uni){
	$sql = "SELECT DISTINCT E.name
	FROM Users U, Event_members M, events E
		WHERE $uni =  U.university
		AND U.u_id = M.u_id
		AND M.e_id = E.e_id;";	
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo  "<h2>Name: \t" .$row["name"] .  "<br> Type: \t"  . $row["category"] . "</h2>";
			$name = $row["name"];
			echo  "<a href='searchEvent.php?more=$name'><h2 style='margin-top: 0px;'> See Event </h2></a>";
		}
	}	
}

function showSingleEvent($conn,$event){
	$row = EventExists($conn,$event);
	echo  "<h2>Name: \t" .$row["name"] .  "<br> Type: \t"  . $row["category"] . 
					" <br> Description: \t" .$row["description"] .  "<br> Date: \t"  . $row["date"] ."</h2>";
	//Post all of the comments that belong to that event here
	
}

function GetEid($conn,$name){
	$eid = EventExists($conn,$name);
	$idnum = $eid["e_id"];
	return $idnum;
}

function EventStatus($conn,$name){
	$event = EventExists($conn,$name);
	$status = $event['approved'];
	if($status==='unapproved'){
		$status = false;
		
	}
	else{
		$status = true;
	}
	return $status;
}

function DisplayEvent($conn,$name){
	$eventName = EventExists($conn,$name);
	if($rsoName!== false){
		echo "<p> " .$eventName['name'] . "</p>";
		return $eventName;
	}
	else{
		return $eventName;
	}
}

function showFilteredEvents($conn,$filter,$uni){
	$sql = "SELECT DISTINCT name FROM Events
		INNER JOIN Event_members ON Event_members.e_id = Events.e_id
		INNER JOIN Users ON Users.u_id = Event_members.u_id
		WHERE Users.university = '$uni' AND Events.category = '$filter';";	
		$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck > 0){
				while($row = mysqli_fetch_assoc($result)){
					echo  "<h2>Name: \t" .$row["name"] .  "<br> Type: \t"  . $filter . "</h2>";
				}
			}
}

function checkIfMemberEvent($conn,$uid,$name){
	$event = EventExists($conn,$name);
	$eid = $event['e_id'];
	
	$sql = "SELECT 1 FROM Event_members
		WHERE u_id = $uid AND e_id = $eid;";		
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			return true;
		}
		else{
			return false;
		}
}

function LeaveEvent($conn,$name,$uid){
	$event = EventExists($conn,$name);
	$eid = $event['e_id'];
	$sql = "DELETE FROM Event_members
	WHERE Event_members.u_id = $uid AND Event_members.e_id = $eid;";		
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
}

function JoinEvent($conn,$name,$uid){
	$event = EventExists($conn,$name);
	$eid = $event['e_id'];
	if(!checkIfMemberEvent($conn,$uid,$name)){
		$sql = "INSERT INTO Event_members (e_id, u_id)
		VALUES (?,?);";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("location: searchEvent.php?error=stmtfailed");
			exit();
		}
		mysqli_stmt_bind_param($stmt,"ss",$eid, $uid);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	else{
		header("location: searchEvent.php?error=alreadymember");
			exit();
	}
}
