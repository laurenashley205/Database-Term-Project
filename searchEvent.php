<?php
	include_once 'header.html';
	include_once 'methods.inc.php';
	
	if($_SESSION["status"] === "superadmin"){
		header("location: superAdminEvents.php");
			exit();
	}	

	if(!empty($_GET["event"])){
		$name = $_GET["event"];
		$eventInfo = EventExists($conn,$name);
	}
?>

<div class="welcome-screen">
	<h2>Search for Event</h2>
</div>

<div class="form-sheet">
	<form action="searchEvent.inc.php" method="GET">
		<input style="background-color: #f1f1f1; width:100%; margin-left: -70px; margin-top:20px; border:1px solid black;" type="text" name="event" placeholder="Event Name">
		<button style="background-color: #f1f1f1; margin-left: 30px; margin-bottom: 20px; background-color: white;" type="submit" name="submit" value="join">Join</button>
		<button style="background-color: #f1f1f1;margin-left: 10px; background-color: white;" type="submit" name="submit" value="leave">Leave</button>
		<?php
			if(isset($_GET["error"])){
				if($_GET["error"]=="emptyinput"){
					echo "<p>Fill in all fields!</p>";
				}
				else if($_GET["error"]=="noevent"){
					echo "<p>Filter returned no results!</p>";
				}
				else if($_GET["error"]=="alreadymember"){
					echo "<p>You are already part of that Event!</p>";
				}
			}
		?>
		<legend style="color:black; font-family: Acme; margin-top:20px; margin-right:-250px">Filter by Type</legend>
		<button style="background-color: red;margin-top:-25px;margin-bottom:20px;" type="submit" name="submit" value="reset">Reset</button>
		<li style="background: white; border: 1px solid black;margin-right: 70px;">
			<input type="checkbox" name="eventtype[]" value="organization"><p style="color:black; font-family: Acme;">Social</p><br>      
			<input type="checkbox" name="eventtype[]" value="fraternity"><p style="color:black; font-family: Acme;">Fundraising</p><br>      
			<input type="checkbox" name="eventtype[]" value="club"><p style="color:black; font-family: Acme;">Tech Talk</p><br>    
			<button style="margin-bottom: 20px;" type="submit" name="submit" value="filter">Filter</button>
			<?php
			if(isset($_GET["left"])){
				echo "<p>Left Event!</p>";
			}
			if(isset($_GET["joined"])){
				echo "<p>Joined Event!</p>";
			}
		?>
		</li>
	</form>
</div>


<?php

	if(!empty($_GET["event"])){
		
		echo "<h1>Event Found</h1>";
		if($eventInfo["type"] === "public" || $eventInfo["type"] === "private"){
			echo "<h2>Name: \t" .$eventInfo["name"] .  "<br> Type: \t"  . $eventInfo["type"] . "<br> Category: \t"  . $eventInfo["category"] ."</h2>";	
		}
		else{
			echo "<h2>Name: \t" .$eventInfo["name"] .  "<br> RSO: \t"  . $eventInfo["type"] . "<br> Category: \t"  . $eventInfo["category"] ."</h2>";	
		}
		
	}
	if(!empty($_GET["filters"])){
		
		echo "<h1>filtered Results</h1>";
		if(!empty($_GET["filters1"])){	//we have two filters 
			showFilteredEvents($conn,$_GET["filters"],$_SESSION["university"]);
			showFilteredEvents($conn,$_GET["filters1"],$_SESSION["university"]);
		}
		else{
			showFilteredEvents($conn,$_GET["filters"],$_SESSION["university"]);
		}
	
		
	}

?>

<div class="list-screen">
<?php
	// if(empty($_GET["event"]) && empty($_GET["filters"]) && empty($_GET["more"])){
	
	// 	echo "<h1>All Events</h1>";
	// 	showAvailableEvents($conn,$_SESSION["university"]);
	// }
	 if(empty($_GET["event"]) && empty($_GET["filters"]) && !empty($_GET["more"])){
		$eventName = $_GET["more"];
		echo "<h1>Info about: \t" .$eventName . "</h1>";
		showSingleEvent($conn,$eventName);
	}
?>
</div>

		
						
<?php
	include_once 'footer.html';
?>