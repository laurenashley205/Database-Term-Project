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