<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>	</title>
		<link rel="stylesheet" href="style.css">
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
					<li><a href="rso.php">Create RSO</a></li>
				</ul>
			</div>
		</nav>


		<!-- action will take you to the next page-->
		<form action="index.php" method="post">
			<input type="text" name="name" placeholder="Event Name">
			<br><input type="text" name="admin" placeholder="Admin ID">
            <br><input type="text" name="description" placeholder="description">
			<br><input type="text" name="member1" placeholder="member1">
			<br><input type="text" name="member2" placeholder="member2">
			<br><input type="text" name="member3" placeholder="member3">
			<br><input type="text" name="member4" placeholder="member4">
			<br><input type="text" name="member5" placeholder="member5">
            <br><input type="text" name="emailDomain" placeholder="Email Domain">
			<br><button type="submit" name="submit">Submit</button>
		</form>

	</body>
</html>