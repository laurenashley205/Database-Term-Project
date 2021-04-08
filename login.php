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
				</ul>
			</div>
		</nav>
		<!-- action will take you to the next page-->
		<form action="index.php" method="post">
			<input type="text" name="S.usermame" placeholder="Username">
			<br><input type="password" name="S.pwd" placeholder="password">
			<br><button type="submit" name="submit">Login</button>
		</form>
		
<?php

?>
	
	
	</body>
</html>

<!--
<p>Option 1:</p> <input type="radio" name="gender" value="Male">
			<p>Option 2:</p> <input type="radio" name="gender" value="Female">
			<p>Option 3:</p> <input type="radio" name="gender" value="Other" checked>
			<br><textarea name="message" placeholder="Use this to write description"></textarea>
			-->