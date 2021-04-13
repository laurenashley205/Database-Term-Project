<?php
	include_once 'header.html';
	if(!isset($_SESSION["pid"])){
		header("location: signup.php");
		exit();
	}
?>
<h1>Create a new RSO</h1>
<div class="form-sheet">
	<form action="createRso.inc.php" method="POST">
		<input type="text" name="name" placeholder="RSO Name">
		<br><br>
		<h3 style="color: black; font-family: Alata; padding-top: 10px;">RSO type</h3>
		<select name="university">
			<option value="organization">Organization</option>
			<option value="club">Club</option>
			<option value="fraternity">Fraternity</option>
		</select>
		<br><br>
		<h3 style="color: black; font-family: Alata; font-size: 18px; padding-top: 10px;"> All members must have an account</h3>
		<input type="text" name="member1" placeholder="Enter email of first member">
		<input type="text" name="member2" placeholder="Enter email of second member">
		<input type="text" name="member3" placeholder="Enter email of third member">
		<input type="text" name="member4" placeholder="Enter email of fourth member">
		<br>
		<button type="submit" name="submit">Create RSO</button>
		<?php
	if(isset($_GET["error"])){
		if($_GET["error"]=="emptyinput"){
			echo "<p>Fill in all fields!</p>";
		}
		else if($_GET["error"]=="rsotaken"){
			echo"<p>This RSO already exists!</p>";
		}
		else if($_GET["error"]=="nouser"){
			echo"<p>no users with that email exist!</p>";
		}
		else if($_GET["error"]=="stmtfailed"){
			echo"<p>At the end Something went wrong, try again!</p>";
		}	
	}
	else if(isset($_GET["signup"])){
		echo"<p>RSO was created!</p>";
	}
?>
</div>



<?php
	include_once 'footer.html';
?>