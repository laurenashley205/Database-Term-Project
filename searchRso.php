<?php
	include_once 'header.html';
	include_once 'methods.inc.php';
	include_once 'connect.inc.php';

	if(!empty($_GET["rso"])){
		$name = $_GET["rso"];
		$rsoInfo = RsoExists($conn,$name);
	}
?>
<div class="welcome-screen">
<h2>Search for RSO</h2>
</div>
<div class="form-sheet">
	<form action="searchRso.inc.php" method="GET">
		<input style="background-color: #f1f1f1; width:100%; margin-left: -70px; margin-top:20px; border:1px solid black;" type="text" name="rso" placeholder="RSO Name">
		<button style="background-color: #f1f1f1; margin-left: 30px; margin-bottom: 20px; background-color: white;" type="submit" name="submit" value="join">Join</button>
		<button style="background-color: #f1f1f1;margin-left: 10px; background-color: white;" type="submit" name="submit" value="leave">Leave</button>
		<?php
			if(isset($_GET["error"])){
				if($_GET["error"]=="emptyinput"){
					echo "<p>Fill in all fields!</p>";
				}
				else if($_GET["error"]=="norso"){
					echo "<p>Filter returned no results!</p>";
				}
				else if($_GET["error"]=="alreadymember"){
					echo "<p>You are already part of that Rso!</p>";
				}
			}
		?>
		<legend style="color:black; font-family: Acme; margin-top:20px; margin-right:-250px">Filter by Type</legend>
		<button style="background-color: red;margin-top:-25px;margin-bottom:20px;" type="submit" name="submit" value="reset">Reset</button>
		<li style="background: white; border: 1px solid black;margin-right: 70px;">
			<input type="checkbox" name="rsotype[]" value="organization"><p style="color:black; font-family: Acme;">Organization</p><br>      
			<input type="checkbox" name="rsotype[]" value="fraternity"><p style="color:black; font-family: Acme;">Fraternity</p><br>      
			<input type="checkbox" name="rsotype[]" value="club"><p style="color:black; font-family: Acme;">Club</p><br>    
			<button style="margin-bottom: 20px;" type="submit" name="submit" value="filter">Filter</button>
			<?php
			if(isset($_GET["left"])){
				echo "<p>Left Rso!</p>";
			}
			if(isset($_GET["joined"])){
				echo "<p>Joined Rso!</p>";
			}
		?>
		</li>
	</form>
</div>


<?php

	if(!empty($_GET["rso"])){
		
		echo "<h1>RSO Found</h1>";
		echo "<h2>Name: \t" .$rsoInfo["name"] .  "<br> Type: \t"  . $rsoInfo["type"] . "<br> Status: \t"  . $rsoInfo["status"] ."</h2>";	
	}
	if(!empty($_GET["filters"])){
		
		echo "<h1>filtered Results</h1>";
		if(!empty($_GET["filters1"])){	//we have two filters 
			showFiltered($conn,$_GET["filters"],$_SESSION["university"]);
			showFiltered($conn,$_GET["filters1"],$_SESSION["university"]);
		}
		else{
			showFiltered($conn,$_GET["filters"],$_SESSION["university"]);
		}	
	}

?>

<div class="list-screen">
<?php
	if(empty($_GET["rso"]) && empty($_GET["filters"])){
	
		echo "<h1>All RSO's</h1>";
		showAvailableRso($conn,$_SESSION['university']);
	}
?>
</div>
<?php
	include_once 'footer.html';
?>