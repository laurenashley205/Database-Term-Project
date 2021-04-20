<?php
	include_once 'header.html';
	include_once 'methods.inc.php';
	
	if(isset($_GET["event"])){
		$name = $_GET['event'];
	}
	
?>

<div class="welcome-screen">
	<h2>Comment on Event</h2>
</div>

<div class="form-sheet">
	<form action="commentEvent.inc.php" method="POST">
		<input style="background-color: white; width:97%; margin-left: -70px; margin-top:20px;border: none;" type="text" name="event" value = "<?php echo $name?>">
		<textarea style="background-color: #f1f1f1; width:100%; margin-left: -70px; margin-top:20px; border:1px solid black;" type="text" name="comment" placeholder="Comment on the Event"></textarea>
		<br><br>
		<h3 style="color: black; font-family: Alata; padding-top: 10px;">Give a Rating</h3>
		<select name="rating">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
		<button style="background-color: #f1f1f1; margin-left: 90px; margin-bottom: 20px; background-color: white;" type="submit" name="submit" value="comment">Comment</button>
	</form>
<div>