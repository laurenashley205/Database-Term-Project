      
<?php
	include_once 'connect.php';
	include 'methods.inc.php';
	
	$e_id = RandomNum();
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$start_date = mysqli_real_escape_string($conn, $_POST['start']);
	$end_date = mysqli_real_escape_string($conn, $_POST['end']);
	$location = mysqli_real_escape_string($conn, $_POST['location']);
	// $email = get_email();//comes from admin's email 
    $email = mysqli_real_escape_string($conn, $_POST['email']);
	$category = $_POST['category'];
	$type = $_POST['type']; 
	if($type == "RSO"){
		$r_name = $_POST['r_name'];
	}

	if(!empty($r_name)){
		$rsoInfo = RsoExists($conn, $r_name);

		if($rsoInfo === false){
			echo "RSO does not exist!";
			header("location: events.php?error=RsoDNE");
			exit();
		}
	}

	$r_id = $rsoInfo["r_id"];


	$sql = "INSERT INTO events (e_id, name, description, start_date, end_date, location, email, category, type, r_name, r_id)
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
		// mysqli_query($conn, $sql);

	
		$stmt = mysqli_stmt_init($conn);
		// checks if starement failed
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("location: events.php?error=stmtfailed");
			exit();
			// echo "SQL ERROR!";
		} else{
		mysqli_stmt_bind_param($stmt,"sssssssssss", $e_id, $name, $description, $start_date, $end_date, $location, $email, $category, $type, $r_name, $r_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		header("location: events.php?event=created");
			exit();
		}

	header("Location: index.php?event=created");
		
	?>


<!-- //lauren database table 
CREATE TABLE events (
	e_id 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	name		VARCHAR(20)	NOT NULL,
	description	VARCHAR(100) NOT NULL,
	start_date	VARCHAR(20) NOT NULL,
    end_date	VARCHAR(20) NOT NULL,
	location    VARCHAR(20) NOT NULL,
	email       VARCHAR(50) NOT NULL,
	category	VARCHAR(20) NOT NULL,
	type		VARCHAR(20) NOT NULL,
	r_name		VARCHAR(30),
	r_id		INT,
	FOREIGN KEY (r_id) REFERENCES Rsos(r_id)
) -->