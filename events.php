<!-- <!DOCTYPE html>
<html>
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
	
	</body>
</html> -->

<!DOCTYPE html>
<html>
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
<!-- Can only be created by admin or super admin if admin, automatically attach the RSO if selected-->
		
		<form action="createEvent.php" method="POST">
			<input type="text" name="name" placeholder="Event Name">
			<br>
			<textarea name="description" placeholder="Give a description"></textarea>
			<input type="text" name="start" placeholder="start time">
			<input type="text" name="end" placeholder="end time">
			<input type="text" name="location" placeholder="location">
			<input type="text" name="email" placeholder="E-mail">
			<br>
			<p>Choose an Event Category:</p>
			<br>
			<p>Social:</p> <input type="radio" name="category" value="Social" checked>
			<p>Fundraising:</p> <input type="radio" name="category" value="Fundraising">
			<p>Tech Talk:</p> <input type="radio" name="category" value="Tech Talk">
			<br>
			<p>Choose an Event Type:</p>
			<br>
			<p>Public:</p> <input type="radio" name="type" value="Public" checked>
			<p>Private:</p> <input type="radio" name="type" value="Private">
			<p>RSO:</p> <input type="radio" name="type" value="RSO">
			<br>
			<input type="text" name="rsoname" placeholder="Enter RSO">

			<button type="submit" name="submit">Create</button>
		</form>
	
	
	</body>
</html>