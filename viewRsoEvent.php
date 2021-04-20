

<?php
	include_once 'header.html';
	include_once 'connect.inc.php';
	include 'methods.inc.php';
	if(!isset($_SESSION["uid"])){
		header("location: profile.php");
		exit();
	}
?>

<div class="general-screen">
	<br><br><br>
	<h1 style="color: black; font-family: alata;font-size: 20px;text-align: center;">RSO EVENTS</h1>
    <br><br><br>
	<?php
		DisplayRsoEventInfo($conn,$_SESSION["uid"]);
	?>
	<textarea style="color:black; text-align: center;" name="comment" rows="10" cols="10" placeholder="Comment on an event."></textarea>


</div>




<?php
	include_once 'footer.html';
?>