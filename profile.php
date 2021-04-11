<?php
	include_once 'header.html';
	if(!isset($_SESSION["pid"])){
		header("location: signup.php");
		exit();
	}
?>
	<div class="general-screen">
		<?php
			echo "<p>Name:  " .$_SESSION["name"] . " "  .$_SESSION["lastName"] ."</p>";
			echo "<p>Email:  " .$_SESSION["email"] ."</p>";
			echo "<p>PID:  " .$_SESSION["pid"] ."</p>";
			echo "<p>User Status: "  .$_SESSION["status"] ."</p>";
	
	?>
		
	</div>


<?php
	include_once 'footer.html';
?>
		