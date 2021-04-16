<?php
	include_once 'header.html';
?>
<h1>Sign up</h1>
<div class="form-sheet">
	<form action="signup.inc.php" method="POST">
		<input type="text" name="first" placeholder="First Name">
		<input type="text" name="last" placeholder="Last Name">
		<input type="text" name="email" placeholder="E-mail">
		<br>
		<input type="password" name="password" placeholder="password">
		<br><br>
		<h3 style="color: black; font-family: Alata; padding-top: 10px;">Select school</h3>
		<select name="university">
			<option value="ucf">UCF</option>
			<option value="fau">FAU</option>
			<option value="uf">UF</option>
		</select>
		<h3 style="color: black; font-family: Alata; padding-top: 10px;">Select role</h3>
		<select name="security">
			<option value="student">Student</option>
			<option value="admin">Admin</option>
			<option value="superadmin">Super Admin</option>
		</select>
		<br>
		<button type="submit" name="submit">Sign Up</button>
		<br>
		<h2>Already have an account?</h2>
		<a href="login.php">Log In</a>
	</form>
	<?php
	if(isset($_GET["error"])){
		if($_GET["error"]=="emptyinput"){
			echo "<p>Fill in all fields!</p>";
		}
		else if($_GET["error"]=="invalidemail"){
			echo"<p>Email is not correct!</p>";
		}
		else if($_GET["error"]=="emailtaken"){
			echo"<p>A user with that email already exists!</p>";
		}
		else if($_GET["error"]=="stmtfailed"){
			echo"<p>Something went wrong, try again!</p>";
		}
	}
?>
</div>
	<?php
	include_once 'footer.html';
?>





















<!-- <?php
	include_once 'header.html';
?>
	
<h1>Log in</h1>
<div class="form-sheet">
	<form action="login.inc.php" method="post">
		<input type="text" name="email" placeholder="email">
		<br>
		<input type="password" name="password" placeholder="password">
		<br>
		<button type="submit" name="submit">Log In</button>
		<h3 style="color: black; font-family: Alata; padding: 10px 0 10px 0; margin-left: 125px;">New User?</h3>
		<a style="margin-left:130px; href="signup.php">Sign Up</a>
		<br><br>
	</form>
	<?php
	if(isset($_GET["error"])){
		if($_GET["error"]=="emptyinput"){
			echo "<p>Fill in all fields!</p>";
		}
		else if($_GET["error"]=="emailnotfound"){
			echo"<p>Email is not correct!</p>";
		}
		else if($_GET["error"]=="wrongpassword"){
			echo"<p>Password is not correct!</p>";
		}
		else if($_GET["error"]=="stmtfailed"){
			echo"<p>Something went wrong, try again!</p>";
		}
		else if($_GET["error"]=="loggedout"){
			echo"<p>You have logged out successfully!</p>";
		}
	}
?>
</div> -->
		

	
	
	<?php
	include_once 'footer.html';
?>

<!--
<p>Option 1:</p> <input type="radio" name="gender" value="Male">
			<p>Option 2:</p> <input type="radio" name="gender" value="Female">
			<p>Option 3:</p> <input type="radio" name="gender" value="Other" checked>
			<br><textarea name="message" placeholder="Use this to write description"></textarea>
			-->



















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
					<li><a href="rso.php">Create RSO</a></li>
				</ul>
			</div>
		</nav>
	
		<!-- action will take you to the next page-->
		<form action="createUser.php" method="POST">
			<input type="text" name="first" placeholder="First Name">
			<input type="text" name="last" placeholder="Last Name">
			<input type="text" name="studentID" placeholder="Student ID">
			<input type="text" name="email" placeholder="E-mail">
			<br><input type="password" name="password" placeholder="password">
			<br><select name="university">
				<option value="none">None</option>
				<option value="uni1">UCF</option>
				<option value="uni2">USF</option>
				<option value="uni3">FAU</option>
				</select>
				
			<br><select name="level">
				<option value="super_admin">Super Admin</option>
				<option value="admin">Admin</option>
				<option value="student">Student</option>
				</select>
			<br><button type="submit" name="submit">Signup</button>
		</form>
	
	
	</body>
</html> -->