<?php
	include_once 'connect.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css">
		<title>Main Page</title>
	</head>
	<body>
	
		<nav>
			<div class="wrapper">
				
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="contact.php">Contact</a></li>
					<li><a href="events.php">Find Events </a></li>
					<li><a href="signup.php">Signup</a></li>
					<li><a href="login.php">Log in</a></li>
				</ul>
			</div>
		</nav>
		
		<div class="wrapper">
			<h1>Log in to access</h1>
			<p>Temporary words to placehold</p>
		</div>
			
	<?php
		$sql = "SELECT * FROM Users WHERE fname = 'test';";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			while($row = mysqli_fetch_assoc($result)){
				echo $row['fname'];
			}
		}
	?>


			
	</body>
</html>