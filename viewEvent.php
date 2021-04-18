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
	<h1 style="color: black; font-family: alata;font-size: 20px;text-align: center;">View Event</h1>
    <br><br><br>

    <!-- <form action="postComment.inc.php" method="POST"> -->

    <?php
        $name = mysqli_real_escape_string($conn, $_GET['name']);

        $sql = "SELECT * 
        FROM events E
        WHERE name='$name'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                    // <h1 style="color: black; font-family: alata;font-size: 20px;text-align: center;">RSO EVENTS</h1>
                    // echo "<div class = "general-screen"";
                    echo "<p>NAME: " .$row['name'] . "</p>";
                    echo "<br>";
                    echo "<p>Description:  " .$row['description'] ."</p>";
                    echo "<p>Start:  " .$row['start_date'] . "</p>";
                    echo "<p>End:  " .$row['end_date'] ."</p>";
                    echo "<p>Location: "  .$row['location'] ."</p>";
                    echo "<p>Contact: "  .$row['email'] ."</p>";
                    echo "<p>Category: "  .$row['category'] ."</p>";
                    echo "<p>Event type: "  .$row['type'] ."</p>";
                    // echo "</div>";
                    echo "<p align=center> _________________________________________________________________ </p>";
                    echo "<br><br><br><br><br>";
                }
            }

			

//    echo "<form action='".setComments($conn)."' method='POST'>
   echo "<form action='postComment.inc.php' method='POST'>
        <p style='text-align: center'> Comment </p>
        // <input type='hidden' name='u_id' value='Anonymous'>
        <input type='hidden' name='e_id' value='" .$name. "'>
        <textarea style='background-color:white; width=100%' name='comment' placeholder='Comment on Event'></textarea>
        <br><br><br>
        <button type='submit' name='submit-comment'>Comment</button>
        <br><br><br>
    </form>";
?>
</div>
<br><br><br>

<div class='comment-screen'>
<br><br><br>
<?php
	getComments($conn);
?>
</div>


<?php
	include_once 'footer.html';
?>
