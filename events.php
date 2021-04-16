<?php
	include_once 'header.html';
?>
	
<!-- Can only be created by admin or super admin if admin, automatically attach the RSO if selected-->
	<!-- <div class="createEvent"> -->
		<form action="createEvent.php" method="POST">
			<input type="text" name="name" placeholder="Event Name">
			<br>
			<textarea style="color:black" name="desctiption" rows="10" cols="10" placeholder="Enter event details here."></textarea>
			<input type="text" name="start" placeholder="start time">
			<input type="text" name="end" placeholder="end time">
			<input type="text" name="location" placeholder="location">
			<input type="text" name="email" placeholder="E-mail">
			<br>
			<p>Choose an Event Category:</p>
			<br>
			<p>Social:</p> <input type="radio" name="category" value="Social" checked>
			<p>Fundraising:</p> <input type="radio" name="category" value="Fundraising">
			<p>Tech Talk:</p> <input type="radio" name="category" value="Tech Talk">
			<br>
			<p>Choose an Event Type:</p>
			<br>
			<p>Public:</p> <input type="radio" name="type" value="Public" checked>
			<p>Private:</p> <input type="radio" name="type" value="Private">
			<p>RSO:</p> <input type="radio" name="type" value="RSO">
			<br>
			<input type="text" name="r_name" placeholder="Enter RSO">
			<button type="submit" name="submit">Create</button>
		</form>
	<!-- </div> -->
	
	<?php
	include_once 'footer.html';
?>