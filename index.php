<!-- // changed to profile

<?php
	include_once 'header.html';
	include_once 'methods.inc.php';
?>
	
<div class="welcome-screen">
	<?php
	
	if(isset($_SESSION["pid"])){
		echo "<p>Welcome " .$_SESSION["name"] ."</p>";
	}
	else{
		header("location: signup.php");
		exit();
	}
	?>
	<?php
	if($_SESSION["status"] === "student"){
		echo "<h2>Show student allowed event stream here</h2>";
	}
	if($_SESSION["status"] === "admin"){
		echo "<h2>Show admin allowed event stream here</h2>";
	}
	if($_SESSION["status"] === "superadmin"){
		echo "<h2>Show RSO requests here</h2>";
	}
	?>
</div>
		
						
<?php
	include_once 'footer.html';
?> -->
		

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
<br><br><br>
	<h1 style="color: black; font-family: alata;font-size: 40px;text-align: center;">User Information</h1>
	<?php
		echo "<p>Name: " .$_SESSION["name"] . " "  .$_SESSION["lastName"] ."</p>";
		echo "<p>Email:  " .$_SESSION["email"] ."</p>";
		echo "<p>University:  " .$_SESSION["university"] . "</p>";
		echo "<p>PID:  " .$_SESSION["pid"] ."</p>";
		echo "<p>User Status: "  .$_SESSION["status"] ."</p>";
	?>
	<br><br><br>
</div>
<br><br><br>
<div class = "general-screen">
	<br><br><br>
	<h1 style="color: black; font-family: alata;font-size: 40px;text-align: center;">Joined Groups</h1>
	<?php
		DisplayGroups($conn,$_SESSION["uid"]);
	?>
	<br><br><br>
</div>
<br><br><br>
<div class = "general-screen">
	<br><br><br>
	<h1 style="color: black; font-family: alata;font-size: 40px;text-align: center;">Upcoming Events</h1>
	<br><br><br>
	<h2 style="color: black; font-family: alata;font-size: 30px;text-align: center;">RSO Events</h2>
	<?php
		DisplayRsoEvents($conn, $_SESSION["uid"]);
		//Use display groups as a skeleton for this 
	?>
	<div class = "form-sheet">
		<form action="viewRsoEvent.php">
    		<input type="submit" value="View RSO Events" />
		</form>
	</div>
	<br><br><br>
	<h2 style="color: black; font-family: alata;font-size: 30px;text-align: center;">University Events</h2>
	<?php
		DisplayUniEvents($conn, $_SESSION["uid"]);
		//Use display groups as a skeleton for this 
	?>
	<div class = "form-sheet">
		<form action="viewUniEvent.php">
    		<input type="submit" value="View University Events" />
		</form>
	</div>
	<br><br><br>
	<h2 style="color: black; font-family: alata;font-size: 30px;text-align: center;">All Public Events</h2>
	<?php
		DisplayPublicEvents($conn, $_SESSION["uid"]);
		//Use display groups as a skeleton for this 
	?>
	<div class = "form-sheet">
		<form action="viewPublicEvent.php">
    		<input type="submit" value="View Public Events" />
		</form>
		<br><br><br>
	</div>
	
</div>


<?php
	include_once 'footer.html';
?>
		