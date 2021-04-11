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
?>
		