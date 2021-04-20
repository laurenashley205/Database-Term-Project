<?php
	include_once 'header.html';
?>

<div class="welcome-screen">
<h2>New Event</h2>
</div>
<!-- <div class="new-event-screen"> -->
		<form action="createEvent.php" method="POST">
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
			}
			?>
			<br><br><br>
			<input type="text" name="name" placeholder="Event Name">
			<br><br><br>
			<textarea style="color:black" name="description" rows="10" cols="10" placeholder="Enter event details here."></textarea>
			<br><br><br>
			<!-- <input type="text" name="description" placeholder="Event description."> -->
			<input type="text" name="start" placeholder="start time">
			<br>
			<input type="text" name="end" placeholder="end time">
			<br><br><br>
			<!-- <input type="text" name="location" placeholder="location"> -->
			<p>Choose a Location:</p>
			<br>
			<p>UCF</p> <input type="radio" name="location" value="UCF" checked>
			<p>FAU</p> <input type="radio" name="location" value="FAU">
			<p>UF</p> <input type="radio" name="location" value="UF">
			<br><br><br>
			<input type="text" name="email" placeholder="E-mail">
			<br><br><br>
			<p>Choose an Event Category:</p>
			<br>
			<p>Social:</p> <input type="radio" name="category" value="Social" checked>
			<p>Fundraising:</p> <input type="radio" name="category" value="Fundraising">
			<p>Tech Talk:</p> <input type="radio" name="category" value="Tech Talk">
			<br><br><br>
			<p>Choose an Event Type:</p>
			<br>
			<p>Public:</p> <input type="radio" name="type" value="Public" checked>
			<p>Private:</p> <input type="radio" name="type" value="Private">
			<p>RSO:</p> <input type="radio" name="type" value="RSO">
			<br>
			<input type="text" name="r_name" placeholder="Enter RSO">

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
			<br><br><br>
			<button type="submit" name="submit">Create</button>
		</form>
<!-- </div> -->
	
<?php
	include_once 'footer.html';
?> 






















<!-- <?php
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
?> -->