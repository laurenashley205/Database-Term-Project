<?php
	include_once 'header.html';
	include_once 'connect.inc.php';
	include 'methods.inc.php';
	if(!isset($_SESSION["pid"])){
		header("location: signup.php");
		exit();
	}
?>
<div class="general-screen">
	<?php
		echo "<p>Name: " .$_SESSION["name"] . " "  .$_SESSION["lastName"] ."</p>";
		echo "<p>Email:  " .$_SESSION["email"] ."</p>";
		echo "<p>University:  " .$_SESSION["university"] . "</p>";
		echo "<p>PID:  " .$_SESSION["pid"] ."</p>";
		echo "<p>User Status: "  .$_SESSION["status"] ."</p>";
	?>
	
	<h1 style="color: black; font-family: alata;font-size: 40px;text-align: center;">Joined Groups</h1>
	<?php
		DisplayGroups($conn,$_SESSION["uid"]);
	?>
	<h1 style="color: black; font-family: alata;font-size: 40px;text-align: center;">Upcoming Events</h1>
	<?php
		//DisplayEvents($conn,);
		//Use display groups as a skeleton for this 
	?>
		
</div>


<?php
	include_once 'footer.html';
?>
		