// was trying to view each event by making it a session but dont think you can?
// now going to try viewing details of all events in a category at once 
// (ex, all rso events, all uni events, all public events)
// can comment on each event there

// this or search event similar to search rso, idk yet ah

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
	<h1 style="color: black; font-family: alata;font-size: 20px;text-align: center;">UNIVERSITY EVENTS</h1>
    <br><br><br>
	<?php
		DisplayUniEventInfo($conn,$_SESSION["uid"]);
	?>

</div>




<?php
	include_once 'footer.html';
?>