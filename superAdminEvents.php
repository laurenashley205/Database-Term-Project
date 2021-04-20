<?php
	include_once 'header.html';
	include_once 'methods.inc.php';
?>

<div class="form-sheet">
<form action="superAdminEvents.inc.php" method="GET">
		<input style="background-color: #f1f1f1; width:100%; margin-left: -70px; margin-top:20px; border:1px solid black;" type="text" name="event" placeholder="Event Name">
		<button style="background-color: #08db0f; margin-left: 30px; margin-bottom: 20px; background-color: white;" type="submit" name="submit" value="approve">Approve</button>
		<button style="background-color: #e12120;margin-left: 10px; background-color: white;" type="submit" name="submit" value="reject">Reject</button>
</form>
</div>
<div class="welcome-screen">
	<h2>Event Requests</h2>
</div>
<?php
showAvailableEventsAdmin($conn,$_SESSION['university']);
if(!empty($_GET["more"])){
	$eventName = $_GET["more"];
	echo "<h1>Info about: \t" .$eventName . "</h1>";
	showSingleEvent($conn,$eventName);
}

