<?php
	include_once 'header.html';
?>
	
<div class="welcome-screen">
<h2>Create a new event</h2>
</div>
<div class="form-sheet">
		<form action="event.inc.php" method="POST">
		<?php
			if(isset($_GET["error"])){
				if($_GET["error"]=="emptyinput"){
					echo "<p>Fill in all fields!</p>";
				}
				else if($_GET["error"]=="eventexists"){
					echo "<p>There is already an event with that name!</p>";
				}
				else if($_GET["error"]=="inactiverso"){
					echo "<p>That rso is currently inactive!</p>";
				}
				else if($_GET["error"]=="timetaken"){
					echo "<p>There is already an event at that time!</p>";
				}
				else if($_GET["error"]=="notAdmin"){
					echo "<p>You are not the owner of this RSO!</p>";
				}
			}
			?>
			<input type="text" name="name" placeholder="Event Name">
			<br>
			<textarea style="background-color:#f1f1f1;" name="description" placeholder="Give a description"></textarea>
			<br>
			<label for="date"><h3>Day of Event:<h3></label>
			<input type="date" name="date">
			<br>
			<h2>Choose an Event Category:</h2>
			<br>
			<li style="border: 1px solid black;">
				<h3>Social:</h3> <input type="radio" name="category" value="Social" checked>
				<h3>Fundraising:</h3> <input type="radio" name="category" value="Fundraising">
				<h3>Tech Talk:</h3> <input type="radio" name="category" value="Tech Talk">
			<li>
			<br>
			<h2>Choose an Event Type:</h2>
			<br>
			<li style="border: 1px solid black;">
				<h3>Public:</h3> <input type="radio" name="type" value="public" checked>
				<h3>Private:</h3> <input type="radio" name="type" value="private">
				<h3>RSO:</h3> <input type="radio" name="type" value="rso">
			<li>
			<br>
			<input type="text" name="rsoname" placeholder="Enter RSO">
			<button type="submit" name="submit">Create</button>
			<?php
				if(isset($_GET["error"])){
					if($_GET["error"]=="norso"){
						echo "<p>That rso does not exist!</p>";
					}
				}
				if(isset($_GET["success"])){
					echo "<p>Event created!</p>";
				}
			?>
		</form>
	
	
	<?php
	include_once 'footer.html';
?>