<?php
	include_once 'header.html';
	if(!isset($_SESSION["pid"])){
		header("location: signup.php");
		exit();
	}
?>

<div class="welcome-screen">
<h2>Create a new university</h2>
</div>
<div class="form-sheet">
	<form action="createUniversity.inc.php" method="GET">
		<input type="text" name="name" placeholder="University Name">
		<input type="text" name="numStudents" placeholder="Number of Students">
		<br>
			<textarea style="background-color:#f1f1f1;" name="description" placeholder="Give a description"></textarea>
		<br>
		<input type="text" name="location" placeholder="Location">
		<button type="submit" name="submit">Create University</button>
		<?php
	if(isset($_GET["error"])){
		if($_GET["error"]=="emptyinput"){
			echo "<p>Fill in all fields!</p>";
		}
		else if($_GET["error"]=="unitaken"){
			echo"<p>This university already exists!</p>";
		}
		else if($_GET["error"]=="stmtfailed"){
			echo"<p>Something went wrong, try again!</p>";
		}	
	}
	else if(isset($_GET["success"])){
		echo"<p>University was created!</p>";
	}
?>
</div>



<?php
	include_once 'footer.html';
?>