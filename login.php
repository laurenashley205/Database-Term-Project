<?php
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
</div>
		

	
	
	<?php
	include_once 'footer.html';
?>

<!--
<p>Option 1:</p> <input type="radio" name="gender" value="Male">
			<p>Option 2:</p> <input type="radio" name="gender" value="Female">
			<p>Option 3:</p> <input type="radio" name="gender" value="Other" checked>
			<br><textarea name="message" placeholder="Use this to write description"></textarea>
			-->