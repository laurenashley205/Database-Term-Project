<?php
	include_once 'header.html';
	include_once 'connect.inc.php';
	include 'methods.inc.php';
	// if(!isset($_POST["Find-an-Event"])){
	// 	header("location: profile.php");
	// 	exit();
	// }
?>

<div class="general-screen">
	<br><br><br>
	<h1 style="color: black; font-family: alata;font-size: 20px;text-align: center;">Find an Event</h1>
    <br><br><br>
    <?php
        if(isset($_POST["search-btn"])){
            //variable with info sent in search form
            $search = mysqli_real_escape_string($conn, $_POST['search-input']);
            $sql = "SELECT name FROM events WHERE name LIKE '%$search%'";
            // $sql = "SELECT E.name 
            // FROM events E, Users U, Rso_members M, Rsos R
            // WHERE $uid = U.u_id
	        //     AND U.u_id = M.u_id
	        //     AND M.r_id = R.r_id
	        //     AND E.r_id = R.r_id
            // OR $uid = U.u_id
	        //     AND U.university = E.location
            // OR $uid = U.u_id
	        //     AND E.type = 'Public';"
            $result = mysqli_query($conn, $sql);
            $queryResult = mysqli_num_rows($result);

            if($queryResult > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<a href='viewEvent.php?name=".$row['name']."'> <p>Event: " .$row['name'] . "</p><br></a>";
                }
            } else {
                echo "<p>No events match your search</p>";
            }
        }
    
    ?>

</div>




<?php
	include_once 'footer.html';
?>


